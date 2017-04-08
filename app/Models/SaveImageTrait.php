<?php

namespace App\Models;

trait SaveImageTrait
{
    /**
     * @param mixed $value
     */
    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $destination_path = "brands";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk()->delete($this->image);

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk()->put("public/" . $this->imageDestination .'/'.$filename, $image->stream());
            // 3. Save the path to the database
            $this->attributes[$attribute_name] = 'storage/' . $this->imageDestination.'/'.$filename;
        }
    }
}