<?php

namespace App\Models;

use \Illuminate\Http\UploadedFile;

trait ImageTrait
{
    public static $imgFormat = '.jpg';

    /**
     * URL картинки для браузера
     * @param int $image
     * @return string
     */
    public function getImageUrl($image): string
    {
        return static::$imageUrlPrefix . $image . static::$imgFormat;
    }

    /**
     * URL первой картинки из $this->imagesnew для браузера
     * @return string
     */
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
    public function getImageDestination($image): string
    {
        return static::$imageDestination . $image . static::$imgFormat;
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
     * @param $image
     * @return bool
     */
    private function isBase64($image): bool
    {
        return substr($image, 0, 10) == 'data:image';
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
            $this->attributes[static::$imageFieldName] = null;
        }
        // if a base64 was sent, store it in the db
        elseif (starts_with($value, 'data:image'))
        {
            $image = \Image::make($value);
            $filename = crc32($value . time());
            \Storage::disk()->put($this->getImageDestination($filename), $image->stream());
            $this->attributes[static::$imageFieldName] = $filename;
        } elseif ($value instanceof UploadedFile) {
            $filename = crc32(microtime());
            $image = \Image::make($value);
            \Storage::disk()->put($this->getImageDestination($filename), $image->stream());
            $this->attributes[static::$imageFieldName] = $filename;
        } else {
            $this->attributes[static::$imageFieldName] = $value;
        }
    }

    /**
     * @param $value
     * @throws \Exception
     */
    public function setImagesnewAttribute($value)
    {
        if (empty($value)) {
            // Если надо удалить все
            if ($this->imagesnew) {
                foreach ($this->imagesnew as $image) {
                    \Storage::disk()->delete($this->getImageDestination($image));
                }
            }
            $this->attributes[static::$imagesFieldName] = '[]';
        } elseif (is_array($value)) {
            $tmp = [];
            // Сохраняем новые картинки на диск
            foreach ($value as $img) {
                if ($this->isBase64($img)) {
                    $filename = crc32($img . microtime());
                    $image = \Image::make($img);
                    \Storage::disk()->put($this->getImageDestination($filename), $image->stream());
                    $tmp[] = $filename;
                } else {
                    $tmp[] = $img;
                }
            }
            $this->attributes[static::$imagesFieldName] = json_encode($tmp);

            // Стираем с диска удаленные картинки
            $request = \Request::instance();
            if ($toClean = $request->get('clean_' . static::$imagesFieldName)) {
                foreach ($toClean as $filename) {
                    \Storage::disk()->delete($this->getImageDestination($filename));
                }
            }
        } else {
            throw new \Exception('Invalid value');
        }
    }

    /**
     * @param $value
     */
    public function setCleanImagesnewAttribute($value)
    {
        // Грязный хак: атрибут clean_imagesnew не должен попадать в SQL запрос.
    }
}