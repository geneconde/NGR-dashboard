<?php
/**
 * Database wrapper using MySQL and PHP's PDO.
 * Created by: Raina Gamboa
 */
class DB extends PDO {
	/** LIVE
	protected $host = DATABASE_HOST; 
	protected $username = DATABASE_USERNAME; 
	protected $password = DATABASE_PASSWORD; 
	protected $database = DATABASE_NAME; 
	**/
	
	var $stmt;
	
	protected $host = "localhost";
	/*protected $username = "jigzenco_ngrdev";
	protected $password = "jigzen1234aA";*/
	protected $username = "root";
	protected $password = "password";
	protected $database = "jigzenco_dashboard_live";
	
	private $conn = null;
	private $sql;
	
	public function __construct() {}
	
	public function connect() {
		try {
			$this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			$this->dberror($e->getMessage());
		}
	}
	
	public function select($table, $where="", $fields="*", $orderby="") {
		try {
			$sql = "SELECT " . $fields . " FROM " . $table;
			if(!empty($where)) {
				$wherestr = null;
				foreach ($where as $key => $val) {
					if ($wherestr != null)
						$wherestr .= " AND ";
					
					$wherestr .= "$key = :$key";
				}
				$sql .= " WHERE " . $wherestr;
			}
			
			if(!empty($orderby))
				$sql .= " ORDER BY $orderby ";
				
			$sql .= ";";
			
			$this->stmt = $this->conn->prepare($sql);
			
			if(!empty($where)) {
				foreach ($where as $key => $val)
					$this->stmt->bindValue(":$key", $val);
			}
				
			$this->stmt->execute();
			$result = $this->stmt->fetchAll();
			
			return $result;
		} catch (Exception $e) {
			$this->dberror($e->getMessage());
		}
	}

	public function selectDistinct($table, $where="", $fields="*", $orderby="") {
		try {
			$sql = "SELECT DISTINCT " . $fields . " FROM " . $table;
			if(!empty($where)) {
				$wherestr = null;
				foreach ($where as $key => $val) {
					if ($wherestr != null)
						$wherestr .= " AND ";
					
					$wherestr .= "$key = :$key";
				}
				$sql .= " WHERE " . $wherestr;
			}
			
			if(!empty($orderby))
				$sql .= " ORDER BY $orderby ";
				
			$sql .= ";";
			
			$this->stmt = $this->conn->prepare($sql);
			
			if(!empty($where)) {
				foreach ($where as $key => $val)
					$this->stmt->bindValue(":$key", $val);
			}
				
			$this->stmt->execute();
			$result = $this->stmt->fetchAll();
			
			return $result;
		} catch (Exception $e) {
			$this->dberror($e->getMessage());
		}
	}
	
	public function insert($table, $data) {
		try {
			$columns = array();
			$placeholders = array();
			
			foreach ($data as $key => $val) {
				$columns[] = $key;
				$placeholders[] = ":$key";
			}
			
			$columns      = implode(', ', $columns);
			$placeholders = implode(', ', $placeholders);
			
			$sql   = "INSERT INTO $table ($columns) VALUES ($placeholders);";
			$this->stmt = $this->conn->prepare($sql);
			
			foreach ($data as $key => $val)
				$this->stmt->bindValue(":$key", $val);
			
			return $this->stmt->execute();
		} catch (Exception $e) {
			$this->dberror($e->getMessage());
		}
	}

	public function insertReturn($table, $data) {
		try {
			$columns = array();
			$placeholders = array();
			
			foreach ($data as $key => $val) {
				$columns[] = $key;
				$placeholders[] = ":$key";
			}
			
			$columns      = implode(', ', $columns);
			$placeholders = implode(', ', $placeholders);
			
			$sql   = "INSERT INTO $table ($columns) VALUES ($placeholders);";
			$this->stmt = $this->conn->prepare($sql);
			
			foreach ($data as $key => $val)
				$this->stmt->bindValue(":$key", $val);
			
			$this->stmt->execute();

			return $this->conn->lastInsertId();
		} catch (Exception $e) {
			$this->dberror($e->getMessage());
		}
	}
	
	public function delete($table, $where) {
		try {
			$wherestr = null;
			foreach ($where as $key => $val) {
				if ($wherestr != null)
					$wherestr .= " AND ";
				
				$wherestr .= "$key = :$key";
			}
			
			$sql = "DELETE FROM $table WHERE $wherestr;";
			$this->stmt = $this->conn->prepare($sql);
			 
			foreach ($where as $key => $val)
				$this->stmt->bindValue(":$key", $val);
			
			return $this->stmt->execute();
		} catch (Exception $e) {
			$this->dberror($e->getMessage());
		}
	}
	
	public function update($table, $where, $data) {
		try {
			$wherestr = null;
			foreach ($where as $key => $val) {
				if ($wherestr != null)
					$wherestr .= " AND ";
				$wherestr .= "$key = :$key";
			}
			
			$setstr = null;
			foreach ($data as $key => $val) {
				if ($setstr != null)
					$setstr .= ", ";
				$setstr .= "$key = :$key";
			}
			
			$sql = "UPDATE $table SET $setstr WHERE $wherestr;";
			$this->stmt = $this->conn->prepare($sql);
			 
			foreach ($data as $key => $val)
				$this->stmt->bindValue(":$key", $val);
			
			foreach ($where as $key => $val)
				$this->stmt->bindValue(":$key", $val);
			
			return $this->stmt->execute();
		} catch (Exception $e) {
			$this->dberror($e->getMessage());
		}
	}
	
	public function query($sql) {
		try {
			$this->stmt = $this->conn->prepare($sql);
				
				if(!empty($where)) {
					foreach ($where as $key => $val)
						$this->stmt->bindValue(":$key", $val);
				}
					
				$this->stmt->execute();
				$result = $this->stmt->fetchAll();
				
				return $result;
		} catch (Exception $e) {
				$this->dberror($e->getMessage());
		}
	}
	
	public function dbgetrowcount() {
		try {
			$count = $this->stmt->rowCount();
			return $count;
		} catch (Exception $e) {
			$this->dberror($e->getMessage());
		}
	}
	
	public function dblastinsertid() {
		return $this->conn->lastInsertId();
	}
	
	public function disconnect() {
		$this->conn = null;
	}
	
	function dberror($e) {
		$dbe['error'] = "DB-ERROR";
		$dbe['msg'] = $e;
		$dbe['sql'] = $this->sql;
		$dbe['debug_backtrace']= debug_backtrace();
		var_dump($dbe);
		exit();
	}
}
?>