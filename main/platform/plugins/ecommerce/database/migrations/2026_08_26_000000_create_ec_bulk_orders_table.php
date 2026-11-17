<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('ec_bulk_orders', function (Blueprint $table): void {
            $table->id();
            $table->string('code', 60)->unique();
            $table->string('full_name', 120);
            $table->string('company_name', 191);
            $table->string('phone', 60);
            $table->string('email', 120)->nullable();
            $table->string('customer_type', 60);
            $table->json('products')->nullable();
            $table->longText('message')->nullable();
            $table->string('delivery_location', 191);
            $table->text('address');
            $table->string('city', 120);
            $table->string('state', 120);
            $table->string('pincode', 20);
            $table->string('gstin', 30)->nullable();
            $table->longText('admin_note')->nullable();
            $table->string('status', 60)->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ec_bulk_orders');
    }
};
