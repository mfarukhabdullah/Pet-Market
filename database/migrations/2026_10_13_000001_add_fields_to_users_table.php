<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->unique()->after('email');
            $table->timestamp('phone_verified_at')->nullable()->after('phone');
            $table->string('avatar')->nullable()->after('phone_verified_at');
            $table->enum('role', ['buyer', 'seller', 'admin'])->default('buyer')->after('avatar');
            $table->enum('seller_type', ['individual', 'breeder', 'business'])->default('individual')->after('role');
            $table->string('city')->nullable()->after('seller_type');
            $table->text('address')->nullable()->after('city');
            $table->text('bio')->nullable()->after('address');
            $table->unsignedTinyInteger('trust_score')->default(20)->after('bio');
            $table->boolean('is_verified')->default(false)->after('trust_score');
            $table->string('badge_type')->nullable()->after('is_verified');
            $table->boolean('is_banned')->default(false)->after('badge_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'phone_verified_at',
                'avatar',
                'role',
                'seller_type',
                'city',
                'address',
                'bio',
                'trust_score',
                'is_verified',
                'badge_type',
                'is_banned',
            ]);
        });
    }
}
