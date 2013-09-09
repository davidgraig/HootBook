<?php

class ContactTest extends CDbTestCase
{
    public $fixtures = array(
        'contacts' => 'Contact',
        'twitter_cache' => 'TwitterCache'
    );

    public function testGetTwitterImage()
    {
        $contact = Contact::model()->findByPk(1);
        $twitterImage = $contact->getTwitterImage();
        $fixtureData = $this->twitter_cache['twitterCache1']['image'];
        $this->assertTrue($twitterImage === $fixtureData);
    }

    public function testGetFullName()
    {
        $contact = Contact::model()->findByPk(1);
        $fullName = $contact->getFullName();
        $fixtureData = $this->contacts['contact1']['first_name'] . ' ' . $this->contacts['contact1']['last_name'];
        $this->assertTrue($fullName === $fixtureData);
    }

}