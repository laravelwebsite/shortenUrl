<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortcutUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shortcut_urls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shortcut_url');
            $table->string('redirect');
            $table->int('iduser_create');
            $table->string('purpose');
            $table->int('count_click');
            $table->string('email_user');
            $table->string('category');
            $table->int('job_id');
            $table->int('source');
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
        Schema::dropIfExists('shortcut_urls');
    }
}
