<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntryRepos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_repos', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('raffle_entry_id');
            $table->uuid('entry_repo_id');
            $table->enum('source', ['web', 'facebook', 'twitter', 'instagram']);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['raffle_entry_id', 'source']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entry_repos');
    }
}
