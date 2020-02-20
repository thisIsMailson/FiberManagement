<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "parametrizacao".
 *
 * @property int $id
 * @property string $designacao
 * @property string $categoria
 * @property int $estado
 */
class Parametrizacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parametrizacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['designacao', 'categoria', 'estado'], 'required'],
            [['estado'], 'integer'],
            [['designacao', 'categoria'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'designacao' => 'Designacao',
            'categoria' => 'Categoria',
            'estado' => 'Estado',
        ];
    }
}
