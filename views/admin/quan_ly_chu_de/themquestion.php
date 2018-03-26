<?php
include('../../model/database.class.php');
include('../../model/class.question.php');
include('../../model/class.selection.php');

if(isset($_POST["submit"])){
    if ( $_POST['cauhoi'] ==""){
        echo '<div class="alert alert-danger"> Hãy điền đầy đủ thông tin!!!</div>';
    }
    else{
        $new = new question();
        $selection = new selection();
	    $max_id_question = $new->layMaxID();
	    $id_question = $max_id_question['max']+1;
	    $max_id_select = $selection->layMaxID();
		$id_select = $max_id_select['max']+1;
	  
        $new->setID($id_question);
        $new->setName($_POST['cauhoi']);
        $new->setAswer($_POST['giaithich']);
        $new->setIdTitle($_GET['id-title']);
        
        
        if($_FILES['uploadFile']['name'] != NULL){ 
            if($_FILES['uploadFile']['type'] == "image/jpeg" || $_FILES['uploadFile']['type'] == "image/png" || $_FILES['uploadFile']['type'] == "image/gif"){
                $maxFileSize = 10 * 1000 * 1000;
                if($_FILES['uploadFile']['size'] > ($maxFileSize * 1000 * 1000)){
                    echo 'Tập tin không được vượt quá: '.$maxFileSize.' MB';
                } else {
                    $path = '../upload/images/'; 
                    $tmp_name = $_FILES['uploadFile']['tmp_name'];
                    $name = $_FILES['uploadFile']['name'];
                    $type = $_FILES['uploadFile']['type']; 
                    $size = $_FILES['uploadFile']['size']; 
                    move_uploaded_file($tmp_name,$path.$name);
                    $new->setImage($name);

                    for($j = 1; $j < 5; $j++){
				        if($_POST["luachon$j"] != null){
				            $tmp = $_POST["loai1"];
				            $control = 0;
				            if($tmp == $j){
				                $control = 1;
				            }
				            $select[] = array(
				            	"id"=>$id_select,
				                "name"=>$_POST["luachon$j"],
				                "id_question"=>$id_question,
				                "control"=>$control
				            );
				        }
				        $id_select++;
				    }

				    foreach ($select as $s) {
			            $selection->setId($s['id']);
			            $selection->setName($s['name']);
			            $selection->setControl($s['control']);
			            $selection->setIdQuestion($s['id_question']);

			            $kq = $selection->themSelection();
			            if ($kq){
			                echo '<div class="alert alert-success"> Thêm mới thành công</div>';
			            }
			            else{
			                echo '<div class="alert alert-error"> Có lỗi xảy ra, hãy kiểm tra lại dữ liệu!!!</div>';
			            }
			        }

                    $kq = $new->themQuestion();
                    if ($kq){
                        echo "<script>  alert('Thêm mới thành công'); window.history.go(-2);</script>";
                    }
                    else{
                        echo '<div class="alert alert-error"> Có lỗi xảy ra, hãy kiểm tra lại dữ liệu!!!</div>';
                    }
                }
            } else {
                echo 'Tập tin phải là hình ảnh';
            }
        } else {
            echo 'Vui lòng chọn tập tin';
        }
        
    }

	
}
?>

<div id="page-wrapper">
    <div class="">
        <h1 style="color: blue;">Selection
            <small style="color: #3C3838; font-size: 16px;">Thêm</small>
        </h1>
    </div>
    <div class="content">
        <br>
        <form action="" method="POST" name="form_them" enctype="multipart/form-data">
            <div id="questions" class="an">
                <div class="question" style="border: 1px solid #856B6B; padding: 10px;">
                    <div>Name
                        <br>
                        <textarea class="cauhoi text" name="cauhoi" placeholder="Nhập nội dung" rows="3" cols="20"></textarea>
                    </div>
                    <div class="kc"></div>
                    <div id="chonFile">
		                <input name='uploadFile' type='file' >
		            </div>
                    <div class="kc"></div>
                    <label>Đáp án: </label>
                    <br>
                    <div style="border: 1px solid #A0BAC4; padding: 10px;">
                        <div id="dapan">
                            <div class="luachon">1: 
                                <input class="lc" name="luachon1" placeholder="Nhap text" size="70" style=" padding: 2px;">
                                <input class="ckeck1" checked name="loai1" value="1" type="radio">
                            </div>
                            <div class="kc"></div>
                            <div class="luachon">2: 
                                <input class="lc" name="luachon2" placeholder="Nhap text" size="70" style=" padding: 2px;">
                               <input class="ckeck2" name="loai1" value="2" type="radio">
                            </div>
                            <div class="kc"></div>
                            <div class="luachon">3: 
                                <input class="lc" name="luachon3" placeholder="Nhap text" size="70" style=" padding: 2px;">
                                <input class="ckeck3" name="loai1" value="3" type="radio">
                            </div>
                            <div class="kc"></div>
                            <div class="luachon">4: 
                                <input class="lc" name="luachon4" placeholder="Nhap text" size="70" style=" padding: 2px;">
                                <input class="ckeck4" name="loai1" value="4" type="radio">
                            </div>
                            <div class="kc"></div>
                            <div>
                                <label>Giải thích:</label>
                                <br>
                                <textarea class="giaithich text" name="giaithich" placeholder="Nhập giải thích" rows="3" cols="20"></textarea>
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
            <input name="submit" type="submit" value="Thêm" />
        </form>
    </div>
</div>
<div class="kc"></div>
<div style="margin-top: 50px;"></div>