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
        Schema::create('csregistration', function (Blueprint $table) {
            $table->increments('csrid');
            $table->unsignedInteger('csid');
            $table->string('caseCode', 15)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('registatus')->default('Going');
            $table->timestamps();

            // Define foreign key constraint for 'caseCode' column
            $table->foreign('csid') // Column in the child table
                ->references('csid') // Column in the parent table (sc_addressinfo)
                ->on('communityservice') // Parent table
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Define foreign key constraint for 'caseCode' column
            $table->foreign('caseCode') // Column in the child table
                ->references('caseCode') // Column in the parent table (sc_addressinfo)
                ->on('users') // Parent table
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csregistration');
    }
};
