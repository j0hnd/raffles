<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;
use DB;


class RaffleEntry extends Model
{
    use SoftDeletes;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "raffle_entries";

    protected $guard = ['raffle_id', 'raffle_entry_id', 'action_id'];

    protected $fillable = ['email', 'code'];

    protected $dates = ['deleted_at', 'created_at', 'modified_at'];


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uid = Uuid::generate()->string;
        });
    }

    public static function get_raffle_entries($raffle_id, $entries_per_page)
    {
        try {

            $entries = self::select(DB::Raw('raffle_entries.raffle_entry_id, raffle_entries.email, raffle_entries.code, raffle_entries.created_at, actions.name AS action_name'))
                        ->join('raffles', 'raffles.raffle_id', '=', 'raffle_entries.raffle_id')
                        ->join('actions', 'actions.action_id', '=', 'raffle_entries.action_id')
                        ->where([
                            'raffle_entries.raffle_id' => $raffle_id,
                            'raffle_entries.is_active' => 1,
                            'raffle_entries.deleted_at' => null
                        ])
                        ->orderBy('raffle_entries.created_at', 'desc')
                        ->paginate($entries_per_page);

        } catch (\Exception $e) {
            throw $e;
        }

    }
}
