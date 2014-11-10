<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Description of ImagesHelper
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class ImagesHelper
{
    /**
     * Process uploaded images.
     * Save to gallery.
     * @param Bulletin $model
     * @param CUploadedFile[] $images
     */
    public static function processImages($model, $images)
    {
        if (isset($images) && count($images) > 0)
        {
            // configure and save gallery model
            $gallery = new Gallery();
            $gallery->name = false;
            $gallery->description = false;
            $gallery->versions = array(
                'small' => array(
                    'resize' => array(150, null),
                ),
                'medium' => array(
                    'resize' => array(800, null),
                )
            );
            $gallery->save();

            $model->gallery_id = $gallery->id;
            $model->save();

            // go through each uploaded image
            foreach ($images as $imageFile)
            {
                $galleryPhoto = new GalleryPhoto();
                $galleryPhoto->gallery_id = $gallery->id;
                $galleryPhoto->name = '';
                $galleryPhoto->description = '';
                $galleryPhoto->file_name = $imageFile->getName();
                $galleryPhoto->save();

                $galleryPhoto->setImage($imageFile->getTempName());
            }
        }
    }

    /**
     * Save advertisement's banners to file.
     * Important!: don't save model.
     * @param Advertisement $model
     * @param CUploadedFile $banner
     */
    public static function processAdvertisement($model, $banner)
    {
        if (!empty($banner))
        {
            //delete old file
            if ($model->banner && file_exists($model->bannersDir . $model->banner))
                unlink($model->bannersDir . $model->banner);
            if (is_array($banner))
                $banner = current($banner);
            $model->banner = $banner;
            Yii::app()->image->load($model->banner->getTempName())
                ->save($model->bannersDir . $model->banner);
        }
    }

}

?>
