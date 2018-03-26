<?php
	session_start();
	if(isset($_GET["p"])) $p = $_GET["p"];
	else $p = "";
  if($_SESSION['username']){
    ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <link rel="Shortcut Icon" href="../images/logo.gif"> 
        <title>Quản lý trắc nghiệm</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
          <script src="../library/jquery-3.2.1.min.js"></script>
          <script src="../ckeditor/ckeditor.js"></script>
          <script src="../ckfinder/ckfinder.js"></script>
          <script>CKEDITOR.replace('noidung')</script>
      </head>
      <body>
      <div class="main">
          <img src="http://trande.edu.vn/upload/18180/20170321/banner_main7.png" width="960" height="118" style="margin-bottom:1px;"/> 
            <div style="height: 32px; background-color:#006;">
              <img src="https://png.pngtree.com/element_origin_min_pic/16/12/19/2aa96c4f5ac086c7a193197e76000bc9.jpg" width="18" height="18" style="float:left; padding-left:10px; padding-top:7px"/>
              <p style="float:left; font-size:14px; color:white; padding:9px 16px;"> <script> document.write("25/2/2018"); </script></p>
              <?php
              if(isset(($_SESSION['username']))){
                ?>
                <p style="float:right; font-size:14px; color:white; padding:9px 20px;"> Tên đăng nhập: <?= $_SESSION['username']?>(<a href="../blocks/logout.php" style="font-size:14px; color:white;"> Thoát </a>)</p>
                <?php
              }
              ?>
            </div>
            <div class ="Content">
              <div class="vertical-menu">
            <a href="admin.php">Hướng dẫn sử dụng</a>
            <a href="admin.php?p=quan-ly-chu-de" id="message">Quản lý chủ đề</a>
              </div>
              <div class ="RightMenu">
                 <?php
                 switch ($p) {
                  case 'quan-ly-chu-de':
                    require "quan_ly_chu_de/quanlychude.php";
                    break;
                  case 'chi-tiet':
                    require "quan_ly_chu_de/chitiet.php";
                    break;
                  case 'them-chu-de':
                    require "quan_ly_chu_de/them.php";
                    break;
                  case 'edit':
                    require "quan_ly_chu_de/edit.php";
                    break;
                  case 'xoa-question':
                    require "quan_ly_chu_de/delquestion.php";
                    break;
                  case 'xoa-selection':
                    require "quan_ly_chu_de/delselection.php";
                    break;
                  case 'them-selection':
                    require "quan_ly_chu_de/themselection.php";
                    break;
                  case 'them-question':
                    require "quan_ly_chu_de/themquestion.php";
                    break;

                  default:
                    require "huong-dan-su-dung.php";
                    break;
                 }
                 ?>
               </div>
          </div>
        </div>
      </body>
    </html>
    <?php
  }else{
    echo "<script>  alert('Anh là ai, hệ thống không quen anh, anh biến ra đi !!!');</script>";
    header('Location: http://tuhocmang.com/wp-content/uploads/2015/06/fake-facebook.jpg');
    die();
  }
?>

