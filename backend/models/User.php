<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property string $photo
 * @property int $role_id
 * @property int $coordenacao_id
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 *
 * @property Encomendas[] $encomendas
 * @property HistoricoPedidos[] $historicoPedidos
 * @property HistoricoProjetos[] $historicoProjetos
 * @property Pedidos[] $pedidos
 * @property Projetos[] $projetos
 * @property Coordenacoes $coordenacao
 * @property Roles $role
 * @property UserRegioes[] $userRegioes
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'name', 'auth_key', 'password_hash', 'email', 'photo', 'role_id', 'coordenacao_id', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'coordenacao_id'], 'safe'],
            [['status', 'role_id', 'coordenacao_id', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'photo', 'verification_token', 'regiao_id_regiao'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            ['regiao_id_regiao', 'required',  'whenClient' => function ($model) {
                    return $model->role_id == 3;
            } 
            ],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['coordenacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coordenacoes::className(), 'targetAttribute' => ['coordenacao_id' => 'id_coordenacao']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'name' => 'Utilizador',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'photo' => 'Photo',
            'role_id' => 'Role ID',
            'regiao_id_regiao' => 'Região',
            'coordenacao_id' => 'Coordenacao ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncomendas()
    {
        return $this->hasMany(Encomendas::className(), ['users_id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoPedidos()
    {
        return $this->hasMany(HistoricoPedidos::className(), ['user_id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoProjetos()
    {
        return $this->hasMany(HistoricoProjetos::className(), ['user_id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['user_id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjetos()
    {
        return $this->hasMany(Projetos::className(), ['user_id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoordenacao()
    {
        return $this->hasOne(Coordenacoes::className(), ['id_coordenacao' => 'coordenacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRegioes()
    {
        return $this->hasMany(UserRegioes::className(), ['user_id_user' => 'id']);
    }
}
