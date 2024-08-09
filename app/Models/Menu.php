<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Menu extends Model
{
    use HasFactory ,Searchable ;
    protected $fillable = [
        'name',
        'category',
        'price',
        'image',
        'component',
    ];
    public function toSearchableArray(){
        return [
                'name' => $this->name,
                'category' => $this->category,
                'component' => $this->component,
                'price' => $this->price,
        ];
    }
}
