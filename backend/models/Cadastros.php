<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cadastros".
 *
 * @property int $id_cadastro
 * @property string $referencia_ot
 * @property string $LACETE
 * @property string $ADSL
 * @property string $VOIP
 * @property string $IPTV
 * @property string $OLT_NOME
 * @property string $OLT_PON_ONUID
 * @property string $BSP_PON_Painel_Porto
 * @property string $BSP_modulo
 * @property string $BSP_modulo_splitter
 * @property string $BSP_modulo_porto
 * @property string $BSP_Porto_In
 * @property string $BSP_Porto_Out
 * @property string $ODF_modulo
 * @property string $ODF_porto
 * @property string $PRIMARIO_modulo
 * @property string $PRIMARIO_porto
 * @property string $SPLITTERS_modulo
 * @property string $SPLITTERS_splitter
 * @property string $SPLITTERS_Porto_In
 * @property string $SPLITTERS_Porto_Out
 * @property string $SECUNDARIO_modulo
 * @property string $SECUNDARIO_PDO
 * @property string $SECUNDARIO_par
 * @property string $PDOs_pdo
 * @property string $PDOs_par
 */
class Cadastros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cadastros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['referencia_ot', 'LACETE', 'ADSL', 'VOIP', 'IPTV', 'OLT_NOME', 'OLT_PON_ONUID', 'BSP_PON_Painel_Porto', 'BSP_modulo', 'BSP_modulo_splitter', 'BSP_modulo_porto', 'BSP_Porto_In', 'BSP_Porto_Out', 'ODF_modulo', 'ODF_porto', 'PRIMARIO_modulo', 'PRIMARIO_porto', 'SPLITTERS_modulo', 'SPLITTERS_splitter', 'SPLITTERS_Porto_In', 'SPLITTERS_Porto_Out', 'SECUNDARIO_modulo', 'SECUNDARIO_PDO', 'SECUNDARIO_par', 'PDOs_pdo', 'PDOs_par'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cadastro' => 'Id Cadastro',
            'referencia_ot' => 'Referencia Ot',
            'LACETE' => 'Lacete',
            'ADSL' => 'Adsl',
            'VOIP' => 'VoIp',
            'IPTV' => 'Iptv',
            'OLT_NOME' => 'Nome Olt',
            'OLT_PON_ONUID' => 'Pon Onuid',
            'BSP_PON_Painel_Porto' => 'Pon Painel Porto',
            'BSP_modulo' => 'Módulo',
            'BSP_modulo_splitter' => 'Módulo Splitter',
            'BSP_modulo_porto' => 'Módulo Porto',
            'BSP_Porto_In' => 'Porto In',
            'BSP_Porto_Out' => 'Porto Out',
            'ODF_modulo' => 'Módulo',
            'ODF_porto' => 'Porto',
            'PRIMARIO_modulo' => 'Módulo Primário ',
            'PRIMARIO_porto' => 'Porto Primário ',
            'SPLITTERS_modulo' => 'Módulo Splitters ',
            'SPLITTERS_splitter' => 'Splitter',
            'SPLITTERS_Porto_In' => 'Splitters Porto In',
            'SPLITTERS_Porto_Out' => 'Splitters Porto Out',
            'SECUNDARIO_modulo' => 'Módulo Secundário ',
            'SECUNDARIO_PDO' => 'Secundário Pdo',
            'SECUNDARIO_par' => 'Secundário Par',
            'PDOs_pdo' => 'PDOs Pdo',
            'PDOs_par' => 'PDOs Par',
        ];
    }
}
