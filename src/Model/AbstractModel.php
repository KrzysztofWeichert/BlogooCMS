<?php

declare(strict_types=1);

namespace App;

use Exception;
use PDO;
use Mysqli;

abstract class AbstractModel
{
    protected $conn;

    public function __construct(array $db_config)
    {
        $this->conn = new mysqli($db_config['host'], $db_config['user'], $db_config['password'], $db_config['database']);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function login(?string $username, ?string $password)
    {
        $query = "SELECT * FROM admins WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function friendlyUrl($title)
    {
        $polishChars = [
            'ą' => 'a',
            'ć' => 'c',
            'ę' => 'e',
            'ł' => 'l',
            'ń' => 'n',
            'ó' => 'o',
            'ś' => 's',
            'ź' => 'z',
            'ż' => 'z',
            'Ą' => 'a',
            'Ć' => 'c',
            'Ę' => 'e',
            'Ł' => 'l',
            'Ń' => 'n',
            'Ó' => 'o',
            'Ś' => 's',
            'Ź' => 'z',
            'Ż' => 'z'
        ];
        $title = strtr($title, $polishChars);
        $title = preg_replace('/[^a-zA-Z0-9\s]/', '', $title);
        $title = str_replace(' ', '-', $title);
        $title = strtolower($title);
        $title = preg_replace('/-+/', '-', $title);
        $title = trim($title, '-');
        return $title;
    }
}
