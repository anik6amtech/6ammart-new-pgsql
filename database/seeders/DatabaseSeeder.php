<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Run all seeders in a directory.
     *
     * @return void
     */
    public function run()
    {
        // Directory containing all seeders (adjust if needed)
        $seedersDirectory = database_path('seeders');

        // Get all PHP files in the directory
        $files = File::allFiles($seedersDirectory);

        foreach ($files as $file) {
            $fileName = $file->getFilenameWithoutExtension();

            // Skip this master seeder itself to avoid infinite loop
            if ($fileName === 'DatabaseSeeder') {
                continue;
            }

            // Check if the class exists and then run it
            $class = "Database\\Seeders\\$fileName";
            if (class_exists($class)) {
                $this->call($class);
            }
        }
    }
}
