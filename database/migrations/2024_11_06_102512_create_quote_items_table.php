<?php

use App\Models\Auth\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quote_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quote_id');
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('makaris_type')->nullable();
            $table->integer('amount')->default(1);
            $table->string('description')->nullable();
            $table->string('product_number')->nullable();
            $table->integer('makaris_id')->nullable();
            $table->float('selling_price')->default(0);
            $table->string('image_url')->nullable();
            $table->boolean('is_required')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_items');
    }
};
