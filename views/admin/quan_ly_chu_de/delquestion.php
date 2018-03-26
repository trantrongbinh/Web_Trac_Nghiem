<?php
include('../../model/database.class.php');
include('../../model/class.question.php');
include('../../controller/question.php');

if(isset($_GET["id-question"])){
    $id_q = $_GET["id-question"];
    $question2 = new question();
    $questions = new data_question();
    $ketqua = $question2 ->xoaQuestion($id_q);
    $ketqua2 = $questions->delSelectionByIdQuestion($id_q);

    if(!$ketqua && !$ketqua2){
        echo "<script>  alert('Có lỗi xảy ra! Vui lòng thử lại'); window.history.go(-1);</script>";
    } else {
        echo "<script>  alert('Xóa Câu hỏi thành công thành công!'); window.history.go(-1);</script>";
    }
}
?>