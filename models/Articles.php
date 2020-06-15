<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $header
 * @property string $article
 * @property string $keywords
 * @property string $image
 * @property string $date
 * @property string $id_category
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['header', 'article', 'keywords'], 'required'],
            [['header', 'article', 'keywords'], 'string'],
            [['date'], 'safe'],
            ['date', 'default', 'value' => date('Y-m-d H:i:s')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header' => 'Header',
            'article' => 'Article',
            'keywords' => 'Keywords',
            'image' => 'Image',
            'date' => 'Date',
            'id_category' => 'Id Category',
        ];
    }
}
