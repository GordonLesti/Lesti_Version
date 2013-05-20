<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 19.05.13
 * Time: 21:31
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Version_Model_Resource_Cms_Page_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    /**
     * Define resource model
     *
     */
    protected function _construct()
    {
        $this->_init('version/cms_page');
    }

}