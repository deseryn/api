<?php

namespace App\Actions;

use App\UserMedicationService;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class GetUserMedicationAction extends Action
{
    public function __construct(
        private readonly UserMedicationService $userMedicationService,
        private readonly int $id
    )
    {
    }

    /**
     * @throws \JsonException
     */
    public function handle(Request $request, Response $response): Response
    {
        if ($this->id === null) {
            return $response->withStatus(400)->withJson(['error' => 'User ID is required']);
        }

        // check if user is of type Pharmacist, otherwise Exception and 403

        $userMedication = $this->userMedicationService->getUserMedicationsByUserId($this->id);
        if ($userMedication === []) {
            // 404 not found exception would fit better in the way Action works
            // but it actually depends on why it's null since it's a valid case that there is just no medication, yet
            // which would be an argument for 200
            return $response->withStatus(404)->withJson(['error' => 'User medication not found']);
        }

        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode($userMedication, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT)
        );
    }
}
