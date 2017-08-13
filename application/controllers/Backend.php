<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Backend extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    public function index_get() {
        $id = $this->get('id');
        $member = $this->query->datamember($id);
        $this->response($member,200);
    }
    public function index_post() {
       
        $result = $this->query->tambahmember();
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
    public function index_put() {
         $id = $this->put('id');
         $data = array( 
            'first_name' => $this->put('first_name'),
            'last_name' => $this->put('last_name'),
            'language' => $this->put('language')
            );
         $result = $this->query->editmember($id,$data);
         if($this->put('file')<>''){
            $member = $this->query->datamember($id);
             foreach ($member as $member){
                 $file = $member->upload; 
             }
             unlink('upload/'.$file);
            $data = array( 
            'upload' => $this->put('file')
            );
            $this->query->editmember($id,$data);
         }
        
        
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
    public function index_delete() {
        $id = $this->delete('id');
             $member = $this->query->datamember($id);
             foreach ($member as $member){
                 $file = $member->upload; 
             }
        $result = $this->query->hapusmember($id);
         if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            unlink('upload/'.$file);
            $this->response(array('status' => 'success'));
        }
       
    }
 


}
?>