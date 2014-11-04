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
 * Class Lesti_Version_Adminhtml_Version_RestoreController
 */
class Lesti_Version_Adminhtml_Version_RestoreController extends
    Mage_Adminhtml_Controller_Action
{
    /**
     * @throws Exception
     */
    public function cmspageAction()
    {
        $id = Mage::app()->getRequest()->getParam('id');
        if ($id) {
            $id = (int) $id;
            $version = Mage::getModel('version/cms_page')->load($id);
            if ($version->getId()) {
                $pageId = (int) $version->getParentId();
                if ($pageId) {
                    $page = Mage::getModel('cms/page')->load($pageId);
                    if ($page->getId()) {
                        $page->setContent($version->getContent());
                        $page->save();
                        Mage::getSingleton('adminhtml/session')->addSuccess(
                            Mage::helper('version')
                                ->__('Version has been restored.')
                        );
                        $this->_redirect(
                            'adminhtml/cms_page/edit',
                            array('page_id' => $pageId)
                        );
                        return;
                    }
                }
            }
        }

        $this->_redirect('adminhtml/cms_page/edit');
    }

    /**
     * @throws Exception
     */
    public function cmsblockAction()
    {
        $id = Mage::app()->getRequest()->getParam('id');
        if ($id) {
            $id = (int) $id;
            $version = Mage::getModel('version/cms_block')->load($id);
            if ($version->getId()) {
                $blockId = (int) $version->getParentId();
                if ($blockId) {
                    $block = Mage::getModel('cms/block')->load($blockId);
                    if ($block->getId()) {
                        $block->setContent($version->getContent());
                        $block->save();
                        Mage::getSingleton('adminhtml/session')->addSuccess(
                            Mage::helper('version')
                                ->__('Version has been restored.')
                        );
                        $this->_redirect(
                            'adminhtml/cms_block/edit',
                            array('block_id' => $blockId)
                        );
                        return;
                    }
                }
            }
        }
        $this->_redirect('adminhtml/cms_block/edit');
    }
}
