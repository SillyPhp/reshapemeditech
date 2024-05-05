<?php

namespace app\controllers;

use app\models\DetailGroups;
use app\models\PoolDetailGroups;
use app\models\PoolSpecifications;
use app\models\PoolSpecificationValues;
use app\models\Processors;
use app\models\Specifications;
use app\models\SpecificationValues;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class TestController extends Controller
{
    public function actionIndex()
    {
        return 'edit query first';
        $data = "Apple A13 Bionic ,Qualcomm Snapdragon 865 ,Apple A12 Bionic ,HiSilicon Kirin 990 ,Samsung Exynos 990 ,Qualcomm Snapdragon 855 Plus ,Qualcomm Snapdragon 855 ,Samsung Exynos 9825 ,Samsung Exynos 9820 ,Apple A11 Bionic ,HiSilicon Kirin 980 ,Samsung Exynos 9810 ,Qualcomm Snapdragon 845 ,Qualcomm Snapdragon 765G ,HiSilicon Kirin 810 ,Qualcomm Snapdragon 730G ,Qualcomm Snapdragon 720G ,MediaTek Helio G90T ,Qualcomm Snapdragon 730 ,MediaTek Helio P95 ,MediaTek Helio P90 ,HiSilicon Kirin 970 ,HiSilicon Kirin 960 ,Qualcomm Snapdragon 675 ,Samsung Exynos 8895 ,Qualcomm Snapdragon 835 ,Qualcomm Snapdragon 712 ,MediaTek Helio G70 ,Samsung Exynos 8890 ,Samsung Exynos 9611 ,Samsung Exynos 9610 ,HiSilicon Kirin 955 ,HiSilicon Kirin 950 ,Samsung Exynos 9609 ,Apple A10 Fusion ,MediaTek Helio P65 ,Qualcomm Snapdragon 710 ,Qualcomm Snapdragon 670 ,Qualcomm Snapdragon 665 ,Qualcomm Snapdragon 660 ,Hisilicon Kirin 710F ,Hisilicon Kirin 710 ,MediaTek Helio P70 ,Qualcomm Snapdragon 821 ,Qualcomm Snapdragon 820 ,Samsung Exynos 7885 ,Mediatek Helio P60 ,Samsung Exynos 7420 ,Apple A9 ,Qualcomm Snapdragon 653 ,MediaTek Helio X23 ,Qualcomm Snapdragon 652 ,Qualcomm Snapdragon 650 ,Mediatek Helio X20 ,Qualcomm Snapdragon 636 ,Samsung Exynos 7904 ,Qualcomm Snapdragon 632 ,Mediatek Helio P35 ,Mediatek Helio P25 ,Qualcomm Snapdragon 810 ,Apple A8 ,Qualcomm Snapdragon 808 ,Qualcomm Snapdragon 805 ,Intel Atom Z3580 ,Qualcomm Snapdragon 630 ,Qualcomm Snapdragon 626 ,Qualcomm Snapdragon 625 ,Mediatek Helio P23 ,Mediatek Helio P22 ,Mediatek Helio P20 ,Qualcomm Snapdragon 801 ,Samsung Exynos 5430 ,Mediatek MT6595 ,HiSilicon Kirin 925 ,Qualcomm Snapdragon 439 ,Qualcomm Snapdragon 800 ,Samsung Exynos 5420 ,HiSilicon Kirin 920 ,Samsung Exynos 7880 ,HiSilicon Kirin 935 ,HiSilicon Kirin 659 ,Samsung Exynos 7884B ,Mediatek Helio X10 ,Samsung Exynos 7870 ,HiSilicon Kirin 655 ,HiSilicon Kirin 650 ,Mediatek Helio P10 ,Apple A7 ,Qualcomm Snapdragon 450 ,Qualcomm Snapdragon 429 ,Mediatek Helio A22 ,Intel Atom Z3560 ,Samsung Exynos 5260 ,Mediatek MT6752 ,Samsung Exynos 7580 ,Qualcomm Snapdragon 617 ,Qualcomm Snapdragon 616 ,Qualcomm Snapdragon 615 ,Mediatek MT6753 ,Mediatek MT6750 ,Mediatek MT6592 ,Qualcomm Snapdragon 600 ,HiSilicon Kirin 910T ,Qualcomm Snapdragon 435 ,Qualcomm Snapdragon 430 ,Qualcomm Snapdragon 425 ,Qualcomm Snapdragon 415 ,Mediatek MT6739 ,Mediatek MT6732 ,Mediatek MT6735 ,Mediatek MT8735 ,Mediatek MT6737 ,Samsung Exynos 7570 ,Qualcomm Snapdragon 410 ,HiSilicon Kirin 620 ,Qualcomm Snapdragon 400 ,Qualcomm Snapdragon S4 Pro ,Intel Atom Z2560 ,Apple A6 ,NVIDIA Tegra 3 ,Spreadtrum SC9832 ,Spreadtrum SC9830 ,Samsung Exynos 3475 ,Mediatek MT6582 ,Mediatek MT6580M ,Spreadtrum SC7731 ,Qualcomm Snapdragon 212 ,Mediatek MT6589 ,Qualcomm Snapdragon 210 ,Qualcomm Snapdragon 200 ,Marvell PXA1088 ,Qualcomm 205 ,Qualcomm Snapdragon S4 Plus ,Samsung Exynos 4212 1.5 GHz ,Qualcomm Snapdragon S4 Play ,Texas Instruments OMAP 4460 ,MediaTek MT6572 ,Spreadtrum SC8830 ,MediaTek MT6577 ,ARM Cortex A8 1.2 GHz ,Qualcomm Snapdragon S1";
        $data = explode(' ,', $data);
        foreach ($data as $d) {
            $chk = Processors::findOne(['name' => $d]);
            if (!$chk) {
                $model = new Processors();
                $model->enc_id = Yii::$app->security->generateRandomString(6);
                $model->name = $d;
                $model->assigned_to = 1;
                $model->created_by = '_yxoDn9tE4VsyjW_J3B4';
                if (!$model->save()) {
                    print_r($model->getErrors());
                    die();
                }
            }
        }
    }

    public function actionPool()
    {
        return 'okkk';
        $data = SpecificationValues::find()->all();
        foreach ($data as $d) {
            $chk = PoolSpecificationValues::findOne(['name' => $d->value]);
            if (!$chk) {
                $model = new PoolSpecificationValues();
                $model->enc_id = Yii::$app->security->generateRandomString(6);
                $model->name = $d->value;
                $model->created_by = Yii::$app->user->identity->enc_id;
                if (!$model->save()) {
                    print_r($model->getErrors());
                    die();
                }
                $pool_id = $model->enc_id;
            } else {
                $pool_id = $chk->enc_id;
            }
            $d->value = $pool_id;
            if (!$d->save()) {
                print_r($d->getErrors());
                die();
            }
        }
    }

}
