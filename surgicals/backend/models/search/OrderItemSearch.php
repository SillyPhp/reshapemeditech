<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderItem;

/**
 * OrderItemSearch represents the model behind the search form of `app\models\OrderItem`.
 */
class OrderItemSearch extends OrderItem
{
    public $product_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', 'product_id', 'order_id', 'quantity'], 'integer'],
            [['product_name','_uid', 'created_at', 'updated_at'], 'safe'],
            [['price', 'discount', 'tax_amount'], 'number'],
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
        $query = OrderItem::find()->alias('z')
        ->distinct()
        ->joinWith(['productCombinations a' => function($a){
            $a->joinWith(['products b']);
        }],false);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['product_name'] = [
            'asc'  => ['b.name' => SORT_ASC ],
            'desc' => ['b.name' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'z._id' => $this->_id,
            'z.product_id' => $this->product_id,
            'z.order_id' => $this->order_id,
            'z.price' => $this->price,
            'z.discount' => $this->discount,
            'z.tax_amount' => $this->tax_amount,
            'z.quantity' => $this->quantity,
            'z.created_at' => $this->created_at,
            'z.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'z._uid', $this->_uid])
        ->andFilterWhere(['like', 'b.name', $this->product_name]);

        return $dataProvider;
    }
}
