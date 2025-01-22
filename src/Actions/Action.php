<?php

namespace App\Actions;

use App\Exceptions\DuplicateMedicationException;
use App\Exceptions\InvalidAuthorizationException;
use App\Exceptions\MedicationNotFoundException;
use App\Exceptions\MissingParameterException;
use App\Exceptions\MissingRightsException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use Throwable;

abstract class Action
{
    public function __invoke(Request $request, Response $response): Response
    {
        try {
            http_response_code($response->getStatusCode());
            header('Content-Type: application/json');
            return $this->handle($request, $response);
        } catch (MissingParameterException|InvalidArgumentException $e) {
            return $response->withStatus(400);
        } catch (InvalidAuthorizationException $e) {
            return $response->withStatus(401);
        } catch (MedicationNotFoundException $e) {
            return $response->withStatus(404);
        } catch (MissingRightsException $e) {
            return $response->withStatus(403);
        } catch (DuplicateMedicationException $e) {
            return $response->withStatus(409);
        }
    }

    protected abstract function handle(Request $request, Response $response): Response;
}
