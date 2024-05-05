<div class="owl-carousel owl-theme">
    <?php if($ourTeam) {
        foreach ($ourTeam as $team) { ?>
    <div class="item">
        <div class="hs_astro_team_img_main_wrapper">
            <div class="hs_astro_img_wrapper">
                <?php
                $image_path = Yii::$app->params['upload_directories']['teams']['image'].$team['uid'].'/'.$team['image'];
                 ?>
                <img src="<?= $image_path ?>" alt="team-img">
                <ul>
                    <li><a href="tel:<?= $team['phone'] ?>"><i class="fa fa-phone"></i>&nbsp; Call Now</a></li>
                </ul>
            </div>
            <div class="hs_astro_img_cont_wrapper">
                <div class="hs_astro_img_inner_wrapper">
                    <h2><a href="#"><?= $team['name'] ?></a></h2>
                    <p><?= $team['designation']?></p>
                </div>
                <?php if($team['charges']) { ?>
                <div class="hs_astro_img_bottom_wrapper">
                    <ul>
                        <li>Charges :</li>
                        <li>₹ <?= $team['charges']?> / hour.</li>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } } ?>
</div>