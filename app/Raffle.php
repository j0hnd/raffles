<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use DB;


class Raffle extends AppModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "raffles";

    protected $fillable = ['raffle_id', 'name', 'raffle_url', 'start_date', 'end_date'];

    protected $dates = ['created_at', 'modified_at'];



    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->raffle_id = Uuid::generate()->string;
        });
    }

    public static function get_raffles()
    {
        $raffles = null;

        try {

            $object = self::where([ 'is_active' => 1, 'deleted_at' => null ]);

            if ($object->count()) {
                $raffles = $object->get();
            }

        } catch (\Exception $e) {
            throw $e;
        }

        return $raffles;
    }
}
