<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido_zonas".
 *
 * @property int $id_pedidoZona
 * @property int $id_Zona
 * @property int $id_pedido
 *
 * @property Pedidos $pedido
 * @property Zonas $zona
 */
class PedidoZonas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido_zonas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Zona', 'id_pedido'], 'required'],
            [['id_Zona', 'id_pedido'], 'integer'],
            [['id_pedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['id_pedido' => 'id']],
            [['id_Zona'], 'exist', 'skipOnError' => true, 'targetClass' => Zonas::className(), 'targetAttribute' => ['id_Zona' => 'id_zona']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pedidoZona' => 'Id Pedido Zona',
            'id_Zona' => 'Id Zona',
            'id_pedido' => 'Id Pedido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedidos::className(), ['id' => 'id_pedido']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZona()
    {
        return $this->hasOne(Zonas::className(), ['id_zona' => 'id_Zona']);
    }
}
