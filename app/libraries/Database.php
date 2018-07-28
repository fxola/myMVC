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
 			PDO::ATTR_ERRMODE => PDO_ERRMODE_EXCEPTION
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
 }

?>