<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\AuthAssignment;
/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Gestão de Utilizador';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
function getProfiles($model){
    $auth = new AuthAssignment();
    $result = "";
    foreach ($auth->getProfilesByUser($model->id) as $value) {
       $result .= Html::a($value->item_name, $value->itemName->description).'<br/>';
    }
    return $result;
}
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        'username',
                        'email:email',
                        ['attribute' => 'status',
                        'value' => function($model){
                            return $model->status == 10 ? 'Ativo' : 'Inativo';
                        }],
                        'created_at',
                        'updated_at',
                        [
                            'attribute' => 'role_id',
                            'value' => 'role.nome',
                        ],
                        
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>