<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Description of ImportBulletinsAction
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class ImportBulletinsAction extends CAction
{
	public function run()
	{
        $oldBulletins = unserialize(file_get_contents('bulletins.dat'));
        foreach ($oldBulletins as $oldBulletin)
        {
            $bulletin['name'] = Translite::cp1251_to_utf8($oldBulletin['name']);

            $user = User::model()->find('username=:username',
                array(':username'=>Translite::rusencode($oldBulletin['username'])));
            if (!$user)
                continue;
            $bulletin['user_id'] = $user->id;
            $categoryName = Translite::cp1251_to_utf8(substr($oldBulletin['rubka'], 0, strpos($oldBulletin['rubka'], '[ktname]')));
            $category = Category::model()->find('name=:name',
                array(':name'=>$categoryName));
            if (!$category)
                continue;
            $bulletin['category_id'] = $category->id;
            $bulletin['type'] = Translite::cp1251_to_utf8($oldBulletin['type']) == 'П' ? Bulletin::TYPE_OFFER : Bulletin::TYPE_DEMAND;
            $bulletin['views'] = $oldBulletin['views'];
            $bulletin['text'] = Translite::cp1251_to_utf8($oldBulletin['text']);
            $bulletin['created_at'] = $oldBulletin['created_at'];
            $bulletin['youtube_id'] = $oldBulletin['youtube_id'];

            $model=new Bulletin;

            if(isset($bulletin))
            {
                $model->attributes=$bulletin;
                $model->disableBehavior('CTimestampBehavior');
                if ($model->save() && $oldBulletin['foto'])
                {
                    $tempName = Yii::getPathOfAlias('webroot').'/datafoto/'.$oldBulletin['foto'];
                    if (file_exists($tempName))
                    {
                        $file = new CUploadedFile(
                                $oldBulletin['foto'],
                                $tempName,
                                filetype($tempName),
                                filesize($tempName),
                                0
                            );
                        ImagesHelper::processImages($model, array($file));
                    }
                }
            }
        }
	}

}

?>
