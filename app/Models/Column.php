<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $table = "columns";
    protected $fillable = ['name', 'type', 'slug', 'column_degree', 'parent_id_sum', 'parent_id_avg', 'description', 'category_id', 'created_at', 'updated_at'];

    protected $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function students() {
        return $this->belongsToMany('App\Models\Student', 'columns_students', 'column_id', 'student_id', 'id', 'id')->withPivot('student_degree');
    }

    public function scopeSpecific($query, $classId){
        return $query ->where('category_id', $classId)-> select([
            'id','name', 'type', 'slug', 'column_degree','parent_id_sum', 'parent_id_avg','description', 'category_id'
        ]);
    }
    public function getType() {
        if ($this->type == 1){return 'حقل رقم';}
        if ($this->type == 2){return 'متوسط';}
        if ($this->type == 3){return 'مجموع';}
    }
    public function scopeTypeNum($query, $classId) {
        return $query ->where('type', 1)->where('category_id', $classId)-> select([
            'id','name', 'type', 'slug', 'column_degree','parent_id_sum', 'parent_id_avg', 'description', 'category_id'
        ]);
    }

//
//    public function scopeParent($query){
//        return $query -> whereNull('parent_id');
//    }
//    public function scopeChild($query){
//        return $query -> whereNotNull('parent_id');
//    }

    public function parent_sum(){
        return $this->belongsTo(self::class, 'parent_id_sum');
    }

    public function childrens_sum(){
        return $this -> hasMany(self::class,'parent_id_sum');
    }
    public function parent_avg(){
        return $this->belongsTo(self::class, 'parent_id_avg');
    }

    public function childrens_avg(){
        return $this -> hasMany(self::class,'parent_id_avg');
    }










}
