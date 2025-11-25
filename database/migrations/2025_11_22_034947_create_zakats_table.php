<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zakats', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->decimal('income', 15, 2)->default(0)->comment('Penghasilan kerja/bisnis');
            $table->decimal('gold_weight', 10, 2)->default(0)->comment('Berat emas (gram)');
            $table->decimal('silver_weight', 10, 2)->default(0)->comment('Berat perak (gram)');
            $table->decimal('cash', 15, 2)->default(0)->comment('Uang tunai/tabungan');
            $table->decimal('animals', 15, 2)->default(0)->comment('Nilai hewan ternak');
            $table->decimal('trade_goods', 15, 2)->default(0)->comment('Nilai barang dagangan');
            $table->decimal('savings', 15, 2)->default(0)->comment('Tabungan di bank');
            $table->decimal('total_asset', 15, 2)->default(0)->comment('Total harta');
            $table->decimal('nisab', 15, 2)->default(0)->comment('Nilai nisab');
            $table->decimal('zakat_amount', 15, 2)->default(0)->comment('Jumlah zakat (2.5%)');
            $table->string('zakat_type')->nullable()->comment('Tipe zakat: income/wealth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zakats');
    }
};
