<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RaffleWinner extends Model
{
    use SoftDeletes;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "raffle_winners";

    protected $guard = ['raffle_id', 'entry_repo_id'];

    protected $fillable = ['order'];

    protected $dates = ['deleted_at', 'created_at', 'modified_at'];
}
