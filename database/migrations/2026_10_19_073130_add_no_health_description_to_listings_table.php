<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoHealthDescriptionToListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // USER PROMPT: "if some seller is selling a fish in most cases there is no health record  for fish vacination and dewormig so when user upload health description there must be option that no health desciption if user click on this there should be no description for health status of fish"
        Schema::table('listings', function (Blueprint $table) {
            $table->boolean('no_health_description')->default(false)->after('health_certificate');
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
            $table->dropColumn('no_health_description');
        });
    }
}
