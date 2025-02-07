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
    Schema::table('sessions', function (Blueprint $table) {
        // Check if user_agent column exists, if not, add it
        if (!Schema::hasColumn('sessions', 'user_agent')) {
            $table->string('user_agent')->nullable();
        }
        // Now add the ip_address column
        $table->string('ip_address', 45)->nullable()->after('user_agent');
    });
}

public function down()
{
    Schema::table('sessions', function (Blueprint $table) {
        $table->dropColumn('ip_address');
        $table->dropColumn('user_agent');  // Optional, if you want to drop it too
    });
}
};
