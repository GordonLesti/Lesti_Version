<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 19.05.13
 * Time: 21:27
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Version_Model_Cms_Page extends Lesti_Version_Model_Cms_Abstract
{

    const CACHE_TAG              = 'cms_page';
    protected $_cacheTag         = 'cms_page';
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'version_cms_page';

    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('version/cms_page');
    }

}
