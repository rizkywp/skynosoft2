<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Frontend extends CI_Controller {
	var $API ="";
	function __construct() {
        parent::__construct();
        $this->API="http://localhost/skynosoft_rest/index.php/";
    }
	function index()
	{
		 $data['member'] = json_decode($this->curl->simple_get($this->API.'backend'));
        $this->load->view('main',$data);
	}
	function tampil()
	{
		 $data['member'] = json_decode($this->curl->simple_get($this->API.'backend'));
        $this->load->view('tampil',$data);
	}
	function tambah()
	{
		if($this->input->post('first_name')<>''){
			$namafull = $_FILES['file']['name'];
        	$ext = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
            if($namafull<>''){
                for($i=2;$i<1000;$i++){
                $filename = 'upload/'.$namafull;
                if (file_exists($filename)) {
                $namaasli = pathinfo($_FILES['file']['name'],PATHINFO_FILENAME);
                $namafull=$namaasli.'('.$i.')'.'.'.$ext;
                }  else {
                    break;
                }
                }

                $lokasi_file = $_FILES['file']['tmp_name'];
                $direktori="upload/".$namafull;
                move_uploaded_file($lokasi_file,$direktori);

                }
            
                
    	 $data = array(
                'first_name'       =>  $this->input->post('first_name'),
                'last_name'      =>  $this->input->post('last_name'),
                'language'=>  $this->input->post('language'),
                'file'=>  $namafull,
                );

			$insert=$this->curl->simple_post($this->API.'backend', $data, array(CURLOPT_BUFFERSIZE => 10));
			if($insert)
            {
                $this->session->set_flashdata('hasil','Data Berhasil Diinputkan');
            }else
            {
               $this->session->set_flashdata('hasil','Data Gagal Diinputkan');
            }
            redirect('frontend/tampil');
		} else {
        $this->load->view('tambah',$data);
    	}
	}
	function edit($id){
        if(isset($_POST['first_name'])){
        	$namafull = $_FILES['file']['name'];
        	$ext = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
        	if($namafull<>''){
        		for($i=2;$i<1000;$i++){
        		$filename = 'upload/'.$namafull;
				if (file_exists($filename)) {
				$namaasli = pathinfo($_FILES['file']['name'],PATHINFO_FILENAME);
				$namafull=$namaasli.'('.$i.')'.'.'.$ext;
				}  else {
					break;
				}
				}

				$lokasi_file = $_FILES['file']['tmp_name'];
				$direktori="upload/".$namafull;
				move_uploaded_file($lokasi_file,$direktori);

				}
            

	          $data = array(
            	'id' =>  $this->input->post('id'),
                 'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'language'=> $this->input->post('language'),
                'file'=> $namafull);
           $update =  $this->curl->simple_put($this->API.'backend', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('hasil','Data Berhasil Diupdate');
            }else
            {
               $this->session->set_flashdata('hasil','Data Berhasil Diupdate');
            }
           redirect('frontend/tampil');
        }else{
        	$params = array('id'=> $id);
            $data['member'] =$member= json_decode($this->curl->simple_get($this->API.'backend',$params));
            $this->load->view('edit',$data);
        }
    }
	function hapus($id){
        if(empty($id)){
            redirect('frontend/tampil');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'backend', array('id'=>$id), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
          redirect('frontend/tampil');
        }
    }
    function download($id){
    	$params = array('id'=> $id);
         $member= json_decode($this->curl->simple_get($this->API.'backend',$params));
         foreach ($member as $member){
         $file = $member->upload; 
         }
    	$this->load->helper('download');
    	$data = file_get_contents("./upload/".$file); // Read the file's contents
		force_download($file, $data); 
    }
	
	
}
?>
