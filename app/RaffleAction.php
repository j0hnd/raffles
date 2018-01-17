<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;


class RaffleAction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "actions";

    protected $guard = ['action_id'];

    protected $fillable = ['raffle_entry_id', 'name', 'value'];

    protected $dates = ['created_at', 'modified_at'];


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->action_id = Uuid::generate()->string;
        });
    }

    public static function save_entry($form)
    {
        return self::create($form);
    }
}
