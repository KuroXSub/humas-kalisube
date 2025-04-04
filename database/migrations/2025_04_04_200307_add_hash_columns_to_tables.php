<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('user_hash')->nullable()->after('user_id');
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->string('user_hash')->nullable()->after('user_id');
        });

        Schema::table('suggestions', function (Blueprint $table) {
            $table->string('user_hash')->nullable()->after('user_id');
        });

        \App\Models\Complaint::with('user')->each(function ($complaint) {
            $complaint->update([
                'user_hash' => Hash::make($complaint->user_id . config('app.key'))
            ]);
        });

        // Update data yang sudah ada
        \App\Models\Feedback::with('user')->each(function ($feedback) {
            $feedback->update([
                'user_hash' => Hash::make($feedback->user_id . config('app.key'))
            ]);
        });

        \App\Models\Suggestion::with('user')->each(function ($suggestion) {
            $suggestion->update([
                'user_hash' => Hash::make($suggestion->user_id . config('app.key'))
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('user_hash');
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->dropColumn('user_hash');
        });

        Schema::table('suggestions', function (Blueprint $table) {
            $table->dropColumn('user_hash');
        });
    }
};
