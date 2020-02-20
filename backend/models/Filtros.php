<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "filtros".
 *
 * @property int $id_filtro
 * @property string $nome
 */
class Filtros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'filtros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_filtro' => 'Id Filtro',
            'nome' => 'Nome',
        ];
    }
}
