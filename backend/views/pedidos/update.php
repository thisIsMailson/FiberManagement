<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pedidos */

$this->title = 'Update Pedidos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pedidos-update">


    <?= $this->render('_form', [
        'model' => $model,  'zonas' => $zonas,'value'=> [], 
    ]) ?>

</div>
