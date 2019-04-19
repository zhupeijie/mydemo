<?php

namespace helpers;

trait ApiResponse
{
    protected $statusCode = 200;

    protected $message = '';

    protected $data = [];

    /**
     * @param $statusCode
     * @return $this
     */
    private function setStatusCode($statusCode)
    {
        if (null !== $statusCode && !is_numeric($statusCode)) {
            throw new \UnexpectedValueException(sprintf('The ApiResponse message must be a integer, "%s" given.', gettype($statusCode)));
        }
        $this->statusCode = (int)$statusCode;

        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    private function setMessage($message)
    {
        if (null !== $message && !is_string($message)) {
            throw new \UnexpectedValueException(sprintf('The ApiResponse message must be a string, "%s" given.', gettype($message)));
        }
        $this->message = (string)$message;

        return $this;
    }
    /**
     * @param array $data
     * @return $this
     */
    private function setData(array $data)
    {
        if (null !== $data && !is_array($data)) {
            throw new \UnexpectedValueException(sprintf('The ApiResponse message must be a array, "%s" given.', gettype($data)));
        }
        $this->data = $data;

        return $this;
    }

    private function respond()
    {
        $ret = [
            'statusCode' => $this->statusCode,
            'message' => $this->message,
            'data' => $this->data,
        ];

        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
        die;
    }


    /**
     * @param array $data
     * @param string $message
     * @param int $statusCode
     */
    public function successResponse(array $data = [], $message = 'Success', $statusCode = 200)
    {
        if ($statusCode !== $this->statusCode) {
            $this->setStatusCode($statusCode);
        }

         return $this->setMessage($message)
            ->setData($data)
            ->respond();
    }

    /**
     * @param string $message
     * @param array $data
     * @param int $statusCode
     */
    public function errorResponse($message = 'Internet Server Error', array $data = [], $statusCode = 500)
    {
        return $this->setStatusCode($statusCode)
            ->setMessage($message)
            ->setData($data)
            ->respond();
    }
}