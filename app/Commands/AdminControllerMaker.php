<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class AdminControllerMaker extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'ctl:admin';
    protected $description = 'Generate a controller inside the Admin module with default index() method.';
    protected $usage       = 'php spark ctl:admin <ControllerName>';

    public function run(array $params)
    {
        if (count($params) < 1) {
            CLI::error("Usage: php spark ctl:admin <ControllerName>");
            return;
        }

        $controller = ucfirst($params[0]);
        $module = 'Admin';
        $path = APPPATH . "Modules/{$module}/Controllers/{$controller}.php";

        // Buat folder jika belum ada
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        // Jika file sudah ada
        if (file_exists($path)) {
            CLI::error("Controller already exists: {$path}");
            return;
        }

        // Template controller dengan default index()
        $content = <<<PHP
        <?php

        namespace App\\Modules\\{$module}\\Controllers;

        use App\\Controllers\\BaseController;

        class {$controller} extends BaseController
        {
            public function index()
            {
                \$data = [
                    'title' => 'Admin Dashboard',
                    'content' => 'dashboard'
                ];

                return module_view('main_view', '{$module}', \$data);
            }
        }

        PHP;

        file_put_contents($path, $content);
        CLI::write("✅ Controller created: {$path}", 'green');
    }
}
