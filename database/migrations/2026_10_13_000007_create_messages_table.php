<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('conversations')->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            
            $table->enum('type', ['text', 'image', 'offer'])->default('text');
            $table->text('body')->nullable();
            $table->string('attachment_path')->nullable();
            
            $table->decimal('offer_amount', 12, 2)->nullable();
            $table->enum('offer_status', ['pending', 'accepted', 'rejected'])->nullable();
            
            // Anti-Scam Fields
            $table->boolean('has_warning')->default(false);
            $table->string('warning_text')->nullable();
            
            $table->boolean('is_read')->default(false)->index();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['conversation_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
