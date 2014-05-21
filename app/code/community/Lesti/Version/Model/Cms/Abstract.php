<?php

class Lesti_Version_Model_Cms_Abstract extends Mage_Core_Model_Abstract
{

    public function createVersion( $entity )
    {
        //$data = $entity->getData();
        $versionData = array();
        $versionData['content'] = $entity->getContent(); //$data['content'];
        $versionData['parent_id'] = $entity->getId(); //$data['block_id'];
        $versionData['creation_time'] = $entity->getUpdateTime(); //$data['update_time'];
        $versionData['user_id'] = Mage::getSingleton('admin/session')->getUser()->getId();
        $this->setData($versionData);
        $this->save();
        return $this;
    }

}
