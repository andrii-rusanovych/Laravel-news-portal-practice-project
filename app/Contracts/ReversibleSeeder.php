<?php
namespace App\Contracts;

interface ReversibleSeeder {
    /**
     * Revert seeder 'run' method
     *
     * @return mixed
     */
    public function down();
}
