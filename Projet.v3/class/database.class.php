<?php 
class Database {
    
    private $cnx; // connexion bdd
    private $stmt; // statement request
    
    public function __construct($sgbd = NULL, $host = NULL, $db = NULL, $port = NULL, $user = NULL, $pass = NULL) {
        if(is_null($sgbd)) {
            $sgbd = BDD_SGBD;
        }
        if(is_null($host)) {
            $host = BDD_HOST;
        }
        if(is_null($db)) {
            $db = BDD_DATABASE;
        }
        if(is_null($port)) {
            $port = BDD_PORT;
        }
        if(is_null($user)) {
            $user = BDD_USER;
        }
        if(is_null($pass)) {
            $pass = BDD_PASSWORD;
        }
       
       try {
           $this->cnx = new PDO($sgbd.':host='.$host.';dbname='.$db.';port='.$port,$user,$pass,
			                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
       }
       catch(Exception $e) {
    		echo $e->getMessage();
    		die;
	    }
	   return true;
    } 
    
    // préparation/exécution request
    public function executeQuery($query, $params = array())
	{

		$this->stmt = $this->cnx->prepare($query);
		$this->stmt->execute($params);

		return true;
	}
	
	// (UPDATE, INSERT...)
	public function sqlSimpleQuery($query, $params = array()) {
		$result = $this->executeQuery($query, $params);

		return $result;
	}
	
	//SELECT many results
	public function sqlManyResults($query, $params = array()) {
		$data = array();

		$this->executeQuery($query, $params);

		$data = @$this->stmt->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}
	
	// SELECT one result 
	public function sqlSingleResult($query, $params = array()) {
		$data = array();

		$this->executeQuery($query, $params);

		$data = @$this->stmt->fetch(PDO::FETCH_ASSOC);

		return $data;
	}
	
	// last insert id 
	public function lastInsertId()
	{
		return $this->cnx->lastInsertId();
	}
}