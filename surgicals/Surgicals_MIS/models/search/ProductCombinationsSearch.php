<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductCombinations;

/**
 * ProductCombinationsSearch represents the model behind the search form of `common\models\ProductCombinations`.
 */
class ProductCombinationsSearch extends ProductCombinations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', 'status', 'products__id'], 'integer'],
            [['_uid', 'created_at', 'updated_at', 'product_id', 'title'], 'safe'],
            [['price', 'sale_price'], 'number'],
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
        $query = ProductCombinations::find();

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
            '_id' => $this->_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'products__id' => $this->products__id,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
        ]);

        $query->andFilterWhere(['like', '_uid', $this->_uid])
            ->andFilterWhere(['like', 'product_id', $this->product_id])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
