<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "status_pedido_projetos".
 *
 * @property int $id_status
 * @property string $dominio
 * @property string $designacao_estado
 * @property int|null $ordem
 * @property int $status
 *
 * @property HistoricoPedidos[] $historicoPedidos
 * @property HistoricoProjetos[] $historicoProjetos
 * @property Pedidos[] $pedidos
 * @property Projetos[] $projetos
 */
class StatusPedidoProjetos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_pedido_projetos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dominio', 'designacao_estado'], 'required'],
            [['ordem', 'status'], 'integer'],
            [['dominio', 'designacao_estado'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_status' => 'Id Status',
            'dominio' => 'Domínio',
            'designacao_estado' => 'Estado Pedido',
            'ordem' => 'Ordem',
            'status' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoPedidos()
    {
        return $this->hasMany(HistoricoPedidos::className(), ['status_pedido_projeto_id_status' => 'id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoProjetos()
    {
        return $this->hasMany(HistoricoProjetos::className(), ['status_id_status' => 'id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['status_id_status' => 'id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjetos()
    {
        return $this->hasMany(Projetos::className(), ['status_pedido_projetos_Id_status' => 'id_status']);
    }
}
