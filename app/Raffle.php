<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;
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

    protected $guard = ['raffle_id'];

    protected $fillable = ['name', 'slug', 'description', 'start_date', 'end_date'];

    protected $dates = ['start_date', 'end_date', 'deleted_at', 'created_at', 'modified_at'];



    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->raffle_id = Uuid::generate()->string;
        });
    }

    public static function get_raffles($raffle_per_page)
    {
        $raffles = null;
        $results = null;

        try {

            $object = self::where([ 'is_active' => 1, 'deleted_at' => null ])
                        ->orderBy('created_at', 'desc')
                        ->paginate($raffle_per_page);

            if ($object->count()) {
                foreach ($object as $i => $obj) {
                    $raffles[$i]['raffle_id']   = $obj->raffle_id;
                    $raffles[$i]['raffle_name'] = $obj->name;
                    $raffles[$i]['raffle_url']  = URL::to('/')."/".$obj->slug;
                    $raffles[$i]['description'] = $obj->description;
                    $raffles[$i]['start_date']  = is_null($obj->start_date) ? "" : date('Y-m-d H:i A', strtotime($obj->start_date));
                    $raffles[$i]['end_date']    = is_null($obj->end_date) ? "" : date('Y-m-d H:i A', strtotime($obj->end_date));
                }

                $results = ['data' => $raffles, 'object' => $object];
            }

        } catch (\Exception $e) {
            throw $e;
        }

        return $results;
    }

    public static function get_raffle_by_slug($slug)
    {
        return self::where(['slug' => $slug, 'is_active' => 1, 'deleted_at' => null])->first();
    }

    public static function is_raffle_id_valid($raffle_id)
    {
        return self::where(['raffle_id' => $raffle_id, 'is_active' => 1, 'deleted_at' => null])->count() ? true : false;
    }

    public static function is_raffle_valid($raffle_name)
    {
        return self::where(['slug' => $raffle_name, 'is_active' => 1, 'deleted_at' => null])->count() ?  : false;
    }
}
