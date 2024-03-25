Для создания новой БД необходимо ввести url http://localhost:8500/createBD.php
Для указания имени БД в строке $sql = "CREATE DATABASE test"; меняем text на свое имя.

Для переноса таблиц из уже существующей БД нужно ввести url http://localhost:8500/migration.php
Для указания места хранения вашей БД в строке $filePath = 'sql/project_1.sql'; меняем sql/project_1.sql на ваш путь.