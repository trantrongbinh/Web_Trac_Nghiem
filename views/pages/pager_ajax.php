<?php
include('../../model/database.class.php');
include('../../model/class.title.php');

$sotinmottrang = 4;
$trang = $_GET["trang"];
settype($trang, "int");

$from = $trang * $sotinmottrang + 1;

$m_title = new title();
$data = $m_title->layTitle($from, $sotinmottrang);
    foreach ($data as $ds) {
        ?>
        <div class="cat-content">
            <div class="col1">
                <div class="news">
                    <div class="clear"></div>
                    <img class="images_news2" src="views/upload/images/<?=$ds['name_image']?>" align="left" />
                    <h3 class="title" ><a href="index.php?p=chi-tiet&id_title=<?=$ds['id_title']?>"><?=$ds['title']?></a></h3>
                    <div class="des"><?=$ds['content']?></div>
                </div>
            </div>
            <div class="col2"></div>
        </div>
        <div class="clear"></div>
        <?php
    }
?>