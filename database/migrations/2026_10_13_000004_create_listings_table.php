<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('breed_id')->nullable()->constrained('breeds')->onDelete('set null');
            $table->string('breed_name')->nullable();
            
            $table->string('title');
            $table->string('slug')->index();
            $table->longText('description')->nullable();
            
            $table->decimal('price', 12, 2)->default(0);
            $table->boolean('is_negotiable')->default(false);
            
            $table->unsignedSmallInteger('age_months')->nullable();
            $table->enum('gender', ['male', 'female', 'pair', 'unknown'])->default('unknown');
            $table->boolean('vaccinated')->default(false);
            $table->boolean('dewormed')->default(false);
            $table->boolean('health_certificate')->default(false);
            
            $table->string('city')->default('Lahore')->index();
            $table->string('area')->nullable();
            $table->boolean('phone_hidden')->default(false);
            
            $table->enum('status', ['draft', 'pending', 'live', 'rejected', 'sold'])->default('draft')->index();
            $table->text('rejection_reason')->nullable();
            
            $table->boolean('is_featured')->default(false)->index();
            $table->unsignedBigInteger('views_count')->default(0);
            
            $table->timestamps();
            $table->softDeletes();

            // Composite Indexes for Ultra-fast Search Performance
            $table->index(['status', 'city', 'category_id', 'price']);
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
}
