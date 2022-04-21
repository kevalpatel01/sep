<?php
final class Database {
	private $servername;
	private $username;
	private $password;
	private $dbname;
	
	private $conn = NULL;
	private $res = NULL;
	private $errorMsg = NULL;
	private $errorCode = NULL;
	
	public function esc($str) {
		if (get_magic_quotes_gpc()) 
			$str = stripslashes($str);
		}
		// Id�z�jelez�s, ha nem eg�sz �rt�k
		if (!is_numeric($str)) {
			$str = mysqli_real_escape_string($str);
		}
		return $str;
	}
	
	function __construct($servername, $username, $password, $dbname) {
		$this->servername = $servername;
		$this->username = $username;
		$this->password = $password;
		$this->dbname = $dbname;
		
		$this->conn = NULL;
		$this->res = NULL;
		
		$this-> DB_connect();
	}

	private function DB_connect() {
		if (!$this->conn = @mysqli_connect($this->servername, $this->username, $this->password)) {
			$this->errorCode = mysqli_errno($this->conn);
			$this->errorMsg = mysqli_error($this->conn);
			return null;
		}
		$this->select_DB();
		return $this->conn;
	}
	
	public function __sleep() {
		mysqli_close($this->conn);
	}
	
	public function __wakeup() {
		$this->DB_connect();
	}
	
	public function select_DB() {
		if (@!mysqli_select_db($this->conn, $this->dbname)) {
			$this->errorCode = mysqli_errno($this->conn);
			$this->errorMsg = mysqli_error($this->conn);
			return null;
		}	
	}
	
	public function DB_query($query) {
		if (!$this->res = @mysqli_query($this->conn, $query)) {
			$this->errorCode = mysqli_errno($this->conn);
			$this->errorMsg = mysqli_error($this->conn);
			debug($this->errorMsg);
			return NULL;
		}
		return $this->res;
	}
	
	public function DB_getnextrow() {
		if ($this->res)	
			return @mysqli_fetch_assoc($this->res);
		else return 0;
	}
	
	public function DB_fetch_row() {
		if ($this->res)
			return @mysqli_fetch_row($this->res);
		else return 0;
	}
	
	public function get_last_id(){
	  	return @mysqli_insert_id($this->conn);
	}
  
	public function loadResult() {
		$array = array();
		while ($row = @mysqli_fetch_object($this->res)) {
			$array[] = $row;
		}
		mysqli_free_result($this->res);
		return $array;
	}
  
	public function getErrorCode() {
	  	return $this->errorCode;
	}
  
	public function getErrorMsg() {
		return $this->errorMsg;
	}
  
}
?>