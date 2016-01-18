<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Events;

/**
 * EventsSearch represents the model behind the search form about `backend\models\Events`.
 */
class EventsSearch extends Events
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'location_id', 'contractor_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'date_begin', 'date_end', 'images', 'alias'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
//        $users = \common\models\User::find();
//        $query = $users;
        
//        $contractors = Contractors::find()->events;
        $query = Events::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'location_id' => $this->location_id,
            'contractor_id' => $this->contractor_id,
            'user_id' => $this->user_id,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }
}
