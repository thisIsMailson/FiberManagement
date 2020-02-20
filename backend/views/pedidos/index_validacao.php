<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\dynagrid\DynaGrid;
use yii\helpers\URL;
use yii\helpers\ArrayHelper;
use backend\models\Zonas;
use backend\models\Regioes;
use backend\models\Filtros;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Validação';
$this->params['breadcrumbs'][] = 'Validação';
?>
<style type="text/css">
    #zonas-drop {
        width: 2px !important;
    }
</style>
<div class="clientes-index">
  <?php
        Modal::begin([
            'id' => 'modal-id-indicador',
            'header' => '<h1>Ver Pedido</h1>',
            'size' => 'modal-lg',
        ]);
        echo "<div id='modalContentInd'></div>";
        Modal::end()
    ?>
    <?php
        Modal::begin([
            'id' => 'modal-id-projeto',
            'header' => '<h1>Associar Projeto</h1>', 
            'size' => 'modal-lg',
        ]);
        echo "<div id='modalContentProjeto'></div>";
        Modal::end()
    ?>

    <?php
        Modal::begin([
        'id'=>'modal-id-editar',
        'header' => '<h1>Editar Estado</h1>',
        'size'=>'modal-lg',
            ]);
        echo "<div id='modalContentEditar'></div>";
        Modal::end()
    ?>

    <div class="box">
        <div class="box-body">
        <div class="panel-group">
           <div class="panel">
                <div class="alert row" style="background-color:#009BB4">
                    <?= Html::dropDownList('id_regiao', null,
                                    ArrayHelper::map(Filtros::find()->orderby('ordem')->all(), 'id_filtro', 'nome'),['prompt'=>'Selecione um filtro',
                                    'onchange'=>'
                                        $.get("index.php?r=pedidos/filters&id='.'"+$(this).val(), function( data ){
                                            $("select#zonas-drop").html(data);
                                        });
                                    ', 'style' => 'width: 24%; height: 34px;',
                                ]
                        );?>

                <div style="width: 24%; height: 34px; padding-top: 10px;">
                    <?= Select2::widget([
                                    'name' => 'fileter_2',
                                    'id' => 'zonas-drop',
                                    'value' => '',
                                    'options' => ['multiple' => false, 'placeholder' => 'Selecione um item', 'style' => 'width: 24%; height: 34px;', 
                                    'onchange'=>'
                                        let tipo = $(this).parent().prev().find(":selected").val();
                                        
                                        $.post("index.php?r=pedidos/list&idTipoFiltro="+tipo+"&id="+$(this).val(), function( data ){
                                            var theDiv = document.getElementById("pedidos-lista");
                                            theDiv.innerHTML = data;
                                            console.log(data);
                                        });
                                    ',  'onclick' => '
                                            let tipo = $(this).parent().prev().find(":selected").val();
                                            alert($(this).val());
                                            $.post("index.php?r=pedidos/list&idTipoFiltro="+tipo+"&id="+$(this).val(), function( data ){
                                                var theDiv = document.getElementById("pedidos-lista");
                                                theDiv.innerHTML = data;
                                                console.log(data);
                                            });
                                    ']
                                ]);
                    ?>
                    
                </div>
                </div>
           </div>
         </div> 
           
           <div id="pedidos-lista">
               <?= DynaGrid::widget([
                    'storage'=>DynaGrid::TYPE_COOKIE,
                    'theme'=>'panel-default',
                    'showPersonalize'=>true,
                    'storage'=>'cookie',
                    'gridOptions'=>[
                        'dataProvider'=>$dataProvider,
                       // 'filterModel'=>$searchModel,
                        'rowOptions'=>function($model){
                                if ($model->statusIdStatus === 1) {
                                    return ['class'=>'warning'];
                                }
                                return ['class'=>'success'];
                             

                        },
                        'showPageSummary'=>false,
                        'floatHeader'=>true,
                        'pjax'=>true,
                        'panel'=>[
                            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Pedidos</h3>',
                            'after' => false
                        ],        
                        'toolbar' =>  [
                            /*['content'=>
                                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Adicionar', 'class'=>'btn btn-success', 
                                             'data-keyboard'=>'false','data-backdrop'=>'static','data-toggle'=>'modal','data-target'=>".bs-modal-contacto-tp",'href'=>"index.php?r=sgm-pr-contacto-tp/create"]) . ' '.
                                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Atualiar Tabela'])
                            ],*/
                            '{export}',
                            '{toggleData}',
                            ['content' => '{dynagrid}']
                        ]
                    ],
                    'options'=>['id'=>'dynagrid-contacto-tp'], // a unique identifier is important
                    'columns' => [
                        ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
                        [
                            'attribute'=>'cod_cliente',
                            'value'=>'clientesIdCliente.cod_cliente', 
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'10px',
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'clientes_id_cliente', 
                            'value'=>'clientesIdCliente.nome_cliente',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'cod_pedido',
                            'value'=>'cod_pedido',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'10px',
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'zonas_id_zona', 
                            'value'=>'zonasIdZona.nome',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                    
                        [
                            'attribute'=>'status_id_status',
                            'value'=>'statusIdStatus.designacao_estado', 
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                    
                        [
                            'attribute'=>'data_rececao',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                        ['class'=>'kartik\grid\ActionColumn','template'=> '{view}{status}{projeto}',
                            'buttons' => [
                                    'view' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-eye-open" ></span>', FALSE, 
                                     ['value' => $url, 'onclick' => 'js:openPopUp(this);', 'title' => 'Ver']);
                                    },
                                    'status' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-pencil" style="padding: 10px;"></span>', FALSE, 
                                     ['value' => $url, 'onclick' => 'js:openPopUpEditar(this);', 'title' => 'Editar estado']);
                                        
                                    },
                                    // 'projeto' => function ($url, $model) {
                                    //     return Html::a('<span class="glyphicon glyphicon-briefcase"></span>', FALSE, 
                                    //  ['value' => $url, 'onclick' => 'js:openPopProjectUp(this);', 'title' => 'associar projeto']);
                                        
                                    // },
                                
                                
                            ],'header'=>'', 'contentOptions' => ['style' => 'width:90px;'],
                            'dropdown'=>false,'order'=>DynaGrid::ORDER_FIX_RIGHT],
                        ],
                ]);
            ?>
           </div>
            
        </div>
    </div>
</div>
