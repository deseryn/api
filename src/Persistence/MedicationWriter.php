<?php

namespace App\Persistence;

use PDO;

class MedicationWriter
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertMedication(int $userId, array $data): bool
    {
        $sql = "INSERT INTO medications (user_id, name, dosage, started_at, note) 
                VALUES (:user_id, :name, :dosage, :started_at, :note)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'user_id' => $userId,
            'name' => $data['name'],
            'dosage' => $data['dosage'],
            'started_at' => $data['started_at'],
            'note' => $data['note'],
        ]);
    }

    public function updateMedication(int $id, int $userId, array $data): bool
    {
        $sql = "UPDATE medications SET name = :name, started_at = :started_at, dosage = :dosage, note = :note 
                   WHERE id = :id AND user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'name' => $data['name'],
            'started_at' => $data['started_at'],
            'dosage' => $data['dosage'],
            'note' => $data['note'],
            'id' => $id,
            'user_id' => $userId,
        ]);
    }

    public function deleteMedication(int $id, int $userId): bool
    {
        $sql = "DELETE FROM medications WHERE id = :id AND user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'user_id' => $userId,
        ]);
    }
}