<?php

use Domain\Mail\Models\Sequence;
use Domain\Mail\Models\SequenceMailSchedule;
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
        Schema::create('sequence_mails', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sequence::class);
            $table->foreignIdFor(SequenceMailSchedule::class);
            $table->string('subject');
            $table->string('status');
            $table->text('content');
            $table->json('filters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sequence_mails');
    }
};
