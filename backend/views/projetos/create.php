<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Projetos */

$this->title = 'Create Projetos';
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projetos-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
