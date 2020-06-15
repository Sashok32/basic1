<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * EntryForm is the model behind the entry form.
 */
class Country extends ActiveRecord
{
    public static function tableName()
    {
        return 'countries';
    }
}
