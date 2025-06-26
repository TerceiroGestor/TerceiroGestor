<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 *
 * @property $id
 * @property $name
 * @property $uf
 * @property $country_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Country $country
 * @property City[] $cities
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class State extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id', 'name', 'uf', 'country_id'];
    public $incrementing = false;
    protected $keyType = 'int';
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(\App\Models\City::class, 'id', 'state_id');
    }
}
