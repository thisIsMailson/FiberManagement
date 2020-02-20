<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id_cliente
 * @property int $cod_cliente
 * @property string $nome_cliente
 * @property string $tipo_cliente
 * @property string $contato
 *
 * @property Pedidos[] $pedidos
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cod_cliente', 'nome_cliente', 'tipo_cliente', 'contato'], 'required'],
            [['cod_cliente'], 'integer'],
            [['nome_cliente', 'tipo_cliente', 'contato'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cliente' => 'Id Cliente',
            'cod_cliente' => 'Código Cliente',
            'nome_cliente' => 'Nome Cliente',
            'tipo_cliente' => 'Tipo Cliente',
            'contato' => 'Contato',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['clientes_id_cliente' => 'id_cliente']);
    }
     public function getTipoCliente()
    {
        return $this->hasOne(TipoCliente::className(), ['id' => 'tipo_cliente']);
    }
}
