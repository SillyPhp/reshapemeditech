<?php
if(!isset($onlyParent)){
    $onlyParent = false;
}
?>
<section class="py-3 mt-3">
    <div class="page-title text-white text-center">
        <!-- <h2><?=$title?></h2> -->
        <ul class="list-inline">
            <li><a href="/"><i class="fas fa-home"></i>Home</a></li>
                <li><i class="fa fa-angle-right"></i></li>
                <li><a href="<?= $parentLink?>"><?= $parentName?></a></li>
            <?php
            if(!$onlyParent) {
            ?>
                <li><i class="fa fa-angle-right"></i></li>
                <!-- <li><a href="<?=$_SERVER['REQUEST_URI']?>"><?=$title?></a></li> -->
                <li><p><?=$title?></p></li>
            <?php
            }
            ?>
        </ul>
    </div>
</section>
<?php
$this->registerCss('
.with-gradient {
    background: #099A6F;
    background: linear-gradient(90deg, #099A6F 0%, #099A6F 55%, #00A394 100%);
}
.pt-100 {
    padding-top: 100px;
}
.page-title {
//    padding-top: 65px;
    // padding-bottom: 80px;
    text-transform: capitalize;
    display: flex;
    justify-content: flex-start;
    padding-left: 24px;
}
.text-white {
    color: #fff!important;
}
.page-title ul.list-inline {
    margin-bottom: 0px;
}

.list-inline {
    padding-left: 0;
    list-style: none;
}
ul.list-inline>li {
    display: inline-block;
    // color: #fff;
    // margin-bottom: 10px;
    position: relative;
}
ul.list-inline>li:not(:last-child) {
    margin-right: 15px;
}
.page-title ul.list-inline>li:not(:last-child) {
    margin-right: 10px;
}
.page-title li a {
    color: #007bff; 
}
.page-title li a i {
    font-size: 12px;
    margin-right: 5px;
    color: #333;
}
.page-title li i{
    color: #333;
}
');