<?php
$questions = new data_question();
$title = new title();
$ds_title = $title->layTitle();
$new_title = $title->layNewTitle();
$xemnhieu = $questions->getMostView();
$dungnhieu = $questions->getMostTrueInTitle();
$hardtitle = $questions->HardTitle();

// $ds_title = $title->danhSachTitle();
// $danhsachtitle = $ds_title['danhmuc'];
// $thanhphantrang = $ds_title['thanhphantrang'];
?>
<div class="box-cat">
    <div class="cat-content">
        <div id="cat-content-left">
            <div id="left-top">
                <img src="views/upload/images/<?=$new_title['name_image']?>" width="400px" height="260px" />
                <br />
                <br />
                <h2 class="title"><a href="index.php?p=chi-tiet&id_title=<?=$new_title['id_title']?>"><?=$new_title['title']?></a> </h2>
                <div class="des"><?=$new_title['content']?></div>
            </div>
        </div>
        <div id="cat-content-right">
            <div id="right-head">
                <ul class="tab">
                    <li><a href="index.php?p=chi-tiettinmoi" class="tab-link active" onclick="openTab(event, 1)">Xem nhiều</a></li>
                    <li><a href="index.php?p=chi-tiettinxemnhieu" class="tab-link" onclick="openTab(event, 2)">Chủ đề khó</a></li>
                </ul>
            </div> 
            <div class="tab-content" id="tab1">
                <div class="auto" id="nt-container">
                    <div style="text-align: center;">
                        <i class="fa fa-angle-double-up" id="nt1-prev"></i>
                    </div>
                    <ul id="nt1">
                        <?php
                        foreach ($xemnhieu as $xn) {
                            ?>
                            <li>
                                <div class="title_news" id="teks">
                                    <a href="index.php?p=chi-tiet&id_title=<?=$xn['id_title']?>" class="txt_link"><img src="views/upload/images/<?=$xn['name_image']?>" style="float:left;width:70px;height:50px; margin:0 7px 0 -7px;"><b><?=$xn['title']?></b></a>
                                    <div style="height: 20px; display: block; padding: 0 5px 0 3px;"><i class="fa fa-eye" style="font-size:15px;">: </i><span style="color:#900;"> <?=$xn['view']?></span></div>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <div style="text-align: center;">
                        <i class="fa fa-angle-double-down" id="nt1-next"></i>
                    </div>
                </div>
            </div>
            <div class="tab-content hide" id="tab2">
                <div class="auto" id="nt-container">
                    <div style="text-align: center;">
                        <i class="fa fa-angle-double-up" id="nt2-prev"></i>
                    </div>
                    <ul id="nt2">
                        <?php
                        if(empty($hardtitle)){
                            ?>
                            <div class="title_news" id="teks">
                                <div style="height: 20px; display: block; padding: 0 5px 0 3px; width: 257px;"><i class="fa fa-commenting" style="font-size:15px"> </i><span style="color:#900;"><b> Có vẻ không có chủ đề nào có thể làm khó các bạn được. Chúc bạn một ngày tốt lành.</b></span>
                                    <br>
                                    <img src="views/images/loichuc.jpg" width="250" height="170" style="display: block; margin: 20px auto;">
                                </div>
                            </div>
                            <?php
                        }else{
                            foreach ($hardtitle as $hard) {
                            ?>
                                <li>
                                    <div class="title_news" id="teks">
                                        <a href="index.php?p=chi-tiet&id_title=<?=$hard['id_title']?>" class="txt_link"><img src="views/upload/images/<?=$hard['name_image']?>" style="float:left;width:70px;height:50px; margin:0 7px 0 -7px;"><b><?=$hard['title']?></b></a>
                                        <div style="height: 20px; display: block; padding: 0 5px 0 3px;"><i class="fa fa-lock" style="font-size:15px"></i></div>
                                    </div>
                                </li>
                            <?php
                            }
                        }
                        ?>
                    </ul>
                    <div style="text-align: center;">
                        <i class="fa fa-angle-double-down" id="nt2-next" ></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div style="border-top: 2px solid; margin-bottom: 10px"></div>
<!-- box cat-->
<div class="box-cat">
    <div class="cat">
        <div class="main-cat">
            <a href="index.php?p=chi-tiet">Câu hỏi</a>
        </div>
        <div class="child-cat">
        </div>
        <div class="giaoduc" id="danhsach">
            <?php
            foreach ($ds_title as $ds) {
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
            <!-- <div id="phantrang" style = "text-align: center;"><?=$thanhphantrang?></div> -->
            
        </div>

        <div id="xemthem" style="text-align: left; font-size: 14px; margin-top: 5px; color: blue;"><b><a href="./">Xem thêm <li class="fa fa-angle-double-right"></li></a></b></div>
    </div>
</div>
<div class="clear"></div>
<style>
.pagination>li{
    float: left;
    padding: 10px;
}
</style>
<script src="views/library/jquery.newsTicker.min.js"></script>
<script>

    function slideShow() {

        //Set the opacity of all images to 0
        $('#gallery a').css({opacity: 0.0});
        
        //Get the first image and display it (set it to full opacity)
        $('#gallery a:first').css({opacity: 1.0});
        
        //Set the caption background to semi-transparent
        $('#gallery .caption').css({opacity: 0.7});

        //Resize the width of the caption according to the image width
        $('#gallery .caption').css({width: $('#gallery a').find('img').css('width')});
        
        //Get the caption of the first image from REL attribute and display it
        $('#gallery .content').html($('#gallery a:first').find('img').attr('rel'))
        .animate({opacity: 0.7}, 400);
        
        //Call the gallery function to run the slideshow, 6000 = change to next image after 6 seconds
        setInterval('gallery()',6000);
        
    }

    $(document).ready(function(e) {
        //slide tin
         slideShow();
         //tin chạy
        $('#nt1').newsTicker({
            row_height: 75,
            max_rows: 4,
            duration: 3000,
            prevButton: $('#nt1-prev'),
            nextButton: $('#nt1-next')
        });
        $('#nt2').newsTicker({
            row_height: 75,
            max_rows: 4,
            duration: 3000,
            prevButton: $('#nt2-prev'),
            nextButton: $('#nt2-next')
        });

        $(".tab-link").click(function(event){
            event.preventDefault();
            $(".tab-link").removeClass('active');
            // var current_index = $(this).index();
            var current_index = $(".tab-link").index(this);
            $(".tab-link:eq("+current_index+")").addClass('active');
            $(".tab-content").hide();
            $(".tab-content:eq("+current_index+")").fadeIn(300);
        });

        var toancuc = 0;
        $("#xemthem").click(function(event) {
            event.preventDefault();
            toancuc = toancuc + 1;
            $.get("views/pages/pager_ajax.php", {trang:toancuc}, function(data){
                $("#danhsach").append(data);
            });
        });
    });
</script>
