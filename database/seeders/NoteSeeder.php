<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newNote = new Note();
        $newNote->customer_name = 'Christian';
        $newNote->slug = Str::slug($newNote->customer_name, '-');
        $newNote->customer_lastname = 'Algieri';
        $newNote->customer_email = 'Cricco@gmail.com';
        $newNote->note = "Bellisimo itinerario";
        $newNote->save();
    }
}
