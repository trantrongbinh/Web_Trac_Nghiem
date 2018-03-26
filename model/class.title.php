<?php
	/**
	* TTB
	*/
	class title extends database{
		private $__id;
		private $__title;
		private $__content;
		private $__image;
		private $__view;
		
		function __construct(){
			$this->connect();
		}

		public function getId(){
	        return $this->__id;
	    }

	    public function setId($id){
	        $this->__id = $id;
	    }

	    public function getTitle(){
	        return $this->__title;
	    }

	    public function setTitle($title){
	        $this->__title = $title;
	    }

	    public function getContent(){
	        return $this->__content;
	    }

	    public function setContent($content){
	        $this->__content = $content;
	    }

	    public function getImage(){
	        return $this->__image;
	    }

	    public function setImage($image){
	        $this->__image = $image;
	    }

	    public function getView(){
	        return $this->__view;
	    }

	    public function setView($view){
	        $this->__view = $view;
	    }

		public function layTitle($from = 1, $sotinmottrang = 4){
	        $sql = "SELECT * FROM title ORDER BY id_title DESC LIMIT $from, $sotinmottrang";
	        $this-> query($sql);
	        return $this-> fetchALL();
	    }

	    public function layNewTitle(){
	    	$sql = "SELECT * from title WHERE id_title = (SELECT MAX(id_title) FROM title) ";
	        $this-> query($sql);
	        return $this-> fetch();
	    }

	    public function getDsTitle($vitri = -1, $limit = -1){
			$sql = "SELECT * FROM title ORDER BY id_title ASC";
			if($vitri > -1 && $limit > 1){
				$sql .=" limit $vitri,$limit";//nối tiếp câu lệnh truy vấn trên. 
			}
			$this->query($sql);
			return $this->fetchAll();
		}

	 	public function danhSachTitle(){
			$danhmuc = $this->getDsTitle();
			if(isset($_GET['page'])){
				$tranghientai = $_GET['page'];//lay trang hien tai
			}else{
				$tranghientai = 1;
			}

			$pagination = new pagination(count($danhmuc), $tranghientai, 7, 3);
			$paginationHTML = $pagination->showPagination();
			$limit = $pagination->_nItemOnPage;
			$vitri = ($tranghientai-1)*$limit;
			$danhmuc = $this->getDsTitle($vitri, $limit);
			return array('danhmuc'=>$danhmuc,'thanhphantrang'=>$paginationHTML);
		}

		public function layMaxID(){
			$sql = "SELECT MAX(id_title) as max FROM title";
			$this-> query($sql);
			return $this-> fetch();
		}

		public function themTitle(){
	        try
	        {
	            $sql = "INSERT INTO title VALUES (N'".$this->getId()."',N'".$this->getTitle()."',N'".$this->getContent()."',N'".$this->getImage()."', 0, 0, 0)";
	            $this-> query($sql);
	            return true;
	        }
	        catch(mysqli_sql_exception $e)
	        {
	            return false;
	        }
	    }

	    public function suaTitle($id){
	        try
	        {
	            $sql = "UPDATE title SET title = N'".$this->getTitle()."', content = N'".$this->getContent()."', name_image = N'".$this->getImage()."' WHERE id_title = '$id'";
	            $this-> query($sql);
	            return true;
	        }
	        catch(mysqli_sql_exception $e)
	        {
	            return false;
	        }
	    }

	    public function layFullTitle(){
	        $sql = "SELECT * FROM title ORDER BY id_title ASC";
	        $this-> query($sql);
	        return $this-> fetchALL();
	    }

	    public function layMotTitle($id){
	        $sql = "SELECT * FROM title where id_title = '$id' ";
	        $this-> query($sql);
	        return $this-> fetch();
	    }

	    public function xoaTitle($id){
	        try
	        {
	            $sql = "DELETE FROM title WHERE id_title = '$id' ";
	            $this-> query($sql);
	            return true;
	        }
	        catch(mysqli_sql_exception $e)
	        {
	            return false;
	        }
	    }

	    public function checkTitle($id){
	        $kq = $this->layMotTitle($id);
	        if ( $kq == null ){
	            return false;
	        }
	        else{
	            return true;
	        }
	    }

	}
?>