<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/fake-data", name="get_fake_data")
     * @Method("GET")
     */
    public function getFakeDataAction()
    {
        $mock = $this->get('app.mock.data.generator');

        $generatedData = $mock->generateFormData();
        $isJson = empty($generatedData);

        return new JsonResponse(
            $isJson ? '{}' : $generatedData,
            200,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ],
            $isJson
        );
    }

    /**
     * @Route("/post-data", name="post_form_data")
     * @Method("POST")
     */
    public function postDataAction(Request $request)
    {
        $contentType = $request->getContentType();

        if ($contentType === 'json') {
            $postData = json_decode($request->getContent());
        } elseif ($contentType === 'form') {
            $postData = $request->request->all();
        } else {
            $postData = [];
        }

        $logger = $this->get('app.form.data.logger');
        $logger->info(json_encode($postData, JSON_PRETTY_PRINT));

        return new JsonResponse($postData);
    }
}
