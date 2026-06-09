<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('event_registrations')
            ->where('status', 'pending')
            ->update(['status' => 'verified']);
    }

    public function down(): void
    {
        // tidak mengembalikan status pending
    }
};
