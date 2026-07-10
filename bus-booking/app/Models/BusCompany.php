<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'logo',
        'address',
        'licence_number',
        'owner_name',
        'owner_mobile',
        'owner_email',
        'bank_name',
        'account_holder_name',
        'account_number',
        'branch',
        'commission_type',
        'commission_amount',
        'status',
    ];
}
