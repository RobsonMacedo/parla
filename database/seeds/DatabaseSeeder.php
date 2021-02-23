<?php

use App\Models\Edition as EditionModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EditionModel::factory()->create();
    }
}
