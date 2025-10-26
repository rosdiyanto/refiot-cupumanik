composer install
php spark migrate -all
app.baseURL = 'http://localhost:8080/'
app.indexPage = ''
database.default.hostname = localhost
database.default.database = myth_auth
database.default.username = yanto
database.default.password = ayamireng
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
php spark key:generate
php spark make:migration CreatePegawaiTable
php spark migrate
php spark migrate:rollback --all
php spark migrate:status
php spark db:seed PegawaiSeeder
php spark rollback:version 2025-10-21-064235 -> hapus table dan roolback by version kasus jika batch sama
php spark migrate
php spark db:seedall -> jalankan semua seeder
php spark migrate:rollback
php spark ctl:user UserController
php spark ctl:admin AdminController
composer dump-autoload
composer dump-autoload -o -v
php spark filters:list -> cek daftar filter