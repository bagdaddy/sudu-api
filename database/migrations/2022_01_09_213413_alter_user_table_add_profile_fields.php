<?php

use App\Enums\CountryEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserTableAddProfileFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
           $table->string('nickname', 20);
           $table->string('image')->nullable()->default(null)->before('created_at');
           $table->text('description')->nullable()->default(null)->before('created_at');
           $table->enum('country', CountryEnum::getValues())
               ->nullable()->default(null)->before('created_at');
           $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn(['nickname', 'image', 'description', 'country']);
            $table->string('name');
        });
    }
}
