<?php
/**
* 
*/
class data_question extends database{
	
	function getQuestion($id_title){
		$sql="SELECT q.*, GROUP_CONCAT(DISTINCT s.id_selection, ':',s.name_select, ':',s.control) AS selection FROM question AS q INNER JOIN selection AS s ON s.id_question = q.id_question where q.id_title = '$id_title' GROUP BY q.id_question";
		$this->query($sql);
		return $this->fetchAll();
	}

	function getMostView(){
		$sql = "SELECT * FROM title WHERE view > 0 ORDER BY view DESC LIMIT 0,7";
		$this->query($sql);
		return $this->fetchAll();
	}

	function getMostTrueInTitle(){
		$sql = "SELECT * FROM title ORDER BY click_true DESC LIMIT 0,7";
		$this->query($sql);
		return $this->fetchAll();
	}

	function getIDTitle(){
		$sql = "SELECT id_title AS id FROM title";
		$this->query($sql);
		return $this->fetchAll();
	}

	function getIDQuestion(){
		$sql = "SELECT id_question AS id FROM question";
		$this->query($sql);
		return $this->fetchAll();
	}

	function countQuestion($id_title){
		$sql = "SELECT COUNT(*) AS number FROM question WHERE id_title = $id_title";
		$this->query($sql);
		return $this->fetch();
	}

	function countSelect($id_question){
		$sql = "SELECT COUNT(*) AS number_q FROM selection WHERE id_question = $id_question";
		$this->query($sql);
		return $this->fetch();
	}

	function delQuestionByIdTitle($id){
		try
        {
            $sql = "DELETE FROM question WHERE id_title = '$id' ";
            $this-> query($sql);
            return true;
        }
        catch(mysqli_sql_exception $e)
        {
            return false;
        }
    }

    function laySelectionByIdTitle($id){
    	$sql="SELECT s.* FROM selection s, question q, title t WHERE t.id_title = q.id_title AND q.id_question = s.id_question AND t.id_title = $id";
		$this->query($sql);
		return $this->fetchAll();
    }

	function delSelectionByIdTitle($id){
		try
        {
            $sql = "DELETE s.* FROM selection s, question q, title t WHERE t.id_title = q.id_title AND q.id_question = s.id_question AND t.id_title = '$id' ";
            $this-> query($sql);
            return true;
        }
        catch(mysqli_sql_exception $e)
        {
            return false;
        }
    }

    function search($key, $vitri = -1, $limit = -1){
		$sql = "SELECT * FROM title WHERE MATCH (title, content) AGAINST ('$key' IN NATURAL LANGUAGE MODE)";
		if($vitri > -1 && $limit > 1){
			$sql .=" limit $vitri,$limit";//nối tiếp câu lệnh truy vấn trên. 
		}
		$this->query($sql);
		return $this->fetchAll(array($key));
	}


    function timkiem($key){
		$data = $this->search($key);
		if(isset($_GET['page'])){
			$tranghientai = $_GET['page'];//lay trang hien tai
		}else{
			$tranghientai = 1;
		}

		$pagination = new pagination(count($data), $tranghientai, 7, 2);
		$paginationHTML = $pagination->showPagination();
		$limit = $pagination->_nItemOnPage;
		$vitri = ($tranghientai-1)*$limit;
		$data = $this->search($key,$vitri, $limit);
		return array('data'=>$data,'thanhphantrang'=>$paginationHTML);
		
		//return $doan;
	}

	function setView($id){
		$sql = "UPDATE title SET view = view + 1 WHERE id_title = $id";
		$this->query($sql);
	}

	function getTrueInTitle($id){
		$sql = "SELECT click_true AS count FROM title WHERE id_title = $id";
		$this->query($sql);
		return $this->fetch();
	}

	function setTrueInTitle($id){
		$sql = "UPDATE title SET click_true = click_true + 1 WHERE id_title = $id";
		$this->query($sql);
	}

	function setTrueInQuestion($id){
		$sql = "UPDATE question SET click_true = click_true + 1 WHERE id_question = $id";
		$this->query($sql);
	}
	
	function setClickInTitle($id){
		$sql = "UPDATE title SET click = click + 1 WHERE id_title = $id";
		$this->query($sql);
	}
	function setClickInQuestion($id){
		$sql = "UPDATE question SET click = click + 1 WHERE id_question = $id";
		$this->query($sql);
	}

	function getHardTitle(){
		$sql = "SELECT * FROM title WHERE click > 0 AND click_true > 0 ORDER BY id_title ASC";
		$this->query($sql);
		return $this->fetchAll();
	}

	function HardTitle(){
		$hard = $this->getHardTitle();
		$row = array();
		for($i = 0; $i < count($hard); $i ++){
			if(round(($hard[$i]['click_true']/$hard[$i]['click']),2) < 0.30){
				$row[$i] = $hard[$i];
			}
		}
		
		return $row;
	}

	function getHardQuestion(){
		$sql = "SELECT * FROM question WHERE click > 0 AND click_true > 0 ORDER BY id_question ASC";
		$this->query($sql);
		return $this->fetchAll();
	}

	function HardQuestion(){
		$hard = $this->getHardQuestion();
		$row = array();
		for($i = 0; $i < count($hard); $i ++){
			if(round(($hard[$i]['click_true']/$hard[$i]['click']),2) < 0.30){
				$row[$i] = $hard[$i];
			}
		}
		
		return $row;
	}

	function resetClickTitle($id){
		$sql = "UPDATE title SET click_true = '0', click = '0'  WHERE id_title = $id";
		$this->query($sql);
	}

	function runResetClickTitle(){
		$tmp = $this->getIDTitle();
		for($i = 0; $i < count($tmp); $i++){
			$this->resetClickTitle($tmp[$i]['id']);
		}
	}

	function resetClickQuestion($id){
		$sql = "UPDATE question SET click_true = '0', click = '0'  WHERE id_question = $id";
		$this->query($sql);
	}

	function runResetClickQuestion(){
		$tmp = $this->getIDQuestion();
		for($i = 0; $i < count($tmp); $i++){
			$this->resetClickQuestion($tmp[$i]['id']);
		}
	}
}
?>