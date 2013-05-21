<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 19.05.13
 * Time: 21:04
 * To change this template use File | Settings | File Templates.
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