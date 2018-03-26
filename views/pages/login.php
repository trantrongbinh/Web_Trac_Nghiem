<?php
if (isset($_POST['dangnhap'])) {
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
     
    //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$username || !$password) {
        echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    } else if($username != "admin" || $password != "admin"){
    	echo "Tài khoản, mật khẩu không đúng. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;

    }
    //Lưu tên đăng nhập
    $_SESSION['username'] = $username;
    echo "<script>window.location = 'views/admin/admin.php';</script>";
    die();
}

?>

<div class="a">
	<div class="clear"></div>
	<div class="module form-module">
		<div class="toggle"><i class="fa fa-times fa-pencil"></i>
			<div class="tooltip">Đăng ký</div>
		</div>
		<div class="form"'>
			<h2>Đăng nhập vào tài khoản</h2>
			<form method="POST" action="#">
				<input type="text" placeholder="Username" name='txtUsername'/>
				<input type="password" placeholder="Password" name='txtPassword'/>
				<button type="submit" name="dangnhap">Đăng nhập</button>
			</form>
		</div>
		<div class="form">
			<h2>Đăng ký tài khoản</h2>
			<form>
				<input type="text" placeholder="Username"/>
				<input type="password" placeholder="Password"/>
				<input type="email" placeholder="Email Address"/>
				<input type="tel" placeholder="Phone Number"/>
				<button>Đăng ký</button>
			</form>
		</div>
		<div class="cta"><a href="#">Quên mật khẩu?</a></div>
	</div>
	<div class="clear"></div>
</div>

<style type="text/css" media="screen">
	.a{
		background: #D3FCFE;
		color: #666666;
		font-family: 'RobotoDraft', 'Roboto', sans-serif;
		font-size: 14px;
	}
	.form-module {
		position: relative;
		background: #ffffff;
		max-width: 320px;
		width: 100%;
		border-top: 5px solid #33b5e5;
		box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
		margin: 0 auto;
	}
	.form-module .toggle {
		cursor: pointer;
		position: absolute;
		top: -0;
		right: -0;
		background: #33b5e5;
		width: 30px;
		height: 30px;
		margin: -5px 0 0;
		color: #ffffff;
		font-size: 12px;
		line-height: 30px;
		text-align: center;
	}
	.form-module .toggle .tooltip {
		position: absolute;
		top: 5px;
		right: -65px;
		display: block;
		background: rgba(0, 0, 0, 0.6);
		width: auto;
		padding: 5px;
		font-size: 10px;
		line-height: 1;
		text-transform: uppercase;
	}
	.form-module .toggle .tooltip:before {
		content: '';
		position: absolute;
		top: 5px;
		left: -5px;
		display: block;
		border-top: 5px solid transparent;
		border-bottom: 5px solid transparent;
		border-right: 5px solid rgba(0, 0, 0, 0.6);
	}
	.form-module .form {
		display: none;
		padding: 40px;
	}
	.form-module .form:nth-child(2) {
		display: block;
	}
	.form-module h2 {
		margin: 0 0 20px;
		color: #33b5e5;
		font-size: 18px;
		font-weight: 400;
		line-height: 1;
	}
	.form-module input {
		outline: none;
		display: block;
		width: 100%;
		border: 1px solid #d9d9d9;
		margin: 0 0 20px;
		padding: 10px 15px;
		box-sizing: border-box;
		font-wieght: 400;
		-webkit-transition: 0.3s ease;
		transition: 0.3s ease;
	}
	.form-module input:focus {
		border: 1px solid #33b5e5;
		color: #333333;
	}
	.form-module button {
		cursor: pointer;
		background: #33b5e5;
		width: 100%;
		border: 0;
		padding: 10px 15px;
		color: #ffffff;
		-webkit-transition: 0.3s ease;
		transition: 0.3s ease;
	}
	.form-module button:hover {
		background: #178ab4;
	}
	.form-module .cta {
		background: #f2f2f2;
		width: 100%;
		padding: 15px 40px;
		box-sizing: border-box;
		color: #666666;
		font-size: 12px;
		text-align: center;
	}
	.form-module .cta a {
		color: #333333;
		text-decoration: none;
	}
	.footer-bar
	{
		display: block;
		width: 100%;
		height: 45px;
		line-height: 45px;
		background: #111;
		border-top: 1px solid #E62600;
		position: fixed;
		bottom: 0;
		left: 0;
	}
	.footer-bar .article-wrapper{
	    font-family: arial, sans-serif;
	    font-size: 14px;
	    color: #888;
	    float: left;
	    margin-left: 10%;
	}
	.footer-bar .article-link a, .footer-bar .article-link a:visited{
	    text-decoration: none;
	    color: #fff;
	}
	.site-link a, .site-link a:visited{
	    color: #888;
	    font-size: 14px;
	    font-family: arial, sans-serif;
	    float: right;
	    margin-right: 10%;
	    text-decoration: none;
	}
	.site-link a:hover{
	    color: #E62600;
	}
</style>

<script type="text/javascript">
	$('.toggle').click(function(){
		$(this).children('i').toggleClass('fa-pencil'); 
		$('.form').animate({
			height: "toggle",
			'padding-top': 'toggle',
			'padding-bottom': 'toggle',
			opacity: "toggle"
		}, "slow");
	});
</script>