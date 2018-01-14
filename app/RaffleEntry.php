<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;


class RaffleEntry extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "raffle_entries";


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uid = Uuid::generate()->string;
        });
    }
}
