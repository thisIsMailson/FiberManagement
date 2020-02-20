<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Cadastros;

/**
 * CadastrosSearch represents the model behind the search form of `backend\models\Cadastros`.
 */
class CadastrosSearch extends Cadastros
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id_cadastro'], 'integer'],
            [['referencia_ot', 'LACETE', 'ADSL', 'VOIP', 'IPTV', 'OLT_NOME', 'OLT_PON_ONUID', 'BSP_PON_Painel_Porto', 'BSP_modulo', 'BSP_modulo_splitter', 'BSP_modulo_porto', 'BSP_Porto_In', 'BSP_Porto_Out', 'ODF_modulo', 'ODF_porto', 'PRIMARIO_modulo', 'PRIMARIO_porto', 'SPLITTERS_modulo', 'SPLITTERS_splitter', 'SPLITTERS_Porto_In', 'SPLITTERS_Porto_Out', 'SECUNDARIO_modulo', 'SECUNDARIO_PDO', 'SECUNDARIO_par', 'PDOs_pdo', 'PDOs_par', 'globalSearch'], 'safe'],
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
        $query = Cadastros::find();

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
            'id_cadastro' => $this->id_cadastro,
        ]);

        $query->orFilterWhere(['like', 'referencia_ot', $this->globalSearch])
            ->orFilterWhere(['like', 'LACETE', $this->globalSearch])
            ->orFilterWhere(['like', 'ADSL', $this->globalSearch])
            ->orFilterWhere(['like', 'VOIP', $this->globalSearch])
            ->orFilterWhere(['like', 'IPTV', $this->globalSearch])
            ->orFilterWhere(['like', 'OLT_NOME', $this->globalSearch])
            ->orFilterWhere(['like', 'OLT_PON_ONUID', $this->globalSearch])
            ->orFilterWhere(['like', 'BSP_PON_Painel_Porto', $this->globalSearch])
            ->orFilterWhere(['like', 'BSP_modulo', $this->globalSearch])
            ->orFilterWhere(['like', 'BSP_modulo_splitter', $this->globalSearch])
            ->orFilterWhere(['like', 'BSP_modulo_porto', $this->globalSearch])
            ->orFilterWhere(['like', 'BSP_Porto_In', $this->globalSearch])
            ->orFilterWhere(['like', 'BSP_Porto_Out', $this->globalSearch])
            ->orFilterWhere(['like', 'ODF_modulo', $this->globalSearch])
            ->orFilterWhere(['like', 'ODF_porto', $this->globalSearch])
            ->orFilterWhere(['like', 'PRIMARIO_modulo', $this->globalSearch])
            ->orFilterWhere(['like', 'PRIMARIO_porto', $this->globalSearch])
            ->orFilterWhere(['like', 'SPLITTERS_modulo', $this->globalSearch])
            ->orFilterWhere(['like', 'SPLITTERS_splitter', $this->globalSearch])
            ->orFilterWhere(['like', 'SPLITTERS_Porto_In', $this->globalSearch])
            ->orFilterWhere(['like', 'SPLITTERS_Porto_Out', $this->globalSearch])
            ->orFilterWhere(['like', 'SECUNDARIO_modulo', $this->globalSearch])
            ->orFilterWhere(['like', 'SECUNDARIO_PDO', $this->globalSearch])
            ->orFilterWhere(['like', 'SECUNDARIO_par', $this->globalSearch])
            ->orFilterWhere(['like', 'PDOs_pdo', $this->globalSearch])
            ->orFilterWhere(['like', 'PDOs_par', $this->globalSearch]);

        return $dataProvider;
    }
}
