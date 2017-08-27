<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ModelExtended
 *
 * @mixin \Eloquent
 */
class ModelExtended extends Model
{
    /**
     * Преобразует многоязычные поля в строку.
     *
     * @return array
     */
    public function toArray()
    {
        $ans = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $attribute) {
            if (array_key_exists($attribute, $ans)) {
                $ans[$attribute] = $this->$attribute;
            }
        }

        return $ans;
    }
}