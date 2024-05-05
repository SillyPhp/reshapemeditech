<?php

namespace backend\models\extented;

use app\models\PoolDetailGroups;
use yii\db\Exception;
use Yii;

class DetailGroups extends \app\models\DetailGroups
{
    public $cat_id;
    public $pool_id;

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
            [['cat_id', 'pool_id'], 'required'],
            [['cat_id'], 'string', 'max' => 50],
        ];
    }

    public function add()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $cat_id = $this->cat_id;
            $groups = explode(',', $this->pool_id);
            foreach ($groups as $group) {
                $group = ucwords($group);
                $model = new \app\models\DetailGroups();
                $model->enc_id = Yii::$app->security->generateRandomString(10);
                $model->cat_id = $cat_id;
                $model->created_by = Yii::$app->user->identity->enc_id;
                $model->status = 'Active';
                $chkPool = PoolDetailGroups::findOne(['name' => $group]);
                $chkDuplicate = null;
                if ($chkPool) {
                    $model->pool_id = $chkPool->enc_id;
                    $chkDuplicate = \app\models\DetailGroups::findOne(['cat_id' => $cat_id, 'pool_id' => $chkPool->enc_id]);
                }
                if (!$chkDuplicate) {
                    if (!$chkPool) {
                        $poolModel = new PoolDetailGroups();
                        $poolModel->enc_id = Yii::$app->security->generateRandomString(10);
                        $poolModel->name = $group;
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
