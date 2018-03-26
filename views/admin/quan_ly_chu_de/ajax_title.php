<?php
include('../../../model/database.class.php');
include('../../../model/class.title.php');
include('../../../controller/question.php');
	$questions = new data_question();
	$key = $_POST['data'];
	if(empty($key)){
		echo "<script>window.history.go(0);</script>";
	}else{
		$danhsach = $questions->search($key);
		
		foreach ($danhsach as $ds) { 
		?>
		  <tr>
		    <td style="text-align:center; color: #900;"><?=$ds['id_title']?></td>
		    <td><b><?=$ds['title']?></b></td>
		    <td style="text-align: center;"><?=$ds['content']?></td>
		    <td style="text-align: center;"><i class="fa fa-pencil fa-fw"></i> <a href="?p=edit&id-title=<?=$ds['id_title']?>">Edit</a></td>
		    <td style="text-align: center;"><i class="fa fa-pencil fa-fw"></i> <a href="?p=chi-tiet&id-title=<?=$ds['id_title']?>">Xem</a></td>
		    <td style="text-align: center;">
		      <input type="checkbox"  name='num[]' class="other" value='<?=$ds['id_title']?>' >
		      <?php
		      $dsselection = $questions->laySelectionByIdTitle($ds['id_title']);
		      foreach ($dsselection as $ds) {
		        ?>
		        <input style="display: none" type="text"  name='num2[]' class="other" value='<?=$ds['id_selection']?>' >
		        <?php
		      }
		      ?>
		    </td>
		  </tr>
		<?php
		}
	}
?>