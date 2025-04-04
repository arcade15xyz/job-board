<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferedJob extends Model
{
    /** @use HasFactory<\Database\Factories\OfferedJobFactory> */
    use HasFactory;

    public static array $experience = [
        'entry',
        'intermediate',
        'senior'
    ];

    public static array $category = [
        'IT',
        'Finance',
        'Sales',
        'Marketing'
    ];
}
