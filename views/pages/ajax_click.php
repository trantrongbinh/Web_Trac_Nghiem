<?php
	include('../../model/database.class.php');
	include('../../controller/question.php');

	$questions = new data_question();
	$id = $_POST['id'];
	$idq = $_POST['idq'];
	$click_in_title = $questions->setClickInTitle($id);
	$click_in_question = $questions->setClickInQuestion($idq);
?>