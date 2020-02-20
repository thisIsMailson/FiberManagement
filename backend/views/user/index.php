<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Url;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\dynagrid\DynaGrid;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizadores';
?>
<div class="user-index">

        <?php
            Modal::begin([
                'id' => 'modal-Cliente',
                'header' => '<h1>Adicionar Utilizador</h1>',
                'size' => 'modal-lg',
            ]);
            echo "<div id='modalContentCliente'></div>";
            Modal::end()
        ?>     
        <?php
            Modal::begin([
             'id'=>'modal-id-editar',
             'header'=>'<h1>Editar Utilizador</h1>',
             'size'=>'modal-lg',
                ]);
            echo "<div id='modalContentEditar'></div>";
            Modal::end()
        ?>

        <?php
            Modal::begin([
                'id' => 'modal-id-ver',
                'header'=>'<h1>Detalhes do Utilizador</h1>',
                'size' => 'modal-lg',
            ]);
            echo "<div id='modalContentVer'></div>";
            Modal::end()
        ?>
    <div class="box">
        <div class="box-body">
            
            <div class="modelSearch"> <?php echo $this->render('_search', ['model' => $searchModel]); ?></div>
            
            <br>
            <br>
            <br>
            <p style="float: left; margin-bottom: 0px">
                <?= Html::button('Adicionar', ['value'=>URL::to('index.php?r=user/create'), 'class' => 'btn btn-primary', 'id'=>'contatoButton']) ?>
            </p>
            <br>
            <br>
            <br>
       
           <!--  <div class="modelSearch"> <?php echo $this->render('_search', ['model' => $searchModel]); ?></div> -->
            <?= DynaGrid::widget([
                'storage'=>DynaGrid::TYPE_COOKIE,
                'theme'=>'panel-default',
                'showPersonalize'=>true,
                'storage'=>'cookie',
                'gridOptions'=>[
                    'dataProvider'=>$dataProvider,
                
                    'showPageSummary'=>true,
                    'floatHeader'=>true,
                    'pjax'=>true,
                    'panel'=>[
                        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> '.$this->title.'</h3>',
                        'after' => false
                    ],        
                    'toolbar' =>  [
                        '{export}',
                        '{toggleData}',
                        ['content' => '{dynagrid}']
                    ]
                ],
                'options'=>['id'=>'dynagrid-contacto-tp'], // a unique identifier is important
                'columns' => [
                    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
                    
                    ['attribute' => 'photo',
                    'format' => ['html'],
                    'filter' => false,
                    'value' => function ($data) {

                        if (!empty($data['photo'])) {

                            return Html::img(Yii::getAlias($data['photo']), ['width' => '30px']);
                        }
                        return "Not choosen";
                    },

                    ],
                    'name',
                    'username',
                    'email:email',
                    [
                       'attribute' => 'role_id',
                        'value'=>'role.nome',
                        'label' => 'Perfil',
                        'filter'=>array(),
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Status',
                        'value' => function ($model){
                        return $model->status == 10 ?'Ativo':'Inativo';
                        },
                        'filter'=>array(),
                    ],
                   
                    ['class'=>'kartik\grid\ActionColumn','template'=> '{view}{update}',
                        'buttons' => [
                            
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', FALSE, 
                                 ['value' => $url, 'onclick' => 'js:openPopUpVer(this);', 'title' => 'Ver']);
                                },

                                'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil" style="padding: 10px;"></span>', FALSE, 
                                 ['value' => $url, 'onclick' => 'js:openPopUpEditar(this);', 'title' => 'Atualiar']);
                                    
                                },
                            
                            
                        ],'header'=>'', 'contentOptions' => ['style' => 'width:90px;'],
                        'dropdown'=>false,'order'=>DynaGrid::ORDER_FIX_RIGHT],
                ],
            ]);
            ?>
        </div>
    </div>
</div>