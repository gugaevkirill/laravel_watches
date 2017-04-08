<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContactForm
 *
 * @property int $id
 * @property string $name
 * @property string $contact
 * @property string $message
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ContactForm whereContact($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ContactForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ContactForm whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ContactForm whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ContactForm whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ContactForm whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContactForm extends Model
{
    use CrudTrait;

    const FIELDS = [
        'name' => 'required|max:255|min:2',
        'contact' => 'required|max:255|min:7',
        'message' => 'required',
    ];

    protected $dateFormat = 'Y-m-d H:i:sP';

    protected $fillable = ['name', 'message', 'contact'];

    public function __construct(array $attributes = [])
    {
        $this->fillable = array_keys(self::FIELDS);
        parent::__construct($attributes);
    }
}
