<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'school', 'year', 'term', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function categories() {
        return $this->hasMany('App\Models\Category', 'user_id');
    }

    public function getTerm(){
        return  $this -> term  == 1 ?  'الأول'   : 'الثاني' ;
    }

    public function  getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/images/userPhotos/' . $val) : "";
    }









}
