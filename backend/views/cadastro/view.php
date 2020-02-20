<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Cadastros */

$this->title = $model->id_cadastro;
$this->params['breadcrumbs'][] = ['label' => 'Cadastros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cadastros-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'referencia_ot',
            'LACETE',
            'ADSL',
            'VOIP',
            'IPTV',
            'OLT_NOME',
            'OLT_PON_ONUID',
            'BSP_PON_Painel_Porto',
            'BSP_modulo',
            'BSP_modulo_splitter',
            'BSP_modulo_porto',
            'BSP_Porto_In',
            'BSP_Porto_Out',
            'ODF_modulo',
            'ODF_porto',
            'PRIMARIO_modulo',
            'PRIMARIO_porto',
            'SPLITTERS_modulo',
            'SPLITTERS_splitter',
            'SPLITTERS_Porto_In',
            'SPLITTERS_Porto_Out',
            'SECUNDARIO_modulo',
            'SECUNDARIO_PDO',
            'SECUNDARIO_par',
            'PDOs_pdo',
            'PDOs_par',
        ],
    ]) ?>

</div>
