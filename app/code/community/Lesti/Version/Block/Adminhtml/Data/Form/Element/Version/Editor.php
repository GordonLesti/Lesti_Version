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
 * Class Lesti_Version_Block_Adminhtml_Data_Form_Element_Version_Editor
 */
class Lesti_Version_Block_Adminhtml_Data_Form_Element_Version_Editor extends
    Varien_Data_Form_Element_Abstract
{
    /**
     * @param array $attributes
     */
    public function __construct($attributes=array())
    {
        parent::__construct($attributes);
        $this->setType('version_editor');
        $this->setTemplate('version/'.$attributes['version_type'].'.phtml');
    }

    /**
     * Generates element html
     *
     * @return string
     */
    public function getElementHtml()
    {
        $html = $this->getBeforeElementHtml();
        $html .= '<table id="version_table" style="width:100%;">';
        $html .= $this->getDiff();
        $html .= '</table>';
        $html .= $this->getAfterElementHtml();
        return $html;
    }
}
