<?php

class Lesti_Version_Helper_Adminblock
{
    /**
     * @param $object Mage_Core_Block_Abstract parentObject
     * @return mixed
     */
    public function buildLayout($object)
    {
        $form = new Varien_Data_Form();

        $allowedTypes = array('Block', 'Page');
        $type = $object->getType();

        if ( !in_array($type, $allowedTypes) )
        {
            throw new Exception('Unknown parentObject Type');
        }

        $form->setHtmlIdPrefix('version_'.strtolower($type).'_');

        $layoutFieldset = $form->addFieldset('layout_fieldset', array(
            'legend' => Mage::helper('cms')->__($type.' Versions'),
            'class'  => 'fieldset-wide'
        ));

        $layoutFieldset->addType('version', 'Lesti_Version_Block_Adminhtml_Data_Form_Element_Version');
        $layoutFieldset->addType('version_editor', 'Lesti_Version_Block_Adminhtml_Data_Form_Element_Version_Editor');
        $layoutFieldset->addType('version_ajax', 'Lesti_Version_Block_Adminhtml_Data_Form_Element_Version_Ajax');

        $collection = $this->_getVersionCollection();
        $diff = array('', '');
        $old = 0;
        $new = 0;
        $firstItem = $collection->getFirstItem();
        if(isset($firstItem)) {
            $content = $firstItem->getContent();
            $diff = Mage::helper('version')->renderDiff($content, $content);
            $old = $firstItem->getVersionId();
            $new = $firstItem->getVersionId();
        }
        $layoutFieldset->addField('version_editor', 'version_editor', array(
            'name'     => 'version_editor',
            'label'    => '',
            'diff'     => $diff,
            'version_type' => 'cms/'.strtolower($type)
        ));

        $layoutFieldset->addField('version_ajax', 'version_ajax', array(
            'name'     => 'version_ajax',
            'label'    => '',
            'old'      => $old,
            'new'      => $new,
            'version_type' => 'cms/'.strtolower($type)
        ));

        $i = 0;
        foreach($collection as $version) {
            $checked = $i == 0;
            $layoutFieldset->addField('version_'.$version->getId(), 'version', array(
                'name'     => 'version_'.$version->getId(),
                'label'    => $this->_getAdminUser($version->getUserId())->getUsername(),
                'version'  => $version,
                'checked'  => $checked,
                'version_type' => 'cms'.strtolower($type)
            ));
            $i++;
        }

        switch ( $type )
        {
            case 'Block': Mage::dispatchEvent('adminhtml_cms_block_edit_design_prepare_form', array('form' => $form));
                break;
            case 'Page': Mage::dispatchEvent('adminhtml_cms_page_edit_tab_design_prepare_form', array('form' => $form));
                break;
        }


        $this->setForm($form);

        return parent::_prepareForm();
    }

}
