<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Regioes;
use backend\models\Zonas;
/* @var $this yii\web\View */
/* @var $model backend\models\Pedidos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedidosProjetos-form">

    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'validateOnBlur' => false, 'options'=> ['enctype' => 'multipart/form-data']]); ?>

    <div class="panel-group">
         <div class="panel-heading">Dados do cliente</div>
         <div class="panel-body">
         	<?= Html::dropDownList('id_regiao', null,
                            ArrayHelper::map(Regioes::find()->all(), 'id_regiao', 'nome'),['prompt'=>'Selecione uma Região',
                            'onchange'=>'
                            	$.post("index.php?r=pedidos/regions&id='.'"+$(this).val(), function( data ){
                            		$("select#zonas-drop").html(data);
                            	});
                            ', 'style' => 'width: 24%; height: 34px;',
                        ]
                );?>

                <?= Html::dropDownList('id_zona', null,
                            ArrayHelper::map(Zonas::find()->all(), 'id_zona', 'nome'),['prompt'=>'Selecione uma Zona', 'id'=>'zonas-drop','style' => 'width: 25%; height: 34px;', 
                            'onchange'=>'
                            	$.post("index.php?r=pedidos/list&id='.'"+$(this).val(), function( data ){
                            		var theDiv = document.getElementById("pedidos-lista");
                            		theDiv.innerHTML = data;
                            		console.log(data);
                            	});
                            ',
                        ]
                );?>
         </div>
    </div>

    <div class="col-lg-6">
        <div class="alert alert-info">Pedidos</div>
        <div id="pedidos-lista"></div>
    </div>

    <!-- <!?= $form->field($model, 'projetos_id_projeto')->textInput() ?> -->

  

    <?php ActiveForm::end(); ?>

</div>
