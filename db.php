<?php
    // Класс подключения к БД
	class DBConn{
        public mysqli $mysql;
        function connect($hostn, $usern, $pass, $db): void
        {
            $this->mysql = new mysqli($hostn, $usern, $pass, $db);
            $this->mysql->query("SET NAMES 'utf8'");

        }
        function disconnect(): void
        {
            $this->mysql->close();
        }
    }