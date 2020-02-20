<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "historico_projetos".
 *
 * @property int $id_historico_projeto
 * @property int $projetos_id_projetos
 * @property int $user_id_user
 * @property int $status_id_status
 * @property string $data_alteracao
 * @property string $observacao
 *
 * @property Projetos $projetosIdProjetos
 * @property User $userIdUser
 * @property StatusPedidoProjetos $statusIdStatus
 */
class HistoricoProjetos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historico_projetos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['projetos_id_projetos', 'user_id_user', 'status_id_status', 'data_alteracao', 'observacao'], 'required'],
            [['projetos_id_projetos', 'user_id_user', 'status_id_status'], 'integer'],
            [['data_alteracao'], 'safe'],
            [['observacao'], 'string', 'max' => 255],
            [['projetos_id_projetos'], 'exist', 'skipOnError' => true, 'targetClass' => Projetos::className(), 'targetAttribute' => ['projetos_id_projetos' => 'id_projeto']],
            [['user_id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id_user' => 'id']],
            [['status_id_status'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPedidoProjetos::className(), 'targetAttribute' => ['status_id_status' => 'id_status']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_historico_projeto' => 'Id Historico Projeto',
            'projetos_id_projetos' => 'Projeto',
            'user_id_user' => 'Utilizador',
            'status_id_status' => 'Estado',
            'data_alteracao' => 'Data Alteração',
            'observacao' => 'Observação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjetosIdProjetos()
    {
        return $this->hasOne(Projetos::className(), ['id_projeto' => 'projetos_id_projetos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusIdStatus()
    {
        return $this->hasOne(StatusPedidoProjetos::className(), ['id_status' => 'status_id_status']);
    }
}
