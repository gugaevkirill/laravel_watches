<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Spark\User as SparkUser;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string|null $photo_url
 * @property bool $uses_two_factor_auth
 * @property string $authy_id
 * @property string $country_code
 * @property string $phone
 * @property string $two_factor_reset_code
 * @property int $current_team_id
 * @property string $stripe_id
 * @property string $current_billing_plan
 * @property string $card_brand
 * @property string $card_last_four
 * @property string $card_country
 * @property string $billing_address
 * @property string $billing_address_line_2
 * @property string $billing_city
 * @property string $billing_state
 * @property string $billing_zip
 * @property string $billing_country
 * @property string $vat_id
 * @property string $extra_billing_information
 * @property \Carbon\Carbon $trial_ends_at
 * @property string $last_read_announcements_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\LocalInvoice[] $localInvoices
 * @property-read \Illuminate\Database\Eloquent\Collection|\Backpack\PermissionManager\app\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Backpack\PermissionManager\app\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\Subscription[] $subscriptions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\Token[] $tokens
 * @method static \Illuminate\Database\Query\Builder|\App\User role($roles)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAuthyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBillingAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBillingAddressLine2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBillingCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBillingCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBillingState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBillingZip($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCardBrand($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCardCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCardLastFour($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCountryCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCurrentBillingPlan($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereExtraBillingInformation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastReadAnnouncementsAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePhotoUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereStripeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTwoFactorResetCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUsesTwoFactorAuth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereVatId($value)
 * @mixin \Eloquent
 */
class User extends SparkUser
{
    use CrudTrait;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'authy_id',
        'country_code',
        'phone',
        'card_brand',
        'card_last_four',
        'card_country',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_zip',
        'billing_country',
        'extra_billing_information',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
        'uses_two_factor_auth' => 'boolean',
    ];

    public function setPasswordAttribute($value)
    {
        if ($value != '') {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
