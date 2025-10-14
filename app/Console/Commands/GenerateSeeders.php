<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GenerateSeeders extends Command
{
    protected $signature = 'generate:seeders';
    protected $description = 'Generate seeders for all tables in the database';

    public function handle()
    {
        // Get all tables in public schema (Postgres)
        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema='public' AND table_type='BASE TABLE';");

        foreach ($tables as $tableObj) {
            $table = $tableObj->table_name;

            // Fetch all rows from the table
            $rows = DB::table($table)->get();

            if ($rows->isEmpty()) {
                $this->info("Skipping empty table: {$table}");
                continue;
            }

            $seederClass = Str::studly($table) . 'Seeder';
            $seederPath = database_path("seeders/{$seederClass}.php");

            $content = "<?php\n\nuse Illuminate\Database\Seeder;\nuse Illuminate\Support\Facades\DB;\n\n";
            $content .= "class {$seederClass} extends Seeder\n{\n    public function run()\n    {\n";

            foreach ($rows as $row) {
                $rowArray = json_encode((array) $row, JSON_UNESCAPED_UNICODE);
                $content .= "        DB::table('{$table}')->insert({$rowArray});\n";
            }

            $content .= "    }\n}";

            File::put($seederPath, $content);
            $this->info("Seeder generated: {$seederClass}");
        }

        $this->info('All seeders generated successfully!');
    }
}
