<?php

class TwitterCache extends CActiveRecord
{
    public function tableName()
    {
        return 'twitter_cache';
    }

    public function rules()
    {
        return array(
            array('handle, followers, last_update', 'required'),
            array('followers', 'numerical', 'integerOnly' => true),
            array('handle, image', 'length', 'max' => 255),
        );
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function refreshCache()
    {

        $cacheItems = $this->findAll(array('order' => 'last_update', 'limit' => TwitterOAuth::LIMIT));
        foreach ($cacheItems as $item)
        {
            try
            {
                $settings = array(
                    'oauth_token' => TwitterOAuth::TOKEN,
                    'oauth_token_secret' => TwitterOAuth::TOKEN_SECRET,
                    'consumer_key' => TwitterOAuth::CONSUMER,
                    'consumer_secret' => TwitterOAuth::CONSUMER_SECRET,
                    'output_format' => 'object'
                );

                $twitter = new TwitterOAuth($settings);

                $response = $twitter->get('users/show', array(
                    'screen_name' => $item->handle,
                    'include_entities' => false,
                ));

                $item->followers = $response->followers_count;
                $item->image = $response->profile_image_url;
                $item->last_update = time();
                $item->save();

            }
            catch (TwitterException $ex)
            {
                // set a timeout to check before bothering to refresh the cache
                break;
            }
        }
    }

}
