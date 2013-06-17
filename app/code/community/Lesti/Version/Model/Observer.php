<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 19.05.13
 * Time: 21:20
 * To change this template use File | Settings | File Templates.
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