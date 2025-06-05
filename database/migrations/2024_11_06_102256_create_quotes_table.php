<?php

use App\Models\Auth\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('company')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('street')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('remarks')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->integer('makaris_quote_id')->nullable();
            $table->integer('makaris_quote_number')->nullable();
            $table->integer('makaris_quote_version_id')->nullable();
            $table->integer('makaris_quote_version_number')->nullable();
            $table->integer('view_counter')->default(0);
            $table->dateTime('email_confirmed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
