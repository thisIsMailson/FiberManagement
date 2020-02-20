<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Encomendas;

/**
 * EncomendasSearch represents the model behind the search form of `backend\models\Encomendas`.
 */
class EncomendasSearch extends Encomendas
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'pedidos_id_pedido', 'users_id_user'], 'integer'],
            [['tp_encomenda', 'n_encomenda', 'data_encomenda', 'estado_encomenda', 'observacao', 'data_ot', 'ot', 'globalSearch'], 'safe'],
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
        $query = Encomendas::find();

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
            'data_encomenda' => $this->data_encomenda,
            'data_ot' => $this->data_ot,
            'pedidos_id_pedido' => $this->pedidos_id_pedido,
            'users_id_user' => $this->users_id_user,
        ]);

        $query->orFilterWhere(['like', 'tp_encomenda', $this->globalSearch])
            ->orFilterWhere(['like', 'n_encomenda', $this->globalSearch])
            ->orFilterWhere(['like', 'estado_encomenda', $this->globalSearch])
            ->orFilterWhere(['like', 'observacao', $this->globalSearch])
            ->orFilterWhere(['like', 'ot', $this->globalSearch]);

        return $dataProvider;
    }
}
