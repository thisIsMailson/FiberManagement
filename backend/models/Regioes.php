<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "regioes".
 *
 * @property int $id_regiao
 * @property string $nome
 * @property int $ilha
 * @property int $coordenacao_id_coordenacao
 *
 * @property Parametrizacao $ilha0
 * @property Coordenacoes $coordenacaoIdCoordenacao
 * @property UserRegioes[] $userRegioes
 * @property Zonas[] $zonas
 */
class Regioes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public static function tableName()
    {
        return 'regioes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'ilha', 'coordenacao_id_coordenacao'], 'required'],
            [['ilha', 'coordenacao_id_coordenacao'], 'integer'],
            [['nome'], 'string', 'max' => 50],
            [['ilha'], 'exist', 'skipOnError' => true, 'targetClass' => Parametrizacao::className(), 'targetAttribute' => ['ilha' => 'id']],
            [['coordenacao_id_coordenacao'], 'exist', 'skipOnError' => true, 'targetClass' => Coordenacoes::className(), 'targetAttribute' => ['coordenacao_id_coordenacao' => 'id_coordenacao']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_regiao' => 'Id Regiao',
            'nome' => 'Nome',
            'ilha' => 'Ilha',
            'coordenacao_id_coordenacao' => 'Coordenação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIlha0()
    {
        return $this->hasOne(Parametrizacao::className(), ['id' => 'ilha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoordenacaoIdCoordenacao()
    {
        return $this->hasOne(Coordenacoes::className(), ['id_coordenacao' => 'coordenacao_id_coordenacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRegioes()
    {
        return $this->hasMany(UserRegioes::className(), ['regiao_id_regiao' => 'id_regiao']);
    }
    public function getRegioes()
    {
        return Regioes::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZonas()
    {
        return $this->hasMany(Zonas::className(), ['regiao_id_regiao' => 'id_regiao']);
    }
}
