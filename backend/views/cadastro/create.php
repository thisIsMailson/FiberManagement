<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Cadastros */

$this->title = 'Create Cadastros';
$this->params['breadcrumbs'][] = ['label' => 'Cadastros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cadastros-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
