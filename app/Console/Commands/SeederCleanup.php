<?php
namespace App\Console\Commands;


use Database\Seeders\NewsSeeder;
use Illuminate\Console\Command;

class SeederCleanup extends Command
{
    protected $signature = 'seeder:cleanup';
    protected $description = 'Clean up database changes made by the ExampleSeeder';

    public function handle()
    {
        $seeder = new NewsSeeder();
        $seeder->down();

        $this->info('Seeders cleaned up successfully!');
    }
}
