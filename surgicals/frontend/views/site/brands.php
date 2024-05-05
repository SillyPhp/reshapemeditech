<?php
//$this->params['body_classes'] = 'left-sidebar';
?>
    <div id="content" class="site-content" tabindex="-1">
        <div class="container">
            <h3 class="text-center" style="margin-bottom:40px;">Our Brands</h3>
            <div class="row row-full-width align-middle align-right" id="row-1650105290">
                <?php
                if(is_array($brands) && count($brands) > 0){
                    foreach ($brands as $brand){
                        ?>
                        <div class="col medium-3 small-6 large-3 brand-logos-div">
                            <div class="col-inner">
                                <img class="brand-logos" src="/images/brands/<?= $brand['_uid'] .'/'. $brand['image_enc_name'] ?>">
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
<?php
$this->registerCss('
.site-content{
    padding-top:60px;
}

.row-collapse {
    padding: 0;
}
.row-full-width {
    max-width: 100%!important;
}
.small-12 {
    max-width: 100%;
    -ms-flex-preferred-size: 100%;
    flex-basis: 100%;
}
.small-6 {
    max-width: 50%;
    -ms-flex-preferred-size: 50%;
    flex-basis: 50%;
}
@media screen and (min-width: 550px){
.medium-2 {
    max-width: 16.66667%;
    -ms-flex-preferred-size: 16.66667%;
    flex-basis: 16.66667%;
}
  .medium-10 {
    max-width: 83.33333%;
    -ms-flex-preferred-size: 83.33333%;
    flex-basis: 83.33333%;
}
}
@media screen and (min-width: 850px){
.large-2 {
    max-width: 16.66667%;
    -ms-flex-preferred-size: 16.66667%;
    flex-basis: 16.66667%;
}
  .large-10 {
    max-width: 83.33333%;
    -ms-flex-preferred-size: 83.33333%;
    flex-basis: 83.33333%;
}
}
.row-collapse>.flickity-viewport>.flickity-slider>.col, .row-collapse>.col {
    padding: 0!important;
}
.col-inner {
    position: relative;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
    background-position: 50% 50%;
    background-size: cover;
    background-repeat: no-repeat;
    -ms-flex: 1 0 auto;
    flex: 1 0 auto;
}
@media screen and (min-width: 850px){
.col:first-child .col-inner {
    margin-left: auto;
    margin-right: 0;
}
}
#row-77444144 > div > .col-inner{
    margin:15px 0px 10px 0px !important;
}
.price-wrapper .price ins{
    text-decoration: none;
}
#row-77444144 > div.medium-2 > .col-inner {
    margin-top: 110px !important;
}

@media screen and (min-width: 550px){
.medium-3 {
    max-width: 25%;
    -ms-flex-preferred-size: 25%;
    flex-basis: 25%;
}
}

@media screen and (min-width: 850px){
.large-3 {
    max-width: 25%;
    -ms-flex-preferred-size: 25%;
    flex-basis: 25%;
}
}
.brand-logos {
    max-width: 100%;
    height: 82px;
}

.brand-logos-div {
    margin: 0 0 +15px 0;
}
.brand-logos-div .col-inner {
    text-align: center;
}
');
$script = <<<JS

JS;
$this->registerJs($script);