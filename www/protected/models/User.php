<?php

class User extends CActiveRecord
{

    public function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return array(
            array('name, password, email,', 'required'),
            array('created_at', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => true,
                'on' => 'insert'),
            array('name, password, email', 'length', 'max' => 255),
            array('name, email', 'safe', 'on' => 'search'),
            array('name, email', 'filter', 'filter' => array(new CHtmlPurifier(), 'purify')),
        );
    }

    public function relations()
    {
        return array(
            'contacts' => array(self::HAS_MANY, 'Contact', 'user_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'password' => 'Change Password',
            'email' => 'Email',
            'created_at' => 'Created At',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->email, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
