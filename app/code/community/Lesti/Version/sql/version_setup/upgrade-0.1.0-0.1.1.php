<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 17.06.13
 * Time: 21:06
 * To change this template use File | Settings | File Templates.
 */

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Create table 'version/cms_block'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('version/cms_block'))
    ->addColumn('version_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Version ID')
    ->addColumn('parent_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false
    ), 'Parent Block ID')
    ->addColumn('user_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false
    ), 'Admin User ID')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, '2M', array(
    ), 'Block Content')
    ->addColumn('creation_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Block Creation Time')
    ->addForeignKey($installer->getFkName('version/cms_block', 'parent_id', 'cms/block', 'block_id'),
        'parent_id', $installer->getTable('cms/block'), 'block_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addIndex($installer->getIdxName('version/cms_block', array('version_id')),
        array('version_id'))
    ->setComment('Version Block Table');
$installer->getConnection()->createTable($table);