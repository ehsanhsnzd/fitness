<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('photo')->nullable();
            $table->json('description')->nullable();
            $table->dropForeign('categories_plan_id_foreign');
            $table->dropColumn('plan_id');
        });

        Schema::create('category_plan', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('plan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_plan');

        Schema::table('categories',function (Blueprint $table){
            $table->dropColumn('photo');
            $table->dropColumn('description');
        });
    }
}
