<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable()->after('slug');
            $table->string('brand')->nullable()->after('category');
            $table->string('sku')->nullable()->unique()->after('brand');
            $table->string('unit')->nullable()->after('price');
            $table->decimal('weight', 8, 2)->nullable()->after('unit');
            $table->text('ingredients')->nullable()->after('description');
            $table->date('expiry_date')->nullable()->after('ingredients');
            $table->boolean('is_supplement')->default(false)->after('published');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'category', 'brand', 'sku', 'unit', 'weight', 'ingredients', 'expiry_date', 'is_supplement'
            ]);
        });
    }
};
