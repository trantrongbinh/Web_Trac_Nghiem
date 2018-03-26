<?php
include('../../model/database.class.php');
include('../../model/class.selection.php');

if(isset($_GET["id-selection"])){
    $id = $_GET["id-selection"];
    $selection = new selection();
    $ketqua = $selection ->xoaSelection($id);

    if(!$ketqua){
        echo "<script>  alert('Có lỗi xảy ra! Vui lòng thử lại'); window.history.go(-1);</script>";
    } else {
        echo "<script>  alert('Xóa Lựa chọn thành công thành công!'); window.history.go(-1);</script>";
    }
}
?>