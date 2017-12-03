<?php

namespace App;

use App\Product;
use App\Worker;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
     /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
 protected $fillable = [
'worker_name',
'worker_id',
'product_name',
'product_id',
'rate',
'quantity',
'total',
'paid',
'balance',
    ];



    /**
     * Production belongs to Worker.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worker()
    {
    	// belongsTo(RelatedModel, foreignKey = worker_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Worker::class);
    }


    /**
     * Production belongs to Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
    	// belongsTo(RelatedModel, foreignKey = Product_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Product::class);
    }
}
