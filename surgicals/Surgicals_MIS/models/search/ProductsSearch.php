<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;

/**
 * ProductsSearch represents the model behind the search form of `app\models\Products`.
 */
class ProductsSearch extends Products
{
    public $cat_name;
    public $brand_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_featured', 'is_deleted'], 'integer'],
            [['cat_name', 'brand_name', 'enc_id', 'cat_id', 'brand_id', 'name', 'media_id', 'short_description', 'long_description', 'created_by', 'created_on', 'updated_by', 'updated_on', 'status'], 'safe'],
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
        $query = Products::find()->alias('z');
        $query->joinWith(['cat a'], false);
        $query->joinWith(['brand b'], false);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'enc_id',
            'pagination' => [
                'pageSize' => 100
            ],
            'sort' => ['defaultOrder' => ['created_on' => SORT_DESC]]
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
            'z.is_featured' => $this->is_featured,
            'z.created_on' => $this->created_on,
            'z.updated_on' => $this->updated_on,
            'z.is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'z.enc_id', $this->enc_id])
            ->andFilterWhere(['like', 'z.cat_id', $this->cat_id])
            ->andFilterWhere(['like', 'z.brand_id', $this->brand_id])
            ->andFilterWhere(['like', 'z.name', $this->name])
            ->andFilterWhere(['like', 'z.media_id', $this->media_id])
            ->andFilterWhere(['like', 'z.short_description', $this->short_description])
            ->andFilterWhere(['like', 'z.long_description', $this->long_description])
            ->andFilterWhere(['like', 'z.created_by', $this->created_by])
            ->andFilterWhere(['like', 'z.updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'z.status', $this->status])
            ->andFilterWhere(['like', 'a.name', $this->cat_name])
            ->andFilterWhere(['like', 'b.name', $this->brand_name]);

        return $dataProvider;
    }
}
