<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    #login-form > div.form-group > div.input-group > span > i{
        color:#1dbed0;
    }
    #login-form > div.form-group > div.input-group > span{
        border-radius: 15px 0 0 15px;
    }
    #loginform-username,#loginform-password{
        border-radius: 0 15px 15px 0;
    }
    body{
        /*background: transparent url('images/corespondencia1.jpg') no-repeat center center!important;*/
        background-color: #fff !important;
        background-size: cover!important;
        height: 100%!important;
        overflow: hidden;
    }
    #bt_entrar{
        background-color: #1dbed0 !important;
        border-color: #1dbed0 !important;
        border-radius: 15px;
    }
</style>
<div class="site-login">
    <body class="hold-transition login-page">
        <div class="row">
            <div class="col-md-8 imagem_coresp pull-left"> 
                <img src="image/fibra.png" style="margin-left: auto; margin-right: auto; max-width:80%;  margin-top:10%"> 
            </div>
            
            <div class="col-md-2 caixa_login">
                <div class="login-box pull-left" style="margin-top: 65%; box-shadow: 5px 5px 40px rgba(0,0,0,0.5); border-radius: 6px;">
                    <!--<header style="background: #1dbed0 ;height: auto;color:#FFF; padding: 10px 0 10px 0;border-radius: 6px 6px 0 0">
                        <h4 align=center style="margin:3px; line-height: 130%;"><b>GESTÃO DE CORRESPONDÊNCIAS</b></h4>
                    </header>-->
                    <header style="background: #FFFFFF;height: auto;color:#000; padding: 20px 0 10px 0;border-radius: 6px 6px 0 0">
                        <div class="col-md-12">
                            <div class="col-md-4 image" style="margin-bottom: 25px;">
                                <img src="image/CVTelecom.PNG" alt="Smiley face" style="margin-left: auto; margin-right: auto; width: 40%; width: 80px;height: 80px;">
                            </div> 
                            <div class="clo-md-4 pull-left gestao" style="margin-top: 15px;">
                                <h4 align=center style="margin:3px; line-height: 130%;"><b>Gestão de<br> Clientes</b></h4>
                            </div>
                        </div>
                    </header>
                    <div class="login-box-body" style="padding: 20px 40px 10px 40px; border-radius: 0 0 6px 6px;">
                        <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'options' => ['class' => 'form-horizontal'],
                        ]); ?> 
                        <?= $form->field($model, 'username',['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-user"></i>']]])->label(FALSE)->textInput(['class'=>'form-control','placeholder'=>'Utilizador']) ?>

                        <?= $form->field($model, 'password',['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-lock"></i>']]])->label(FALSE)->passwordInput(['class'=>'form-control','placeholder'=>'Palavra-passe']) ?>

                        <div class="form-group">
                          <?= Html::submitButton('<b>ENTRAR</b>', ['class' => 'btn btn-primary btn-block btn-flat', 'id' => 'bt_entrar', 'name' => 'login-button']) ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php ActiveForm::end(); ?>
</div>
