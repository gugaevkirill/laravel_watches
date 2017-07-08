<?php

namespace App\Models;

use \Illuminate\Http\UploadedFile;

trait ImageTrait
{
    protected $imgFormat = '.jpg';

    /**
     * URL картинки для браузера
     * @param int $image
     * @return string
     */
    public function getImageUrl($image): string
    {
        return $this->imageUrlPrefix . $image . $this->imgFormat;
    }

    public function getFirstImageUrl(): string
    {
        if (!$this->imagesnew) {
            return '';
        }

        return $this->getImageUrl($this->imagesnew[0]);
    }

    /**
     * Реальный url картинки
     * @param int $image
     * @return string
     */
    private function getImageDestination($image): string
    {
        return $this->imageDestination . $image . $this->imgFormat;
    }

    /**
     * HTML для админки для поля с одной картинкой
     * @return string
     */
    public function getAdminImageHtml(): string
    {
        return $this->imagenew
            ? "<img src='{$this->getImageUrl($this->imagenew)}' style='max-width: 70px; max-height: 50px;'>"
            : "";
    }

    /**
     * HTML для админки для поля с массивом картинок
     * @return string
     */
    public function getAdminImagesHtml(): string
    {
        $ret = '';
        if (empty($this->imagesnew)) {
            return $ret;
        }

        foreach ($this->imagesnew as $image) {
            $ret .= "<img src='{$this->getImageUrl($image)}' style='max-width: 40px; max-height: 40px; margin: 0 4px 4px 0;'>";
        }

        return $ret;
    }

    /**
     * Сохранение одной картинки
     * @param mixed $value
     */
    public function setImagenewAttribute($value)
    {
        // if the image was erased
        if ($value == null) {
            \Storage::disk()->delete($this->getImageDestination($this->imagenew));
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

    /**
     * @param mixed $value
     */
    public function setImagesnewAttribute($value)
    {
        if ($value == null) {
            foreach ($this->imagesnew as $image) {
                \Storage::disk()->delete($this->getImageDestination($image));
            }
            $this->attributes[$this->imagesFieldName] = '[]';
        } else {
            $request = \Request::instance();
            $attribute_value = (array) $this->{$this->imagesFieldName};
            $files_to_clear = $request->get('clear_' . $this->imagesFieldName);

            // if a file has been marked for removal,
            // delete it from the disk and from the db
            if ($files_to_clear) {
                foreach ($files_to_clear as $key => $filename) {
                    \Storage::disk()->delete($this->getImageDestination($filename));
                    $attribute_value = array_where($attribute_value, function ($value, $key) use ($filename) {
                        return $value != $filename;
                    });
                }

                // Для нормального удаления картинок
                $attribute_value = array_values($attribute_value);
            }

            // if a new file is uploaded, store it on disk and its filename in the database
            if ($request->hasFile($this->imagesFieldName)) {
                foreach ($request->file($this->imagesFieldName) as $file) {
                    if ($file->isValid()) {
                        $filename = crc32($file->getClientOriginalName() . microtime());
                        $image = \Image::make($file);
                        \Storage::disk()->put($this->getImageDestination($filename), $image->stream());
                        $attribute_value[] = $filename;
                    }
                }
            }

            $this->attributes[$this->imagesFieldName] = json_encode($attribute_value);
        }
    }
}