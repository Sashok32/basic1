<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * EntryForm is the model behind the entry form.
 */
class EntryForm extends Model
{
    public $name;
    public $email;
    public $imgFile;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['imgFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            ['email', 'email']
        ];
    }
}
