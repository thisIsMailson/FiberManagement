<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Projetos;

/**
 * ProjetosSearch represents the model behind the search form of `backend\models\Projetos`.
 */
class ProjetosSearch extends Projetos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_projeto', 'status_pedido_projetos_Id_status', 'user_id_user'], 'integer'],
            [['cod_projeto', 'designacao', 'descricao', 'observacao'], 'safe'],
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
        $query = Projetos::find();

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
            'id_projeto' => $this->id_projeto,
            'status_pedido_projetos_Id_status' => $this->status_pedido_projetos_Id_status,
            'user_id_user' => $this->user_id_user,
        ]);

        $query->andFilterWhere(['like', 'cod_projeto', $this->cod_projeto])
            ->andFilterWhere(['like', 'designacao', $this->designacao])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'observacao', $this->observacao]);

        return $dataProvider;
    }
}
