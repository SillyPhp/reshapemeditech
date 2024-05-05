<?php

namespace app\models\extented;

use app\models\PoolSpecifications;
use app\models\PoolSpecificationValues;
use yii\db\Exception;
use Yii;

class Specifications extends \app\models\SpecificationValues
{
    public $cat_id;
    public $detail_group_id;
    public $pool_id;
    public $has_variant;

    public $_flag;

    public function formName()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_id', 'detail_group_id', 'pool_id', 'has_variant'], 'required'],
            [['cat_id', 'detail_group_id'], 'string', 'max' => 50],
        ];
    }

    public function add()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $specifications = explode(',', $this->pool_id);
            foreach ($specifications as $specification) {
                $specification = ucwords(trim($specification));
                $model = new \app\models\Specifications();
                $model->enc_id = Yii::$app->security->generateRandomString(10);
                $model->detail_group_id = $this->detail_group_id;
                $model->cat_id = $this->cat_id;
                $model->created_by = Yii::$app->user->identity->enc_id;
                $model->has_variant = $this->has_variant;
                $chkPool = PoolSpecifications::findOne(['name' => $specification]);
                $chkDuplicate = null;
                if ($chkPool) {
                    $model->pool_id = $chkPool->enc_id;
                    $chkDuplicate = \app\models\Specifications::findOne(['cat_id' => $this->cat_id, 'detail_group_id' => $this->detail_group_id, 'pool_id' => $chkPool->enc_id]);
                }
                if (!$chkDuplicate) {
                    if (!$chkPool) {
                        $poolModel = new PoolSpecifications();
                        $poolModel->enc_id = Yii::$app->security->generateRandomString(10);
                        $poolModel->name = $specification;
                        $poolModel->created_by = Yii::$app->user->identity->enc_id;
                        if (!$poolModel->save()) {
                            $transaction->rollBack();
                            return false;
                        }
                        $model->pool_id = $poolModel->enc_id;
                    }
                    if (!$model->save()) {
                        $transaction->rollBack();
                        return false;
                    }
                }
            }
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            return $e->getMessage();
        }
    }
}
