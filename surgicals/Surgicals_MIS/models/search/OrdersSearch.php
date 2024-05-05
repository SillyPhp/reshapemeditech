<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form of `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    public $full_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', 'user_id', 'status', 'city'], 'integer'],
            [['full_name','_uid', 'promo', 'first_name', 'last_name', 'contact', 'email', 'address1', 'address2', 'zip_code', 'notes', 'created_at', 'updated_at'], 'safe'],
            [['sub_total', 'discount', 'grand_total'], 'number'],
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
        $query = Orders::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['full_name'] = [
            'asc'  => ['CONCAT(first_name," ", last_name)' => SORT_ASC ],
            'desc' => ['CONCAT(first_name," ", last_name)' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            '_id' => $this->_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'sub_total' => $this->sub_total,
            'discount' => $this->discount,
            'grand_total' => $this->grand_total,
            'city' => $this->city,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', '_uid', $this->_uid])
            ->andFilterWhere(['like', 'promo', $this->promo])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'CONCAT(first_name," ", last_name)', $this->full_name]);

        return $dataProvider;
    }
}
