<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";
    protected $fillable = ['name', 'category_id', 'created_at', 'updated_at'];

    protected $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function scopeSpecific($query, $classId){
        return $query ->where('category_id', $classId)-> select([
            'id','name', 'category_id'
        ]);
    }
    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function columns() {
        return $this->belongsToMany('App\Models\Column', 'columns_students', 'student_id', 'column_id', 'id', 'id')->withPivot('student_degree');
    }

}
