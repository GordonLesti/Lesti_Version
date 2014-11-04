<?php
/**
 * Lesti_Version (http:gordonlesti.com/lestiversion)
 *
 * PHP version 5
 *
 * @link      https://github.com/GordonLesti/Lesti_Version
 * @package   Lesti_Fpc
 * @author    Gordon Lesti <info@gordonlesti.com>
 * @copyright Copyright (c) 2013-2014 Gordon Lesti (http://gordonlesti.com)
 * @license   http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

/**
 * Class Lesti_Version_Helper_Data
 */
class Lesti_Version_Helper_Data extends Mage_Core_Helper_Abstract
{
    const GREEN_PLACEHOLDER_BEGIN =
        '<div style="background-color: lightgreen; height: 100%;">';
    const GREEN_PLACEHOLDER_END = '</div>';
    const RED_PLACEHOLDER_BEGIN =
        '<div style="background-color: lightpink; height: 100%;">';
    const RED_PLACEHOLDER_END = '</div>';

    /**
     * @param $contentA
     * @param $contentB
     * @return string
     */
    public function renderDiff($contentA, $contentB)
    {
        $hash = array();
        $arrayA = explode("\n", $contentA);
        $arrayB = explode("\n", $contentB);
        foreach ($arrayA as $key => $line) {
            $sha = sha1($line);
            $hash[$sha] = htmlentities($line);
            $arrayA[$key] = $sha;
        }
        foreach ($arrayB as $key => $line) {
            $sha = sha1($line);
            $hash[$sha] = htmlentities($line);
            $array2[$key] = $sha;
        }
        $diff = $this->diff($arrayA, $arrayB);
        $html = '<tr><td>'.$this->__('Old Version').'</td><td>'.
            $this->__('New Verison').'</td></tr>';
        $tempDiffA = array();
        $tempDiffB = array();
        for ($i = 0; $i < count($diff[0]); $i++) {
            $lineA = $diff[0][$i];
            $lineB = $diff[1][$i];
            if ($lineA !== $lineB) {
                if ($lineA !== false) {
                    $tempDiffA[] = $lineA;
                }
                if ($lineB !== false) {
                    $tempDiffB[] = $lineB;
                }
            } else {
                if (count($tempDiffA) || count($tempDiffB)) {
                    for ($j = 0; $j < max(count($tempDiffA), count($tempDiffB)); $j++) {
                        $html .= '<tr>';
                        if (isset($tempDiffA[$j])) {
                            $html .= '<td style="background-color: lightpink;">'.$hash[$tempDiffA[$j]].'</td>';
                        } else {
                            $html .= '<td></td>';
                        }
                        if (isset($tempDiffB[$j])) {
                            $html .= '<td style="background-color: lightgreen;">'.$hash[$tempDiffB[$j]].'</td>';
                        } else {
                            $html .= '<td></td>';
                        }
                        $html .= '</tr>';
                    }
                    $tempDiffA = array();
                    $tempDiffB = array();
                }
                $html .= '<tr>';
                $html .= '<td>'.$hash[$lineA].'</td>';
                $html .= '<td>'.$hash[$lineB].'</td>';
                $html .= '</tr>';
            }
        }
        return $html;
    }

    /**
     * @param array $arrayA
     * @param array $arrayB
     * @return array
     */
    protected function diff(array $arrayA, array $arrayB)
    {
        $matrix = array();
        $n = count($arrayA);
        $m = count($arrayB);
        $outA = array();
        $outB = array();
        for ($i = 0; $i < $n; $i++) {
            $matrix[$i] = array();
            for ($j = 0; $j < $m; $j++) {
                $max = 0;
                $canAdd = true;
                if ($i > 0) {
                    if ($matrix[$i-1][$j] > $max) {
                        $max = $matrix[$i-1][$j];
                        $canAdd = false;
                    }
                }
                if ($j > 0) {
                    if ($matrix[$i][$j-1] > $max) {
                        $max = $matrix[$i][$j-1];
                        $canAdd = false;
                    }
                }
                if ($i > 0 && $j > 0) {
                    if ($matrix[$i-1][$j-1] >= $max) {
                        $max = $matrix[$i-1][$j-1];
                        $canAdd = true;
                    }
                }
                if ($arrayA[$i] == $arrayB[$j] && $canAdd)
                    $max++;
                $matrix[$i][$j] = $max;
            }
        }

        $i = $n-1;
        $j = $m-1;
        while ($i >= 0 && $j >= 0) {
            $dir = 1;
            $max = 0;
            if ($i > 0) {
                if ($matrix[$i-1][$j] >= $max) {
                    $max = $matrix[$i-1][$j];
                    $dir = 2;
                }
            }
            if ($j > 0) {
                if ($matrix[$i][$j-1] >= $max) {
                    $max = $matrix[$i][$j-1];
                    $dir = 3;
                }
            }
            if ($i > 0 && $j > 0) {
                if ($matrix[$i-1][$j-1] >= $max) {
                    $max = $matrix[$i-1][$j-1];
                    $dir = 1;
                }
            }
            switch ($dir) {
                case 1:
                    if ($max != $matrix[$i][$j]) {
                        $outA[] = $arrayA[$i];
                        $outB[] = $arrayB[$j];
                    } else {
                        $outA[] = $arrayA[$i];
                        $outB[] = false;
                        $outA[] = false;
                        $outB[] = $arrayB[$j];
                    }
                    $i--;
                    $j--;
                    break;
                case 2:
                    if ($max != $matrix[$i][$j]) {
                        $outA[] = $arrayA[$i];
                        $outB[] = $arrayB[$j];
                        while ($i > 0) {
                            $i--;
                            $outA[] = $arrayA[$i];
                            $outB[] = false;
                        }
                    } else {
                        $outA[] = $arrayA[$i];
                        $outB[] = false;
                    }
                    $i--;
                    break;
                case 3:
                    if ($max != $matrix[$i][$j]) {
                        $outA[] = $arrayA[$i];
                        $outB[] = $arrayB[$j];
                        while($j > 0) {
                            $j--;
                            $outA[] = false;
                            $outB[] = $arrayB[$j];
                        }
                    } else {
                        $outA[] = false;
                        $outB[] = $arrayB[$j];
                    }
                    $j--;
                    break;
            }
        }

        return array(array_reverse($outA), array_reverse($outB));
    }
}