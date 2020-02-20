<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserRegioes */

$this->title = 'Create User Regioes';
$this->params['breadcrumbs'][] = ['label' => 'User Regioes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-regioes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
