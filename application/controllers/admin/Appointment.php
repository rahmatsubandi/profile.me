<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_admin() && !is_user()) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $data = array();
        $data['page_title'] = 'Appointment';
        $data['user'] = $this->admin_model->get_user_info();
        $data['appointments'] = $this->admin_model->get_appointments($data['user']->id);
        $data['my_days'] =$this->admin_model->get_user_days($data['user']->id);
        $data['main_content'] = $this->load->view('admin/appointments/add',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function add()
    {   
        $user = $this->admin_model->get_user_info();
        $this->admin_model->delete_assaign_days($user->id, 'assaign_days');

        if($_POST)
        {   
            $user_data = array(
                'appointment_info' => $this->input->post("appointment_info")
            );
            $this->admin_model->edit_option($user_data, user()->id, 'users');

            for ($i=0; $i < 7; $i++) { 
                if(empty($this->input->post("day_".$i))){
                    $day = 0;
                }else{
                    $day = $this->input->post("day_".$i);
                }
                $data = array(
                    'user_id' => $user->id,
                    'day' => $day,
                    'start' => $this->input->post("start_time_".$i),
                    'end' => $this->input->post("end_time_".$i)
                );
                $data = $this->security->xss_clean($data);
                $this->admin_model->insert($data, 'assaign_days');
            }

            $this->session->set_flashdata('msg', 'Appointment days added Successfully'); 
            redirect(base_url('admin/appointment'));
        }      
        
    }



    public function delete($id)
    {
        $this->admin_model->delete($id,'appointments'); 
        echo json_encode(array('st' => 1));
    }

}
	

