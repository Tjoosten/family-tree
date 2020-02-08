<?php

namespace App\Models\Presenters;

/**
 * Trait UserPresenter
 *
 * @package App\Models\Presenters
 */
trait UserPresenter
{
    public function getNameAttribute(): string
    {
        return ucwords("{$this->firstname} {$this->lastname}");
    }
}
