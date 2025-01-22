<?php

namespace App\Persistence;

use PDO;

class MedicationLoader
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function loadUserMedication(int $userId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM medications WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return $data;
        }

        return [];
    }
}