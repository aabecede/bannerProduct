<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterProduk extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'master_produk';
    protected $guarded = ['id'];

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
