<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 19.05.13
 * Time: 22:02
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Version_Block_Adminhtml_Cms_Page_Edit_Tab_Version
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    protected $_users = array();

    protected function _prepareForm()
    {

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('page_');

        $model = Mage::registry('cms_page');

        $layoutFieldset = $form->addFieldset('layout_fieldset', array(
            'legend' => Mage::helper('cms')->__('Page Versions'),
            'class'  => 'fieldset-wide'
        ));

        foreach($this->_getVersionCollection() as $version) {
            $layoutFieldset->addField('version_'.$version->getId(), 'link', array(
                'name'     => 'version_'.$version->getId(),
                'label'    => $this->_getAdminUser($version->getUserId())->getUsername(),
                'value'    => $version->getCreationTime(),
                'href'     => Mage::getUrl('adminhtml/version_cms_page/view', array('version_id' => $version->getId()))
            ));
        }

        Mage::dispatchEvent('adminhtml_cms_page_edit_tab_design_prepare_form', array('form' => $form));

        $this->setForm($form);

        return parent::_prepareForm();
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
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('version')->__('Page Versions');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('version')->__('Page Versions');
    }

    /**
     * Returns status flag about this tab can be shown or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }

    protected function _getVersionCollection()
    {
        /** @var $model Mage_Cms_Model_Page */
        $model = Mage::registry('cms_page');
        $collection = Mage::getModel('version/cms_page')->getCollection()
            ->addFieldToFilter('parent_id', array('eq' => $model->getId()));
        return $collection;
    }
}