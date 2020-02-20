<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\HistoricoPedidos;

/**
 * HistoricoPedidosSearch represents the model behind the search form of `backend\models\HistoricoPedidos`.
 */
class HistoricoPedidosSearch extends HistoricoPedidos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_historico_pedido', 'pedidos_id_pedido', 'user_id_user', 'status_pedido_projeto_id_status'], 'integer'],
            [['data_alteracao', 'observacao'], 'safe'],
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
        $query = HistoricoPedidos::find();

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
            'id_historico_pedido' => $this->id_historico_pedido,
            'pedidos_id_pedido' => $this->pedidos_id_pedido,
            'user_id_user' => $this->user_id_user,
            'status_pedido_projeto_id_status' => $this->status_pedido_projeto_id_status,
            'data_alteracao' => $this->data_alteracao,
        ]);

        $query->andFilterWhere(['like', 'observacao', $this->observacao]);

        return $dataProvider;
    }
}
