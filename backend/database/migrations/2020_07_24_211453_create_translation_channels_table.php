<?php

use App\TranslationChannel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'translation_channels',
            function (Blueprint $table)
            {
                $table->id();
                $table->string('channel_id')->unique();
                $table->string('name')->nullable();
                $table->string('profile_image_url')->nullable();
                $table->string('profile_image_width')->nullable();
                $table->string('profile_image_height')->nullable();
                $table->date('channel_created_at')->nullable();
                $table->bigInteger('subscribers_count')->nullable();
                $table->enum('tier', TranslationChannel::$possibleTiers)->nullable();
                $table->boolean('good_editor')->nullable();
                $table->string('main_focus_manual')->nullable();
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
        Schema::dropIfExists('translation_channels');
    }
}
