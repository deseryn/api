<?php

namespace App;

use App\Persistence\MedicationLoader;
use App\Persistence\MedicationWriter;
use Exception;

class UserMedicationService
{

    public function __construct(
        private readonly MedicationLoader $medicationLoader,
        private readonly MedicationWriter $medicationWriter
    )
    {
    }

    public function getUserMedicationsByUserId(int $userId): array
    {
        try {
            $userMedication = $this->medicationLoader->loadUserMedication($userId);
        } catch (Exception $e) {
            // add message and maybe further information to custom exception and throw it
            throw $e;
        }

        if (!$userMedication) {
            throw new \Exception('User not found');
        }

        return $userMedication;
    }

    public function addUserMedication(int $userId, array $data): void
    {
        try {
            $this->medicationWriter->insertMedication($userId, $data);
        } catch (Exception $e) {
            // add message and maybe further information to custom exception and throw it
            throw $e;
        }
    }

    public function updateUserMedication(int $userId, int $medicationId, array $data): void
    {
        try {
            $this->medicationWriter->updateMedication($userId, $medicationId, $data);
        } catch (Exception $e) {
            // add message and maybe further information to custom exception and throw it
            throw $e;
        }
    }

    public function removeUserMedication(int $userId, int $medicationId): void
    {
        try {
            $this->medicationWriter->deleteMedication($userId, $medicationId);
        } catch (Exception $e) {
            // add message and maybe further information to custom exception and throw it
            throw $e;
        }
    }
}