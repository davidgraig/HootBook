<?php

/**
 * This is the model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $phone
 * @property string $twitter
 * @property integer $favorite
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Contact extends CActiveRecord
{

    const NO_IMAGE_URL = '/images/no-twitter-image.png';

    public function getTwitterImage()
    {
        $record = TwitterCache::model()->findByAttributes(array('handle' => $this->twitter));
        return $record->image == null ? Contact::NO_IMAGE_URL : $record->image;
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFollowers()
    {
        $record = TwitterCache::model()->findByAttributes(array('handle' => $this->twitter));
        return $record == null || $record->followers == -1 ?  -1 : $record->followers;
    }

    public function tableName()
    {
        return 'contact';
    }

    public function rules()
    {
        return array(
            array('user_id, first_name, last_name, phone, twitter', 'required'),
            array('user_id, favorite', 'numerical', 'integerOnly' => true),
            array('first_name, last_name, twitter', 'length', 'max' => 255),
            array('first_name, last_name, phone, twitter', 'filter', 'filter' => array(new CHtmlPurifier(), 'purify')),
            array('first_name, last_name, phone, twitter', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'full_name' => 'Name',
            'phone' => 'Phone',
            'twitter' => 'Twitter',
            'favorite' => 'Favorite',
            'created_at' => 'Created At',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('phone', $this->phone);
        $criteria->compare('twitter', $this->twitter, true);
        $criteria->compare('favorite', $this->favorite);
        $criteria->compare('created_at', $this->created_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Contact the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
