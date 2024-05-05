<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Categories;

/**
 * CategoriesSearch represents the model behind the search form of `app\models\Categories`.
 */
class CategoriesSearch extends Categories
{
    public $parent_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', 'status', 'user_authorities__id'], 'integer'],
            [['_uid', 'created_at', 'updated_at', 'name', 'eo_uid', '_parent_id', 'parent_name'], 'safe'],
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
        $query = Categories::find()->alias('z')
        ->joinWith(['parentId a'])
            ->where(['not',['z.status' => 3]])
        ->orderBy(['created_at' => SORT_DESC]);

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
            'z.status' => $this->status,
            'z.user_authorities__id' => $this->user_authorities__id,
        ]);

        $query->andFilterWhere(['like', 'z._uid', $this->_uid])
            ->andFilterWhere(['like', 'z.name', $this->name])
            ->andFilterWhere(['like', 'a.name', $this->parent_name])
            ->andFilterWhere(['like', 'z.eo_uid', $this->eo_uid]);

        return $dataProvider;
    }
}
