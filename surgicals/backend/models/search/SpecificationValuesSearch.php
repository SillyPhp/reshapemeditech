<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SpecificationValues;

/**
 * SpecificationValuesSearch represents the model behind the search form of `app\models\SpecificationValues`.
 */
class SpecificationValuesSearch extends SpecificationValues
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_highlighted'], 'integer'],
            [['enc_id', 'product_id', 'specification_id', 'pool_id', 'created_by', 'created_on'], 'safe'],
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
        $query = SpecificationValues::find();

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
            'id' => $this->id,
            'is_highlighted' => $this->is_highlighted,
            'created_on' => $this->created_on,
        ]);

        $query->andFilterWhere(['like', 'enc_id', $this->enc_id])
            ->andFilterWhere(['like', 'product_id', $this->product_id])
            ->andFilterWhere(['like', 'specification_id', $this->specification_id])
            ->andFilterWhere(['like', 'pool_id', $this->pool_id])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
