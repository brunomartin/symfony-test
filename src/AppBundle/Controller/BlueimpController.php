<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\HttpFoundation\Request;

use Oneup\UploaderBundle\Uploader\Response\EmptyResponse;

use Oneup\UploaderBundle\Controller\BlueimpController as BaseController;

class BlueimpController extends BaseController
{
    public function upload()
    {
        $request = $this->getRequest();
        $response = new EmptyResponse();
        $files = $this->getFiles($request->files);

        $chunked = !is_null($request->headers->get('content-range'));

        $fileResponses = array();

        foreach ((array) $files as $file) {
            try {
                $chunked ?
                    $this->handleChunkedUpload($file, $response, $request) :
                    $this->handleUpload($file, $response, $request)
                ;

                $fileResponse['error'] = 0;
                $fileResponse['name'] = $file->getClientOriginalName();
                $fileResponse['size'] = $file->getClientSize();

                $fileResponses[] = $fileResponse;

            } catch (UploadException $e) {
                $this->errorHandler->addException($response, $e);
            }
        }

        $data = $response->assemble();
        $data['files'] = $fileResponses;

        return $this->createSupportedJsonResponse($data);
    }
}
