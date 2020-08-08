<?php
declare(strict_types=1);

namespace App\Controller\Traits;

/**
 * Response trait
 */
trait ResponseTrait
{
    /**
     * Json return type
     *
     * @var string
     */
    private $jsonType = 'application/json';

    /**
     * Prepare and return json response
     *
     * @param  mixed $data Data to return as a json response
     * @param  int $status HTTP status code
     * @return \Cake\Http\Response
     */
    public function setJsonResponse($data, $status = null)
    {
        $data = $this->prepareData($data);

        return $this->prepareResponse($status)->withStringBody($data);
    }

    /**
     * Prepare data to send response as a json response
     *
     * @param  mixed $data Data to prepare
     * @return string
     */
    private function prepareData($data)
    {
        if (is_array($data)) {
            $data = json_encode($data);
        } elseif (is_object($data)) {
            $data = json_encode($data);
        }

        return $data;
    }

    /**
     * Returns proper response object with status condition
     *
     * @param  int|null $status HTTP status code
     * @return \Cake\Http\Response
     */
    private function prepareResponse($status)
    {
        $response = $this->getResponse()->withType($this->jsonType);

        if ($status !== null) {
            $response = $response->withStatus($status);
        }

        return $response;
    }
}
