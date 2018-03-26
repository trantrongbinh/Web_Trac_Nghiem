<?php
	/**
	* TTB
	*/
	class question extends database{
		private $__id;
		private $__name;
		private $__answer;
		private $__image;
		private $__id_title;
		
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

	    public function getAswer(){
	        return $this->__answer;
	    }

	    public function setAswer($answer){
	        $this->__answer = $answer;
	    }

	    public function getImage(){
	        return $this->__image;
	    }

	    public function setImage($image){
	        $this->__image = $image;
	    }

	    public function getIdTitle(){
	        return $this->__id_title;
	    }

	    public function setIdTitle($id_title){
	        $this->__id_title = $id_title;
	    }

		public function themQuestion(){
	        try
	        {
	            $sql = "INSERT INTO question VALUES (N'".$this->getId()."',N'".$this->getName()."', N'".$this->getAswer()."', N'".$this->getIdTitle()."', N'".$this->getImage()."')";
	            $this-> query($sql);
	            return true;
	        }
	        catch(mysqli_sql_exception $e)
	        {
	            return false;
	        }
	    }

	    public function themQuestion2(){
	        try
	        {
	            $sql = "INSERT INTO question VALUES (null, N'".$this->getName()."', N'".$this->getAswer()."', N'".$this->getIdTitle()."', N'".$this->getImage()."')";
	            $this-> query($sql);
	            return true;
	        }
	        catch(mysqli_sql_exception $e)
	        {
	            return false;
	        }
	    }

	    public function suaQuestion($id){
	        try
	        {
	            $sql = "UPDATE question SET name = N'".$this->getName()."', answer = N'".$this->getAswer()."', id_title = N'".$this->getIdTitle()."', name_image = N'".$this->getImage()."' WHERE id_question = $id ";
	            $this-> query($sql);
	            return true;
	        }
	        catch(mysqli_sql_exception $e)
	        {
	            return false;
	        }
	    }

	    public function layQuestion(){
	        $sql = "SELECT * FROM question ORDER BY id_question ASC";
	        $this-> query($sql);
	        return $this-> fetchALL();
	    }

	    public function layMaxID(){
			$sql = "SELECT MAX(id_question) as max FROM question";
			$this-> query($sql);
			return $this-> fetch();
		}


	    public function layMotQuestion($id){
	        $sql = "SELECT * FROM question where id_question = '$id' ";
	        $this-> query($sql);
	        return $this-> fetch();
	    }

	    public function xoaQuestion($id){
	        try
	        {
	            $sql = "DELETE FROM question WHERE id_question = '$id' ";
	            $this-> query($sql);
	            return true;
	        }
	        catch(mysqli_sql_exception $e)
	        {
	            return false;
	        }
	    }

	    public function checkQuestion($id){
	        $kq = $this->layMotQuestion($id);
	        if ( $kq == null ){
	            return false;
	        }
	        else{
	            return true;
	        }
	    }
	}
?>