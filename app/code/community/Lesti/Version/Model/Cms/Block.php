<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 17.06.13
 * Time: 21:04
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Version_Model_Cms_Block extends Lesti_Version_Model_Cms_Abstract
{

    const CACHE_TAG              = 'cms_block';
    protected $_cacheTag         = 'cms_block';
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'version_cms_block';

    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('version/cms_block');
    }

}
