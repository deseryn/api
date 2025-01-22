<?php

namespace App\Actions;


use App\UserMedicationService;
use Exception;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class DeleteUserMedicationAction extends Action
{
    public function __construct(
        private readonly UserMedicationService $userMedicationService,
        private readonly int $userId,
        private readonly int $medicationId
    )
    {
    }

    public function handle(Request $request, Response $response): Response
    {
        if ($this->userId === null) {
            return $response->withStatus(400)->withJson(['error' => 'User ID is required']);
        }
        if ($this->medicationId === null) {
            return $response->withStatus(400)->withJson(['error' => 'User ID is required']);
        }

        try {
            $this->userMedicationService->removeUserMedication($this->userId, $this->medicationId);
        } catch (Exception $e) {
            return $response->withStatus(400)->withJson(['error' => $e->getMessage()]);
        }

        return $response->withStatus(204);
    }
}