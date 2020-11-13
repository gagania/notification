<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST.php';

use Restserver\Libraries\REST;

class Notification extends REST {

    function __construct() {
        parent::__construct();
    }

    public function index_get() {
        $id = $this->get('id');
        if ($id !== NULL) {

            $id = (int) $id;
            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            $string = file_get_contents("vendor.json");
            $vendors = json_decode($string, true);
            $vendor = array();
            if (!empty($vendors)) {
                foreach ($vendors as $key => $value) {
                    if ($value['flag']) {
                        $vendor = $value;
                    }
                }
            }

            if (!empty($vendor)) {
                //request vendor to do sms notification assuming vendor completed the task
                $this->set_response(array('vendor'=>$vendor['name'],'status'=>true,'message'=>'Message Sent'), REST::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Vendor could not be found'
                        ], REST::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $this->set_response('no Request', REST::HTTP_OK);
        }
    }
}
