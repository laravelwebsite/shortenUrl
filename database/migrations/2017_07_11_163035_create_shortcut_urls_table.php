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
            $table->string('category_id');
            $table->string('purpose');
            $table->int('iduser_create');
            $table->string('email_user');
            $table->int('wait_check');
            $table->int('count_click');
            $table->int('source');
            $table->string('job_id');
            $table->string('redirect');
            $table->string('fileupload_name');
            $table->string('title');
            $table->string('region');
            $table->text('description');
            $table->string('date_begin_seeder');
            $table->int('id_user_seeder');
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
