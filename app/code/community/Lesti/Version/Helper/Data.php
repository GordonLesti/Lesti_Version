<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 19.05.13
 * Time: 22:08
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Version_Helper_Data extends Mage_Core_Helper_Abstract
{
    const GREEN_PLACEHOLDER_BEGIN = '<div style="background-color: lightgreen; height: 100%;">';
    const GREEN_PLACEHOLDER_END = '</div>';
    const RED_PLACEHOLDER_BEGIN = '<div style="background-color: lightpink; height: 100%;">';
    const RED_PLACEHOLDER_END = '</div>';

    public function renderDiff($content1, $content2)
    {
        $hash = array();
        $array1 = explode("\n", $content1);
        $array2 = explode("\n", $content2);
        foreach($array1 as $key => $line) {
            $sha1 = sha1($line);
            $hash[$sha1] = htmlentities($line);
            $array1[$key] = $sha1;
        }
        foreach($array2 as $key => $line) {
            $sha1 = sha1($line);
            $hash[$sha1] = htmlentities($line);
            $array2[$key] = $sha1;
        }
        $content1 = '';
        $content2 = '';
        $diff = $this->diff($array1, $array2);
        $html = '<tr><td>'.$this->__('Old Version').'</td><td>'.$this->__('New Version').'</td></tr>';
        $tempDiff1 = array();
        $tempDiff2 = array();
        for($i = 0; $i < count($diff[0]); $i++) {
            $line1 = $diff[0][$i];
            $line2 = $diff[1][$i];
            if($line1 !== $line2) {
                if($line1 !== false) {
                    $tempDiff1[] = $line1;
                }
                if($line2 !== false) {
                    $tempDiff2[] = $line2;
                }
            } else {
                if(count($tempDiff1) || count($tempDiff2)) {
                    for($j = 0; $j < max(count($tempDiff1), count($tempDiff2)); $j++) {
                        $html .= '<tr>';
                        if(isset($tempDiff1[$j])) {
                            $html .= '<td style="background-color: lightpink;">'.$hash[$tempDiff1[$j]].'</td>';
                        } else {
                            $html .= '<td></td>';
                        }
                        if(isset($tempDiff2[$j])) {
                            $html .= '<td style="background-color: lightgreen;">'.$hash[$tempDiff2[$j]].'</td>';
                        } else {
                            $html .= '<td></td>';
                        }
                        $html .= '</tr>';
                    }
                    $tempDiff1 = array();
                    $tempDiff2 = array();
                }
                $html .= '<tr>';
                $html .= '<td>'.$hash[$line1].'</td>';
                $html .= '<td>'.$hash[$line2].'</td>';
                $html .= '</tr>';
            }
        }
        return $html;
    }

    private function diff(array $array1, array $array2)
    {
        $matrix = array();
        $n = count($array1);
        $m = count($array2);
        $out1 = array();
        $out2 = array();
        for($i = 0; $i < $n; $i++) {
            $matrix[$i] = array();
            for($j = 0; $j < $m; $j++) {
                $max = 0;
                $canAdd = true;
                if($i > 0) {
                    if($matrix[$i-1][$j] > $max) {
                        $max = $matrix[$i-1][$j];
                        $canAdd = false;
                    }
                }
                if($j > 0) {
                    if($matrix[$i][$j-1] > $max) {
                        $max = $matrix[$i][$j-1];
                        $canAdd = false;
                    }
                }
                if($i > 0 && $j > 0) {
                    if($matrix[$i-1][$j-1] >= $max) {
                        $max = $matrix[$i-1][$j-1];
                        $canAdd = true;
                    }
                }
                if($array1[$i] == $array2[$j] && $canAdd)
                    $max++;
                $matrix[$i][$j] = $max;
            }
        }

        $i = $n-1;
        $j = $m-1;
        while($i >= 0 && $j >= 0) {
            $dir = 1;
            $max = 0;
            if($i > 0) {
                if($matrix[$i-1][$j] >= $max) {
                    $max = $matrix[$i-1][$j];
                    $dir = 2;
                }
            }
            if($j > 0) {
                if($matrix[$i][$j-1] >= $max) {
                    $max = $matrix[$i][$j-1];
                    $dir = 3;
                }
            }
            if($i > 0 && $j > 0) {
                if($matrix[$i-1][$j-1] >= $max) {
                    $max = $matrix[$i-1][$j-1];
                    $dir = 1;
                }
            }
            switch($dir) {
                case 1:
                    if($max != $matrix[$i][$j]) {
                        $out1[] = $array1[$i];
                        $out2[] = $array2[$j];
                    } else {
                        $out1[] = $array1[$i];
                        $out2[] = false;
                        $out1[] = false;
                        $out2[] = $array2[$j];
                    }
                    $i--;
                    $j--;
                    break;
                case 2:
                    if($max != $matrix[$i][$j]) {
                        $out1[] = $array1[$i];
                        $out2[] = $array2[$j];
                        while($i > 0) {
                            $i--;
                            $out1[] = $array1[$i];
                            $out2[] = false;
                        }
                    } else {
                        $out1[] = $array1[$i];
                        $out2[] = false;
                    }
                    $i--;
                    break;
                case 3:
                    if($max != $matrix[$i][$j]) {
                        $out1[] = $array1[$i];
                        $out2[] = $array2[$j];
                        while($j > 0) {
                            $j--;
                            $out1[] = false;
                            $out2[] = $array2[$j];
                        }
                    } else {
                        $out1[] = false;
                        $out2[] = $array2[$j];
                    }
                    $j--;
                    break;
            }
        }

        return array(array_reverse($out1), array_reverse($out2));
    }

    private function stringToArray($string)
    {
        $array = array();
        for($i = 0; $i < strlen($string); $i++) {
            $array[] = $string[$i];
        }
        return $array;
    }

}
