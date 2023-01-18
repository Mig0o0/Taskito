<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class);

            $table->foreignIdFor(Task::class);

            $table->integer("value");

            $table->enum("reason", ["hint", "time_extension", "task_migration", "other"])->default("hint");

            $table->text("description")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_histories');
    }
}
