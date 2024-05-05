<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "camera_apertures".
 *
 * @property int $id
 * @property string $enc_id
 * @property float $value show like f/1.8
 * @property string $created_on
 * @property string $created_by
 *
 * @property AssignedCameras[] $assignedCameras
 */
class CameraApertures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'camera_apertures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'value', 'created_by'], 'required'],
            [['value'], 'number'],
            [['created_on'], 'safe'],
            [['enc_id', 'created_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'enc_id' => Yii::t('app', 'Enc ID'),
            'value' => Yii::t('app', 'Value'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * Gets query for [[AssignedCameras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedCameras()
    {
        return $this->hasMany(AssignedCameras::className(), ['aperture_id' => 'enc_id']);
    }
}
