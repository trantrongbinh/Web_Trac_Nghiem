<?php
include('../../model/database.class.php');
include('../../model/class.title.php');
include('../../model/class.question.php');
include('../../model/class.selection.php');
include('../../controller/question.php');

$title = new title();
$questions = new data_question();
if (!isset($_GET['id-title']) || $title->checkTitle($_GET['id-title']) == false ) {
    echo "<script>  alert('Không tồn tại!!!');</script>";
    exit();
}
$chude  = $title->layMotTitle($_GET['id-title']);
$question = $questions->getQuestion($_GET['id-title']);

if(isset($_POST["sua"])){
    $question2 = new question();
    $selection = new selection();
    $title2 = new title();
    $chude2  = $title2->layMotTitle($_GET['id-title']);

    $title2->setTitle($_POST['tieude']);
    $title2->setContent($_POST['noidung']);
    $title2->setView(0);

    if($_FILES['uploadFile0']['name'] != NULL){ 
        if($_FILES['uploadFile0']['type'] == "image/jpeg" || $_FILES['uploadFile0']['type'] == "image/png" || $_FILES['uploadFile0']['type'] == "image/gif"){
            $maxFileSize = 10 * 1000 * 1000; 
            if($_FILES['uploadFile0']['size'] > ($maxFileSize * 1000 * 1000)){
                echo 'Tập tin không được vượt quá: '.$maxFileSize.' MB';
            } else {
                $path = '../upload/images/';
                $tmp_name = $_FILES['uploadFile0']['tmp_name'];
                $name = $_FILES['uploadFile0']['name'];
                $type = $_FILES['uploadFile0']['type']; 
                $size = $_FILES['uploadFile0']['size']; 
                move_uploaded_file($tmp_name,$path.$name);
                $title2->setImage($name);
            }
        } else {
            echo 'Tập tin phải là hình ảnh';
        }
    }else{
        $title2->setImage($chude2['name_image']);
    }
    $kq = $title2->suaTitle($_GET['id-title']);
    if ($kq){
        $ttb1 = "thành công";
    }
    $countquestion = $questions->countQuestion($_GET['id-title']);
    $count = $countquestion['number'];

    for($i = 1; $i <= $count; $i++){
        $q  = $question2->layMotQuestion($_POST["id_q$i"]);
        if($_FILES["uploadFile$i"]['name'] != NULL){
            if($_FILES["uploadFile$i"]['type'] == "image/jpeg" || $_FILES["uploadFile$i"]['type'] == "image/png" || $_FILES["uploadFile$i"]['type'] == "image/gif"){
                $maxFileSize = 10 * 1000 * 1000;
                if($_FILES["uploadFile$i"]['size'] > ($maxFileSize * 1000 * 1000)){
                    echo 'Tập tin không được vượt quá: '.$maxFileSize.' MB';
                } else {
                    $path = '../upload/images/'; 
                    $tmp_name = $_FILES["uploadFile$i"]['tmp_name'];
                    $name = $_FILES["uploadFile$i"]['name'];
                    $type = $_FILES["uploadFile$i"]['type']; 
                    $size = $_FILES["uploadFile$i"]['size']; 
                    move_uploaded_file($tmp_name,$path.$name);
                    $row[$i] = array(
                        "id_q"=>$_POST["id_q$i"],
                        "name"=>$_POST["cauhoi$i"],
                        "answer"=>$_POST["giaithich$i"],
                        "id_title"=>$_GET['id-title'],
                        "name_image"=>$name
                    );
                }
            } else {
                echo 'Tập tin phải là hình ảnh';
            }
        }else {
            $row[$i] = array(
                "id_q"=>$_POST["id_q$i"],
                "name"=>$_POST["cauhoi$i"],
                "answer"=>$_POST["giaithich$i"],
                "id_title"=>$_GET['id-title'],
                "name_image"=>$q['name_image']
            );
        }

        $ttb = $questions->countSelect($_POST["id_q$i"]);
        for($j = 1; $j <= $ttb['number_q']; $j++){
            if($_POST["luachon$i$j"] != null){
                $tmp = $_POST["loai$i"];
                $control = 0;
                if($tmp == $j){
                    $control = 1;
                }
                $select[] = array(
                    "id_s"=>$_POST["id_s$i$j"],
                    "name"=>$_POST["luachon$i$j"],
                    "id_question"=>$_POST["id_q$i"],
                    "control"=>$control
                );
            }
        }
        
    }
    if (empty($row) || empty($select)){
        echo('<div class="alert alert-error"> Có lỗi xảy ra, hãy kiểm tra lại dữ liệu!!!</div>');
    }else{
        foreach ($row as $data) {
            $question2->setName($data['name']);
            $question2->setAswer($data['answer']);

            $question2->setImage($data['name_image']);
            $question2->setIdTitle($data['id_title']);

            $kq = $question2->suaQuestion($data['id_q']);
            if ($kq){
                $ttb2 = "thành công";
            }
        }

        foreach ($select as $s) {
            $selection->setName($s['name']);
            $selection->setControl($s['control']);
            $selection->setIdQuestion($s['id_question']);

            $kq = $selection->suaSelection($s['id_s']);
            if ($kq){
                $ttb3 = "thành công";
            }
        }
    }

   if( $ttb1 == "thành công" &&  $ttb2 == "thành công" &&  $ttb3 == "thành công"){
        $_SESSION['sua']= 'done';
        echo '<script>window.history.go(-2);</script>';
   }else{
        echo '<div class="alert alert-error"> Có lỗi xảy ra, hãy kiểm tra lại dữ liệu!!!</div>';
   }
    
}
?>

<div id="page-wrapper">
    <div class="">
        <h1 style="color: blue;">Nội Dung
            <small style="color: #3C3838; font-size: 16px;">Sửa</small>
        </h1>
    </div>
    <div class="content">
        <br>
        <form action="" method="POST" name="form_edit" enctype="multipart/form-data">
            <div class="chude">
                <div>
                    <label>Tiêu đề</label>
                    <br>
                    <textarea class="tieude text" name="tieude" placeholder="Nhập tiêu đề" rows="3" cols="20"><?=$chude['title']?></textarea>
                </div>
                <div class="kc"></div>
                <div class="noidung">
                    <label>Nội dung</label>
                    <br>
                    <textarea id="noidung" name="noidung" class="ckeditor" rows="5"><?=$chude['content']?></textarea>
                </div>
                <div class="kc"></div>
                <div id="chonFile">
                    <img src="../upload/images/<?=$chude['name_image']?>" width="470" height="350" alt="">
                    <br>
                    <input class="file_anh" name='uploadFile0' type='file' id="file0" onchange="return fileValidation()" value="<?=$chude['name_image']?>">
                </div>
                <div class="kc"></div>
            </div>
            <div id="questions" class="an">
                <?php
                $stt = 1;
                foreach ($question as $ds) {
                    ?>
                    <div class="question1" style="border: 1px solid #856B6B; padding: 10px;">
                        <div>Câu
                            <span class="number"><?=$stt?></span>
                            <input name="id_q<?=$stt?>" placeholder="Nhap text" size="7" style=" padding: 2px;" value="<?=$ds['id_question']?>">
                            <br>
                            <textarea class="cauhoi<?=$stt?> text" name="cauhoi<?=$stt?>" placeholder="Nhập nội dung" rows="3" cols="20"><?=$ds['name']?></textarea>
                        </div>
                        <div class="kc"></div>
                        <div id="chonFile">
                            <img src="../upload/images/<?=$ds['name_image']?>" width="470" height="350" alt="">
                            <br>
                            <input class="file_anh1" name="uploadFile<?=$stt?>" type="file"  id="file1" onchange="return fileValidation()" value="<?=$ds['name_image']?>">
                        </div>
                        <div class="kc"></div>
                        <label>Đáp án: </label>
                        <br>
                        <div style="border: 1px solid #A0BAC4; padding: 10px;">
                            <div id="dapan">
                            <?php
                            $selection = explode(',',$ds['selection']);//phan cach mang thanh cac mang con boi dau ','
                            $tmp = 1;
                            foreach ($selection as $s) {
                                list($id, $select, $control) = explode(':', $s);
                                ?>
                                <div class="luachon"><?=$tmp?>: 
                                    <input class="lc<?=$stt?><?=$tmp?>" name="luachon<?=$stt?><?=$tmp?>" placeholder="Nhap text" size="70" style=" padding: 2px;" value="<?=$select?>">
                                    <input name="id_s<?=$stt?><?=$tmp?>" placeholder="Nhap text" size="7" style=" padding: 2px; display: none;" value="<?=$id?>">
                                    <?php
                                    if($control == 1){
                                        ?>
                                        <input class="ckeck<?=$stt?><?=$tmp?>" checked name="loai<?=$stt?>" value="<?=$tmp?>" type="radio">
                                        <?php
                                    } else{
                                        ?>
                                        <input class="ckeck<?=$stt?><?=$tmp?>" name="loai<?=$stt?>" value="<?=$tmp?>" type="radio">
                                        <?php
                                    }
                                    ?>
                                    
                                </div>
                                <div class="kc"></div>
                                <?php
                                $tmp++;
                            }
                            ?>
                                <div>
                                    <label>Giải thích:</label>
                                    <br>
                                    <textarea class="giaithich<?=$stt?> text" name="giaithich<?=$stt?>" placeholder="Nhập giải thích" rows="3" cols="20"><?=$ds['answer']?></textarea>
                                </div>
                                <div class="kc"></div>
                            </div>
                            <div class="kc"></div>
                        </div>
                        <div class="kc"></div>
                    </div>
                    <div class="kc"></div>
                    <?php
                    $stt++;
                }
                ?>
            </div>
            <div class="kc"></div>
            <a class="btn" id="btnThemQ" style="width:70px; border:solid 1px green;background: #5631F7; color:white; padding:2px; text-align:center" href="#" >Thêm Câu hỏi</a>
            <div class="kc"></div>
            <button type="submit" name="sua">Sửa</button>
        </form>
    </div>
</div>
<div class="kc"></div>
<div style="margin-top: 50px;"></div>