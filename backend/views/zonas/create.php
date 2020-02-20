<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Zonas */

$this->title = 'Create Zonas';
$this->params['breadcrumbs'][] = ['label' => 'Zonas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zonas-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
