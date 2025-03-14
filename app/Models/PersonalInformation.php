<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class PersonalInformation extends Model
{
    use HasFactory;
=======

class PersonalInformation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function contactInformation()
    {
        return $this->hasOne(ContactInformation::class, 'personal_information_id');
    }

    public function education()
    {
        return $this->hasMany(Education::class, 'personal_information_id');
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class, 'personal_information_id');
    }

    public function interests()
    {
        return $this->hasMany(Interests::class, 'personal_information_id');
    }

    public function languages()
    {
        return $this->hasMany(Languages::class, 'personal_information_id');
    }

    public function projects()
    {
        return $this->hasMany(Projects::class, 'personal_information_id');
    }

    public function skills()
    {
        return $this->hasMany(Skills::class, 'personal_information_id');
    }
>>>>>>> test2025
}
