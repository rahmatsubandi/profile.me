<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_admin()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Package';      
        $data['page'] = 'Package';   
        $data['package'] = FALSE;
        $data['packages'] = $this->admin_model->get_admin_package_features(1);
        $data['features'] = $this->admin_model->select('features');
        $data['main_content'] = $this->load->view('admin/package',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   

            $id = $this->input->post('id', true);
            $data=array(
                'name' => $this->input->post('name', true),
                'monthly_price' => $this->input->post('monthly_price', true),
                'price' => $this->input->post('price', true),
                'status' => $this->input->post('status', true)
            );
            $data = $this->security->xss_clean($data);
           
            $this->admin_model->edit_option($data, $id, 'package');
            $this->session->set_flashdata('msg', 'package Edited Successfully'); 

            $features = $this->input->post('features');
            // insert photos
            if(!empty($features)){
                $this->admin_model->delete_assign_features($id,'feature_assaign');
                foreach ($features as $feature) {
                    $data = array(
                        'package_id' => $id,
                        'feature_id' => $feature
                    );
                    $this->admin_model->insert($data, 'feature_assaign');  
                } 
            }
            redirect(base_url('admin/package'));
            
        }      
        
    }


    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['package'] = $this->admin_model->select_option($id, 'package');
        $data['features'] = $this->admin_model->select('features');
        $data['assign_features'] = $this->admin_model->get_assign_package_features($id);
        $data['main_content'] = $this->load->view('admin/package',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    

    public function delete($id)
    {
        $this->admin_model->delete($id,'package'); 
        echo json_encode(array('st' => 1));
    }

}
	

