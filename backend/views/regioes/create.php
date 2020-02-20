<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Regioes */

$this->title = 'Create Regioes';
$this->params['breadcrumbs'][] = ['label' => 'Regioes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regioes-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
