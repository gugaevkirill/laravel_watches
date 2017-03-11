<?php

namespace App;

use Laravel\Spark\Team as SparkTeam;

/**
 * App\Team
 *
 * @property int $id
 * @property int $owner_id
 * @property string $name
 * @property string $slug
 * @property string|null $photo_url
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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read string $email
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\Invitation[] $invitations
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\LocalInvoice[] $localInvoices
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\TeamSubscription[] $subscriptions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereBillingAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereBillingAddressLine2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereBillingCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereBillingCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereBillingState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereBillingZip($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereCardBrand($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereCardCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereCardLastFour($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereCurrentBillingPlan($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereExtraBillingInformation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team wherePhotoUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereStripeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereVatId($value)
 * @mixin \Eloquent
 */
class Team extends SparkTeam
{
    //
}
