<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 17.06.13
 * Time: 21:04
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Version_Model_Cms_Block extends Mage_Core_Model_Abstract
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

    public function createVersion(Mage_Cms_Model_Block $block)
    {
        $data = $block->getData();
        $versionData = array();
        $versionData['content'] = $data['content'];
        $versionData['parent_id'] = $data['block_id'];
        $versionData['creation_time'] = $data['update_time'];
        $versionData['user_id'] = Mage::getSingleton('admin/session')->getUser()->getId();
        $this->setData($versionData);
        $this->save();
        return $this;
    }

}