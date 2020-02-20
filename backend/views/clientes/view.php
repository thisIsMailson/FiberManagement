<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Clientes */

$this->title = $model->id_cliente;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clientes-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cod_cliente',
            'nome_cliente',
            'tipoCliente.descricao',
            'contato',
        ],
    ]) ?>

</div>
