<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function item()
    {

        return $this->hasMany(item::class);
    }
}
