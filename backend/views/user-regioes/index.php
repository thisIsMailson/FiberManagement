<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserRegioesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Regioes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-regioes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Regioes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_user_regioes',
            'user_id_user',
            'regiao_id_regiao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
