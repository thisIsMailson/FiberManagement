<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "projetos".
 *
 * @property int $id_projeto
 * @property string|null $cod_projeto
 * @property string|null $designacao
 * @property string|null $descricao
 * @property string $observacao
 * @property int $status_pedido_projetos_Id_status
 * @property int $user_id_user
 *
 * @property HistoricoProjetos[] $historicoProjetos
 * @property Pedidos[] $pedidos
 * @property StatusPedidoProjetos $statusPedidoProjetosIdStatus
 * @property User $userIdUser
 */
class Projetos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projetos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['observacao', 'status_pedido_projetos_Id_status', 'user_id_user'], 'required'],
            [['status_pedido_projetos_Id_status', 'user_id_user'], 'integer'],
            [['observacao'], 'string'],
            [['cod_projeto'], 'string', 'max' => 10],
            [['designacao', 'descricao'], 'string', 'max' => 255],
            [['cod_projeto'], 'unique'],
            [['id_projeto'], 'unique'],
            [['status_pedido_projetos_Id_status'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPedidoProjetos::className(), 'targetAttribute' => ['status_pedido_projetos_Id_status' => 'id_status']],
            [['user_id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_projeto' => 'Id Projeto',
            'cod_projeto' => 'Código Projeto',
            'designacao' => 'Designação',
            'descricao' => 'Descricao',
            'observacao' => 'Observação',
            'status_pedido_projetos_Id_status' => 'Estado',
            'user_id_user' => 'Utilizador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoProjetos()
    {
        return $this->hasMany(HistoricoProjetos::className(), ['projetos_id_projetos' => 'id_projeto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['projetos_id_projeto' => 'id_projeto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusPedidoProjetosIdStatus()
    {
        return $this->hasOne(StatusPedidoProjetos::className(), ['id_status' => 'status_pedido_projetos_Id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id_user']);
    }


     public function getProjetos(){
        return \yii\helpers\ArrayHelper::map(self::find()->all(),'id_projeto','cod_projeto');
    }
}
