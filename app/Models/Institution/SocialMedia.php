<?php

namespace App\Models\Institution;

use App\Models\Model;

class SocialMedia extends Model
{
    public $timestamps = false;

    const SERVICES = [
        'vk', 'instagram', 'facebook', 'twitter'
    ];
}
