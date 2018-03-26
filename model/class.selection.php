<?php
	/**
	* TTB
	*/
	class selection extends database{
		private $__id;
		private $__name;
		private $__control;
		private $__id_question;
		
		function __construct(){
			$this->connect();
		}

		public function getId(){
	        return $this->__id;
	    }

	    public function setId($id){
	        $this->__id = $id;
	    }

	    public function getName(){
	        return $this->__name;
	    }

	    public function setName($name){
	        $this->__name = $name;
	    }

	    public function getControl(){
	        return $this->__control;
	    }

	    public function setControl($control){
	        $this->__control = $control;
	    }

	    public function getIdQuestion(){
	        return $this->__id_question;
	    }

	    public function setIdQuestion($id_question){
	        $this->__id_question = $id_question;
	    }

		public function themSelection(){
	        try
	        {
	            $sql = "INSERT INTO selection VALUES (null,N'".$this->getName()."', N'".$this->getIdQuestion()."', N'".$this->getControl()."')";
	            $this-> query($sql);
	            return true;
	        }
	        catch(mysqli_sql_exception $e)
	        {
	            return false;
	        }
	    }

	    public function suaSelection($id){
	        try
	        {
	            $sql = "UPDATE selection SET name_select = N'".$this->getName()."', id_question = N'".$this->getIdQuestion()."', control = N'".$this->getControl()."' WHERE id_selection = $id";
	            $this-> query($sql);
	            return true;
	        }
	        catch(mysqli_sql_exception $e)
	        {
	            return false;
	        }
	    }

	    public function laySelection(){
	        $sql = "SELECT * FROM selection ORDER BY id_selection ASC";
	        $this-> query($sql);
	        return $this-> fetchALL();
	    }

	    public function layMaxID(){
			$sql = "SELECT MAX(id_selection) as max FROM selection";
			$this-> query($sql);
			return $this-> fetch();
		}

	    public function layMotSelection($id){
	        $sql = "SELECT * FROM selection where id_selection = '$id' ";
	        $this-> query($sql);
	        return $this-> fetch();
	    }

	    public function xoaSelection($id){
	        try
	        {
	            $sql = "DELETE FROM selection WHERE id_selection = '$id' ";
	            $this-> query($sql);
	            return true;
	        }
	        catch(mysqli_sql_exception $e)
	        {
	            return false;
	        }
	    }

	    public function checkSelection($id){
	        $kq = $this->layMotSelection($id);
	        if ( $kq == null ){
	            return false;
	        }
	        else{
	            return true;
	        }
	    }
	}
?>