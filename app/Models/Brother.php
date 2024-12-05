<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Brother extends Model
{
    // 指定模型关联的表名，如果不指定则默认为模型名的复数形式
    protected $table = 'brother';
    // 指定主键，如果不指定则默认为主键为 'id'
    protected $primaryKey = 'id';
    // 指定主键是否递增，如果为 false 则主键为非递增（例如 UUID）
    public $incrementing = true;
    // 指定是否自动维护时间戳（created_at 和 updated_at 字段）
    public $timestamps = true;
}
