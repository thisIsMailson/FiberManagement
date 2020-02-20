<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EncUtilizadores */

//$this->title = 'Alterar Utilizador';
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];

?>
<div class="cor-user-update">

<!--    <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_formUpdatephoto', [
        'model' => $model,
    ]) ?>

</div>