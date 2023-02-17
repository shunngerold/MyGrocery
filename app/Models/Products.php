<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = ['product_name','description','category','price','stock','date_in_wh','date_created','date_expiry','active'];

    protected function scopeFilter($query) {
        if (request('category') ?? false) {
            $query->where('category','like','%'.request('category').'%');
        }

        if (request('search') ?? false) {
            $query
            ->orWhere('category','like','%'.request('search').'%')
            ->orWhere('product_name','like','%'.request('search').'%')
            ->orWhere('description','like','%'.request('search').'%')
            ->orWhere('price','like','%'.request('search').'%');
        }
    }
}
