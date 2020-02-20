<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\user */

$this->title = '';
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <style>
        form .form-group  .form-control {
            border-radius: 4px !important;
            box-shadow: none;
            //    border-color: #d2d6de;
        }
        .modal-content{
            border-radius: 5px !important;
            //  background: #000;
            width: 370px;
           
            margin: auto;
        }
        .form-group label{
            color: #333333 !important;  
        }
    </style>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
    <?= Html::a('Alterar Foto', ['user/updatephoto', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       
    </p>

    <div class="box box-primary" >       
        <div class="box-header with-border" style="margin-bottom:8px;padding: 5px 10px">
            <h3 class="box-title"style="color: #666666"><b>DETALHES DO UTILIZADOR</b></h3>
        </div>

         <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'username',
                'email:email',
                [
                    'attribute' => 'status',
                    'value' => function($model)
                    {
                       return $model->status == 10 ? "Ativo" : "Inativo";
                    }
                ],
            ],
        ]) ?>
    </div>
</div>


