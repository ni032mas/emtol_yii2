<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `backend\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'consumer_id', 'qty', 'order_status_id', 'created_at', 'updated_at'], 'integer'],
            [['sum', 'paid'], 'number'],
            [['comment'], 'safe'],
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
        $query = Orders::find()->select('orders.*')
            ->leftJoin('orders_item', 'orders_item.order_id = orders.id')
            ->leftJoin('reservationinfo', 'reservationinfo.id = orders_item.reservationinfo_id')
            ->leftJoin('objreservation', 'objreservation.id = reservationinfo.objreservation_id')
            ->leftJoin('customers', 'objreservation.customer_id = customers.id')
            ->leftJoin('user', 'customers.user_id = user.id')
            ->where(['user.id' => Yii::$app->user->id]);
//        $query = Orders::find();

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
            'consumer_id' => $this->consumer_id,
            'qty' => $this->qty,
            'sum' => $this->sum,
            'paid' => $this->paid,
            'order_status_id' => $this->order_status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
