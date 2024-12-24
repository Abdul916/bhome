<?php

/**
* Modelo
*/

// TODO Selects con p‡ginaci—n

abstract class Core_App_Model_Model  implements Iterator
{
	private $_hasRecords=false;
	private $_recordsArray;
	private $_rawObjects;

	private $_childModelString;
	private $_hasOneChildModel;
	private $_hasOneChildModelStr;
	private $_childModel;

	private $_record_id=0;
	private $_objectRecord;
	private $_objectStatus=4;	// fromDb, forUpdate, new, null, multiRecord
	private $_referenceStatus; // belongs_to, has_many
	// Indica el index actual del Iterator
	private $_pointer;
	private $_query;
	private $_dirty = null;

	protected $_db_connection;
	protected $_table;
	protected $_fields;
	protected $_updateFields;

	protected $_belongToModel;
	protected $_belongToModelStr;
	protected $_belongsId;

	protected $_hasMany;
	protected $_hasMany_id;
	protected $_hasOneId;

	protected $_hasPointerModel;
	protected $_hasPointerModelStr;
	protected $_hasPointerId;

	const NULL= null;
	const FROM_DB= 1;
	const FOR_UPDATE= 2;
	const INSERT= 3;
	const MULTI_RECORD= 5;
	const FOR_DELETE= 6;
	const HAS_MANY= 7;

	function __construct(Core_Db_Db $db_connection)
	{
		$this->_recordsArray= null;
		$this->_db_connection= $db_connection;
		$this->_childModelString = array();
		$this->_hasMany_id = array();
		$this->setUp();
		$this->_objectRecord=array();

		foreach($this->_fields AS $key => $field){
			$this->setProp($field, '');
		}
	}
	abstract function setUp();

	public function markDirty()
	{
		$this->_dirty = true;
	}
	public function isDirty()
	{
		return $this->_dirty;
	}
	/**
	* Se encarga de encontrar un elemento en base a su ID
	*/
	public function find($record_id)
	{
		//TODO Validar que el id sea Numerico y si no mandar un error correcto
		$sql="SELECT * FROM ".$this->_table." WHERE id=".$record_id;

		$this->runSelect($sql);
		$this->_record_id= $record_id;
	}
	public function findWhere($where)
	{
		//TODO Validar que el id sea Numerico y si no mandar un error correcto
		$sql="SELECT * FROM ".$this->_table." WHERE ".$where;
		$this->runSelect($sql);
	}
	public function runSelectPublic($query){
		$this->runSelectQuery($query) ;
	}
	protected function runSelect($query)
	{
		$this->_query= $query;
		$result= $this->_db_connection->query($query);

		if($result)
		{
			if($this->_db_connection->countRows($result) == 1)
			{
				$this->setModelStatus(Core_App_Model_Model::FROM_DB);
				$this->setThisObject($result);
				$this->_record_id= $this->prop('id');
			}else if($this->_db_connection->countRows($result) > 1)
			{
				//
				$this->setModelStatus(self::MULTI_RECORD);
				$this->_record_id= 0;
				$this->_rawObjects = array();
				$i=0;
	
				while($record = $this->_db_connection->fetchObject($result))
				{
					$this->_rawObjects[]= $record;
				}
				
			}else{
				$this->setModelStatus(Core_App_Model_Model::NULL);
			}
		}else
		{
			$this->_record_id= 0;
		}
	}
	public function findChild(Core_App_Model_Model $parent, $model)
	{
		//selecciona en base al id de un padre

		$parent_filed_id= $parent->getHasOneId($model);
		$selQuery= $this->getSelectWhere( $parent_filed_id.'='.$parent->prop('id'));
		$this->_query= $selQuery;
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

		}
	}
	public function findPointed( Core_App_Model_Model $parent , $model )
	{
		$parent_field_id = $parent->getPointerId($model);
		$selQuery = $this->getSelectWhere('id ='.$parent->prop($parent_field_id));
		$this->_query = $selQuery;
		$result = $this->_db_connection->query($selQuery);
		if($result)
		{
			if($this->_db_connection->countRows($result) > 0)
			{
				$this->setModelStatus(Core_App_Model_Model::FROM_DB);
				$this->setThisObject($result);
				$this->_record_id = $this->prop('id');
			}else{
				$this->setModelStatus(Core_App_Model_Model::NULL);
			}
		}else{
			echo "sql error:\n";
			echo mysql_error();
		}
	}

	public function findParent( Core_App_Model_Model $child, $model)
	{
		//$parent_filed_id= $parent->getBelongsId($model);
	}
	public function collection(Core_App_Model_Model $parent = null, $model = null)
	{
		if(!$parent)
		{
			$this->getAll();
		}else
		{
			$parent_filed_id= $parent->getHasManyId($model);
			$selQuery= $this->getSelectWhere( $parent_filed_id.'='.$parent->prop('id'));
			$this->_query= $selQuery;
			$this->runSelectQuery($selQuery);
		}
	}
	/**
	 * addCollection()
	 * Permite agregar elementos del mismo modelo al Objeto para crear colecciones
	 * de objetos arbitrarios
	 */
	public function addCollection(Core_App_Model_Model $obj)
	{
		$this->setModelStatus(self::MULTI_RECORD);
		$this->_record_id= 0;
		if(!$this->_recordsArray) $this->_recordsArray = array();
		$this->_recordsArray[]= $obj;
		// Esta linea es importante para hacer el count de la coleccion de objetos
		$this->_rawObjects[]= $obj;

		return;
	}
	public function getAll()
	{
		$sql=$this->getSelectAllQuery();
		$this->runSelectQuery($sql);

	}
	public function runSelectQuery($sql)
	{
		$result= $this->_db_connection->query($sql);
		if($result)
		{
			$this->setModelStatus(self::MULTI_RECORD);
			$this->_record_id= 0;
			$this->_rawObjects = array();
			$i=0;

			while($record = $this->_db_connection->fetchObject($result))
			{
				$this->_rawObjects[]= $record;
			}
		}else{
			echo $sql.'<br />';
			echo mysql_error();
		}
	}
	public function getSelectWhere( $where)
	{
		$sl=$this->getSelectAllQuery().' WHERE '.$where;
		return $sl;
	}

	public function getSelectAllQuery()
	{
		return "SELECT * FROM ".$this->_table;
	}
	public function getDirtyObjectAt( $index)
	{
		return @$this->_recordsArray[$index];
	}
	public function getObjectAt( $index )
	{
		if(!is_numeric($index)){
			return null;
		}

		if(isset($this->_recordsArray[$index]) && is_object($this->_recordsArray[$index]))
		{
			return $this->_recordsArray[$index];
		}

		if(isset($this->_rawObjects[$index]) && $this->_rawObjects[$index])
		{
			$newSelf= $this->newSelf($this->_db_connection);

			for($i=0; $i< count($this->_fields); $i++)
			{
				$field=$this->_fields[$i];
				$newSelf->set($field, $this->_rawObjects[$index]->$field);
			}
			$this->_recordsArray[$index] = $newSelf;
		}
		if(!isset($this->_recordsArray[$index]))
			return null;

		return $this->_recordsArray[$index];
	}

	public abstract function newSelf(Core_Db_Db $conection);

	public function getRecords()
	{
		return $this->_recordsArray;
	}

	private function setThisObject($dbResult)
	{
		$this->_objectRecord=array();
		$obj=$this->_db_connection->fetchObject($dbResult);
		foreach($this->_fields AS $field => $value){
			$this->setProp($value , $obj->$value);
		}
		$this->_rawObjects[] = $this;
		return;
	}
	public function loadArray($_array)
	{
		if(!is_array($_array))
			return new Core_Error_DbError(Core_Error_DbError::WrongData);

		foreach($this->_fields AS $index => $field){
			if(isset($_array[$field]))
				$this->setProp($field , $_array[$field]);
		}
	}
	public function set($propName , $propValue)
	{
		return $this->setProp($propName , $propValue);
	}

	private function setProp($propName , $propValue)
	{
		$this->_objectRecord[$propName]= $propValue;
	}

	public function prop($value)
	{
		return $this->getProperty($value);
	}

	public function getProperty($value)
	{
		return $this->_objectRecord[$value];
	}


	/**
	* Metodos para manejar Inserts
	*/
	private function construct_insert_fields($data){
		if( is_array($data) ){

			$total=count($data);
			$camp='';
			$value='';
			$m=0;
			foreach ($data as $key => $val){
				$camp.=" `$key`";
				if(($total-1)!=$m){
					$camp.=", ";
				}
				$value.="'".$this->secure_db_text($val)."'";
				if(($total-1)!=$m){
					$value.=", ";
				}
				$m++;
			}

			return "($camp) VALUES ($value)";
		}else if( !is_array($data) && !is_array($this->_fields) ){
			return "($data) VALUES ($fields)";
		}
	}

	/**
	* Se encarga de ejecutar el UPDATE contra la base de datos
	*/
	public function insert()
	{
		/*if($this->getModelStatus() != self::INSERT){
			// TODO enviar un error adecuado
			return false;
		}*/
		$fields = $this->construct_insert_fields($this->_objectRecord);

		$sql="INSERT INTO `{$this->_table}` $fields";
	    $r=$this->_db_connection->query($sql);

		if(!$r){
			error_log($sql, 0);
			error_log(mysql_error(), 0);
			error_log('', 0);
		}
		$this->_record_id = mysql_insert_id();
		$this->set('id' , $this->_record_id);
	    return $r;
	}

	/**
	* Metodos para manejar Updates
	*/


	private function constructUpdateFields($data, $validFields){
		if( is_array($data) ){
			$total=count($data);
			$camp='';
			$value='';

			foreach ($data as $key => $val){
				if(in_array( $key, $validFields )){
					$value.="`$key` = '".$this->secure_db_text($val)."'";
					$value.=", ";
				}
			}

			return substr($value ,0, -2);
		}
	}

	/**
	* Se encarga de ejecutar el UPDATE contra la base de datos
	*/
	public function update()
	{
		if($this->getModelStatus() != self::FOR_UPDATE)
		{
			// TODO enviar un error adecuado
			echo "ERROR UPDATE";
			return false;
		}
		$fields = $this->constructUpdateFields($this->_objectRecord, $this->_updateFields);
		$sql="UPDATE `{$this->_table}` SET $fields WHERE id=".$this->getId();

	    $r=$this->_db_connection->query($sql);
		if(!$r){
			error_log($sql, 0);
		}

	    return $r;
	}
	public function updateFields(Array $data, Array $fields)
	{
		if(!is_array($data))
			return false;

		$fields = $this->constructUpdateFields($data, $fields);
		$sql="UPDATE `{$this->_table}` SET $fields WHERE id=".$this->getId();

	    $r=$this->_db_connection->query($sql);
		if(!$r){
			error_log($sql, 0);
		}

	    return $r;
	}
	/**
	* Define el ID al que se realizarÃ¡ el Update
	*/
	public function load( $record_id)
	{
		if( !is_numeric($record_id))
		{
			trigger_error( "El identificador del objeto debe ser numerico", E_USER_ERROR);
			return;
		}
		$this->setModelStatus(self::FOR_UPDATE);
		$this->_record_id= $record_id;
		$this->set('id', $this->_record_id);

	}


	private function setModelStatus( $status){
		$this->_objectStatus = $status;
	}
	public function getModelStatus(){
		return $this->_objectStatus;
	}
	public function getId()
	{
		return $this->_record_id;
	}

	private function secure_db_text($txt){
		return mysql_real_escape_string($txt);
	}

	public function delete( $record_id)
	{
		$this->_record_id= $record_id;
		$this->setModelStatus(self::FOR_DELETE);
		$this->destroyDb();
	}

	public function destroyDb()
	{
		$sql="DELETE FROM `{$this->_table}` WHERE id=".$this->getId();
	    $r=mysql_query($sql);

		if(!$r){
			error_log($sql, 0);
		}

	    return $r;
	}

	public function count()
	{
		return count($this->_rawObjects);
	}

	/*
	* Funciones de control del iterador
	*/

	public function rewind()
	{
		$this->_pointer= 0;
	}
	public function current()
	{
		if($this->isDirty())
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
		if($this->isDirty())
			$row = $this->getDirtyObjectAt($this->_pointer);
		else
			$row = $this->getObjectAt($this->_pointer);
		if( $row)
		{
			$this->_pointer++;
		}
		return $row;
	}
	public function valid()
	{
		return ( !is_null( $this->current() ) );
	}

	/*
	* Metodos de control de referencia a otras tablas
	*/

	public function setReferenceStatus($status)
	{
		$this->_referenceStatus = $status;
	}

	public function setBelongsTo($model, $field)
	{
		$this->_belongToModelStr[$model]= $model;
		$this->_belongsId[$model]= $field;
	}
	public function getBelongsToId($model)
	{
		if($model == null){
			$model = array_keys($this->_belongToModelStr);
			$model= $model[0];
		}
		return $this->_belongsId[$model];
	}
	public function setHasMany($model_str, $field)
	{
		$this->_childModelString[$model_str]= $model_str;
		$this->_childModelString;
		$this->_hasMany_id[$model_str]= $field;
	}
	public function getHasManyId($model = null)
	{
		if($model == null){
			$model = array_keys($this->_childModel);
			$model= $model[0];
		}
		return $this->_hasMany_id[$model];
	}
	public function getHasOneId($model = null)
	{
		if($model == null){
			$model = array_keys($this->_hasOneChildModel);
			$model= $model[0];
		}
		return $this->_hasOneId[$model];
	}
	public function getPointerId($model = null)
	{
		if($model == null){
			$model = array_keys($this->_hasPointerModel);
			$model= $model[0];
		}
		return $this->_hasPointerId[$model];
	}
	public function getChilds($model = null)
	{
		/*
		Se encarga de generar el modelo con los elementos de una tabla _hasMany que
		se identifiquen con el $identifier entregado, se usa en casos de HasMany
		*/
		if($model == null){
			$model = array_keys($this->_childModel);
			$model= $model[0];
		}
		$str_newObj=$this->_childModelString[$model];
		$this->_childModel[$model] = new $str_newObj( $this->_db_connection);
		$this->_childModel[$model]->collection($this , $model);
		return $this->_childModel[$model];
	}
	public function getChild( $model = null, $query = null)
	{
		if(!$model)
		{
			$model = array_keys( $this->_hasOneChildModelStr);
			$model = $model[0];

		}
		$str_newObj= $this->_hasOneChildModelStr[$model];
		$this->_hasOneChildModel[$model] = new $str_newObj( $this->_db_connection);
		$this->_hasOneChildModel[$model]->findChild($this, $model);

		return $this->_hasOneChildModel[$model];
	}
	public function getPointedModel( $model = null , $query = null)
	{
		if(!$model){
			$model = array_keys( $this->_hasPointerModelStr);
			$model = $model[0];
		}
		$str_newObj= $this->_hasPointerModelStr[$model];
		$this->_hasPointerModel[$model] = new $str_newObj( $this->_db_connection);
		$this->_hasPointerModel[$model]->findPointed( $this, $model);

		return $this->_hasPointerModel[$model];
	}
	public function getParent( $model = null){

		if(!$model)
		{
			$model = array_keys( $this->_belongToModelStr);
			$model = $model[0];
		}
		$str_newObj= $this->_belongToModelStr[$model];
		$this->_belongToModel[$model] = new $str_newObj( $this->_db_connection);
		$this->_belongToModel[$model]->findParent($this, $model);

		return $this->_belongToModel[$model];
	}
	public function setHasOne($model, $field_id)
	{
		$this->_hasOneChildModelStr[$model]= $model;
		$this->_hasOneId[$model]= $field_id;
	}
	public function setPointerTo( $model, $field_id)
	{
		$this->_hasPointerModelStr[$model]= $model;
		$this->_hasPointerId[$model]= $field_id;
	}
}


?>