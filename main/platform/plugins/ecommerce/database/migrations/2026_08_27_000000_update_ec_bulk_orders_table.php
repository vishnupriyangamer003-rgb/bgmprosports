<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ec_bulk_orders', function (Blueprint $table): void {
            $table->string('delivery_location', 191)->nullable()->change();
            $table->string('attachment')->nullable()->after('message');
        });
    }

    public function down(): void
    {
        Schema::table('ec_bulk_orders', function (Blueprint $table): void {
            $table->dropColumn('attachment');
            $table->string('delivery_location', 191)->nullable(false)->change();
        });
    }
};
