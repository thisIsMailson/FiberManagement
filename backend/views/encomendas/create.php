<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Encomendas */

$this->title = 'Create Encomendas';
$this->params['breadcrumbs'][] = ['label' => 'Encomendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encomendas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
