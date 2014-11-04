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
 * Class Lesti_Version_Model_Resource_Cms_Page_Collection
 */
class Lesti_Version_Model_Resource_Cms_Page_Collection extends
    Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('version/cms_page');
    }
}
