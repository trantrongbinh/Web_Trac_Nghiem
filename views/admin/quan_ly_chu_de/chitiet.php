<?php
include('../../model/database.class.php');
include('../../model/class.title.php');
include('../../controller/question.php');

$title = new title();
$questions = new data_question();
if (!isset($_GET['id-title']) || $title->checkTitle($_GET['id-title']) == false ) {
    echo "<script>  alert('Không tồn tại!!!');</script>";
    exit();
}
$chude  = $title->layMotTitle($_GET['id-title']);
$question  = $questions->getQuestion($_GET['id-title']);

?>

<br>
<h1 class="title"><?=$chude['title']?></h1>
<br>
<div class="click">
  <a class="nut" href="admin.php?p=them-question&id-title=<?=$chude['id_title']?>" >Thêm câu hỏi</a>
</div>
<br>
<img style="display: block; margin-left: auto; margin-right: auto;" alt="ảnh" src="../upload/images/<?=$chude['name_image']?>" width="470" height="350">
<br>
<div class="des"><i><?=$chude['content']?></i></div>
<br>
<br>
<div class="chitiet">
  <br>
    <?php
      foreach ($question as $ds) {
      ?>
        <img alt="ảnh" src="../upload/images/<?=$ds['name_image']?>" width="450" height="350">
        <br>
        <br>
        <h2><?=$ds['name']?></h2>
        <div class="click">
          <a class="nut" href="?p=edit&id-title=<?=$ds['id_title']?>">Edit</a>
          <a class="nut" onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="admin.php?p=xoa-question&id-question=<?=$ds['id_question']?>"> Delete</a>
          <a class="nut" href="admin.php?p=them-selection&id-question=<?=$ds['id_question']?>" >Thêm đáp án</a>
        </div>
        <br>
        <div id="disabled">
          <?php
            $selection = explode(',',$ds['selection']);//phan cach mang thanh cac mang con boi dau ','
            foreach ($selection as $s) {
              list($id, $select, $control) = explode(':', $s);
              ?>
              <div class="select">
                <h2 class="check<?=$ds['id_question']?>" style="padding: 10px" onclick="myFunction(<?=$ds['id_question']?>, <?=$control?>, <?=$id?>)" ><a class="title chon<?=$id?>" href="#"><?=$select?></a></h2>
                <div class="click btn2">
                  <a class="nut" href="?p=edit&id-title=<?=$ds['id_title']?>">Edit</a>
                  <a class="nut" onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="admin.php?p=xoa-selection&id-selection=<?=$id?>"> Delete</a>
                </div>
                <?php
                  if($control == 1){
                    ?>
                    <div class="selection<?=$ds['id_question']?> gt answer">
                      <p>Đáp án chính xác là: <mark><?=$select?></mark></p>
                      <hr>
                      <p><?=$ds['answer']?></p>
                    </div>
                    <?php
                  }
                ?>
              </div>
              <?php
            }
          ?>
            <div class="chen<?=$ds['id_question']?>"></div>
          </div>
          <br>
      <?php
      }
    ?>
</div>
<style>
  .nut{
    color: white;
    background: blue;
    padding: 2px;
  }
  .btn2{
    margin-left: 50px;
  }
  .click a:hover{
    background: #900;
  }
</style>