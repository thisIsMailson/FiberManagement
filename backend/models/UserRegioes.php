<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_regioes".
 *
 * @property int $id_user_regioes
 * @property int $user_id_user
 * @property int $regiao_id_regiao
 *
 * @property User $userIdUser
 * @property Regioes $regiaoIdRegiao
 */
class UserRegioes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_regioes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regiao_id_regiao'], 'required'],
            [['user_id_user', 'regiao_id_regiao'], 'integer'],
            [['user_id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id_user' => 'id']],
            [['regiao_id_regiao'], 'exist', 'skipOnError' => true, 'targetClass' => Regioes::className(), 'targetAttribute' => ['regiao_id_regiao' => 'id_regiao']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user_regioes' => 'Id User Regioes',
            'user_id_user' => 'Utilizador',
            'regiao_id_regiao' => 'Região',
        ];
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
    public function getRegiaoIdRegiao()
    {
        return $this->hasOne(Regioes::className(), ['id_regiao' => 'regiao_id_regiao']);
    }
}
