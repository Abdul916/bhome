<?php
/*
 * Nueva versi�n del modelo, implementa nuevas formas de uso
 *
 * Formas de uso:
 *
 * $model = new Core_App_Model_Model2();
 * $model->find( (int) $id);
 * $model->select('id, name')->where('category_id = 10')->limit('10,2');
 * $model->findChild('Model_Child')->where('category_id = 10');
 * $model->findParent('Model_Parent')->limit('10,2');
 *
 * DELETE
 *
 * $model->loadId( (int) $id);
 * $mode->delete();
 *
 * $model->find(1);
 * $model->markForDelete();
 *
 * UPDATE
 * $model->loadId(1);
 * $model->loadArray( $array);
 * $model->update();
 *
 * $model->loadId(1);
 * $array= array('name' => 'nuevo nombre', 'apellido' => 'nuevo apellido');
 * $model->updateFields( $array);
 *
 * $model->select();
 * $model->delete();
 * $model->insert();
 * $model->update();
 *
 * Created on Apr 28, 2010
 *
 * @category    Atlas
 * @package    Atlas_Core
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

abstract class Core_App_Model_Model2 implements Iterator
{
  /**
   * Status del modelo, indica como se ha formado el modelo y cual es su estado actual
   * Puede ser: NULL (Recien creado), INSERTED (Insertado), UPDATED (actualizado),
   * 			  NORMAL (despues de un select), DIRTY (el modelo es esta sucio, no se debe insertar)
   * 			  DELETED (borrado, el objeto ya no puede ser editado o usado), ERROR (Error en el query)
   *
   *
   *
   * option
   * @access private
   * @var integer
   */
  private $_modelStatus = 0;

  const NULL = 0;
  const INSERTED = 1;
  const UPDATED = 2;
  const NORMAL = 3;
  const DELETED = 4;
  const DIRTY = 5;
  const ERROR = 6;
  const COLLECTION = 7;

  /**
   * Status de la colecci�n del modelo
   * Sus posibles status son: SINGLE (un unico registro), COLLECTION
   *
   * option
   * @access private
   * @var integer
   */
  private $_collectionStatus = false;

  /**
   * Contiene el query que se haya usado para el modelo
   *
   * option
   * @access private
   * @var integer
   */
  protected $_query;
    // variables del stado del query
  protected $_queryFromSet = false;
  protected $_fromString = null;
  protected $_whereString = null;
  protected $_orderString = null;
  protected $_groupString = null;
  protected $_limitString = null;

  protected $_dbConnection;

  protected $childModels;
  protected $parentModels;
  protected $pointedModels;

  protected $_oneToManyRelations;
  protected $_oneToManyRelationField;
  protected $_oneToManyObjects;

  protected $_oneToOneRelations;
  protected $_oneToOneRelationField;
  protected $_oneToOneObjects;

  protected $_referencesToParentRelations;
  protected $_referencesToParentRelationField;
  protected $_referencesToParentObjects;

  protected $_referencesToRelations;
  protected $_referencesToRelationField;
  protected $_referencesToObjects;

  protected $objectsPerPage = 10;
  /**
   * Contiene la referencia al query que representa al objeto
   *
   * option
   * @access private
   * @var integer
   */
  private $_objectRecord;
  private $_rawObjects;

  protected $_recordId;
  private $_pointer;

	// Variables de relaci�n con la tabla del modelo

  protected $_tableName;
  protected $_tableFields;
  protected $_tableUpdateFields;
  protected $_tableNotSecureFields;

  function __construct(Core_Db_Db $dbConnection)
  {
    $this->_rawObjects = array();
    $this->_queryFromSet = false;
    $this->_dbConnection = $dbConnection;
    $this->_tableNotSecureFields = array();
    $this->setUp();
  }
    /*
   * setUp debe ser implementada por todos los modelos
   * Incluye los elementos que definen el uso del modelo, su tabla, campos y relaciones
   * */
  abstract protected function setup();
	/*
   * newSelf crea un nuevo objeto de la clase, se utiliza para generar objetos en base a las
   * clases que extienden el objeto
   * */
  abstract public function newSelf(Core_Db_Db $dbConnection);


    // METODOS DEDICADAS AL MANEJO DE SELECTS

  public function select($selection = null)
  {
    if (!$selection) {
      $selection = '*';
    }
    $this->_query = 'SELECT ' . $selection;

    return $this;
  }
  public function collection(Core_App_Model_Model2 $parent = null, $model = null)
  {
    if (!$parent) {
      $this->select();
    } else {
      $parent_filed_id = $parent->getHasManyId($model);
      $this->select()->where($parent_filed_id . '=' . $parent->get('id'));
			//$this->runSelect();
    }
    $this->statusCollection();
    return $this;
  }
  public function runSelect()
  {
    if (!$this->isFromQuerySet()) {
      $this->from();
    }
    $response = $this->_dbConnection->query($this->_query);
    $this->manageSelectResponse($response);
  }
  public function getCurrentQuery()
  {
    return $this->_query;
  }
  public function from($fromString = null)
  {
    if (!$fromString) {
      $this->_fromString = $this->_tableName;
    } else {
      $this->_fromString = $fromString;
    }

    $this->_query .= ' FROM ' . $this->_fromString;
    $this->_queryFromSet = true;
    return $this;
  }
  public function where($whereString)
  {
    if (!$this->isFromQuerySet()) {
      $this->from();
    }
    $this->_whereString = $whereString;
    if (strpos($this->_query, 'WHERE') === false)
      $this->_query .= ' WHERE ' . $whereString;
    else
      $this->_query .= ' ' . $whereString;
    return $this;
  }
  public function orderBy($orderString)
  {
    if (!$this->isFromQuerySet()) {
      $this->from();
    }
    $this->_orderString = $orderString;
    $this->_query .= ' ORDER BY ' . $orderString;
    return $this;
  }
  public function groupBy($groupString)
  {
    if (!$this->isFromQuerySet()) {
      $this->from();
    }
    $this->_groupString = $groupString;
    $this->_query .= ' GROUP BY ' . $groupString;
    return $this;
  }
  public function limit($limitString)
  {
    if (!$this->isFromQuerySet()) {
      $this->from();
    }
    $this->_limitString = $limitString;
    $this->_query .= ' LIMIT ' . $limitString;
    return $this;
  }
  public function page($page = 1)
  {
    $page;
    $this->_query .= ' LIMIT OFFSET ' . $page;
    return $this;
  }
  public function getId()
  {
    return $this->getProperty('id');
  }
  protected function getSelectQuery()
  {
    $r = $this->isFromQuerySet();
    if (!$r) {
      $this->from();
    }
    return $this->_query;
  }
  protected function getTotalRowsForCurrentModel()
  {
    $countQuery = $this->select('count(id) AS total')->where($this->_whereString);
    $r = $this->_dbConnection->query($countQuery);
    if ($r) {
      $total = $this->_dbConnection->fetchObject($r);
      return $total->total;
    }
  }

  private function manageSelectResponse($queryResponse)
  {
    if (!$queryResponse) {
      return null;
    }

    if ($this->_dbConnection->countRows($queryResponse) == 0) {
      $this->statusNull();
      return;
    }
    if ($this->_dbConnection->countRows($queryResponse) == 1 && $this->getModelStatus() != self::COLLECTION) {
      $this->setSingleRecord($queryResponse);

    } else {
      $this->setMultipleRecords($queryResponse);
    }
		//$this->statusNormal();
  }
	// METODOS DE CREACI�N RAPIDA DE QUERYES
  public function find($record_id)
  {
		//TODO Validar que el id sea Numerico y si no mandar un error correcto
    if (!is_numeric($record_id)) {
      throw new Exception("Id del objeto debe ser numerico Model2::find " . $this->_tableName, 1);
			
			// trigger_error("Id del objeto debe ser numerico Model2::find " . $this->_tableName, E_USER_ERROR);
      return;
    }
    $this->select()->where('id = ' . $record_id);
    $this->runSelect();
    $this->_recordId = $record_id;
  }
  /**
   * Define el ID al que se realizará el Update
   */
  public function loadId($record_id)
  {
    if (!is_numeric($record_id)) {
      trigger_error("El identificador del objeto debe ser numerico " . $this->_tableName, E_USER_ERROR);
      return;
    }
    $this->setModelStatus(self::NORMAL);
    $this->_record_id = $record_id;
    $this->set('id', $this->_record_id);

  }
  public function insert()
  {
		/*if($this->getModelStatus() != self::INSERT){
			// TODO enviar un error adecuado
			return false;
		}*/
    $fields = $this->construct_insert_fields($this->_objectRecord);

    $sql = "INSERT INTO `{$this->_tableName}` $fields";
    $r = $this->_dbConnection->query($sql);

    if (!$r) {
      error_log($sql, 0);
      error_log(mysql_error(), 0);
      error_log('', 0);
    }
    $this->_recordId = $this->_dbConnection->getLastInsertId();
    $this->set('id', $this->_recordId);
    return $r;
  }
  public function update()
  {
    if ($this->getId() == 0) {
			// TODO enviar un error adecuado
      echo "ERROR UPDATE no se ha seteado el id del modelo. {$this->_tableName}";
      return false;
    }
    $fields = $this->constructUpdateFields($this->_objectRecord, $this->_tableUpdateFields);
    $sql = "UPDATE `{$this->_tableName}` SET $fields WHERE id=" . $this->getId();
    $this->_query = $sql;
    $r = $this->_dbConnection->query($sql);
    if (!$r) {
      error_log($sql, 0);
    }
    $this->setModelStatus(self::UPDATED);
    return $r;
  }
  public function updateFields(array $data)
  {
    if (!is_array($data))
      return false;
    $campos = array();
    $valores = array();
		// print_r($this->_objectRecord);
    foreach ($data as $campo => $valor) {
      $campos[] = $campo;
      $valores[$campo] = $valor;
    }
    $fields = $this->constructUpdateFields($valores, $campos);
    $sql = "UPDATE `{$this->_tableName}` SET $fields WHERE id=" . $this->getId();

    $r = $this->_dbConnection->query($sql);
    if (!$r) {
      error_log($sql, 0);
    }

    return $r;
  }
  public function delete($record_id)
  {
    $this->_record_id = $record_id;
    $this->setModelStatus(self::DELETED);
    $this->destroyDb();
  }
	//METODOS DE SETUP DE OBJETOS DESDE BASE DE DATOS
  public function setSingleRecord($queryResult)
  {
    $this->statusNormal();
		// setear este objeto
    $this->setThisObject($queryResult);
  }
  public function setMultipleRecords($queryResult)
  {
    $this->statusCollection();
    $this->_record_id = 0;
    $this->_rawObjects = array();
    $i = 0;

    $response = $this->_dbConnection->fetchObject($queryResult);

    foreach ($response as $record) {
      if (is_array($record)) $record = $record[0];
      $this->_rawObjects[] = $record;
    }
  }
  private function setThisObject($dbResult)
  {
    $this->_objectRecord = array();
    $obj = $this->_dbConnection->fetchObject($dbResult);
    if (is_array($obj)) {
      $obj = $obj[0];
    }
		// print_r($obj);
		// exit;

    foreach ($this->_tableFields as $field => $value) {
      if (property_exists($obj, $value)) {
				// echo $value . '<br>';
				// echo stripslashes($obj->$value) . '<br><br>';
        $this->setProp($value, stripslashes($obj->$value));
      }
    }
    $this->_rawObjects[] = $obj;
    return;
  }
  public function loadArray($_array)
  {
    if (!is_array($_array))
      return new Core_Error_DbError(Core_Error_DbError::WrongData);

    foreach ($this->_tableFields as $index => $field) {
      if (isset($_array[$field]))
        $this->setProp($field, $_array[$field]);
    }
  }
  public function set($propName, $propValue)
  {
    return $this->setProp($propName, $propValue);
  }
  private function setProp($propName, $propValue)
  {
    $this->_objectRecord[$propName] = $propValue;
  }
  public function get($value)
  {
    return $this->getProperty($value);
  }
  protected function getProperty($value)
  {
    if (!isset($this->_objectRecord[$value])) {
			//error_log( print_r($this->_objectRecord, true), 0);
			//error_log('el campo '.$value.' no existe en: '.$this->_tableName);
      return null;
    }

    return $this->_objectRecord[$value];
  }
  protected function getProperties()
  {
    return $this->_objectRecord;
  }
  private function construct_insert_fields($data)
  {
    if (is_array($data)) {

      $total = count($data);
      $camp = '';
      $value = '';
      $m = 0;
      foreach ($data as $key => $val) {
        $camp .= " `$key`";
        if (($total - 1) != $m) {
          $camp .= ", ";
        }
        if (in_array($key, $this->_tableNotSecureFields)) {
					// el campo esta en el array,  EL USUARIO ES RESPONSABLE DE LA SEGURIDAD DEL CAMPO
          $value .= "" . $val . "";
        } else {
					// el campo esta no esta en el array
					// $value.="'".$this->secure_db_text($val)."'";

          $v = ($val) ? "'" . $this->secure_db_text($val) . "'" : 'NULL';
          $value .= $v;
        }

        if (($total - 1) != $m) {
          $value .= ", ";
        }
        $m++;
      }

      return "($camp) VALUES ($value)";
    } else if (!is_array($data) && !is_array($this->_tableFields)) {
      return "($data) VALUES ($fields)";
    }
  }
  private function constructUpdateFields($data, $validFields)
  {
    if (is_array($data)) {
      $total = count($data);
      $camp = '';
      $value = '';

      foreach ($data as $key => $val) {
        if (in_array($key, $validFields)) {
          if (in_array($key, $this->_tableNotSecureFields)) {
						// el campo esta en el array,  EL USUARIO ES RESPONSABLE DE LA SEGURIDAD DEL CAMPO
            $value .= "`$key` = " . $val . "";
          } else {
            $v = ($val) ? '"' . $this->secure_db_text($val) . '"' : 'NULL';
            $value .= "`$key` = {$v}";
          }
          $value .= ", ";
        }
      }

      return substr($value, 0, -2);
    }
  }

  public function destroyDb()
  {
    $sql = "DELETE FROM `{$this->_tableName}` WHERE id=" . $this->getId();
    $r = $this->_dbConnection->query($sql);

    if (!$r) {
      error_log($sql, 0);
    }

    return $r;
  }

	// METODOS DE CONTROL DE SETUP DEL OBJETO
  public function setDirty()
  {
    $this->setModelStatus(self::DIRTY);
  }
  private function isDirty()
  {
    if ($this->getModelStatus() == self::DIRTY) {
      return true;
    }
    return false;
  }
  private function isFromQuerySet()
  {
    return $this->_queryFromSet;
  }
  private function statusNull()
  {
    $this->setModelStatus(self::NULL);
  }
  private function statusCollection()
  {
    $this->setModelStatus(self::COLLECTION);
  }
  private function statusInserted()
  {
    $this->setModelStatus(self::INSERTED);
  }
  private function statusNormal()
  {
    $this->setModelStatus(self::NORMAL);
  }
  protected function setModelStatus($status)
  {
    $this->_modelStatus = $status;
  }
  public function getModelStatus()
  {
    return $this->_modelStatus;
  }
  protected function setTable($tablename)
  {
    $this->_tableName = $tablename;
  }
  protected function setFields($fieldsArray)
  {
    if (!is_array($fieldsArray)) {
      trigger_error('la asignaci�n de campos para este modelo' . $this->_tableName . ' debe ser un array');
    }
    $this->_tableFields = array_filter(array_unique($fieldsArray));
  }
  protected function setNotSecureFields($array)
  {
    if (!is_array($array)) {
      trigger_error('la asignaci�n de campos para este modelo' . $this->_tableName . ' debe ser un array : setNotSecureFields');
    }
    $this->_tableNotSecureFields = $array;
  }
  protected function setUpdateFields($updateFields)
  {
    if (!is_array($updateFields)) {
      trigger_error('la asignaci�n de campos para este modelo' . $this->_tableName . ' debe ser un array');
    }
    $this->_tableUpdateFields = array_filter(array_unique($updateFields));
  }

	//METODOS DE SEURIDAD DE DATOS
  private function secure_db_text($txt)
  {
    return addslashes($txt);
  }
  public function secureText($text)
  {
    return $this->secure_db_text($text);
  }
	//METODOS DEDICADOS AL CONTROL DE RELACIONES
  public function findChild($model, Core_App_Model_Model2 $parent)
  {
		//selecciona en base al id de un padre
    $parent_filed_id = $parent->getHasOneId($model);
		//$selQuery= $this->getSelectWhere( $parent_filed_id.'='.$parent->prop('id'));
    $this->select()->where($parent_filed_id . '=' . $parent->get('id'));
		/*
		$result= $this->_db_connection->query($selQuery);
		if($result)
		{
			if($this->_db_connection->countRows($result) > 0)
			{
				$this->setModelStatus(Core_App_Model_Model::FROM_DB);
				$this->setThisObject($result);

				$this->_record_id= $this->prop('id');
			}else{
				$this->setModelStatus(Core_App_Model_Model::NULL);
			}

		}*/
    return $this;
  }
  public function findParent($model, Core_App_Model_Model2 $child)
  {
		// Encuentra el objeto que tiene una relaci�n Hijo > Padre
    $child_relation_id = $child->getBelongsToId($model);
    $this->select()->where('id = ' . $child->getId());
    return $this;
  }
  public function findPointed($model, Core_App_Model_Model2 $child)
  {
    $child_relation_id = $child->getPointedId($model);
    $this->select()->where('id = ' . $child->get($child_relation_id));
    return $this;
  }
  public function getChild($model = null)
  {
    if (!$model) {
      return null;
    }
    $strModelId = $this->_oneToOneRelations[$model];
    $childModel = $this->_oneToOneObjects[$model] = new $strModelId($this->_dbConnection);
    $childModel->findChild($model, $this);
    return $childModel;
  }
  public function getChilds($model = null)
  {
    if (!$model) {
      return null;
    }
    $childsModelString = $this->_oneToManyRelations[$model];
    $childsModel = new $childsModelString($this->_dbConnection);
    $this->_oneToManyObjects[$model] = $childsModel;
    $this->_oneToManyObjects[$model]->collection($this, $model);
    return $this->_oneToManyObjects[$model];
  }
  public function getParent($model)
  {
    $parentString = $this->_referencesToParentRelations[$model];
    $parentModel = new $parentString($this->_dbConnection);
    $parentModel->findParent($model, $this);
    $this->_referencesToParentObjects[$model] = $parentModel;
    return $this->_referencesToParentObjects[$model];
  }
  public function getPointed($model)
  {
    $pointedString = $this->_referencesToRelations[$model];
    $parentModel = new $pointedString($this->_dbConnection);
    $parentModel->findPointed($model, $this);
    $this->_referencesToObjects[$model] = $parentModel;
    return $this->_referencesToObjects[$model];
  }
	// METODOS DEDICADAS AL MANEJO DE COLECCIONES
  public function setHasMany($childsModel, $relationship_field)
  {
    $this->_oneToManyRelations[$childsModel] = $childsModel;
    $this->_oneToManyRelationField[$childsModel] = $relationship_field;
  }
  public function setHasOne($childModel, $relationship_field)
  {
    $this->_oneToOneRelations[$childModel] = $childModel;
    $this->_oneToOneRelationField[$childModel] = $relationship_field;
  }
  public function setBelongsTo($parentModel, $relationship_field)
  {
    $this->_referencesToParentRelations[$parentModel] = $parentModel;
    $this->_referencesToParentRelationField[$parentModel] = $relationship_field;
  }
  public function setPointerTo($pointedModel, $relationship_field)
  {
    $this->_referencesToRelations[$pointedModel] = $pointedModel;
    $this->_referencesToRelationField[$pointedModel] = $relationship_field;
  }
  public function getBelongsToId($model)
  {
    return $this->_referencesToParentRelationField[$model];
  }
  public function getHasManyId($model)
  {
    return $this->_oneToManyRelationField[$model];
  }
  public function getHasOneId($model)
  {
    return $this->_oneToOneRelationField[$model];
  }
  public function getPointedId($model)
  {
    return $this->_referencesToRelationField[$model];
  }
  public function isCollection()
  {
    if ($this->getModelStatus() == self::COLLECTION) {
      return true;
    }
    return false;
  }
  public function addCollection(Core_App_Model_Model2 $model)
  {
		// agregar al array y marcar el objeto como dirty
    $this->_recordsArray[] = $model;
    $this->_rawObjects = $this->_recordsArray;
    $this->statusCollection();
  }
  protected function hasParent()
  {
  }
  protected function hasParents()
  {
  }
  protected function hasChild()
  {
  }
  protected function hasChilds()
  {
  }


    /*
   * METODOS DE IMPLEMENTACI�N DE "ITERATOR"
   */
  public function getDirtyObjectAt($index)
  {
    return @$this->_recordsArray[$index];
  }
  public function getObjectAt($index)
  {
    if (!is_numeric($index)) {
      return null;
    }

    if (isset($this->_recordsArray[$index]) && is_object($this->_recordsArray[$index])) {
      return $this->_recordsArray[$index];
    }

    if (isset($this->_rawObjects[$index]) && $this->_rawObjects[$index]) {
      $newSelf = $this->newSelf($this->_dbConnection);
      $countFields = count($this->_tableFields);
      for ($i = 0; $i < $countFields; $i++) {
        $field = $this->_tableFields[$i];
        $newSelf->set($field, $this->_rawObjects[$index]->$field);
      }
      $this->_recordsArray[$index] = $newSelf;
    }
    if (!isset($this->_recordsArray[$index]))
      return null;

    return $this->_recordsArray[$index];
  }
  public function count()
  {
    return count($this->_rawObjects);
  }
  public function rewind()
  {
    $this->_pointer = 0;
  }
  public function current()
  {
    if ($this->isDirty())
      $obj = $this->getDirtyObjectAt($this->_pointer);
    else
      $obj = $this->getObjectAt($this->_pointer);
    return $obj;
  }
  public function key()
  {
    return $this->_pointer;
  }
  public function next()
  {
    $row = $this->getObjectAt($this->_pointer);
    if ($this->isDirty())
      $row = $this->getDirtyObjectAt($this->_pointer);
    else
      $row = $this->getObjectAt($this->_pointer);
    if ($row) {
      $this->_pointer++;
    }
    return $row;
  }
  public function valid()
  {
    return (!is_null($this->current()));
  }
  public function toJson($fields_array = null)
  {
    $data = array();

    $json_fields = ($fields_array) ? $fields_array : $this->_tableFields;

    if ($this->count() == 1 && !$this->isCollection()) {
      foreach ($this as $model) {
        if ($model->get('id') > 0) {
          foreach ($json_fields as $field) {
            $data[$field] = $model->get($field);
          }

          return json_encode($data);
        }
      }

    } else if ($this->count() > 0) {
      $i = 0;
      foreach ($this as $child) {
        $data[$i] = array();

        foreach ($json_fields as $field) {
          $data[$i][$field] = $child->get($field);
        }
        $i++;
      }

      return json_encode($data);
    }


    return json_encode(array());
  }
  public function getArray()
  {
    return $this->_rawObjects;
  }
}

