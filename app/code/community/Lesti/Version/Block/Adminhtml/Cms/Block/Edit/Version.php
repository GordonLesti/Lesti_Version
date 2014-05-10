<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 17.06.13
 * Time: 21:42
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Version_Block_Adminhtml_Cms_Block_Edit_Version extends Mage_Adminhtml_Block_Widget_Form
{
    protected $_users = array();

    public function __construct()
    {
        parent::__construct();
    }

    protected function _prepareForm()
    {
        return Mage::helper('version/adminhtml')->buildLayout($this);
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

}
