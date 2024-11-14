<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $collection = 'addresses';

    protected $fillable = [
        'student_id',
        'address',
        'city',
        'state',
        'postal_code'
    ];

    /**
     * Define an inverse one-to-one relationship with Student.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
