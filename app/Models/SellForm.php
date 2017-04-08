<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SellForm
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $phone
 * @property string $email
 * @property string $reference
 * @property int $year
 * @property bool $has_box
 * @property bool $has_documents
 * @property string $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SellForm whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SellForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SellForm whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SellForm whereHasBox($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SellForm whereHasDocuments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SellForm whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SellForm whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SellForm whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SellForm wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SellForm whereReference($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SellForm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SellForm whereYear($value)
 * @mixin \Eloquent
 */
class SellForm extends Model
{
    use CrudTrait;
    use SaveImageTrait;

    const FIELDS = [
        'name' => 'required|max:255|min:2',
        'image' => 'image|mimes:jpeg,bmp,png,jpg',
        'phone' => 'required|max:20|min:10',
        'email' => 'nullable|email',
        'reference' => 'required|max:255|min:2',
        'year' => 'nullable|integer|digits:4',
        'has_box' => 'nullable|boolean',
        'has_documents' => 'nullable|boolean',
        'amount' => 'nullable|integer',
    ];

    protected $fillable = [
        'name',
        'image',
        'phone',
        'email',
        'reference',
        'year',
        'has_box',
        'has_documents',
        'amount',
    ];
    protected $dateFormat = 'Y-m-d H:i:sP';

    // Папка куда складывать картинки
    protected $imageDestination = 'sellform';

    public function __construct(array $attributes = [])
    {
        $this->fillable = array_keys(self::FIELDS);
        parent::__construct($attributes);
    }

    /**
     * @return string
     */
    public function getAdminImageHtml(): string
    {
        return $this->image
            ? "<img src='/$this->image' style='max-width: 70px; max-height: 70px;'>"
            : "";
    }
}
