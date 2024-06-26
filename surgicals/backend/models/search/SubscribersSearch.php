<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subscribers;

/**
 * SubscribersSearch represents the model behind the search form of `app\models\Subscribers`.
 */
class SubscribersSearch extends Subscribers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id'], 'integer'],
            [['_uid', 'email', 'created_at'], 'safe'],
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
        $query = Subscribers::find();

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
        ]);

        $query->andFilterWhere(['like', '_uid', $this->_uid])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
