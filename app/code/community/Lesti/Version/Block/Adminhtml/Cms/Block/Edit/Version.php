<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 17.06.13
 * Time: 21:42
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Version_Block_Adminhtml_Cms_Block_Edit_Version
    extends Mage_Adminhtml_Block_Widget_Form
    implements Lesti_Version_Block_Adminhtml_Interface_Adminblock
{
    protected $_users = array();

    protected $type = 'Block';

    public function __construct()
    {
        parent::__construct();
    }

    protected function _prepareForm()
    {

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('version_block_');

        $model = Mage::registry('cms_block');

        $layoutFieldset = $form->addFieldset('layout_fieldset', array(
            'legend' => Mage::helper('cms')->__('Block Versions'),
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
            'version_type' => 'cms/block'
        ));

        $layoutFieldset->addField('version_ajax', 'version_ajax', array(
            'name'     => 'version_ajax',
            'label'    => '',
            'old'      => $old,
            'new'      => $new,
            'version_type' => 'cms/block'
        ));

        $i = 0;
        foreach($collection as $version) {
            $checked = $i == 0;
            $layoutFieldset->addField('version_'.$version->getId(), 'version', array(
                'name'     => 'version_'.$version->getId(),
                'label'    => $this->_getAdminUser($version->getUserId())->getUsername(),
                'version'  => $version,
                'checked'  => $checked,
                'version_type' => 'cmsblock'
            ));
            $i++;
        }

        Mage::dispatchEvent('adminhtml_cms_block_edit_design_prepare_form', array('form' => $form));

        $this->setForm($form);

        return parent::_prepareForm();
    }

    protected function _getVersionCollection()
    {
        /** @var $model Mage_Cms_Model_Block */
        $model = Mage::registry('cms_block');
        $collection = Mage::getModel('version/cms_block')->getCollection()
            ->addFieldToFilter('parent_id', array('eq' => $model->getId()))
            ->setOrder('creation_time', 'desc');
        return $collection;
    }

    protected function _getAdminUser($userId)
    {
        $userId = (int) $userId;
        if(!isset($this->_users[$userId])) {
            $this->_users[$userId] = Mage::getModel('admin/user')->load($userId);
        }
        return $this->_users[$userId];
    }

    /**
     * @see Lesti_Version_Block_Adminhtml_Interface_Adminblock
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

}