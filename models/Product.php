<?php

namespace sielavic\product\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $book
 * @property string $title
 * @property string|null $text
 * @property string $url
 * @property int $status_id
 * @property int $sort
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }





/**  стоимость одного дня залога - 10 рублей **/

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book', 'title', 'url'], 'required'],
            
            [['status_id', 'sort', 'text', 'url'], 'integer', 'max' => 150],
            [['book', 'title'], 'string', 'max' => 150],
           
            [['status_id'], 'integer', 'min' => 3],
            ['text', 'trim'],
];
        
    }

public function validateArenda($attr)
    {
        if (!in_array($this->$attr, ['world'])) {
            $this->addError($attr, 'имя не совпадает.');
        }
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
    
        return [
            'id' => 'ID',
            'book' => 'книга',
            'title' => 'арендатор',
            'text' => 'количество',
            'url' => 'срок аренды',
            'status_id' => 'сумма залога',
            'sort' => 'Sort',
        ];
    }
}
