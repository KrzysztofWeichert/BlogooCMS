<?php

declare(strict_types=1);

namespace App;

require_once('src/Model/AbstractModel.php');

class Model extends AbstractModel
{
    
    public function login(?string $username)
    {
        $query = "SELECT * FROM admins WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function add(array $data): void {
        $url = $this->friendlyUrl($data['title']);
        $query = "INSERT INTO articles (title, description, URL, meta_title, meta_desc) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $data['title'], $data['description'], $url, $data['meta-title'], $data['meta-description']);
        $stmt->execute();
        $stmt->close();
    }

    public function selectAll(): array {
        $query = "SELECT * FROM articles";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function selectAllCMS($pageNumber): array {
        $offset = ($pageNumber - 1) * 10;
        $query = "SELECT * FROM articles LIMIT $offset, 10";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function selectOne($id, $articles = 'articles', $URL = null): ?array{
        if (!$URL) {
            $query = "SELECT * FROM $articles WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $id);
        } else {
            $query = "SELECT * FROM $articles WHERE URL = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $URL);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function edit($data, $articles = 'articles'): void {
        if ($articles === 'articles') {
            $query = "UPDATE $articles SET title = ?, description = ?, 
                      meta_title = ?, meta_desc = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssssi", $data['title'], $data['description'], $data['metaTitle'], $data['metaDescription'], $data['id']);
        } else {
            $query = "UPDATE $articles SET description = ?, 
                      meta_title = ?, meta_desc = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sssi", $data['description'], $data['metaTitle'], $data['metaDescription'], $data['id']);
        }
        $stmt->execute();
        $stmt->close();
    }

    public function delete($id): void {
        $query = "DELETE FROM articles WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function count(){
        $query = "SELECT COUNT(*) FROM articles";
        $result = $this->conn->query($query)->fetch_column();
        return $result;
    }
}