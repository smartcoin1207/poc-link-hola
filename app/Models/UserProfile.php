<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_implemented_type',
        'coporate_type',
        'corporate_number',
        'corporate_name',
        'representative_title',
        'representative_name',
        'main_phone_number',
        'postal_code',
        'prefecture',
        'city_town',
        'address_beyond_city_town',
        'other_credit_history',
        'corporate_account_registration_date',
        'department_name',
        'personal_title',
        'personal_name',
        'contact_phone_number',
        'email_address',
        'project_history',
    ];
}
