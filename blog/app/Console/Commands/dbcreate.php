<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class dbcreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schemaName = $this->argument('name') ?: config('database.connections.mysql.database');

        $charset = config('database.connections.mysql.charset', 'ut8mb4');

        $collation = config('database.connection.mysql.collation', 'utf8mb4_general_ci');

        config(['database.connections.mysql.database' => null]);

        $query = "DROP DATABASE $schemaName;";
        DB::statement($query);

        $query = "CREATE DATABASE IF NOT EXISTS $schemaName CHARACTER SET $charset COLLATE $collation;";
        DB::statement($query);

        echo "Database $schemaName has been created :D";
        config(['database.connections.mysql.database' => $schemaName]);


    }
}
