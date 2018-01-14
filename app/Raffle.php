<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;
use DB;


class Raffle extends AppModel
{
    use SoftDeletes;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "raffles";

    protected $fillable = ['raffle_id', 'name', 'raffle_url', 'start_date', 'end_date'];

    protected $dates = ['start_date', 'end_date', 'deleted_at', 'created_at', 'modified_at'];



    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->raffle_id = Uuid::generate()->string;
        });
    }

    public static function get_raffles($item_per_page = 1)
    {
        $raffles = null;
        $results = null;

        try {

            $object = self::where([ 'is_active' => 1, 'deleted_at' => null ])
                        ->orderBy('created_at', 'desc')
                        ->paginate($item_per_page);

            if ($object->count()) {
                foreach ($object as $i => $obj) {
                    $raffles[$i]['raffle_id']   = $obj->raffle_id;
                    $raffles[$i]['raffle_name'] = $obj->name;
                    $raffles[$i]['raffle_url']  = $obj->raffle_url;
                    $raffles[$i]['start_date']  = $obj->start_date;
                    $raffles[$i]['end_date']    = $obj->end_date;
                }

                $results = ['data' => $raffles, 'object' => $object];
            }

        } catch (\Exception $e) {
            throw $e;
        }

        return $results;
    }
}
