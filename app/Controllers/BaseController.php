<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    protected function sendNotif($whatsapp, $msg)
    {
        try {
            $data = array(
                'phone' => $whatsapp,
                'messageType' => 'text',
                'body' => $msg,
            );

            $url = 'https://sendtalk-api.taptalk.io/api/v1/message/send_whatsapp';
            $client = new Client();
            $response = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'API-Key' => API_KEY],
                'body' => json_encode($data),
            ]);

            $resSender = json_decode($response->getBody());
            $resStatus = $this->getStatusMessage($resSender->data->id);
            return json_encode($resStatus);
        } catch (Exception $e) {
            $this->response([
                'status' => false,
                'message' => 'Terjadi kesalahan',
            ], self::HTTP_INTERNAL_ERROR);
        }
    }

    protected function getStatusMessage($id)
    {
        try {
            $data = ['id' => $id];

            $url = 'https://sendtalk-api.taptalk.io/api/v1/message/get_status';
            $client = new Client();
            $response = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'API-Key' => API_KEY],
                'body' => json_encode($data),
            ]);

            $res = json_decode($response->getBody());
            $msg = "Successfully sent message";
            $type = "success";
            if ($res->data->status == 'acknowledged') {
                $msg = "WhatsApp number is unknown!";
                $type = "error";
            }

            return [
                'id' => $id,
                'status_code' => $res->status,
                'status_label' => $res->data->status,
                'status_message' => $msg,
                'type' => $type,
            ];

        } catch (Exception $e) {
            $this->response([
                'status' => false,
                'message' => 'Terjadi kesalahan',
            ], self::HTTP_INTERNAL_ERROR);
        }
    }
}
