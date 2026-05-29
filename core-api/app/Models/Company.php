<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// know that eloquent handles table automatically
// and will assume that the Company Model is based on the
// companies table if not, you could manualy do it by doing the following
// #[Table('companies')]
class Company extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    public function users(){
        // this tells laravel that one company owns multiple
        // employee account
        return $this->hasMany(User::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }

}

?>