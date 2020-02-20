<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "encomendas".
 *
 * @property int $id
 * @property int $tp_encomenda
 * @property string $n_encomenda
 * @property string $data_encomenda
 * @property int $estado_encomenda
 * @property string $observacao
 * @property string $data_ot
 * @property string $ot
 * @property int $pedidos_id_pedido
 * @property int $users_id_user
 *
 * @property Parametrizacao $estadoEncomenda
 * @property Pedidos $pedidosIdPedido
 * @property Parametrizacao $tpEncomenda
 * @property User $usersIdUser
 */
class Encomendas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'encomendas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tp_encomenda', 'n_encomenda', 'data_encomenda', 'estado_encomenda', 'pedidos_id_pedido', 'users_id_user'], 'required'],
            [['tp_encomenda', 'estado_encomenda', 'users_id_user'], 'integer'],
            [['data_encomenda', 'data_ot', 'tipo_cliente', 'nome_cliente'], 'safe'],
            [['observacao'], 'string'],
            [['n_encomenda', 'ot'], 'string', 'max' => 36],
            [['estado_encomenda'], 'exist', 'skipOnError' => true, 'targetClass' => Parametrizacao::className(), 'targetAttribute' => ['estado_encomenda' => 'id']],
            [['pedidos_id_pedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['pedidos_id_pedido' => 'id']],
            [['tp_encomenda'], 'exist', 'skipOnError' => true, 'targetClass' => Parametrizacao::className(), 'targetAttribute' => ['tp_encomenda' => 'id']],
            [['users_id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['users_id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tp_encomenda' => 'Tipo Encomenda',
            'n_encomenda' => 'Nº Encomenda',
            'data_encomenda' => 'Data Encomenda',
            'estado_encomenda' => 'Estado Encomenda',
            'observacao' => 'Observação',
            'data_ot' => 'Data OT',
            'ot' => 'OT',
            'pedidos_id_pedido' => 'Pedido',
            'users_id_user' => 'Utilizador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoEncomenda()
    {
        return $this->hasOne(Parametrizacao::className(), ['id' => 'estado_encomenda']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidosIdPedido()
    {
        return $this->hasOne(Pedidos::className(), ['id' => 'pedidos_id_pedido']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTpEncomenda()
    {
        return $this->hasOne(Parametrizacao::className(), ['id' => 'tp_encomenda']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'users_id_user']);
    }
}
