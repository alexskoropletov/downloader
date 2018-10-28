<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    // statuses
    const ERROR = -1;
    const PENDING = 0;
    const PROCESSING = 1;
    const READY = 2;

    const STATUSES = [
        self::ERROR => 'Error',
        self::PENDING => 'Pending',
        self::PROCESSING => 'Processing',
        self::READY => 'Ready',
    ];

    /**
     * @return bool
     */
    public function isReady() {
        return $this->status === self::READY;
    }

    /**
     * @return mixed
     */
    public function getStatusName() {
        return self::STATUSES[$this->status];
    }
}
