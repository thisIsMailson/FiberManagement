<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\user */

$this->title = 'Adicionar Utilizador';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
	
    <?= $this->render('_form', [
        'model' => $model,
        'region'=>$region,
        'userRegiao'=>$userRegiao,
        'value'=>$value,

    ]) ?>

</div>
