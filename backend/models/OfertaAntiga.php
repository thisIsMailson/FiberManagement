<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "oferta_antiga".
 *
 * @property int $id
 * @property string $oferta
 */
class OfertaAntiga extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'oferta_antiga';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oferta'], 'required'],
            [['oferta'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'oferta' => 'Oferta',
        ];
    }
}
