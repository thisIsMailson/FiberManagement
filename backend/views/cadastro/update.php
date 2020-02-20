<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Cadastros */

$this->title = 'Update Cadastros: ' . $model->id_cadastro;
$this->params['breadcrumbs'][] = ['label' => 'Cadastros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cadastro, 'url' => ['view', 'id' => $model->id_cadastro]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cadastros-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
