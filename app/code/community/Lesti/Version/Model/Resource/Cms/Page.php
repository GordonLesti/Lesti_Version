<?php
/**
 * Lesti_Version
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * http://opensource.org/licenses/OSL-3.0
 *
 * @package      Lesti_Version
 * @copyright    Copyright (c) 2014 Gordon Lesti (http://www.gordonlesti.com)
 * @author       Gordon Lesti <info@gordonlesti.com>
 * @license      http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

/**
 * Class Lesti_Version_Model_Resource_Cms_Page
 */
class Lesti_Version_Model_Resource_Cms_Page extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('version/cms_page', 'version_id');
    }

}