<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Clientes;

/**
 * ClientesSearch represents the model behind the search form of `backend\models\Clientes`.
 */
class ClientesSearch extends Clientes
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id_cliente', 'cod_cliente'], 'integer'],
            [['nome_cliente', 'tipo_cliente', 'contato', 'globalSearch'], 'safe'],
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
        $query = Clientes::find()->orderby('cod_cliente asc');

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
        // $query->andFilterWhere([
        //     'id_cliente' => $this->id_cliente,
        //     'cod_cliente' => $this->cod_cliente,
        // ]);

        $query->orFilterWhere(['like', 'nome_cliente', $this->globalSearch])
            ->orFilterWhere(['like', 'tipo_cliente', $this->globalSearch])
            ->orFilterWhere(['like', 'cod_cliente', $this->globalSearch])
            ->orFilterWhere(['like', 'contato', $this->globalSearch]);

        return $dataProvider;
    }
}
