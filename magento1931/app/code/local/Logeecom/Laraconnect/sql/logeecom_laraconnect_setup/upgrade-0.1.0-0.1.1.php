<?php

$installer = $this;
$installer->startSetup();

$installer->getConnection()->addColumn(
    $installer->getTable('logeecom_laraconnect/storeentity'),
    'chosenpackage',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'nullable' => false,
        'comment' => 'Package Chosen'
    )
);

$this->endSetup();