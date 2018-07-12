<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('lead')->nullable();
            $table->string('photo')->nullable();
            $table->mediumText('content')->nullable();
            $table->boolean('is_published')->default(0);
            $table->boolean('is_seo_publised')->default(0);
        });        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
