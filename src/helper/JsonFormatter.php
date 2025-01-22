<?php

namespace App\Helper;

class JsonFormatter
{
    /**
     * Returns a JSON response for a successful operation.
     *
     * @param mixed $data
     * @param string $message
     * @return string
     */
    public static function success($data, $message = 'Operation successful')
    {
        return json_encode([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * Returns a JSON response for a failed operation.
     *
     * @param string $message
     * @param int $code
     * @return string
     */
    public static function failure($message = 'Operation failed', $code = 400)
    {
        return json_encode([
            'status' => 'failure',
            'message' => $message,
            'code' => $code
        ]);
    }

    /**
     * Returns a JSON response for an exception.
     *
     * @param \Exception $exception
     * @return string
     */
    public static function exception(\Exception $exception)
    {
        return json_encode([
            'status' => 'error',
            'message' => $exception->getMessage(),
            'code' => $exception->getCode()
        ]);
    }
}