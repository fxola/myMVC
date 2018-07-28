<?php
/*
 *PDO database class
 *Connect to database
 *Create prepared statements
 *Bind Values
 *Return rows and results
 *
 */

 class Database
 {
 	private $host = DB_HOST;

 	private $user = DB_USERNAME;

 	private $password = DB_PASSWORD;

 	private $db_name = DB_NAME;

 	private $dbh;

 	private $stmt;

 	private $error;

 	public function __construct()
 	{
 		//set DSN

 		$dsn = 'mysql:host='. $this->host .'; dbname=' . $this->db_name;

 		$options = [
 			PDO::ATTR_PERSISTENT => true,
 			PDO::ATTR_ERRMODE => 'PDO_ERRMODE_EXCEPTION'
 		];


 		//create new PDO instance

 		try
 		{
 			$this->dbh = new PDO($dsn, $this->user, $this->password, $options);
 		}

 		catch(PDOException $e)
 		{
 			$this->error = $e->getMessage();

 			echo $this->error;
 		}
 	}


 	//prepare statement with query

 	public function query($sql)
 	{
 		$this->stmt = $this->dbh->prepare($sql);
 	}


 	//Bind Values

 	public function bind($params, $value, $type = null)
 	{
 		if(is_null($type))
 		{
 			switch (true) 
 			{
 				case is_int($value):
 					$type = PDO::PARAM_INT;
 					break;

 				case is_bool($value):
 					$type = PDO::PARAM_BOOL;
 					break;

 				case is_null($value):
 					$type = PDO::PARAM_NULL;
 					break;
 				
 				default:
 					$type = PDO::PARAM_STR;
 			}
 		}

 		$this->stmt->bindValue($params, $value, $type);
 	}



 	//Execute Prepared statement

 	public function execute()
 	{
 		$this->stmt->execute();
 	}



 	//Get Result Set as array of objects

 	public function resultSet()
 	{
 		$this->execute();

 		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
 	}


 	//Get Single record as object

 	public function row()
 	{
 		$this->execute();

 		return $this->stmt->fetch(PDO::FETCH_OBJ);
 	}


 	//Get Row count

 	public function rowCount()
 	{
 		return $this->stmt->rowCount();
 	}

 }

?>