<?php

namespace App;

use App\Production;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
      /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
   protected $fillable = ['name',
'description',];

/**
 * WorkItem has many Productions.
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function productions()
{
	// hasMany(RelatedModel, foreignKeyOnRelatedModel = workItem_id, localKey = id)
	return $this->hasMany(Production::class);
}
}
