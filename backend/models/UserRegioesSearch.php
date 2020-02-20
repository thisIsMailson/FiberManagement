<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserRegioes;

/**
 * UserRegioesSearch represents the model behind the search form of `backend\models\UserRegioes`.
 */
class UserRegioesSearch extends UserRegioes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user_regioes', 'user_id_user', 'regiao_id_regiao'], 'integer'],
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
        $query = UserRegioes::find();

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
            'id_user_regioes' => $this->id_user_regioes,
            'user_id_user' => $this->user_id_user,
            'regiao_id_regiao' => $this->regiao_id_regiao,
        ]);

        return $dataProvider;
    }
}
