<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Zonas */

$this->title = 'Update Zonas: ' . $model->id_zona;
$this->params['breadcrumbs'][] = ['label' => 'Zonas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_zona, 'url' => ['view', 'id' => $model->id_zona]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zonas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
