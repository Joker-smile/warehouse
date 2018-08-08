<?php

namespace App;

use App\Department;
use App\Record;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{

    protected $table = 'materials';

    protected $fillable = [
        'name', //物料名称
        'remark', //备注
        'supplier', //供货商
        'unit', //单位
        'type', //类型
        'price', //价格
    ];

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function department()
    {
        return $this->belongsToMany(Department::class, 'department_materials')
            ->withTimestamps()
            ->withPivot('quantity');
    }

    public function getTotalQuantityAttribute()
    {
        return $this->department()->sum("quantity");
    }

}
