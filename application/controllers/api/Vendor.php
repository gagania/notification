<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST.php';
use Restserver\Libraries\REST;

class Vendor extends REST {

    function __construct() {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get() {
        $string = file_get_contents("vendor.json");
        $vendors = json_decode($string, true);
        
        $id = $this->get('id');

        if ($id === NULL) {
            if ($vendors)
            {
                $this->response($vendors, REST::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No vendor were found'
                ], REST::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else if ($id !== NULL) {
            $vendor = array();
            $id = (int) $id;
            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
            if (!empty($vendors)) {
                foreach ($vendors as $key => $value)
                {
                    if (isset($value['id']) && $value['id'] == $id)
                    {
                        $vendor = $value;
                    }
                }
                $this->set_response($vendor, REST::HTTP_OK); // OK (200) being the HTTP response code
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

    public function change_flag_post() {
        // $this->some_model->update_user( ... );
        $updateData = $this->post();
        $string = file_get_contents("vendor.json");
        $vendors = json_decode($string, true);
        foreach ($vendors as $key => $value) {
            if ($updateData['id'] == $value['id']) {
                $vendors[$key]['flag'] = $updateData['flag'];
            } else {
                $vendors[$key]['flag'] = false;
            }
        }
        $newJsonString = json_encode($vendors);
        file_put_contents('vendor.json', $newJsonString);
        $message = [
            'message' => 'Success change flag to'.$updateData['id']
        ];

        $this->set_response($message, REST::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }
}
