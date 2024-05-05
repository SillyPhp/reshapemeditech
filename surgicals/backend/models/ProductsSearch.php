<?php

namespace app\models;

use yii\base\Model;

//use yii\data\ActiveDataProvider;

/**
 * ProductsSearch represents the model behind the search form of `app\models\Products`.
 */
class ProductsSearch extends Model
{
    public $name;
    public $brand_name;
    public $short_description;
    public $created_at;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'name', 'short_description', 'brand_name'], 'safe'],
        ];
    }

    private $_filtered = false;

    public function search($params)
    {
        if ($this->load($params) && $this->validate()) {
            $this->_filtered = true;
        }
        return new \yii\data\ArrayDataProvider([
            // ArrayDataProvider here takes the actual data source
            'allModels' => $this->getData(),
            'key' => '_id',
            'sort' => [
                // we want our columns to be sortable:
                'defaultOrder' => ['name' => SORT_ASC],
                'attributes' => ['name'],
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
    }

    protected function getData()
    {
        $data = \app\models\Products::find()->alias('z')
            ->select(['z._uid','z._id','z.name','z.short_description','z.created_at','a.name brand_name','a._id brand_id'])
            ->joinWith(['brands a'])
            ->where(['not',['z.status' => 3]])
            ->orderBy(['created_at' => SORT_ASC]);
        if ($this->_filtered) {
            if($this->name){
                $data = $data->andFilterWhere(['like','z.name' , $this->name]);
            }
            if($this->brand_name){
                $data = $data->andFilterWhere(['like','a.name' , $this->brand_name]);
            }
            if($this->short_description){
                $data = $data->andFilterWhere(['like','z.short_description' , $this->short_description]);
            }
        }
        $data = $data->asArray()->all();
        return $data;
    }

}
