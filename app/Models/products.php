<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ProductRating;

class products extends Model
{
    use HasFactory;
    // Product.php model
    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }
}
