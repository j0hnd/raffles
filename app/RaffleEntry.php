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

    protected $fillable = ['raffle_id', 'email', 'code'];

    protected $dates = ['deleted_at', 'created_at', 'modified_at'];


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->raffle_entry_id = Uuid::generate()->string;
        });
    }

    public static function get_raffle_entries($raffle_id, $entries_per_page)
    {
        $data = null;

        try {

            $entries = self::select(DB::Raw('raffle_entries.raffle_entry_id, raffle_entries.email, raffle_entries.code, raffle_entries.created_at, actions.name AS action_name'))
                        ->join('raffles', 'raffles.raffle_id', '=', 'raffle_entries.raffle_id')
                        ->leftjoin('actions', 'actions.action_id', '=', 'raffle_entries.action_id')
                        ->where([
                            'raffle_entries.raffle_id' => $raffle_id,
                            'raffle_entries.is_active' => 1,
                            'raffle_entries.deleted_at' => null
                        ])
                        ->orderBy('raffle_entries.created_at', 'desc')
                        ->paginate($entries_per_page);

            if ($entries->count()) {
                $data = $entries;
            }

        } catch (\Exception $e) {
            throw $e;
        }

        return $data;
    }

    public static function get_raffle_entry($id)
    {
        $object = self::where('id', $id);
        return $object->count() ? $object->first() : null;
    }

    public static function create_entry($form)
    {
        return self::create($form);
    }

    public static function check_reaffle_entry($raffle_id, $email_address)
    {
        $found = self::where(['raffle_id' => $raffle_id, 'email' => $email_address, 'is_active' => 1, 'deleted_at' => null]);

        return $found->count() ? false : true;
    }
}
