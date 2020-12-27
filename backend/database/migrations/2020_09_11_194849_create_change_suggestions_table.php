<?php

use App\TranslationChannel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'change_suggestions',
            function (Blueprint $table)
            {
                $table->id();
                $table->string('channel_id');
                $table->enum('tier', TranslationChannel::$possibleTiers)->nullable();
                $table->boolean('good_editor')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('change_suggestions');
    }
}
