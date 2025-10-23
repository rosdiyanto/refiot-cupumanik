<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class UserControllerMaker extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'ctl:user';
    protected $description = 'Generate a controller inside the User module with default index() method.';
    protected $usage       = 'php spark ctl:user <ControllerName>';

    public function run(array $params)
    {
        if (count($params) < 1) {
            CLI::error("Usage: php spark ctl:user <ControllerName>");
            return;
        }

        $controller = ucfirst($params[0]);
        $module = 'User';
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
                    'title' => 'UserDashboard',
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
