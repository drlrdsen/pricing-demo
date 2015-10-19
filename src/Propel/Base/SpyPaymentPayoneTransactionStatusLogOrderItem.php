<?php

namespace Propel\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\SpyPaymentPayoneTransactionStatusLog as ChildSpyPaymentPayoneTransactionStatusLog;
use Propel\SpyPaymentPayoneTransactionStatusLogOrderItemQuery as ChildSpyPaymentPayoneTransactionStatusLogOrderItemQuery;
use Propel\SpyPaymentPayoneTransactionStatusLogQuery as ChildSpyPaymentPayoneTransactionStatusLogQuery;
use Propel\SpySalesOrderItem as ChildSpySalesOrderItem;
use Propel\SpySalesOrderItemQuery as ChildSpySalesOrderItemQuery;
use Propel\Map\SpyPaymentPayoneTransactionStatusLogOrderItemTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'spy_payment_payone_transaction_status_log_order_item' table.
 *
 *
 *
* @package    propel.generator.src.Propel.Base
*/
abstract class SpyPaymentPayoneTransactionStatusLogOrderItem extends SpyPaymentPayoneTransactionStatusLogOrderItem implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Propel\\Map\\SpyPaymentPayoneTransactionStatusLogOrderItemTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id_payment_payone_transaction_status_log field.
     * @var        int
     */
    protected $id_payment_payone_transaction_status_log;

    /**
     * The value for the id_sales_order_item field.
     * @var        int
     */
    protected $id_sales_order_item;

    /**
     * The value for the created_at field.
     * @var        \DateTime
     */
    protected $created_at;

    /**
     * @var        ChildSpyPaymentPayoneTransactionStatusLog
     */
    protected $aSpyPaymentPayoneTransactionStatusLog;

    /**
     * @var        ChildSpySalesOrderItem
     */
    protected $aSpySalesOrderItem;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Propel\Base\SpyPaymentPayoneTransactionStatusLogOrderItem object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>SpyPaymentPayoneTransactionStatusLogOrderItem</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyPaymentPayoneTransactionStatusLogOrderItem</code>, delegates to
     * <code>equals(SpyPaymentPayoneTransactionStatusLogOrderItem)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|SpyPaymentPayoneTransactionStatusLogOrderItem The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id_payment_payone_transaction_status_log] column value.
     *
     * @return int
     */
    public function getIdPaymentPayoneTransactionStatusLog()
    {
        return $this->id_payment_payone_transaction_status_log;
    }

    /**
     * Get the [id_sales_order_item] column value.
     *
     * @return int
     */
    public function getIdSalesOrderItem()
    {
        return $this->id_sales_order_item;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTime ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id_payment_payone_transaction_status_log] column.
     *
     * @param int $v new value
     * @return $this|\Propel\SpyPaymentPayoneTransactionStatusLogOrderItem The current object (for fluent API support)
     */
    public function setIdPaymentPayoneTransactionStatusLog($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_payment_payone_transaction_status_log !== $v) {
            $this->id_payment_payone_transaction_status_log = $v;
            $this->modifiedColumns[SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_ID_PAYMENT_PAYONE_TRANSACTION_STATUS_LOG] = true;
        }

        if ($this->aSpyPaymentPayoneTransactionStatusLog !== null && $this->aSpyPaymentPayoneTransactionStatusLog->getIdPaymentPayoneTransactionStatusLog() !== $v) {
            $this->aSpyPaymentPayoneTransactionStatusLog = null;
        }

        return $this;
    } // setIdPaymentPayoneTransactionStatusLog()

    /**
     * Set the value of [id_sales_order_item] column.
     *
     * @param int $v new value
     * @return $this|\Propel\SpyPaymentPayoneTransactionStatusLogOrderItem The current object (for fluent API support)
     */
    public function setIdSalesOrderItem($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_sales_order_item !== $v) {
            $this->id_sales_order_item = $v;
            $this->modifiedColumns[SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_ID_SALES_ORDER_ITEM] = true;
        }

        if ($this->aSpySalesOrderItem !== null && $this->aSpySalesOrderItem->getIdSalesOrderItem() !== $v) {
            $this->aSpySalesOrderItem = null;
        }

        return $this;
    } // setIdSalesOrderItem()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Propel\SpyPaymentPayoneTransactionStatusLogOrderItem The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::translateFieldName('IdPaymentPayoneTransactionStatusLog', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_payment_payone_transaction_status_log = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::translateFieldName('IdSalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_sales_order_item = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Propel\\SpyPaymentPayoneTransactionStatusLogOrderItem'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aSpyPaymentPayoneTransactionStatusLog !== null && $this->id_payment_payone_transaction_status_log !== $this->aSpyPaymentPayoneTransactionStatusLog->getIdPaymentPayoneTransactionStatusLog()) {
            $this->aSpyPaymentPayoneTransactionStatusLog = null;
        }
        if ($this->aSpySalesOrderItem !== null && $this->id_sales_order_item !== $this->aSpySalesOrderItem->getIdSalesOrderItem()) {
            $this->aSpySalesOrderItem = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyPaymentPayoneTransactionStatusLogOrderItemQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyPaymentPayoneTransactionStatusLog = null;
            $this->aSpySalesOrderItem = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see SpyPaymentPayoneTransactionStatusLogOrderItem::setDeleted()
     * @see SpyPaymentPayoneTransactionStatusLogOrderItem::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyPaymentPayoneTransactionStatusLogOrderItemQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aSpyPaymentPayoneTransactionStatusLog !== null) {
                if ($this->aSpyPaymentPayoneTransactionStatusLog->isModified() || $this->aSpyPaymentPayoneTransactionStatusLog->isNew()) {
                    $affectedRows += $this->aSpyPaymentPayoneTransactionStatusLog->save($con);
                }
                $this->setSpyPaymentPayoneTransactionStatusLog($this->aSpyPaymentPayoneTransactionStatusLog);
            }

            if ($this->aSpySalesOrderItem !== null) {
                if ($this->aSpySalesOrderItem->isModified() || $this->aSpySalesOrderItem->isNew()) {
                    $affectedRows += $this->aSpySalesOrderItem->save($con);
                }
                $this->setSpySalesOrderItem($this->aSpySalesOrderItem);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_ID_PAYMENT_PAYONE_TRANSACTION_STATUS_LOG)) {
            $modifiedColumns[':p' . $index++]  = 'id_payment_payone_transaction_status_log';
        }
        if ($this->isColumnModified(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_ID_SALES_ORDER_ITEM)) {
            $modifiedColumns[':p' . $index++]  = 'id_sales_order_item';
        }
        if ($this->isColumnModified(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_payment_payone_transaction_status_log_order_item (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_payment_payone_transaction_status_log':
                        $stmt->bindValue($identifier, $this->id_payment_payone_transaction_status_log, PDO::PARAM_INT);
                        break;
                    case 'id_sales_order_item':
                        $stmt->bindValue($identifier, $this->id_sales_order_item, PDO::PARAM_INT);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_FIELDNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_FIELDNAME)
    {
        $pos = SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdPaymentPayoneTransactionStatusLog();
                break;
            case 1:
                return $this->getIdSalesOrderItem();
                break;
            case 2:
                return $this->getCreatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_FIELDNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_FIELDNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['SpyPaymentPayoneTransactionStatusLogOrderItem'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SpyPaymentPayoneTransactionStatusLogOrderItem'][$this->hashCode()] = true;
        $keys = SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdPaymentPayoneTransactionStatusLog(),
            $keys[1] => $this->getIdSalesOrderItem(),
            $keys[2] => $this->getCreatedAt(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[2]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[2]];
            $result[$keys[2]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSpyPaymentPayoneTransactionStatusLog) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyPaymentPayoneTransactionStatusLog';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_payment_payone_transaction_status_log';
                        break;
                    default:
                        $key = 'SpyPaymentPayoneTransactionStatusLog';
                }

                $result[$key] = $this->aSpyPaymentPayoneTransactionStatusLog->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpySalesOrderItem) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderItem';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_item';
                        break;
                    default:
                        $key = 'SpySalesOrderItem';
                }

                $result[$key] = $this->aSpySalesOrderItem->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_FIELDNAME.
     * @return $this|\Propel\SpyPaymentPayoneTransactionStatusLogOrderItem
     */
    public function setByName($name, $value, $type = TableMap::TYPE_FIELDNAME)
    {
        $pos = SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Propel\SpyPaymentPayoneTransactionStatusLogOrderItem
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdPaymentPayoneTransactionStatusLog($value);
                break;
            case 1:
                $this->setIdSalesOrderItem($value);
                break;
            case 2:
                $this->setCreatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_FIELDNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_FIELDNAME)
    {
        $keys = SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdPaymentPayoneTransactionStatusLog($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdSalesOrderItem($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCreatedAt($arr[$keys[2]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_FIELDNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Propel\SpyPaymentPayoneTransactionStatusLogOrderItem The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_FIELDNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_ID_PAYMENT_PAYONE_TRANSACTION_STATUS_LOG)) {
            $criteria->add(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_ID_PAYMENT_PAYONE_TRANSACTION_STATUS_LOG, $this->id_payment_payone_transaction_status_log);
        }
        if ($this->isColumnModified(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_ID_SALES_ORDER_ITEM)) {
            $criteria->add(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $this->id_sales_order_item);
        }
        if ($this->isColumnModified(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_CREATED_AT, $this->created_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildSpyPaymentPayoneTransactionStatusLogOrderItemQuery::create();
        $criteria->add(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_ID_PAYMENT_PAYONE_TRANSACTION_STATUS_LOG, $this->id_payment_payone_transaction_status_log);
        $criteria->add(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $this->id_sales_order_item);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdPaymentPayoneTransactionStatusLog() &&
            null !== $this->getIdSalesOrderItem();

        $validPrimaryKeyFKs = 2;
        $primaryKeyFKs = [];

        //relation spy_payment_payone_transaction_status_log_order_item_fk_a65732 to table spy_payment_payone_transaction_status_log
        if ($this->aSpyPaymentPayoneTransactionStatusLog && $hash = spl_object_hash($this->aSpyPaymentPayoneTransactionStatusLog)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        //relation spy_payment_payone_transaction_status_log_order_item_fk_b190fc to table spy_sales_order_item
        if ($this->aSpySalesOrderItem && $hash = spl_object_hash($this->aSpySalesOrderItem)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getIdPaymentPayoneTransactionStatusLog();
        $pks[1] = $this->getIdSalesOrderItem();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param      array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setIdPaymentPayoneTransactionStatusLog($keys[0]);
        $this->setIdSalesOrderItem($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getIdPaymentPayoneTransactionStatusLog()) && (null === $this->getIdSalesOrderItem());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Propel\SpyPaymentPayoneTransactionStatusLogOrderItem (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdPaymentPayoneTransactionStatusLog($this->getIdPaymentPayoneTransactionStatusLog());
        $copyObj->setIdSalesOrderItem($this->getIdSalesOrderItem());
        $copyObj->setCreatedAt($this->getCreatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Propel\SpyPaymentPayoneTransactionStatusLogOrderItem Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildSpyPaymentPayoneTransactionStatusLog object.
     *
     * @param  ChildSpyPaymentPayoneTransactionStatusLog $v
     * @return $this|\Propel\SpyPaymentPayoneTransactionStatusLogOrderItem The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSpyPaymentPayoneTransactionStatusLog(ChildSpyPaymentPayoneTransactionStatusLog $v = null)
    {
        if ($v === null) {
            $this->setIdPaymentPayoneTransactionStatusLog(NULL);
        } else {
            $this->setIdPaymentPayoneTransactionStatusLog($v->getIdPaymentPayoneTransactionStatusLog());
        }

        $this->aSpyPaymentPayoneTransactionStatusLog = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyPaymentPayoneTransactionStatusLog object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyPaymentPayoneTransactionStatusLogOrderItem($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyPaymentPayoneTransactionStatusLog object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSpyPaymentPayoneTransactionStatusLog The associated ChildSpyPaymentPayoneTransactionStatusLog object.
     * @throws PropelException
     */
    public function getSpyPaymentPayoneTransactionStatusLog(ConnectionInterface $con = null)
    {
        if ($this->aSpyPaymentPayoneTransactionStatusLog === null && ($this->id_payment_payone_transaction_status_log !== null)) {
            $this->aSpyPaymentPayoneTransactionStatusLog = ChildSpyPaymentPayoneTransactionStatusLogQuery::create()->findPk($this->id_payment_payone_transaction_status_log, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyPaymentPayoneTransactionStatusLog->addSpyPaymentPayoneTransactionStatusLogOrderItems($this);
             */
        }

        return $this->aSpyPaymentPayoneTransactionStatusLog;
    }

    /**
     * Declares an association between this object and a ChildSpySalesOrderItem object.
     *
     * @param  ChildSpySalesOrderItem $v
     * @return $this|\Propel\SpyPaymentPayoneTransactionStatusLogOrderItem The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSpySalesOrderItem(ChildSpySalesOrderItem $v = null)
    {
        if ($v === null) {
            $this->setIdSalesOrderItem(NULL);
        } else {
            $this->setIdSalesOrderItem($v->getIdSalesOrderItem());
        }

        $this->aSpySalesOrderItem = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpySalesOrderItem object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyPaymentPayoneTransactionStatusLogOrderItem($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpySalesOrderItem object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSpySalesOrderItem The associated ChildSpySalesOrderItem object.
     * @throws PropelException
     */
    public function getSpySalesOrderItem(ConnectionInterface $con = null)
    {
        if ($this->aSpySalesOrderItem === null && ($this->id_sales_order_item !== null)) {
            $this->aSpySalesOrderItem = ChildSpySalesOrderItemQuery::create()->findPk($this->id_sales_order_item, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpySalesOrderItem->addSpyPaymentPayoneTransactionStatusLogOrderItems($this);
             */
        }

        return $this->aSpySalesOrderItem;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aSpyPaymentPayoneTransactionStatusLog) {
            $this->aSpyPaymentPayoneTransactionStatusLog->removeSpyPaymentPayoneTransactionStatusLogOrderItem($this);
        }
        if (null !== $this->aSpySalesOrderItem) {
            $this->aSpySalesOrderItem->removeSpyPaymentPayoneTransactionStatusLogOrderItem($this);
        }
        $this->id_payment_payone_transaction_status_log = null;
        $this->id_sales_order_item = null;
        $this->created_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aSpyPaymentPayoneTransactionStatusLog = null;
        $this->aSpySalesOrderItem = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyPaymentPayoneTransactionStatusLogOrderItemTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
