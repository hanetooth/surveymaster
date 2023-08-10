<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Seed default components, ( input text, input date picker, input number )
     */
    public function run(): void
    {
        Component::insert([
                [
                    'name' => 'input_text',
                    'content' =>
                        '<input type="text" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" %s/>',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'input_date_picker',
                    'content' =>
                        '<input type="date" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" %s/>',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'input_number',
                    'content' =>
                        '<input type="number" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" %s/>',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
        ]);
    }
}
