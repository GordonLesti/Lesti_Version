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
 * Class Lesti_Version_Adminhtml_Version_DiffController
 */
class Lesti_Version_Adminhtml_Version_DiffController extends Mage_Adminhtml_Controller_Action
{

    public function cmspageAction()
    {
        if(Mage::app()->getRequest()->isAjax()) {
            $old = (int) Mage::app()->getRequest()->getParam('old');
            $new = (int) Mage::app()->getRequest()->getParam('new');
            $old = Mage::getModel('version/cms_page')->load($old);
            $new = Mage::getModel('version/cms_page')->load($new);
            $diff = Mage::helper('version')->renderDiff($old->getContent(), $new->getContent());
            $result = array();
            $result['table'] = $diff;
            $this->getResponse()->setBody(Zend_Json::encode($result));
        }
    }

    public function cmsblockAction()
    {
        if(Mage::app()->getRequest()->isAjax()) {
            $old = (int) Mage::app()->getRequest()->getParam('old');
            $new = (int) Mage::app()->getRequest()->getParam('new');
            $old = Mage::getModel('version/cms_block')->load($old);
            $new = Mage::getModel('version/cms_block')->load($new);
            $diff = Mage::helper('version')->renderDiff($old->getContent(), $new->getContent());
            $result = array();
            $result['table'] = $diff;
            $this->getResponse()->setBody(Zend_Json::encode($result));
        }
    }

}