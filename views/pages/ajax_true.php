<?php
	include('../../model/database.class.php');
	include('../../controller/question.php');

	$questions = new data_question();
	$number = $_POST['data'];
	$id = $_POST['id'];
	$idq = $_POST['idq'];
	$true_in_title = $questions->setTrueInTitle($id);
	$true_in_question = $questions->setTrueInQuestion($idq);
?>
<input style="display: none;"  class="n" id="n" type="number" name="n" value="<?=$number?>">
<?php
?>