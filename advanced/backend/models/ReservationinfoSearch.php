<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Reservationinfo;

/**
 * ReservationinfoSearch represents the model behind the search form about `backend\models\Reservationinfo`.
 */
class ReservationinfoSearch extends Reservationinfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'objreservation_id', 'date_begin', 'date_end', 'amount', 'created_at', 'updated_at'], 'integer'],
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
        $query = Reservationinfo::find();

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
            'objreservation_id' => $this->objreservation_id,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
