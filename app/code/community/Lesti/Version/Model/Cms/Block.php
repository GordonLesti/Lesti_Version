<?php
/**
 * Lesti_Version (http:gordonlesti.com/lestiversion)
 *
 * PHP version 5
 *
 * @link      https://github.com/GordonLesti/Lesti_Version
 * @package   Lesti_Fpc
 * @author    Gordon Lesti <info@gordonlesti.com>
 * @copyright Copyright (c) 2013-2014 Gordon Lesti (http://gordonlesti.com)
 * @license   http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

/**
 * Class Lesti_Version_Model_Cms_Block
 */
class Lesti_Version_Model_Cms_Block extends Mage_Core_Model_Abstract
{
    const CACHE_TAG              = 'cms_block';

    /**
     * @var string
     */
    protected $_cacheTag         = 'cms_block';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'version_cms_block';

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('version/cms_block');
    }

    /**
     * @param Mage_Cms_Model_Block $block
     * @return $this
     * @throws Exception
     */
    public function createVersion(Mage_Cms_Model_Block $block)
    {
        $data = $block->getData();
        $versionData = array();
        $versionData['content'] = $data['content'];
        $versionData['parent_id'] = $data['block_id'];
        $versionData['creation_time'] = $data['update_time'];
        $versionData['user_id'] = Mage::getSingleton('admin/session')
            ->getUser()->getId();
        $this->setData($versionData);
        $this->save();
        return $this;
    }
}
