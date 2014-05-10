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

    protected $type = 'Page';

    public function __construct()
    {
        parent::__construct();
    }

    protected function _prepareForm()
    {
        Mage::helper('version/adminblock')->buildLayout($this);

        return parent::_prepareForm();
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
            ->addFieldToFilter('parent_id', array('eq' => $model->getId()))
            ->setOrder('creation_time', 'desc');
        return $collection;
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