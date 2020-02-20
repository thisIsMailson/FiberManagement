<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Coordenacoes */

$this->title = 'Create Coordenacoes';
$this->params['breadcrumbs'][] = ['label' => 'Coordenacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coordenacoes-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
