<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorAndHasPapersToListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            if (!Schema::hasColumn('listings', 'color')) {
                $table->string('color', 100)->nullable()->after('gender');
            }
            if (!Schema::hasColumn('listings', 'has_papers')) {
                $table->boolean('has_papers')->default(false)->after('health_certificate');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            if (Schema::hasColumn('listings', 'color')) {
                $table->dropColumn('color');
            }
            if (Schema::hasColumn('listings', 'has_papers')) {
                $table->dropColumn('has_papers');
            }
        });
    }
}
