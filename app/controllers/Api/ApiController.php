<?php namespace Api;

use Response;
use Illuminate\Http\Response as IlluminateResponse;

class ApiController extends \BaseController {

    protected $statusCode = IlluminateResponse::HTTP_OK;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    private function setCORSHeaders()
    {
        $header['Access-Control-Allow-Origin'] = '*';
        $header['Allow'] = 'GET, POST, OPTIONS';
        $header['Access-Control-Allow-Headers'] = 'Origin, Content-Type, Accept, Authorization, X-Request-With';
        $header['Access-Control-Allow-Credentials'] = 'true';

        return $header;
    }

    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithCORS($data)
    {
        return $this->respond($data, $this->setCORSHeaders());
    }
}
