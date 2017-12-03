<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
   protected $fillable = ['name',
'mobile',
'address',];

/**
 * Worker has many Productions.
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function productions()
{
	// hasMany(RelatedModel, foreignKeyOnRelatedModel = worker_id, localKey = id)
	return $this->hasMany(Production::class);
}
}
