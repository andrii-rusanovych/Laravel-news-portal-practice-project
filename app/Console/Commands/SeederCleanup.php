<?php
namespace App\Console\Commands;


use App\Contracts\ReversibleSeeder;
use Database\Seeders\NewsSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Console\Command;
use PHPUnit\Util\Exception;

class SeederCleanup extends Command
{
    protected $signature = 'seeder:cleanup';
    protected $description = 'Clean up database changes made by the ExampleSeeder';

    public function handle()
    {
        $seeders = [
            new NewsSeeder(),
            new UserSeeder()
        ];

        foreach ($seeders as $seeder) {
            if($seeder instanceof ReversibleSeeder) {
                $seeder->down();
            } else {
                throw new Exception('Seeder '.$seeder.get_class().' not implement ReversibleSeeder interface, cannot call down() method');
            }
        }



        $this->info('Seeders cleaned up successfully!');
    }
}
