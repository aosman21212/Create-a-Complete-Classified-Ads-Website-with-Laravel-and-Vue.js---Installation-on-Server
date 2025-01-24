<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'subcategory_id'];

    // Define relationship with Subcategory
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}