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