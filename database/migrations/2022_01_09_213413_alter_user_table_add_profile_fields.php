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
           $table->string('username', 20)->after('remember_token');
           $table->string('image')->nullable()->default(null)->after('username');
           $table->text('description')->nullable()->default(null)->after('username');
           $table->enum('country', CountryEnum::getValues())
               ->nullable()->default(null)->after('username');
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
            $table->dropColumn(['username', 'image', 'description', 'country']);
            $table->string('name');
        });
    }
}
