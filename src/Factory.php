<?php

namespace App;

use App\Actions\DeleteUserMedicationAction;
use App\Actions\GetUserMedicationAction;
use App\Actions\PostUserMedicationAction;
use App\Actions\UpdateUserMedicationAction;
use App\Persistence\MedicationLoader;
use App\Persistence\MedicationWriter;
use PDO;

class Factory
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }
    
    private function createUserService(): UserMedicationService
    {
        return new UserMedicationService($this->createMysqlReader(), $this->createMysqlWriter());
    }

    public function createGetAction(int $id): GetUserMedicationAction
    {
        return new GetUserMedicationAction($this->createUserService(), $id);
    }

    public function createPostAction(int $userId): PostUserMedicationAction
    {
        return new PostUserMedicationAction($this->createUserService(), $userId);
    }

    public function createPatchAction(int $userId, int $medicationId): UpdateUserMedicationAction
    {
        return new UpdateUserMedicationAction($this->createUserService(), $userId, $medicationId);
    }

    public function createDeleteAction(int $userId, int $medicationId): DeleteUserMedicationAction
    {
        return new DeleteUserMedicationAction($this->createUserService(), $userId, $medicationId);
    }

    private function createMysqlReader(): MedicationLoader
    {
        return new MedicationLoader($this->createPdo());
    }

    private function createMysqlWriter(): MedicationWriter
    {
        return new MedicationWriter($this->createPdo());
    }

    private function createPdo(): PDO
    {
        return new PDO(
            'mysql:host=mysql;dbname=db',
            'user',
            '123456'
        );
    }
}