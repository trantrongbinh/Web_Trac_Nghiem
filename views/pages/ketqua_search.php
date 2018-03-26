<?php
$key = $_GET['key'];
$questions = new data_question();
$ds = $questions->timkiem($key);
$data = $ds['data'];
//print_r($data);
$thanhphantrang = $ds['thanhphantrang'];

foreach ($data as $ds) {
    ?>
        <div class="cat-content" style="margin-top: -7px;">
            <div class="col1">
                <div class="news">
                    <div class="clear"></div>
                    <img class="images_news2" src="views/upload/images/<?=$ds['name_image']?>" align="left" />
                    <h3 class="title" style="margin-top: 10px;" ><a href="index.php?p=chi-tiet&id_title=<?=$ds['id_title']?>"><?=$ds['title']?></a></h3>
                    <br>
                    <br>
                    <div class="des"><?=$ds['content']?></div>
                </div>
            </div>
            <div class="col2"></div>
        </div>
        <div class="clear"></div>
    <?php
}
?>
<div id="phantrang" style = "text-align: center;"><?=$thanhphantrang?></div>
<style>
	.pagination>li{
		float: left;
		padding: 10px;
	}
</style>


<link rel="Shortcut Icon" href="https://trantrongbinhbka.000webhostapp.com/views/images/favicon.ico"> 
    <link rel='stylesheet prefetch' href='https://trantrongbinhbka.000webhostapp.com/views/library/fonts.googleapis.css'>
    <link rel='stylesheet prefetch' href='https://trantrongbinhbka.000webhostapp.com/views/library/Font-Awesome/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="https://trantrongbinhbka.000webhostapp.com/views/css/layout.css">
    <script src="https://trantrongbinhbka.000webhostapp.com/views/library/jquery-3.2.1.min.js"></script>
    <script src="https://trantrongbinhbka.000webhostapp.com/views/library/jquery-1.8.2.js"></script>

