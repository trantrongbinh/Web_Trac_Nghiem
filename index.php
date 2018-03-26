<?php
	session_start();
	if(isset($_GET["p"])) $p = $_GET["p"];
	else $p = "";
	include('model/database.class.php');
	include('controller/pager.php');
	include('model/class.title.php');
	include('controller/question.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!--<base href="http://localhost:1997/trongbinh/Project3_v2/">-->
	<meta charset="UTF-8">
	<title>Trang Quản Lý - Giáo Dục</title>
	<link rel='stylesheet prefetch' href='views/library/fonts.googleapis.css'>
	<link rel="Shortcut Icon" href="views/images/logo.gif"> 
	<link rel='stylesheet prefetch' href='views/library/Font-Awesome/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="views/css/layout.css">
    <script src="views/library/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="http://www.maytinhhtl.com/images/code/snowstorm.js"></script>
    
</head>
<body>
	<div id="wrap-vp">
		<div id="header-vp">
	    	<div id="logo"><img src="http://trande.edu.vn/upload/18180/20170321/banner_main7.png" width="1000px" /></div>
	    </div>
	    <br>
	    <div id="menu-vp" style="background-color: #A590EB;">
	    	<!--block/menu.php-->
	    	<?php require "views/blocks/menu.php";?>
	    </div>
	    <div id="midheader-vp">
	    	<div id="left">
	        	<ul class="list_arrow_breakumb">
	            	<li class="start">
	                	<a href="javascript:;">Trang chủ</a>
	                	<span class="arrow_breakumb">&nbsp;</span>
	            	</li>
	           </ul>
	           <div class="txt_timer left" id="clockPC"><img src="views/images/lịch.png" width="22px" height="22px"> Chủ nhật, 25/2/2018 | 00:00 GMT+7 | <mark>TK-MK: admin-admin</mark></div>
	        </div>
	        <div id="right">
				<!--blocks/search.php-->
				<?php require "views/blocks/search.php";
				?>
	        </div>
	        <a href="index.php?p=login" id="btnLogin">Đăng nhập</a>
    	</div>
    	<div class="clear"></div>
		<hr>
		<div class="container">
			<div id="content-vp">
				<?php
					switch ($p) {
						case 'login':
							require "views/pages/login.php";
							break;
						default:
							?>
								<div id="content-main">
								<!--PAGES-->
									<?php
										switch ($p) {
											case 'tim-kiem':
												require "views/pages/ketqua_search.php";
												break;
											case 'chi-tiet':
												require "views/pages/chitiet.php";
												break;
											default:
												require "views/pages/trangchu.php";
												break;
										}
									?>
					        	</div>
					        	<div id="content-right">
									<!--blocks/cot_phai.php-->
									<?php require "views/blocks/cot_phai.php";?>
					        	</div>
							<?php
							break;
					}
				?>
    		</div>
		</div>
    	<div class="clear"></div>
    	<div class="clear"></div>
		<div id="footer">
			<!--blocks/footer.php-->
   			<?php require "views/blocks/footer.php";?>
		</div>
	</div>
</body>
</html>