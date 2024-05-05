<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Specifications;

/**
 * SpecificationsSearch represents the model behind the search form of `app\models\Specifications`.
 */
class SpecificationsSearch extends Specifications
{
    public $spec_name;
    public $group_name;
    public $cat_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['spec_name', 'group_name', 'cat_name', 'enc_id', 'detail_group_id', 'cat_id', 'pool_id', 'created_by', 'created_on'], 'safe'],
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
        $query = Specifications::find()->alias('z');
        $query->joinWith(['pool a'], false);
        $query->joinWith(['detailGroup b' => function ($b) {
            $b->joinWith(['pool d'], false);
        }], false);
        $query->joinWith(['cat c'], false);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'enc_id',
            'pagination' => [
                'pageSize' => 200
            ],
            'sort' => ['defaultOrder' => ['created_on' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'z.id' => $this->id,
            'z.created_on' => $this->created_on,
        ]);

        $query->andFilterWhere(['like', 'z.enc_id', $this->enc_id])
            ->andFilterWhere(['like', 'z.detail_group_id', $this->detail_group_id])
            ->andFilterWhere(['like', 'z.cat_id', $this->cat_id])
            ->andFilterWhere(['like', 'z.pool_id', $this->pool_id])
            ->andFilterWhere(['like', 'z.created_by', $this->created_by])
            ->andFilterWhere(['like', 'c.name', $this->cat_name])
            ->andFilterWhere(['like', 'd.name', $this->group_name])
            ->andFilterWhere(['like', 'a.name', $this->spec_name]);

        return $dataProvider;
    }
}
