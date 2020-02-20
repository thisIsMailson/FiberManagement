<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Projetos */

$this->title = 'Update Projetos: ' . $model->id_projeto;
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_projeto, 'url' => ['view', 'id' => $model->id_projeto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="projetos-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
