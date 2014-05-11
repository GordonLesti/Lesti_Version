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

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Create table 'version/cms_page'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('version/cms_page'))
    ->addColumn('version_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Version ID')
    ->addColumn('parent_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false
    ), 'Parent Page ID')
    ->addColumn('user_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false
    ), 'Admin User ID')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, '2M', array(
    ), 'Page Content')
    ->addColumn('creation_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Page Creation Time')
    ->addForeignKey($installer->getFkName('version/cms_page', 'parent_id', 'cms/page', 'page_id'),
        'parent_id', $installer->getTable('cms/page'), 'page_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addIndex($installer->getIdxName('version/cms_page', array('version_id')),
        array('version_id'))
    ->setComment('Version Page Table');
$installer->getConnection()->createTable($table);