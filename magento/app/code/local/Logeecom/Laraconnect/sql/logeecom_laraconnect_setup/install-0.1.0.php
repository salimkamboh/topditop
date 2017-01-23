<?php
$this->startSetup();

/**
 * Note: there are many ways in Magento to achieve the same result of
 * creating a database table. For this tutorial, we have gone with the
 * Varien_Db_Ddl_Table method, but feel free to explore what Magento
 * does in CE 1.8.0.0 and earlier versions.
 */
$table = new Varien_Db_Ddl_Table();

/**
 * This is an alias of the real name of our database table, which is
 * configured in config.xml. By using an alias, we can refer to the same
 * table throughout our code if we wish, and if the table name ever has
 * to change, we can simply update a single location, config.xml
 * - logeecom_laraconnect is the model alias
 * - storeentity is the table reference
 */
$table->setName($this->getTable('logeecom_laraconnect/storeentity'));

/**
 * Add the columns we need for now. If you need more later, you can
 * always create a new setup script as an upgrade. We will introduce
 * that later in this tutorial.
 */
$table->addColumn(
    'entity_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true
    )
);

$table->addColumn(
    'created_at',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false,
    )
);

$table->addColumn(
    'updated_at',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false,
    )
);

$table->addColumn(
    'name',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array(
        'nullable' => false,
    )
);

$table->addColumn(
    'storeowner',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array(
        'nullable' => false,
    )
);

$table->addColumn(
    'chosenstore',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'nullable' => false,
    )
);

/**
 * These two important lines are often missed.
 */
$table->setOption('type', 'InnoDB');
$table->setOption('charset', 'utf8');

/**
 * Create the table!
 */
$this->getConnection()->createTable($table);

$this->endSetup();