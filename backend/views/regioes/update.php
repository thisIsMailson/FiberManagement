<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Regioes */

$this->title = 'Update Regioes: ' . $model->id_regiao;
$this->params['breadcrumbs'][] = ['label' => 'Regioes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_regiao, 'url' => ['view', 'id' => $model->id_regiao]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="regioes-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
