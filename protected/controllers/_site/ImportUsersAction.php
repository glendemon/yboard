<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Description of ImportUsersAction
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class ImportUsersAction extends CAction
{
    /**
     * Import users from old board.
     */
	public function run()
	{
        $oldUsers = unserialize(file_get_contents('users.dat'));

        foreach ($oldUsers as $olduser)
        {
            $userArray['username'] = Translite::rusencode($olduser['username']);
            $userArray['password'] = $olduser['password'];
            $userArray['email'] = $olduser['email'];
            $userArray['superuser'] = 0;
            $userArray['status'] = !empty($olduser['status']) && $olduser['status'] == 'activated' ? User::STATUS_ACTIVE : User::STATUS_NOACTIVE;

            $profileArray['first_name'] = '';
            $profileArray['last_name'] = '';
            $profileArray['city'] = Translite::cp1251_to_utf8($olduser['city']);
            $profileArray['url'] = Translite::cp1251_to_utf8($olduser['url']);
            $profileArray['phone'] = Translite::cp1251_to_utf8($olduser['phone']);
            $profileArray['icq'] = Translite::cp1251_to_utf8($olduser['icq']);
            $profileArray['company'] = Translite::cp1251_to_utf8($olduser['company']);
            $profileArray['about'] = Translite::cp1251_to_utf8($olduser['about']);

            $model=new User;
            $profile=new Profile;

			$model->attributes=$userArray;
			$model->activkey=UserModule::encrypting(microtime().$model->password);
			$profile->attributes=$profileArray;
			$profile->user_id=0;
			if($model->validate()&&$profile->validate()) {
				$model->password=UserModue::encrypting($model->password);
				if($model->save()) {
					$profile->user_id=$model->id;
					$profile->save();
				}
			} else $profile->validate();

        }
	}

}

?>
