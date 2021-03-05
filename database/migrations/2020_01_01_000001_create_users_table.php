<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique()->comment('Correo de recuperación de datos de acceso');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token', 60)->unique()->nullable();
            $table->string('session_id')->nullable();
            $table->morphs('userable','ndx');
            $table->boolean('active')->default(true);
            $table->dateTime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();

            $table->rememberToken();
            $table->timestamps();

            $table->char('correo_manual_enviado', 1)->default('N');
            $table->char('correo_automatico_enviado', 1)->default('N');
            $table->char('cuenta_validada', 1)->default('N');
            $table->char('correo_institucional_validado', 1)->default('0');

            $table->index('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
