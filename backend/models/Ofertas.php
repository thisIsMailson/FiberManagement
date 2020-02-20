<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ofertas".
 *
 * @property int $id
 * @property string $oferta
 * @property string $tipo
 *
 * @property Pedidos[] $pedidos
 * @property Pedidos[] $pedidos0
 */
class Ofertas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ofertas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oferta', 'tipo'], 'required'],
            [['oferta'], 'string', 'max' => 100],
            [['tipo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['oferta_antiga' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos0()
    {
        return $this->hasMany(Pedidos::className(), ['oferta_nova' => 'id']);
    }
}
