<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vouchers;

/**
 * VouchersSearch represents the model behind the search form of `app\models\Vouchers`.
 */
class VouchersSearch extends Vouchers
{
    public $brand_name;
    public $category_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', 'brand_id', 'category_id', 'use_once', 'amount', 'is_deleted'], 'integer'],
            [['brand_name', 'category_name', '_uid', 'created_at', 'updated_at', 'type', 'name', 'end_datetime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Vouchers::find()
            ->alias('z')
            ->where(['z.is_deleted' => 0])
            ->joinWith(['brand a'])
            ->joinWith(['category b']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'z._id' => $this->_id,
            'z.created_at' => $this->created_at,
            'z.updated_at' => $this->updated_at,
            'z.brand_id' => $this->brand_id,
            'z.category_id' => $this->category_id,
            'z.use_once' => $this->use_once,
            'z.end_datetime' => $this->end_datetime,
            'z.is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'z._uid', $this->_uid])
            ->andFilterWhere(['like', 'z.type', $this->type])
            ->andFilterWhere(['like', 'z.amount', $this->amount])
            ->andFilterWhere(['like', 'z.name', $this->name])
            ->andFilterWhere(['like', 'a.name', $this->brand_name])
            ->andFilterWhere(['like', 'b.name', $this->category_name]);

        return $dataProvider;
    }
}
