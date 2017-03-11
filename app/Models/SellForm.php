<?php

namespace App\Models;

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
    protected $dateFormat = 'Y-m-d H:i:sP';

}
