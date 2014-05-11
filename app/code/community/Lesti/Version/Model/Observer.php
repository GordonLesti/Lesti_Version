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
 * Class Lesti_Version_Model_Observer
 */
class Lesti_Version_Model_Observer
{

    public function cmsPageSaveCommitAfter($observer)
    {
        $page = $observer->getEvent()->getObject();
        $version = Mage::getModel('version/cms_page');
        $version->createVersion($page);
    }

    public function coreAbstractSaveAfter($observer)
    {
        $object = $observer->getEvent()->getObject();
        if($object instanceof Mage_Cms_Model_Block) {
            $version = Mage::getModel('version/cms_block');
            $version->createVersion($object);
        }
    }

}