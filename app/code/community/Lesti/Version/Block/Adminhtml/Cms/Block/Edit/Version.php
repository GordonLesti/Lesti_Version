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
        Mage::helper('version/adminblock')->buildLayout($this);

        return parent::_prepareForm();
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