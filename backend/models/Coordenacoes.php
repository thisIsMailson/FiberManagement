<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "coordenacoes".
 *
 * @property int $id_coordenacao
 * @property int $nome
 * @property string $discricao
 *
 * @property Regioes[] $regioes
 */
class Coordenacoes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coordenacoes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'discricao'], 'required'],
            [['discricao','nome'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_coordenacao' => 'Id Coordenacao',
            'nome' => 'Nome Coordenação',
            'discricao' => 'Descrição',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegioes()
    {
        return $this->hasMany(Regioes::className(), ['coordenacao_id_coordenacao' => 'id_coordenacao']);
    }
}
