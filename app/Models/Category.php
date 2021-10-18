<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = "categories";
    protected $fillable = ['name', 'subject', 'user_id', 'created_at', 'updated_at'];

    protected $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function students(){
        return $this->hasMany('App\Models\Student', 'category_id');
    }
    public function columns(){
        return $this->hasMany('App\Models\Column', 'category_id');
    }
    public function scopeSpecific($query){
        return $query ->where('user_id', auth()->id())-> select([
            'id','name','subject', 'user_id'
        ])  ;
    }


}
