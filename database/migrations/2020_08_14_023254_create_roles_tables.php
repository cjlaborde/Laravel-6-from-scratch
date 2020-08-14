<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            // name of the role
            $table->string('name');
            // there situations where name of the role is different to label 
            // what you want to display to user
            // If you don't include label we Capitalize the name and be ready to go.
            $table->string('label')->nullable();
            $table->timestamps();
        });
        // roles includes certain abilities so lets do that as well
        Schema::create('abilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); // edit_form
            $table->string('label')->nullable(); // Edit the Form
            $table->timestamps();
        });
        // We have many to many relationship here so we need a table to store the connection between a role and an ability
        // The naming convention that laravel uses for  many to many tables is singular in alphabetic order
        Schema::create('ability_role', function (Blueprint $table) {
             // combination of role_id and ability_id and they most be unique
            // otherwise you can do a typical primary key and set role_id and ability_id to unique
            $table->primary(['role_id', 'ability_id']);
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('ability_id');
            $table->timestamps();

            // if you delete a role, it will cascade and delete all record containing that role
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->foreign('ability_id')
                ->references('id')
                ->on('abilities')
                ->onDelete('cascade');
        });

        // We need table to store user_id and the role_id associated with them to store all toles user has
        Schema::create('role_user', function (Blueprint $table) {
            $table->primary(['user_id', 'role_id']);

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            // if you delete a role, it will cascade and delete all record containing that role
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('roles', function (Blueprint $table) {
        //     //
        // });
    }
}
