<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "historico_pedidos".
 *
 * @property int $id_historico_pedido
 * @property int $pedidos_id_pedido
 * @property int $user_id_user
 * @property int $status_pedido_projeto_id_status
 * @property string $data_alteracao
 * @property string $observacao
 *
 * @property Pedidos $pedidosIdPedido
 * @property StatusPedidoProjetos $statusPedidoProjetoIdStatus
 * @property User $userIdUser
 */
class HistoricoPedidos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historico_pedidos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pedidos_id_pedido', 'user_id_user', 'status_pedido_projeto_id_status', 'data_alteracao'], 'required'],
            [['pedidos_id_pedido', 'user_id_user', 'status_pedido_projeto_id_status'], 'integer'],
            [['data_alteracao'], 'safe'],
            [['observacao'], 'string', 'max' => 255],
            [['pedidos_id_pedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['pedidos_id_pedido' => 'id']],
            [['status_pedido_projeto_id_status'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPedidoProjetos::className(), 'targetAttribute' => ['status_pedido_projeto_id_status' => 'id_status']],
            [['user_id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_historico_pedido' => 'Id Historico Pedido',
            'pedidos_id_pedido' => 'Pedidos Id Pedido',
            'user_id_user' => 'Utilizador',
            'status_pedido_projeto_id_status' => 'Estado',
            'data_alteracao' => 'Data Alteração',
            'observacao' => 'Observação',
        ];
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
    public function getStatusPedidoProjetoIdStatus()
    {
        return $this->hasOne(StatusPedidoProjetos::className(), ['id_status' => 'status_pedido_projeto_id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id_user']);
    }
}
