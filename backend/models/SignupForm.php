<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $displayName;
    public $password;
    public $coordination_id; 
    public $photo;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['displayName', 'required'],
            ['displayName', 'string', 'min' => 2, 'max' => 200],

            ['email', 'required'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            [['photo'], 'file'],
            [['photo'], 'string'],

            ['coordination_id', 'integer'],
            ['coordination_id', 'required'],

            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->role = 0;
        $user->name = $this->displayName;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->coordination_id = $this->coordination_id;
        $user->photo = $this->photo;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$backend
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$backend->params['supportEmail'] => Yii::$backend->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$backend->name)
            ->send();
    }
    public function attributeLabels()
        {
            return [
                'username' => 'Nome de Utilizador',
                'auth_key' => 'Auth Key',
                'displayName' => 'Nome',
                'password_hash' => 'Password Hash',
                'password_reset_token' => 'Password Reset Token',
                'email' => 'Email',
                'coordination_id' => 'Coordenação',
                'status' => 'Status',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'verification_token' => 'Verification Token',
                'photo' => 'Foto',
            ];
    }
     public function getCoordination()
    {
        return $this->hasOne(Coordination::className(), ['id' => 'coordination_id']);
    }
}
