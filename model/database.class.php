<?php
	/**
	* TTB
	*/
	class database{
		private $__hostname = "localhost";
		private $__userhost = "root";
		private $__passhost = "";
		private $__dbname = "questions";
		private $__conn = null;
		private $__result = null;
		
		function __construct(){
			$this->connect();
		}

		public function connect(){
			$this->__conn = mysqli_connect($this->__hostname, $this->__userhost, $this->__passhost, $this->__dbname) or die ('Loi ket noi');
			mysqli_query($this->__conn, "SET NAMES 'utf8'");
		}

		public function disconnect(){
			if($this->__conn)
				mysqli_close($this->__conn);
		}

		public function query($sql){
			$this->__result = mysqli_query($this->__conn, $sql) or die ('loi query');
		}

		public function runQuery($query){
			$result = mysqli_query($this->__conn, $query);
			while($row = mysqli_fetch_assoc($result)){
				$result[] = $row;
			}
			if(!empty($result)) return $result;
		}

		public function fetch(){
			$data = array();
			$data = mysqli_fetch_assoc($this->__result);
			return $data;
		}

		public function fetchAll(){
			$data = array();
			while($row = $this->fetch()){
				$data[] = $row;
			}
			return $data;
		}
	}
?>