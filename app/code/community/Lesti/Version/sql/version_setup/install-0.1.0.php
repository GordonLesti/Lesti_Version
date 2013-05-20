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
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => true
    ), 'Page Title')
    ->addColumn('root_template', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => true
    ), 'Page Template')
    ->addColumn('meta_keywords', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        'nullable'  => true,
    ), 'Page Meta Keywords')
    ->addColumn('meta_description', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        'nullable'  => true,
    ), 'Page Meta Description')
    ->addColumn('identifier', Varien_Db_Ddl_Table::TYPE_TEXT, 100, array(
        'nullable'  => true,
        'default'   => null,
    ), 'Page String Identifier')
    ->addColumn('content_heading', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => true,
    ), 'Page Content Heading')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, '2M', array(
    ), 'Page Content')
    ->addColumn('creation_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Page Creation Time')
    ->addColumn('sort_order', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'nullable'  => false,
        'default'   => '0',
    ), 'Page Sort Order')
    ->addColumn('layout_update_xml', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        'nullable'  => true,
    ), 'Page Layout Update Content')
    ->addColumn('custom_theme', Varien_Db_Ddl_Table::TYPE_TEXT, 100, array(
        'nullable'  => true,
    ), 'Page Custom Theme')
    ->addColumn('custom_root_template', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => true,
    ), 'Page Custom Template')
    ->addColumn('custom_layout_update_xml', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        'nullable'  => true,
    ), 'Page Custom Layout Update Content')
    ->addColumn('custom_theme_from', Varien_Db_Ddl_Table::TYPE_DATE, null, array(
        'nullable'  => true,
    ), 'Page Custom Theme Active From Date')
    ->addColumn('custom_theme_to', Varien_Db_Ddl_Table::TYPE_DATE, null, array(
        'nullable'  => true,
    ), 'Page Custom Theme Active To Date')
    ->addForeignKey($installer->getFkName('version/cms_page', 'parent_id', 'cms/page', 'page_id'),
        'parent_id', $installer->getTable('cms/page'), 'page_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addIndex($installer->getIdxName('version/cms_page', array('identifier')),
        array('identifier'))
    ->setComment('Version Page Table');
$installer->getConnection()->createTable($table);