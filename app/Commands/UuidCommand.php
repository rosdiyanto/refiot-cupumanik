<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Ramsey\Uuid\Uuid;

class UuidCommand extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'uuid';
    protected $description = 'Generate UUID v4 (universally unique identifier).';

    public function run(array $params)
    {
        $uuid = Uuid::uuid4()->toString();
        CLI::write('Generated UUIDv4: ' . CLI::color($uuid, 'green'));
    }
}
