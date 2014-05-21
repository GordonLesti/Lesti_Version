<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 17.06.13
 * Time: 21:08
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Version_Model_Resource_Cms_Block extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('version/cms_block', 'version_id');
    }

}