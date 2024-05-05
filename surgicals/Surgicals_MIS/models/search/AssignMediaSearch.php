<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AssignMedia;

/**
 * AssignMediaSearch represents the model behind the search form of `app\models\AssignMedia`.
 */
class AssignMediaSearch extends AssignMedia
{
    public $media_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'is_deleted'], 'integer'],
            [['media_name','_uid', 'media_id', 'created_at', 'updated_at', 'user_name', 'phone', 'email', 'password', 'expiry_date_number', 'has_token_key'], 'safe'],
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
        $query = AssignMedia::find()->alias('z')
        ->joinWith(['media a'],false)
        ->where(['z.is_deleted' => 0,'z.status' => 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
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
            'z.created_at' => $this->created_at,
            'z.updated_at' => $this->updated_at,
            'z.status' => $this->status,
            'z.is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'z._uid', $this->_uid])
            ->andFilterWhere(['like', 'z.media_id', $this->media_id])
            ->andFilterWhere(['like', 'z.user_name', $this->user_name])
            ->andFilterWhere(['like', 'z.phone', $this->phone])
            ->andFilterWhere(['like', 'z.email', $this->email])
            ->andFilterWhere(['like', 'z.password', $this->password])
            ->andFilterWhere(['like', 'z.expiry_date_number', $this->expiry_date_number])
            ->andFilterWhere(['like', 'a.title', $this->media_name])
            ->andFilterWhere(['like', 'z.has_token_key', $this->has_token_key]);

        return $dataProvider;
    }
}
