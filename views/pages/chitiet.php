<?php
$questions = new data_question();
$view = $questions->setView($_GET['id_title']);
$titles = new title();
if (!isset($_GET['id_title'])) {
    echo "<script>  alert('Không tồn tại!!!');</script>";
    exit();
}
$question  = $questions->getQuestion($_GET['id_title']);
$title = $titles->layMotTitle($_GET['id_title']);
$countQ = $questions->countQuestion($_GET['id_title']);
$number = $countQ['number'];

?>

<br>
<h1 class="title"><?=$title['title']?></h1>
<br>
<div class="des"><i><?=$title['content']?></i></div>
<br>
<br>
<div class="chitiet">
  <h3><i>( Bạn hãy cân nhắc kỹ khi trả lời các câu hỏi có dấu sao, đó đầu là những câu hỏi khó. )</i><h3>
  <br>
    <?php
      foreach ($question as $ds) {
      ?>
        <img alt="ảnh" src="views/upload/images/<?=$ds['name_image']?>" width="450" height="350">
        <br>
        <br>
        <br>
        <?php
        if(($ds['click_true'] > 0 && $ds['click'] > 0 && (round(($ds['click_true']/$ds['click']),2) < 0.30)) || ($ds['click_true'] == 0 && $ds['click'] > 3)){
          ?>
          <h2><i class="fa fa-star" style="font-size:20px; "></i>&nbsp&nbsp <?=$ds['name']?></h2>
          <?php
        }else{
          ?>
          <h2><?=$ds['name']?></h2>
          <?php
        }
        ?>
        <br>
        <div id="disabled">
          <?php
            $selection = explode(',',$ds['selection']);//phan cach mang thanh cac mang con boi dau ','
            foreach ($selection as $s) {
              list($id, $select, $control) = explode(':', $s);
              ?>
              <div class="select">
                <h2 class="check<?=$ds['id_question']?>" style="padding: 10px" onclick="myFunction(<?=$ds['id_question']?>, <?=$control?>, <?=$id?>)" ><a class="title chon<?=$id?>" href="#"><?=$select?></a></h2>
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
<div class="clear"></div>
<div id="number_count" style="background-color: #dedede; color: blue; padding: 5px; text-align: center;">
  <h2>Trả lời đúng: &nbsp&nbsp
    <input style="border: none; width: 22px; background-color: #dedede; font-size: 20px;" id="countQuestion" class="countQuestion" type="text" name="bienphp" value="0" disabled="true" />/ &nbsp&nbsp&nbsp&nbsp<b><?=$number?>
  </h2>
  <div id="change">
    <input style="display: none;" class="n" id="n" type="number" name="n" value="0">
  </div>
</div>

<div class="clear"></div>
<div id="tincungloai">
<div class="clear"></div>
    <ul>
      <li>       
        <a href="#"><img src="views/upload/images/b.jpg" alt="ảnh"></a> <br />
              <a class="title" href="#">Vị vua nổi tiếng ăn chơi của triều Trần, từng cho mở sòng bạc ngay tại hoàng cung?</a>
      </li>
        
      <li>       
        <a href="#"><img src="views/upload/images/a.jpg" alt="ảnh"></a> <br />
              <a class="title" href="#">Ngay từ khi còn nhỏ, vua Trần Dụ Tông đã thoát chết sau khi bị tai nạn nào?</a>
      </li>
        
      <li>       
        <a href="#"><img src="views/upload/images/c.jpg" alt="ảnh"></a> <br />
              <a class="title" href="#">Trong giai đoạn nắm quyền, vua Trần Dụ Tông từng nổi danh lịch sử khi nhận lễ vật nào của nước Chiêm Thành?</a> 
      </li>
  </ul>
</div>
<div class="clear"></div> 
<script>
  $(".select").on({
    click: function(event){
      event.preventDefault();
    } 
  });
  function myFunction(id_q, control, id_s){
    var $tmp = $('.countQuestion').val();
    $('.selection'+id_q).css({'background':'#dedede'});
    $('.selection'+id_q).removeClass('gt');
    $('.chen'+id_q).addClass('above');
    $.post('views/pages/ajax_click.php', {id: <?=$_GET['id_title']?>,idq: id_q});
    if(control == 1){
      $('.chon'+id_s).css('background','#51D764');
      $('.countQuestion').val(Number($tmp) + 1);
      var $count = $('.countQuestion').val();
      $.post('views/pages/ajax_true.php', {data: $count, id: <?=$_GET['id_title']?>,idq: id_q}, function(data){
          $('#change').html(data);
      })
    }else{
      $('.chon'+id_s).css('background','#C50808');
    }
  }
</script>