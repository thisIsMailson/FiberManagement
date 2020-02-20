<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Regioes;

/**
 * RegioesSearch represents the model behind the search form of `backend\models\Regioes`.
 */
class RegioesSearch extends Regioes
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id_regiao', 'coordenacao_id_coordenacao'], 'integer'],
            [['nome', 'globalSearch'], 'safe'],
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
        $query = Regioes::find()->orderby('nome asc');

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
            'id_regiao' => $this->id_regiao,
            'coordenacao_id_coordenacao' => $this->coordenacao_id_coordenacao,
        ]);

        $query->orFilterWhere(['like', 'nome', $this->globalSearch]);

        return $dataProvider;
    }
}
