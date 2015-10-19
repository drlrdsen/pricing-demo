<?php

namespace Propel\Map;

use Propel\SpyRefund;
use Propel\SpyRefundQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'spy_refund' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SpyRefundTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Propel.Map.SpyRefundTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'spy_refund';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Propel\\SpyRefund';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'src.Propel.SpyRefund';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id_refund field
     */
    const COL_ID_REFUND = 'spy_refund.id_refund';

    /**
     * the column name for the fk_sales_order field
     */
    const COL_FK_SALES_ORDER = 'spy_refund.fk_sales_order';

    /**
     * the column name for the amount field
     */
    const COL_AMOUNT = 'spy_refund.amount';

    /**
     * the column name for the adjustment_fee field
     */
    const COL_ADJUSTMENT_FEE = 'spy_refund.adjustment_fee';

    /**
     * the column name for the comment field
     */
    const COL_COMMENT = 'spy_refund.comment';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'spy_refund.created_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('IdRefund', 'FkSalesOrder', 'Amount', 'AdjustmentFee', 'Comment', 'CreatedAt', ),
        self::TYPE_CAMELNAME     => array('idRefund', 'fkSalesOrder', 'amount', 'adjustmentFee', 'comment', 'createdAt', ),
        self::TYPE_COLNAME       => array(SpyRefundTableMap::COL_ID_REFUND, SpyRefundTableMap::COL_FK_SALES_ORDER, SpyRefundTableMap::COL_AMOUNT, SpyRefundTableMap::COL_ADJUSTMENT_FEE, SpyRefundTableMap::COL_COMMENT, SpyRefundTableMap::COL_CREATED_AT, ),
        self::TYPE_FIELDNAME     => array('id_refund', 'fk_sales_order', 'amount', 'adjustment_fee', 'comment', 'created_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdRefund' => 0, 'FkSalesOrder' => 1, 'Amount' => 2, 'AdjustmentFee' => 3, 'Comment' => 4, 'CreatedAt' => 5, ),
        self::TYPE_CAMELNAME     => array('idRefund' => 0, 'fkSalesOrder' => 1, 'amount' => 2, 'adjustmentFee' => 3, 'comment' => 4, 'createdAt' => 5, ),
        self::TYPE_COLNAME       => array(SpyRefundTableMap::COL_ID_REFUND => 0, SpyRefundTableMap::COL_FK_SALES_ORDER => 1, SpyRefundTableMap::COL_AMOUNT => 2, SpyRefundTableMap::COL_ADJUSTMENT_FEE => 3, SpyRefundTableMap::COL_COMMENT => 4, SpyRefundTableMap::COL_CREATED_AT => 5, ),
        self::TYPE_FIELDNAME     => array('id_refund' => 0, 'fk_sales_order' => 1, 'amount' => 2, 'adjustment_fee' => 3, 'comment' => 4, 'created_at' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('spy_refund');
        $this->setPhpName('SpyRefund');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Propel\\SpyRefund');
        $this->setPackage('src.Propel');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_refund_pk_seq');
        // columns
        $this->addPrimaryKey('id_refund', 'IdRefund', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_order', 'FkSalesOrder', 'INTEGER', 'spy_sales_order', 'id_sales_order', true, null, null);
        $this->addColumn('amount', 'Amount', 'INTEGER', true, null, null);
        $this->addColumn('adjustment_fee', 'AdjustmentFee', 'INTEGER', false, null, null);
        $this->addColumn('comment', 'Comment', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SpySalesOrder', '\\Propel\\SpySalesOrder', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order',
    1 => ':id_sales_order',
  ),
), null, null, null, false);
        $this->addRelation('SpySalesOrderItem', '\\Propel\\SpySalesOrderItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_refund',
    1 => ':id_refund',
  ),
), null, null, 'SpySalesOrderItems', false);
        $this->addRelation('SpySalesExpense', '\\Propel\\SpySalesExpense', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_refund',
    1 => ':id_refund',
  ),
), null, null, 'SpySalesExpenses', false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'true', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdRefund', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdRefund', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdRefund', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? SpyRefundTableMap::CLASS_DEFAULT : SpyRefundTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (SpyRefund object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SpyRefundTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyRefundTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyRefundTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyRefundTableMap::OM_CLASS;
            /** @var SpyRefund $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyRefundTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SpyRefundTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyRefundTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyRefund $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyRefundTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SpyRefundTableMap::COL_ID_REFUND);
            $criteria->addSelectColumn(SpyRefundTableMap::COL_FK_SALES_ORDER);
            $criteria->addSelectColumn(SpyRefundTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(SpyRefundTableMap::COL_ADJUSTMENT_FEE);
            $criteria->addSelectColumn(SpyRefundTableMap::COL_COMMENT);
            $criteria->addSelectColumn(SpyRefundTableMap::COL_CREATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_refund');
            $criteria->addSelectColumn($alias . '.fk_sales_order');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.adjustment_fee');
            $criteria->addSelectColumn($alias . '.comment');
            $criteria->addSelectColumn($alias . '.created_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(SpyRefundTableMap::DATABASE_NAME)->getTable(SpyRefundTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SpyRefundTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SpyRefundTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SpyRefundTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SpyRefund or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SpyRefund object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyRefundTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Propel\SpyRefund) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyRefundTableMap::DATABASE_NAME);
            $criteria->add(SpyRefundTableMap::COL_ID_REFUND, (array) $values, Criteria::IN);
        }

        $query = SpyRefundQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyRefundTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyRefundTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_refund table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SpyRefundQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyRefund or Criteria object.
     *
     * @param mixed               $criteria Criteria or SpyRefund object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyRefundTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyRefund object
        }

        if ($criteria->containsKey(SpyRefundTableMap::COL_ID_REFUND) && $criteria->keyContainsValue(SpyRefundTableMap::COL_ID_REFUND) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyRefundTableMap::COL_ID_REFUND.')');
        }


        // Set the correct dbName
        $query = SpyRefundQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SpyRefundTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SpyRefundTableMap::buildTableMap();
