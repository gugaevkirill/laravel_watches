<?php

namespace App\Models;

use \Illuminate\Http\UploadedFile;

trait ImageTrait
{
    /**
     * URL картинки для браузера
     * @param int $image
     * @return string
     */
    public function getImageUrl($image): string
    {
        return $this->imageUrlPrefix . $image . ".jpg";
    }

    /**
     * Реальный url картинки
     * @param int $image
     * @return string
     */
    private function getImageDestination($image): string
    {
        return $this->imageDestination . $image . ".jpg";
    }

    /**
     * @return string
     */
    public function getAdminImageHtml(): string
    {
        return $this->imagenew
            ? "<img src='{$this->getImageUrl($this->imagenew)}' style='max-width: 70px; max-height: 50px;'>"
            : "";
    }

    /**
     * Сохранение одной картинки
     * @param mixed $value
     */
    public function setImagenewAttribute($value)
    {
        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk()->delete($this->getImageDestination($this->image));

            // set null in the database column
            $this->attributes[$this->imageFieldName] = '';
        }
        // if a base64 was sent, store it in the db
        elseif (starts_with($value, 'data:image'))
        {
            $image = \Image::make($value);
            $filename = crc32($value . time());
            \Storage::disk()->put($this->getImageDestination($filename), $image->stream());
            $this->attributes[$this->imageFieldName] = $filename;
        } elseif ($value instanceof UploadedFile) {
            $filename = crc32(microtime());
            \Storage::putFileAs(
                $this->imageDestination,
                $value,
                $filename . ".jpg"
            );
            $this->attributes[$this->imageFieldName] = $filename;
        } else {
            $this->attributes[$this->imageFieldName] = $value ?? null;
        }
    }
}