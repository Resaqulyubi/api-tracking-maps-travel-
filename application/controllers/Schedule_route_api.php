<?php

require APPPATH . '/libraries/REST_Controller.php';

class Schedule_route_api extends REST_Controller {

  function __construct($config = 'rest') {
    parent::__construct($config);
  }

  // show data
  function index_get() {
    $id = $this->get('id');
    $id_schedule = $this->get('id_schedule');
    if( $id_schedule != ''){
      $this->db->where('id_schedule', $id_schedule);
      $this->db->order_by("createdate", "DESC");
      $data=$this->db->get("tbl_schedule_route")->result();
   
    }   elseif ( $id == ''){
      $data=$this->db->get("tbl_schedule_route")->result();
    }else {
      $this->db->where('id', $id);
   
      $data=$this->db->get("tbl_schedule_route")->result();
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
          'id' => '',
          'id_schedule' => $this->input->post('id_schedule'),
          'lat' => $this->input->post('lat'),
          'longi' => $this->input->post('longi'),
          'createdate' => $this->input->post('createdate'),
          'createby' => $this->input->post('createby')
        );
        $insert = $this->db->insert('tbl_schedule_route', $data);
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
        $update = $this->db->update('tbl_schedule_route', $data);
        if ($update) {
          $this->response(array("data"=>array($data), "status"=>"true", 200));
        } else {
          $this->response(array("data"=>array($data),'status' => 'false', 502));
        }

      }elseif($this->input->post('action')=="DELETE"){
        $id_user = $this->input->post('id');
        $this->db->where('id',  $id_user);
        $delete = $this->db->delete('tbl_schedule_route');
        if ($delete) {
          $this->response(array('status' => 'true'), 200);
        } else {
          $this->response(array('status' => 'false', 502));
        }
      }
    }

  }
