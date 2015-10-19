<?php

namespace Propel\Base;

use \Exception;
use \PDO;
use Propel\SpyCustomer as ChildSpyCustomer;
use Propel\SpyCustomerQuery as ChildSpyCustomerQuery;
use Propel\SpyWishlist as ChildSpyWishlist;
use Propel\SpyWishlistItem as ChildSpyWishlistItem;
use Propel\SpyWishlistItemQuery as ChildSpyWishlistItemQuery;
use Propel\SpyWishlistQuery as ChildSpyWishlistQuery;
use Propel\Map\SpyWishlistTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'spy_wishlist' table.
 *
 *
 *
* @package    propel.generator.src.Propel.Base
*/
abstract class SpyWishlist extends SpyWishlist implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Propel\\Map\\SpyWishlistTableMap';


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
     * The value for the id_wishlist field.
     * @var        int
     */
    protected $id_wishlist;

    /**
     * The value for the fk_customer field.
     * @var        int
     */
    protected $fk_customer;

    /**
     * @var        ChildSpyCustomer
     */
    protected $aSpyCustomer;

    /**
     * @var        ObjectCollection|ChildSpyWishlistItem[] Collection to store aggregation of ChildSpyWishlistItem objects.
     */
    protected $collSpyWishlistItems;
    protected $collSpyWishlistItemsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyWishlistItem[]
     */
    protected $spyWishlistItemsScheduledForDeletion = null;

    /**
     * Initializes internal state of Propel\Base\SpyWishlist object.
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
     * Compares this with another <code>SpyWishlist</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyWishlist</code>, delegates to
     * <code>equals(SpyWishlist)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|SpyWishlist The current object, for fluid interface
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
     * Get the [id_wishlist] column value.
     *
     * @return int
     */
    public function getIdWishlist()
    {
        return $this->id_wishlist;
    }

    /**
     * Get the [fk_customer] column value.
     *
     * @return int
     */
    public function getFkCustomer()
    {
        return $this->fk_customer;
    }

    /**
     * Set the value of [id_wishlist] column.
     *
     * @param int $v new value
     * @return $this|\Propel\SpyWishlist The current object (for fluent API support)
     */
    public function setIdWishlist($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_wishlist !== $v) {
            $this->id_wishlist = $v;
            $this->modifiedColumns[SpyWishlistTableMap::COL_ID_WISHLIST] = true;
        }

        return $this;
    } // setIdWishlist()

    /**
     * Set the value of [fk_customer] column.
     *
     * @param int $v new value
     * @return $this|\Propel\SpyWishlist The current object (for fluent API support)
     */
    public function setFkCustomer($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fk_customer !== $v) {
            $this->fk_customer = $v;
            $this->modifiedColumns[SpyWishlistTableMap::COL_FK_CUSTOMER] = true;
        }

        if ($this->aSpyCustomer !== null && $this->aSpyCustomer->getIdCustomer() !== $v) {
            $this->aSpyCustomer = null;
        }

        return $this;
    } // setFkCustomer()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyWishlistTableMap::translateFieldName('IdWishlist', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_wishlist = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyWishlistTableMap::translateFieldName('FkCustomer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_customer = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 2; // 2 = SpyWishlistTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Propel\\SpyWishlist'), 0, $e);
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
        if ($this->aSpyCustomer !== null && $this->fk_customer !== $this->aSpyCustomer->getIdCustomer()) {
            $this->aSpyCustomer = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyWishlistTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyWishlistQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyCustomer = null;
            $this->collSpyWishlistItems = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see SpyWishlist::setDeleted()
     * @see SpyWishlist::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyWishlistTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyWishlistQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyWishlistTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
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
                SpyWishlistTableMap::addInstanceToPool($this);
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

            if ($this->aSpyCustomer !== null) {
                if ($this->aSpyCustomer->isModified() || $this->aSpyCustomer->isNew()) {
                    $affectedRows += $this->aSpyCustomer->save($con);
                }
                $this->setSpyCustomer($this->aSpyCustomer);
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

            if ($this->spyWishlistItemsScheduledForDeletion !== null) {
                if (!$this->spyWishlistItemsScheduledForDeletion->isEmpty()) {
                    \Propel\SpyWishlistItemQuery::create()
                        ->filterByPrimaryKeys($this->spyWishlistItemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyWishlistItemsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyWishlistItems !== null) {
                foreach ($this->collSpyWishlistItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[SpyWishlistTableMap::COL_ID_WISHLIST] = true;
        if (null !== $this->id_wishlist) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyWishlistTableMap::COL_ID_WISHLIST . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyWishlistTableMap::COL_ID_WISHLIST)) {
            $modifiedColumns[':p' . $index++]  = 'id_wishlist';
        }
        if ($this->isColumnModified(SpyWishlistTableMap::COL_FK_CUSTOMER)) {
            $modifiedColumns[':p' . $index++]  = 'fk_customer';
        }

        $sql = sprintf(
            'INSERT INTO spy_wishlist (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_wishlist':
                        $stmt->bindValue($identifier, $this->id_wishlist, PDO::PARAM_INT);
                        break;
                    case 'fk_customer':
                        $stmt->bindValue($identifier, $this->fk_customer, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_wishlist_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdWishlist($pk);

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
        $pos = SpyWishlistTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdWishlist();
                break;
            case 1:
                return $this->getFkCustomer();
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

        if (isset($alreadyDumpedObjects['SpyWishlist'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SpyWishlist'][$this->hashCode()] = true;
        $keys = SpyWishlistTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdWishlist(),
            $keys[1] => $this->getFkCustomer(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSpyCustomer) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomer';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer';
                        break;
                    default:
                        $key = 'SpyCustomer';
                }

                $result[$key] = $this->aSpyCustomer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyWishlistItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyWishlistItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_wishlist_items';
                        break;
                    default:
                        $key = 'SpyWishlistItems';
                }

                $result[$key] = $this->collSpyWishlistItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Propel\SpyWishlist
     */
    public function setByName($name, $value, $type = TableMap::TYPE_FIELDNAME)
    {
        $pos = SpyWishlistTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Propel\SpyWishlist
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdWishlist($value);
                break;
            case 1:
                $this->setFkCustomer($value);
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
        $keys = SpyWishlistTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdWishlist($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCustomer($arr[$keys[1]]);
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
     * @return $this|\Propel\SpyWishlist The current object, for fluid interface
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
        $criteria = new Criteria(SpyWishlistTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyWishlistTableMap::COL_ID_WISHLIST)) {
            $criteria->add(SpyWishlistTableMap::COL_ID_WISHLIST, $this->id_wishlist);
        }
        if ($this->isColumnModified(SpyWishlistTableMap::COL_FK_CUSTOMER)) {
            $criteria->add(SpyWishlistTableMap::COL_FK_CUSTOMER, $this->fk_customer);
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
        $criteria = ChildSpyWishlistQuery::create();
        $criteria->add(SpyWishlistTableMap::COL_ID_WISHLIST, $this->id_wishlist);

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
        $validPk = null !== $this->getIdWishlist();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdWishlist();
    }

    /**
     * Generic method to set the primary key (id_wishlist column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdWishlist($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdWishlist();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Propel\SpyWishlist (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFkCustomer($this->getFkCustomer());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyWishlistItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyWishlistItem($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdWishlist(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Propel\SpyWishlist Clone of current object.
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
     * Declares an association between this object and a ChildSpyCustomer object.
     *
     * @param  ChildSpyCustomer $v
     * @return $this|\Propel\SpyWishlist The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSpyCustomer(ChildSpyCustomer $v = null)
    {
        if ($v === null) {
            $this->setFkCustomer(NULL);
        } else {
            $this->setFkCustomer($v->getIdCustomer());
        }

        $this->aSpyCustomer = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyCustomer object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyWishlist($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyCustomer object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSpyCustomer The associated ChildSpyCustomer object.
     * @throws PropelException
     */
    public function getSpyCustomer(ConnectionInterface $con = null)
    {
        if ($this->aSpyCustomer === null && ($this->fk_customer !== null)) {
            $this->aSpyCustomer = ChildSpyCustomerQuery::create()->findPk($this->fk_customer, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyCustomer->addSpyWishlists($this);
             */
        }

        return $this->aSpyCustomer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('SpyWishlistItem' == $relationName) {
            return $this->initSpyWishlistItems();
        }
    }

    /**
     * Clears out the collSpyWishlistItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyWishlistItems()
     */
    public function clearSpyWishlistItems()
    {
        $this->collSpyWishlistItems = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSpyWishlistItems collection loaded partially.
     */
    public function resetPartialSpyWishlistItems($v = true)
    {
        $this->collSpyWishlistItemsPartial = $v;
    }

    /**
     * Initializes the collSpyWishlistItems collection.
     *
     * By default this just sets the collSpyWishlistItems collection to an empty array (like clearcollSpyWishlistItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyWishlistItems($overrideExisting = true)
    {
        if (null !== $this->collSpyWishlistItems && !$overrideExisting) {
            return;
        }
        $this->collSpyWishlistItems = new ObjectCollection();
        $this->collSpyWishlistItems->setModel('\Propel\SpyWishlistItem');
    }

    /**
     * Gets an array of ChildSpyWishlistItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyWishlist is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyWishlistItem[] List of ChildSpyWishlistItem objects
     * @throws PropelException
     */
    public function getSpyWishlistItems(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSpyWishlistItemsPartial && !$this->isNew();
        if (null === $this->collSpyWishlistItems || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSpyWishlistItems) {
                // return empty collection
                $this->initSpyWishlistItems();
            } else {
                $collSpyWishlistItems = ChildSpyWishlistItemQuery::create(null, $criteria)
                    ->filterBySpyWishlist($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyWishlistItemsPartial && count($collSpyWishlistItems)) {
                        $this->initSpyWishlistItems(false);

                        foreach ($collSpyWishlistItems as $obj) {
                            if (false == $this->collSpyWishlistItems->contains($obj)) {
                                $this->collSpyWishlistItems->append($obj);
                            }
                        }

                        $this->collSpyWishlistItemsPartial = true;
                    }

                    return $collSpyWishlistItems;
                }

                if ($partial && $this->collSpyWishlistItems) {
                    foreach ($this->collSpyWishlistItems as $obj) {
                        if ($obj->isNew()) {
                            $collSpyWishlistItems[] = $obj;
                        }
                    }
                }

                $this->collSpyWishlistItems = $collSpyWishlistItems;
                $this->collSpyWishlistItemsPartial = false;
            }
        }

        return $this->collSpyWishlistItems;
    }

    /**
     * Sets a collection of ChildSpyWishlistItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $spyWishlistItems A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSpyWishlist The current object (for fluent API support)
     */
    public function setSpyWishlistItems(Collection $spyWishlistItems, ConnectionInterface $con = null)
    {
        /** @var ChildSpyWishlistItem[] $spyWishlistItemsToDelete */
        $spyWishlistItemsToDelete = $this->getSpyWishlistItems(new Criteria(), $con)->diff($spyWishlistItems);


        $this->spyWishlistItemsScheduledForDeletion = $spyWishlistItemsToDelete;

        foreach ($spyWishlistItemsToDelete as $spyWishlistItemRemoved) {
            $spyWishlistItemRemoved->setSpyWishlist(null);
        }

        $this->collSpyWishlistItems = null;
        foreach ($spyWishlistItems as $spyWishlistItem) {
            $this->addSpyWishlistItem($spyWishlistItem);
        }

        $this->collSpyWishlistItems = $spyWishlistItems;
        $this->collSpyWishlistItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyWishlistItem objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SpyWishlistItem objects.
     * @throws PropelException
     */
    public function countSpyWishlistItems(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSpyWishlistItemsPartial && !$this->isNew();
        if (null === $this->collSpyWishlistItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyWishlistItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyWishlistItems());
            }

            $query = ChildSpyWishlistItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyWishlist($this)
                ->count($con);
        }

        return count($this->collSpyWishlistItems);
    }

    /**
     * Method called to associate a ChildSpyWishlistItem object to this object
     * through the ChildSpyWishlistItem foreign key attribute.
     *
     * @param  ChildSpyWishlistItem $l ChildSpyWishlistItem
     * @return $this|\Propel\SpyWishlist The current object (for fluent API support)
     */
    public function addSpyWishlistItem(ChildSpyWishlistItem $l)
    {
        if ($this->collSpyWishlistItems === null) {
            $this->initSpyWishlistItems();
            $this->collSpyWishlistItemsPartial = true;
        }

        if (!$this->collSpyWishlistItems->contains($l)) {
            $this->doAddSpyWishlistItem($l);
        }

        return $this;
    }

    /**
     * @param ChildSpyWishlistItem $spyWishlistItem The ChildSpyWishlistItem object to add.
     */
    protected function doAddSpyWishlistItem(ChildSpyWishlistItem $spyWishlistItem)
    {
        $this->collSpyWishlistItems[]= $spyWishlistItem;
        $spyWishlistItem->setSpyWishlist($this);
    }

    /**
     * @param  ChildSpyWishlistItem $spyWishlistItem The ChildSpyWishlistItem object to remove.
     * @return $this|ChildSpyWishlist The current object (for fluent API support)
     */
    public function removeSpyWishlistItem(ChildSpyWishlistItem $spyWishlistItem)
    {
        if ($this->getSpyWishlistItems()->contains($spyWishlistItem)) {
            $pos = $this->collSpyWishlistItems->search($spyWishlistItem);
            $this->collSpyWishlistItems->remove($pos);
            if (null === $this->spyWishlistItemsScheduledForDeletion) {
                $this->spyWishlistItemsScheduledForDeletion = clone $this->collSpyWishlistItems;
                $this->spyWishlistItemsScheduledForDeletion->clear();
            }
            $this->spyWishlistItemsScheduledForDeletion[]= clone $spyWishlistItem;
            $spyWishlistItem->setSpyWishlist(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyWishlist is new, it will return
     * an empty collection; or if this SpyWishlist has previously
     * been saved, it will retrieve related SpyWishlistItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyWishlist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyWishlistItem[] List of ChildSpyWishlistItem objects
     */
    public function getSpyWishlistItemsJoinSpyProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyWishlistItemQuery::create(null, $criteria);
        $query->joinWith('SpyProduct', $joinBehavior);

        return $this->getSpyWishlistItems($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyWishlist is new, it will return
     * an empty collection; or if this SpyWishlist has previously
     * been saved, it will retrieve related SpyWishlistItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyWishlist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyWishlistItem[] List of ChildSpyWishlistItem objects
     */
    public function getSpyWishlistItemsJoinSpyAbstractProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyWishlistItemQuery::create(null, $criteria);
        $query->joinWith('SpyAbstractProduct', $joinBehavior);

        return $this->getSpyWishlistItems($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aSpyCustomer) {
            $this->aSpyCustomer->removeSpyWishlist($this);
        }
        $this->id_wishlist = null;
        $this->fk_customer = null;
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
            if ($this->collSpyWishlistItems) {
                foreach ($this->collSpyWishlistItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyWishlistItems = null;
        $this->aSpyCustomer = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyWishlistTableMap::DEFAULT_STRING_FORMAT);
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
