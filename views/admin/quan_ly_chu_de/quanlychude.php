<?php
include('../../model/database.class.php');
include('../../model/class.title.php');
include('../../model/class.question.php');
include('../../model/class.selection.php');
include('../../controller/pager.php');
include('../../controller/question.php');

$title = new title();
$questions = new data_question();
$questions2 = new question();
$selection = new selection();
$dstitle = $title->danhSachTitle();
$danhsach = $dstitle['danhmuc'];
$thanhphantrang = $dstitle['thanhphantrang'];

if(isset($_POST['delete'])){
  $box=$_POST['num'];
  while (list($key, $val) = @each($box)){
    $ketqua = $questions ->delSelectionByIdTitle($val);
    $ketqua = $questions ->delQuestionByIdTitle($val);
    $ketqua = $title ->xoaTitle($val);
  }
  ?>
  <script type="text/javascript">
    window.location.href = window.location.href;
  </script>
  <?php
}

if(isset($_POST['reset_hard_t'])){
  $dem = $questions ->runResetClickTitle();
  echo "<script>  alert('Reset thành công!');</script>";
}

if(isset($_POST['reset_hard_q'])){
  $dem = $questions ->runResetClickQuestion();
  echo "<script>  alert('Reset thành công!');</script>";
}

if (isset($_SESSION['sua']) && $_SESSION['sua'] == 'done'){
    echo '<div class="alert alert-success"> Cập nhật thành công!!!</div>';
    $_SESSION['sua'] = "";
}
?>

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td {
    border: 1px solid #bbbbbb;
    text-align: left;
    padding: 8px;
}

th {
    text-align:center;
	  background-color:#003366;
	  padding: 8px;
	  color:white;
		
}
tr:nth-child(even) {
    background-color: #eeeeee;
}
</style>

<h2><strong>Quản lý nội dung</strong></h2>        
<form name="form1" action="" method="POST">
<div style="width:600px; height:120px;margin: 15px 10px 10px 10px;">
	<br>
	<br>
	<label style="margin-left:50px;">Tìm kiếm: </label>     
	<input class="timkiem" type="text" name="timkiem" value=" " style="width:480px; height:24px;margin-bottom:5px;">
	<input type="submit" name="delete" value=" Gỡ bài"  style="width:80px;height:24px; float:right; margin-left:2px;"/>
	<input type="button" value= " Thêm mới" style="width:80px;height:24px; float:right;margin-left:2px;" onclick="them()">
  <input type="submit" name="reset_hard_q" value=" Reset Câu hỏi khó"  style="width:120px;height:24px; float:right; margin-left:2px;"/>
  <input type="submit" name="reset_hard_t" value=" Reset Chủ đề khó"  style="width:120px;height:24px; float:right; margin-left:2px;"/>
</div>

<div style="width:740px; min-height:580px; border-style:groove; border-width:thin;margin-left:10px;"> 
<table>
  <thead>
    <tr>
      <th width="30">STT</th>
      <th width="250">Tiêu đề</th>
      <th width="450">Nội dung</th>
      <th width="20">Sửa</th>
      <th width="20">Xem</th>
      <th width="20">Chọn</th>
    </tr>
  </thead>
  <tbody id="danhsach">
    <?php
      // $stt = 1;
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
      
    ?>
  </tbody>
</table>
</div>
</form> 
<div id="phantrang" style = "text-align: center;"><?=$thanhphantrang?></div>
<style>
.pagination>li{
    float: left;
    padding: 10px;
}
</style>

<script language="javascript">
  function them() {
    window.location.assign("?p=them-chu-de")
  }

  $(document).ready(function(){
    $('.timkiem').keyup(function() {
      var txt = $('.timkiem').val();
        $.post('quan_ly_chu_de/ajax_title.php', {data: txt}, function(data){
            $('#danhsach').html(data);
        })
    });
  });
</script>