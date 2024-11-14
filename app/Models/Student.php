<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $collection = 'students';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'roll_no',
        'age',
        'gender'
    ];

    /**
     * Define a one-to-one relationship with Address.
     */
    public function address()
    {
        return $this->hasOne(Address::class, 'student_id');
    }
}
