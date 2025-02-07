<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Renaming the column 'uk_email' to 'email'
            $table->renameColumn('uk_email', 'email');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverting the column name change if migration is rolled back
            $table->renameColumn('email', 'uk_email');
        });
    }
};
