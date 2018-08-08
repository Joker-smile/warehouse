<?php

namespace App;

use App\Department;
use App\Material;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'records';

    protected $fillable = [
        'user_id', //操作者id
        'department_id', //部门id
        'material_id', //物料id
        'type', //类型, in 入库, out 出库, used消耗, loss损耗
        'before', //更改之前的库存
        'after', //更改之后的库存
        'adjust_reason', //调整原因
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeNameAttribute()
    {
        switch ($this->type) {
            case 'in':
                return '入库';
            case 'out':
                return '出库';
            case 'used':
                return '消耗';
            case 'loss':
                return '损耗';
            case 'adjust':
                return '调整';

        }

    }
}
