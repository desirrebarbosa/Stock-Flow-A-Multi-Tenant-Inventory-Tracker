<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['company_id', 'sku', 'name', 'min_required_stock'];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
