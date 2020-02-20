<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "zonas".
 *
 * @property int $id_zona
 * @property int $nome
 * @property int $regiao_id_regiao
 *
 * @property Pedidos[] $pedidos
 * @property Regioes $regiaoIdRegiao
 */
class Zonas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zonas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_zona', 'nome', 'regiao_id_regiao'], 'required'],
            [['id_zona', 'regiao_id_regiao'], 'integer'],
            [['id_zona'], 'unique'],
            [['regiao_id_regiao'], 'exist', 'skipOnError' => true, 'targetClass' => Regioes::className(), 'targetAttribute' => ['regiao_id_regiao' => 'id_regiao']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_zona' => 'Id Zona',
            'nome' => 'Zona',
            'regiao_id_regiao' => 'Nome da Região',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['zonas_id_zona' => 'id_zona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegiaoIdRegiao()
    {
        return $this->hasOne(Regioes::className(), ['id_regiao' => 'regiao_id_regiao']);
    }

     public function getZonas(){

        $userLoged = \Yii::$app->user->identity;
        $userCoordination = $userLoged->coordenacao_id;

        return \yii\helpers\ArrayHelper::map(self::find()->innerJoin('regioes', 'regioes.id_regiao = zonas.regiao_id_regiao')
            ->innerJoin('coordenacoes', 'regioes.coordenacao_id_coordenacao = coordenacoes.id_coordenacao AND coordenacoes.id_coordenacao = '.$userCoordination)->all(),'id_zona','nome');
    }
}
