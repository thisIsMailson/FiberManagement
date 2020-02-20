<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Encomendas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Encomendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="encomendas-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tpEncomenda.designacao',
            'n_encomenda',
            'data_encomenda',
            'estadoEncomenda.designacao',
            'observacao:ntext',
            'data_ot',
            'ot',
            'pedidosIdPedido.cod_pedido',
            'usersIdUser.name',
        ],
    ]) ?>

</div>
