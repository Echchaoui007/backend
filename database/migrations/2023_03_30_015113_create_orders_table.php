<?php

use App\Models\Menu;
use App\Models\Student;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->constrained('students')->cascadeOnDelete();
            $table->foreignIdFor(Menu::class)->constrained('menus')->cascadeOnDelete();
            $table->enum('order_status', ['Pending', 'Completed', 'Hidden']);
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['menu_id']);
        });

        Schema::dropIfExists('orders');
    }
};
