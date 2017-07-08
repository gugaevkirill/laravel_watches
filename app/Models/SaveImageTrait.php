<?php

namespace App\Models;

trait SaveImageTrait
{
    /**
     * @param mixed $value
     */
    public function setImagenewAttribute($value)
    {
        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk()->delete($this->image);

            // set null in the database column
            $this->attributes[static::IMAGE_FIELD_NAME] = '';
        }
        // if a base64 was sent, store it in the db
        elseif (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk()->put("public/" . $this->imageDestination .'/'.$filename, $image->stream());
            // 3. Save the path to the database
            $this->attributes[static::IMAGE_FIELD_NAME] = 'storage/' . $this->imageDestination . '/' . $filename;
        } else {
            $this->attributes[static::IMAGE_FIELD_NAME] = $value ?? '';
        }
    }
}