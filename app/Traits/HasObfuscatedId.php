<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

trait HasObfuscatedId
{
    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return Hashids::connection(static::class)->encode($this->getKey()) ?: $this->getKey();
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        if ($field && $field !== $this->getRouteKeyName()) {
            return parent::resolveRouteBinding($value, $field);
        }

        $decoded = Hashids::connection(static::class)->decode($value);

        if (empty($decoded)) {
            return null;
        }

        return $this->where($this->getRouteKeyName(), $decoded[0])->first();
    }
}
