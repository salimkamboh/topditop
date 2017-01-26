<?php

class Logeecom_Laraconnect_Model_Resource_Storeentity
    extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        /**
         * Tell Magento the database name and primary key field to persist
         * data to. Similar to the _construct() of our model, Magento finds
         * this data from config.xml by finding the <resourceModel/> node
         * and locating children of <entities/>.
         *
         * In this example:
         * - logeecom_laraconnect is the model alias
         * - storeentity is the entity referenced in config.xml
         * - entity_id is the name of the primary key column
         *
         * As a result, Magento will write data to the table
         * 'logeecom_laraconnect_storeentity' and any calls
         * to $model->getId() will retrieve the data from the
         * column named 'entity_id'.
         */
        $this->_init('logeecom_laraconnect/storeentity', 'entity_id');
    }
}