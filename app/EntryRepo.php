<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;


class EntryRepo extends Model
{
    use SoftDeletes;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "entry_repos";

    protected $guard = ['raffle_entry_id', 'entry_repo_id'];

    protected $fillable = ['raffle_entry_id', 'source'];

    protected $dates = ['deleted_at', 'created_at', 'modified_at'];


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->entry_repo_id = Uuid::generate()->string;
        });
    }

    public static function save_entry($form)
    {
        return self::create($form);
    }
}
