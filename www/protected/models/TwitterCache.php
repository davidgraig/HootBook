<?php

class TwitterCache extends CActiveRecord
{

    const NEVER_UPDATED = -1;
    const INVALID_HANDLE = -2;

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
            array('handle, followers, last_update', 'filter', 'filter' => array(new CHtmlPurifier(), 'purify')),
        );
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function refreshCache()
    {

        $cacheItems = $this->findAll(array('order' => 'last_update', 'limit' => TwitterOAuth::LIMIT));
        $cacheArray = array();
        foreach ($cacheItems as $item)
        {
            $handle = strtolower($item->handle);
            $cacheArray[$handle] = $item;
        }
        $userString = implode(',', array_keys($cacheArray));

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

            $twitterUsers = $twitter->post('users/lookup', array(
                'screen_name' => $userString,
                'include_entities' => false,
            ));

            foreach ($twitterUsers as $twitterUser)
            {
                $handle = strtolower($twitterUser->screen_name);
                $hootBookTwitterCacheItem = $cacheArray[$handle];
                $hootBookTwitterCacheItem->followers = $twitterUser->followers_count;
                $hootBookTwitterCacheItem->image = $twitterUser->profile_image_url;
                $hootBookTwitterCacheItem->last_update = time();
                $hootBookTwitterCacheItem->save();
                unset($cacheArray[$handle]);
            }

            foreach ($cacheArray as $nonExistingTwitterHandle)
            {
                $nonExistingTwitterHandle->followers = TwitterCache::INVALID_HANDLE;
                $nonExistingTwitterHandle->save();
            }

        }
        catch (TwitterException $ex)
        {
            // set a timeout to check before bothering to refresh the cache
            $foo = bar;
        }

    }

}
