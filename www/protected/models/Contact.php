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

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFollowers()
    {
        try
        {
            $settings = array(
                'oauth_token' => '57733326-hwjCHLY0kJju0Gq5rdy4GU3VypSkX0OFqhyRGB0',
                'oauth_token_secret' => '7ydmzP0NgO3bVKxoOSyXjcoM4dovDH4M7nXsloGI',
                'consumer_key' => 'c8O9lC8jxNzApZiE1FtYQ',
                'consumer_secret' => 'IEO7pxo9ybLaSiy2MzsxQkzHzaW79eyxA74EJLvfEw',
                'output_format' => 'object'
            );

            $twitter = new TwitterOAuth($settings);

            $response = $twitter->get('users/show', array(
                'screen_name' => $this->twitter,
                'include_entities' => false,
            ));

            $rate = $twitter->get('application/rate_limit_status', array(
                'resources' => 'users'
            ));

            return $response->followers_count;
        }
        catch (TwitterException $ex)
        {
            if ($ex->getCode() == TwitterException::TWITTER_404_ERROR_CODE)
            {
                $this->addError('twitter', 'The twitter handle does not exist.');
            }
            return 0;
        }

    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, first_name, last_name, phone, twitter', 'required'),
			array('user_id, phone, favorite', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, twitter', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, first_name, last_name, phone, twitter, favorite, created_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('twitter',$this->twitter,true);
		$criteria->compare('favorite',$this->favorite);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
