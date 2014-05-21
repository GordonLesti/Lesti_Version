<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 20.05.13
 * Time: 10:26
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Version_Block_Adminhtml_Data_Form_Element_Version extends Varien_Data_Form_Element_Abstract
{

    public function __construct($attributes=array())
    {
        parent::__construct($attributes);
        $this->setType('version');
    }

    /**
     * Generates element html
     *
     * @return string
     */
    public function getElementHtml()
    {
        $html = $this->getBeforeElementHtml();
        $html .= '<input class="version_radio" id="old_version_'.$this->getVersion()->getVersionId().
            '" type="radio" name="old_version"';
        $html .= $this->getChecked() ? 'checked' : '';
        $html .='/> '.Mage::helper('version')->__('Old');
        $html .= ' <input class="version_radio" id="new_version_'.$this->getVersion()->getVersionId().
            '" type="radio" name="new_version" ';
        $html .= $this->getChecked() ? 'checked' : '';
        $html .= '/> '.Mage::helper('version')->__('New') . ' ';
        $html .= $this->getVersion()->getCreationTime() . ' <a href="'.
            Mage::helper('adminhtml')->getUrl('adminhtml/version_restore/'.$this->getVersionType(), array('id' => $this->getVersion()->getVersionId())).
            '">' . Mage::helper('version')->__('Restore') . '</a>';
        $html .= $this->getAfterElementHtml();
        return $html;
    }

}