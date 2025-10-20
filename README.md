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
php spark migrate:rollback --all
php spark migrate:status
php spark db:seed PegawaiSeeder