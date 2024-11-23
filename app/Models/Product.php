<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'product_category_id',
        'supplier_id',
        'min_stock',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'deleted_at',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class)
            ->using(ProductSale::class)
            ->withPivot('quantity', 'sale_price', 'total', 'discount', "subtotal")
            ->withTimestamps();
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class)
            ->using(ProductPurchase::class)
            ->withPivot('quantity', 'purchase_price')
            ->withTimestamps();
    }
}
