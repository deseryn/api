<?php

namespace App\Actions;

use App\UserMedicationService;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class UpdateUserMedicationAction extends Action
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
        $data = json_decode($request->getBody()->getContents(), true);

        $this->userMedicationService->updateUserMedication($this->userId, $this->medicationId, $data);

        return $response->withStatus(204);
    }
}
