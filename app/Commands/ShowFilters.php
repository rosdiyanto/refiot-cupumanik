<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class ShowFilters extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'filters:list';
    protected $description = 'Menampilkan daftar semua filter yang terdaftar di aplikasi.';

    public function run(array $params)
    {
        $config = config('Filters');

        CLI::write('=== DAFTAR FILTERS ===', 'green');
        CLI::newLine();

        // Aliases
        CLI::write('>> Aliases:', 'yellow');
        foreach ($config->aliases as $name => $class) {
            CLI::write("  - {$name} : {$class}");
        }

        CLI::newLine();
        // Global filters
        CLI::write('>> Global (before):', 'yellow');
        foreach ($config->globals['before'] ?? [] as $before) {
            CLI::write("  - {$before}");
        }

        CLI::newLine();
        CLI::write('>> Global (after):', 'yellow');
        foreach ($config->globals['after'] ?? [] as $after) {
            CLI::write("  - {$after}");
        }

        CLI::newLine();
        // Route filters
        CLI::write('>> Route filters:', 'yellow');
        foreach ($config->filters as $filter => $settings) {
            CLI::write("  - {$filter}");
            if (!empty($settings['before'])) {
                CLI::write("    before: " . implode(', ', $settings['before']));
            }
            if (!empty($settings['after'])) {
                CLI::write("    after: " . implode(', ', $settings['after']));
            }
        }

        CLI::newLine();
        CLI::write('✅ Selesai menampilkan daftar filters.', 'green');
    }
}
