<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->after('content')->nullable();
            $table->foreign('type_id') //foreignKey
                  ->references('id') //colonna che vogliamo utilizzare come foreignKey
                  ->on('types') //tabella da cui vogliamo prendere la foreignKey
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            /*
                OPPURE
            */
            //$table->foreignId('category_id')
            //        ->after('content')
            //        ->nullable()
            //        ->constrained()
            //        ->onDelete('set null')
            //        ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'type_id')) {
                
                $table->dropForeign(['type_id']);

                // OPPURE
                // $table->dropForeign('posts_category_id_foreign');

                $table->dropColumn('type_id');
            }
        });
    }
};
