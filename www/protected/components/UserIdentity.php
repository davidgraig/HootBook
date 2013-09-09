<?php

class UserIdentity extends CUserIdentity
{
    private $_id;

    public function getId() { return $this->_id; }

	public function authenticate()
	{
        $record = User::model()->findByAttributes(array('email' => $this->username));
        if ($record === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if (!CPasswordHelper::verifyPassword($this->password, $record->password))
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->_id = $record->id;
            $this->setState('name', $record->name);
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;

	}
}