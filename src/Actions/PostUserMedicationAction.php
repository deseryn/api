<?php

namespace App\Actions;

use App\UserMedicationService;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class PostUserMedicationAction extends Action
{
    public function __construct(
        private readonly UserMedicationService $userMedicationService,
        private readonly int $userId
    )
    {
    }

    public function handle(Request $request, Response $response): Response
    {
        $data = json_decode($request->getBody()->getContents(), true);

        $this->userMedicationService->addUserMedication($this->userId, $data);

        return $response->withStatus(204);
    }
}