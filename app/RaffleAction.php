<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaffleAction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "actions";


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->action_id = Uuid::generate()->string;
        });
    }
}
