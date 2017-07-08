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
        return $this->imageUrlPrefix . $image . ".png";
    }

    /**
     * Реальный url картинки
     * @param int $image
     * @return string
     */
    private function getImageDestination($image): string
    {
        return $this->imageDestination . $image . ".png";
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
            \Storage::disk()->delete($this->getImageDestination($this->image));
            $this->attributes[$this->imageFieldName] = null;
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
            $image = \Image::make($value);
            \Storage::disk()->put($this->getImageDestination($filename), $image->stream());
            $this->attributes[$this->imageFieldName] = $filename;
        } else {
            $this->attributes[$this->imageFieldName] = $value;
        }
    }
}