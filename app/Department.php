<?php

namespace App;

use App\Material;
use App\Record;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'user_id',
        'name', //部门名称
        'type', //部门名称,warehouse:总仓库,workshop:车间
    ];

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'department_materials')
                    ->withTimestamps()
                    ->withPivot('quantity');
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
