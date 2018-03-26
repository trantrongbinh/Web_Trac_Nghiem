<?php
include('../../model/database.class.php');
include('../../model/class.selection.php');

if(isset($_POST["submit"])){
    //xu lý them
    if ( $_POST['luachon'] ==""){
        echo '<div class="alert alert-danger"> Hãy điền đầy đủ thông tin!!!</div>';
    }
    else{
        $new = new selection();
        $new->setName($_POST['luachon']);
        $new->setIdQuestion($_GET['id-question']);
        $new->setControl(0);
        $kq = $new->themSelection();
        if ($kq){
            echo "<script>  alert('Thêm mới thành công'); window.history.go(-2);</script>";
            //echo '<div class="alert alert-success"> Thêm mới thành công</div>';
        }
        else{
            echo '<div class="alert alert-error"> Có lỗi xảy ra, hãy kiểm tra lại dữ liệu!!!</div>';
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
        <form action="" method="POST" name="form_them">
            <div class="">
                <label>Đáp án: </label>
                <br>
                <div>
                    <div id="dapan">
                        <div class="luachon">
                            <input class="lc" name="luachon" placeholder="Nhap text" size="70" style=" padding: 2px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="kc"></div>
            <input name="submit" type="submit" value="Thêm" />
        </form>
    </div>
</div>
<div class="kc"></div>
<div style="margin-top: 50px;"></div>