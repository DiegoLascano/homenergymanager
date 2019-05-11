<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyPVsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_p_vs', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date'); //maybe text type
            $table->decimal('1',8,4);
            $table->decimal('2',8,4);
            $table->decimal('3',8,4);
            $table->decimal('4',8,4);
            $table->decimal('5',8,4);
            $table->decimal('6',8,4);
            $table->decimal('7',8,4);
            $table->decimal('8',8,4);
            $table->decimal('9',8,4);
            $table->decimal('10',8,4);
            $table->decimal('11',8,4);
            $table->decimal('12',8,4);
            $table->decimal('13',8,4);
            $table->decimal('14',8,4);
            $table->decimal('15',8,4);
            $table->decimal('16',8,4);
            $table->decimal('17',8,4);
            $table->decimal('18',8,4);
            $table->decimal('19',8,4);
            $table->decimal('20',8,4);
            $table->decimal('21',8,4);
            $table->decimal('22',8,4);
            $table->decimal('23',8,4);
            $table->decimal('24',8,4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_p_vs');
    }
}
