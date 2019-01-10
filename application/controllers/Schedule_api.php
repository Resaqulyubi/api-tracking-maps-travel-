<?php

require APPPATH . '/libraries/REST_Controller.php';

class Schedule_api extends REST_Controller {

  function __construct($config = 'rest') {
    parent::__construct($config);
  }

  // show data
  function index_get() {
    $id = $this->get('id');
     $id_driver = $this->get('id_driver');
    if( $id_driver != ''){
      $this->db->where('id_driver', $id_driver);
      $data=$this->db->get("tbl_schedule")->result();
   
    }   elseif ( $id == ''){
      $data=$this->db->get("tbl_schedule")->result();
    }else {
      $this->db->where('id', $id);
     
      $data=$this->db->get("tbl_schedule")->result();
    }
    $data = array(
      "status"=>"true",
      "data"=> $data);
      $this->response($data, 200);
    }

    // insert new data to
    function index_post() {
      if($this->input->post('action')=="POST"){
        $data = array(
          'id' => $this->input->post('id'),
          'id_driver' => $this->input->post('id_driver'),
          'id_customer' => $this->input->post('id_customer'),
          'customer_name' => $this->input->post('customer_name'),
          'email' => $this->input->post('email'),
          'phone' => $this->input->post('phone'),
          'address' => $this->input->post('address'),
          'payment_code' => $this->input->post('payment_code'),
          'paket' => $this->input->post('paket'),
          'pickup_point' => $this->input->post('pickup_point'),
          'pickup_time' => $this->input->post('pickup_time'),
          'destination' => $this->input->post('destination'),
          'route' => $this->input->post('route'),
          'arrival' => $this->input->post('arrival'),
          'createby' => $this->input->post('createby'),
          'createdate' => $this->input->post('createdate'),
          'status' => $this->input->post('status')
        );
        $insert = $this->db->insert('tbl_schedule', $data);
        if ($insert) {
          $this->response(array("data"=>array($data), "status"=>"true", 200));
        } else {
          $this->response(array("data"=>array($data),'status' => 'false', 502));
        }

      }elseif($this->input->post('action')=="PUT"){
        $id_u = $this->input->post('id');
        $data = array(
           'nama' => $this->input->post('nama'),
          'lnglat' => $this->input->post('lnglat'),
          'deskripsi' => $this->input->post('deskripsi'),
          'foto' => $this->input->post('foto'),
          'kategori' => $this->input->post('kategori')
        );

        $this->db->where('id', $id_u);
        $update = $this->db->update('tbl_schedule', $data);
        if ($update) {
          $this->response(array("data"=>array($data), "status"=>"true", 200));
        } else {
          $this->response(array("data"=>array($data),'status' => 'false', 502));
        }

      }elseif($this->input->post('action')=="PUTSTATUS"){
        $id_u = $this->input->post('id');
        
        $data = array(
           'status' => $this->input->post('status'),
        );

        $this->db->where('id', $id_u);
        $update = $this->db->update('tbl_schedule', $data);
        if ($update) {
          $this->response(array("data"=>array($data), "status"=>"true", 200));
        } else {
          $this->response(array("data"=>array($data),'status' => 'false', 502));
        }

      }elseif($this->input->post('action')=="DELETE"){
        $id_user = $this->input->post('id');
        $this->db->where('id',  $id_user);
        $delete = $this->db->delete('tbl_schedule');
        if ($delete) {
          $this->response(array('status' => 'true'), 200);
        } else {
          $this->response(array('status' => 'false', 502));
        }
      }
    }

  }
