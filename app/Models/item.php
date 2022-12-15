<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class item extends Model
{
    use HasFactory;

    //protected $fillable = ['nama', 'harga', 'kuantitas', 'gambar', 'kategori'];
    protected $guarded = ['id'];

    public function Kategori()
    {
        // $kategoris = Kategori::all();
        // return view('items', compact('kategoris'));
        return $this->belongsTo(Kategori::class);
    }

    
}
