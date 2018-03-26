<?php
include('../../model/database.class.php');
include('../../model/class.title.php');
include('../../model/class.question.php');
include('../../model/class.selection.php');

if(isset($_POST["submit"])){
    if ( $_POST['tieude'] =="" || $_POST['noidung'] =="" || $_POST['cauhoi1'] =="" || $_POST['luachon11'] =="" || $_POST['giaithich1'] ==""){
        echo '<div class="alert alert-danger"> Hãy điền đầy đủ thông tin!!!</div>';
    }
    else{

        $title = new title();
        $question = new question();
        $selection = new selection();

        $max_id_title = $title->layMaxID();
        $max_id_question = $question->layMaxID();
        $max_id_select = $selection->layMaxID();
        $id_title = $max_id_title['max']+1;
        $id_question = $max_id_question['max']+1;
        $id_select = $max_id_select['max']+1;

        $ttb1 = "";
        $ttb2 = "";
        $ttb3 = "";
        if($_FILES['uploadFile0']['name'] != NULL){
            if($_FILES['uploadFile0']['type'] == "image/jpeg" || $_FILES['uploadFile0']['type'] == "image/png" || $_FILES['uploadFile0']['type'] == "image/gif"){
                $maxFileSize = 10 * 1000 * 1000; //MB
                if($_FILES['uploadFile0']['size'] > ($maxFileSize * 1000 * 1000)){
                    echo 'Tập tin không được vượt quá: '.$maxFileSize.' MB';
                } else {
                    $path = '../upload/images/'; 
                    $tmp_name = $_FILES['uploadFile0']['tmp_name'];
                    $name = $_FILES['uploadFile0']['name'];
                    $type = $_FILES['uploadFile0']['type']; 
                    $size = $_FILES['uploadFile0']['size']; 
                    move_uploaded_file($tmp_name,$path.$name);
                    $title->setID($id_title);
                    $title->setTitle($_POST['tieude']);
                    $title->setContent($_POST['noidung']);
                    $title->setImage($name);
                    $title->setView(0); 
                    
                }
            } else {
                echo 'Tập tin phải là hình ảnh';
            }
        }

        $count = $_POST['count'];
        for($i = 1; $i <= $count; $i++){

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
                        //Upload file
                        move_uploaded_file($tmp_name,$path.$name);
                         $row[$i] = array(
                            "id"=>$id_question,
                            "name"=>$_POST["cauhoi$i"],
                            "answer"=>$_POST["giaithich$i"],
                            "id_title"=>$id_title,
                            "name_image"=>$name
                        );
                    }
                } else {
                    echo 'Tập tin phải là hình ảnh';
                }
            }

            for($j = 1; $j < 5; $j++){
                if($_POST["luachon$i$j"] != null){
                    $tmp = $_POST["loai$i"];
                    $control = 0;
                    if($tmp == $j){
                        $control = 1;
                    }
                    $select[] = array(
                        "id_s"=>$id_select,
                        "name"=>$_POST["luachon$i$j"],
                        "id_question"=>$id_question,
                        "control"=>$control
                        );
                    $id_select++;
                }
            }
            
            $id_question++;
        }
        if (empty($row) || empty($select)){
            echo('<div class="alert alert-error"> Có lỗi xảy ra, hãy kiểm tra lại dữ liệu!!!</div>');
        }else{
            $kq = $title->themTitle();
            if ($kq){
                $ttb1 = "thành công";
            }
            foreach ($row as $data) {
                $question->setId($data['id']);
                $question->setName($data['name']);
                $question->setAswer($data['answer']);

                $question->setImage($data['name_image']);
                $question->setIdTitle($data['id_title']);

                $kq = $question->themQuestion();
                if ($kq){
                    $ttb2 = "thành công";
                }
            }

            foreach ($select as $s) {
                $selection->setId($s['id_s']);
                $selection->setName($s['name']);
                $selection->setControl($s['control']);
                $selection->setIdQuestion($s['id_question']);

                $kq = $selection->themSelection();
                if ($kq){
                    $ttb3 = "thành công";
                }
            }
        }

        if( $ttb1 == "thành công" &&  $ttb2 == "thành công" &&  $ttb3 == "thành công"){
            echo '<div class="alert alert-success"> Thêm mới thành công</div>';
       }else{
            echo '<div class="alert alert-error"> Thêm thất bại</div>';
       }
   }
    
}

?>
<div id="page-wrapper">
    <div class="">
        <h1 style="color: blue;">Nội Dung
            <small style="color: #3C3838; font-size: 16px;">Thêm</small>
        </h1>
    </div>
    <div class="content">
        <br>
        <form action="" method="POST" name="form_them" enctype="multipart/form-data">
            <div class="chude">
                <div>
                    <label>Tiêu đề</label>
                    <br>
                    <textarea class="tieude text" name="tieude" placeholder="Nhập tiêu đề" rows="3" cols="20"></textarea>
                </div>
                <div class="kc"></div>
                <div class="noidung">
                    <label>Nội dung</label>
                    <br>
                    <textarea id="noidung" name="noidung" class="ckeditor" rows="5"></textarea>
                </div>
                <div class="kc"></div>
                <div id="chonFile">
                    <input class="file_anh" name='uploadFile0' type='file' id="file0" onchange="return fileValidation()">
                </div>
                <div class="kc"></div>
            </div>
            <div id="questions" class="an">
                <div class="question1" style="border: 1px solid #856B6B; padding: 10px;">
                    <div>Câu
                        <span class="number">1</span>
                        <br>
                        <textarea class="cauhoi1 text" name="cauhoi1" placeholder="Nhập nội dung" rows="3" cols="20"></textarea>
                    </div>
                    <div class="kc"></div>
                    <div id="chonFile">
                        <input class="file_anh1" name="uploadFile1" type="file"  id="file1" onchange="return fileValidation()">
                    </div>
                    <div class="kc"></div>
                    <label>Đáp án: </label>
                    <br>
                    <div style="border: 1px solid #A0BAC4; padding: 10px;">
                        <div id="dapan">
                            <div class="luachon">1: 
                                <input class="lc11" name="luachon11" placeholder="Nhap text" size="70" style=" padding: 2px;">
                                <input class="check11" checked="" name="loai1" value="1" type="radio">
                            </div>
                            <div class="kc"></div>
                            <div class="luachon">2: 
                                <input class="lc12" name="luachon12" placeholder="Nhap text" size="70" style=" padding: 2px;">
                                <input class="check12" name="loai1" value="2" type="radio">
                            </div>
                            <div class="kc"></div>
                            <div class="luachon">3: 
                                <input class="lc13" name="luachon13" placeholder="Nhap text" size="70" style=" padding: 2px;">
                                <input class="check13" name="loai1" value="3" type="radio">
                            </div>
                            <div class="kc"></div>
                            <div class="luachon">4: 
                                <input class="lc14" name="luachon14" placeholder="Nhap text" size="70" style=" padding: 2px;">
                                <input class="check14" name="loai1" value="4" type="radio">
                            </div>
                            <div class="kc"></div>
                            <div>
                                <label>Giải thích:</label>
                                <br>
                                <textarea class="giaithich1 text" name="giaithich1" placeholder="Nhập giải thích" rows="3" cols="20"></textarea>
                            </div>
                            <div class="kc"></div>
                        </div>
                        <div class="kc"></div>
                    </div>
                    <div class="kc"></div>
                    <div class="kc"></div>
                </div>
            </div>
            <div class="kc"></div>
            <a class="btn an" id="btnThemQ" style="width:70px; border:solid 1px green;background: #5631F7; color:white; padding:2px; text-align:center" href="#" >Thêm Câu hỏi</a>
            <div class="kc"></div>
            <div class="kc"></div>
            <input class="count an" type="text" name="count" value="1"/>
            <input id="save" class="gui an" name="submit" type="submit" value="Thêm" />
        </form>
    </div>
    <div class="kc"></div>
    <div class="kc"></div>
    <button name="next" onclick = "btnNext()" class = "nextQuestion" />Next</button>
</div>
<div class="kc"></div>
<div style="margin-top: 50px;"></div>
<style>
    .an{
        display: none;
    }
</style>
<script>
    function btnNext(){
        if($('.tieude').val() == "" || CKEDITOR.instances.noidung.getData() == "" || $('.file_anh').val() == ""){
            alert("Yêu cầu nhập đủ thông tin!");
        }else{
            // var data = CKEDITOR.instances.noidung.getData();
            // alert(data);
            $('.chude').css("display", "none");
            $('#questions').removeClass('an');
            $('#btnThemQ').removeClass('an');
            $('.nextQuestion').css("display", "none");
            $('.gui').removeClass('an');
            // $('.count').removeClass('an');
        }
    }

    $(document).ready(function(){
        var $count = 2;
        $("#btnThemQ").click(function(event){
            event.preventDefault();
            var tmp = $count - 1;
            if($('.cauhoi'+tmp).val() == "" || $('.file_anh'+tmp).val() == "" || ($('.lc1_'+tmp).val() == "" && $('.lc2_'+tmp).val() == "" && $('.lc3_'+tmp).val() == "" && $('.lc4_'+tmp).val() == "" ) || $('.giaithich'+tmp).val() == ""){
                alert("Yêu cầu nhập đủ thông tin!");
            }else{
                $("#questions").append('<div class="kc"></div> <div class="question'+$count+'" style="border: 1px solid #856B6B; padding: 10px;"> <div>Câu <span class="number">'+$count+'</span> <br> <textarea class="cauhoi'+$count+' text" name="cauhoi'+$count+'" placeholder="Nhập nội dung" rows="3" cols="20"></textarea> </div> <div class="kc"></div> <div id="chonFile"> <input class="file_anh'+$count+'" name="uploadFile'+$count+'" type="file" id="file'+$count+'" onchange="return fileValidation()" > </div> <div class="kc"></div> <label>Đáp án: </label> <br> <div style="border: 1px solid #A0BAC4; padding: 10px;"> <div id="dapan"> <div>1: <input class="lc'+$count+'1" name="luachon'+$count+'1" placeholder="Nhap text" size="70" style=" padding: 2px;"> <input class="check'+$count+'1" checked="" name="loai'+$count+'" value="1" type="radio"> </div> <div class="kc"></div> <div class="luachon">2: <input class="lc'+$count+'2" name="luachon'+$count+'2" placeholder="Nhap text" size="70" style=" padding: 2px;"> <input class="check'+$count+'2" name="loai'+$count+'" value="2" type="radio"> </div> <div class="kc"></div> <div class="luachon">3: <input class="lc'+$count+'3" name="luachon'+$count+'3" placeholder="Nhap text" size="70" style=" padding: 2px;"> <input class="check'+$count+'3" name="loai'+$count+'" value="3" type="radio"> </div> <div class="kc"></div> <div class="luachon">4: <input class="lc'+$count+'4" name="luachon'+$count+'4" placeholder="Nhap text" size="70" style=" padding: 2px;"> <input class="check'+$count+'4" name="loai'+$count+'" value="4" type="radio"> </div> <div class="kc"></div> <div> <label>Giải thích:</label> <br> <textarea class="giaithich'+$count+' text" name="giaithich'+$count+'" placeholder="Nhập giải thích" rows="3" cols="20"></textarea> </div> <div class="kc"></div> </div> </div> <div class="kc"></div> <div class="kc"></div> </div>');
                $('.count').val($count);
                $count = $count + 1;
                $('#questions').removeClass('an');
            }
        });
    });
</script>
