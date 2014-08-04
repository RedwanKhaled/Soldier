<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soldier extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('soldier_model');
        $this->load->helper('url');
        $this->load->helper('date');
        
    }
    
    public function index()
    {
        $this->search_soldier();
    }
    
    public function show_soldier_info($id)
    {
        
        $data = $this->soldier_model->get_soldier_info($id)->result_array();
        $all_remarks = $this->soldier_model->get_all_remarks($id)->result_array();
        
        
        if(!empty($data))
        {
            $data = $data[0];
        }
        
        $remarks_array = array();
        
        foreach ($all_remarks as $remark)
        {
            
        }
        $this->data['soldier'] = $data;
        $this->data['comments_list'] = $all_remarks;
        $this->load->view('templates/header.php',$this->data);
        $this->load->view('show_soldier',$this->data);
        $this->load->view('templates/footer.php',$this->data);
    }
    
    public function image_upload($file_info)
    {
        $data = null;
        if (isset($file_info))
        {
            $config['image_library'] = 'gd2';
            $config['upload_path'] = 'assets/images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10240';
            //$config['maintain_ratio'] = FALSE;
            $config['width'] = 120;
            $config['height'] = 120;
            //$config['create_thumb'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                return $data = $error;
            } else {
                $upload_data = $this->upload->data();
                $data = array('upload_data' => $upload_data);
                return $data;
            }
        }
        return $data;

    }
    
    public function add_soldier_info()
    {
        $this->data['message'] = '';
        $this->form_validation->set_rules('first_name','First Name','xss_clean|required');
        $this->form_validation->set_rules('last_name','Last Name','xss_clean|required');
        $this->form_validation->set_rules('rank','Rank','xss_clean|required');
        $this->form_validation->set_rules('address','Address','xss_clean');
        $this->form_validation->set_rules('phone','Phone','xss_clean');
        
        
        if($this->input->post('submit_add_soldier'))
        {
            if($this->form_validation->run() == true)
            {
                
                if (isset($_FILES["userfile"]))
                {
                    $file_info = $_FILES["userfile"];
                    $uploaded_image_data = $this->image_upload($file_info);
                    if(isset($uploaded_image_data['error'])) {
                        $this->data['message'] = strip_tags($uploaded_image_data['error']);
                        echo json_encode($this->data);
                        return;
                    }else if(!empty($uploaded_image_data['upload_data']['file_name'])){
                        //$path = FCPATH.NEWS_IMAGE_PATH.$uploaded_image_data['upload_data']['file_name'];
                        //unlink($path);
                    }
                }
                
                $first = $this->input->post('first_name');
                $last = $this->input->post('last_name');
                $rank = $this->input->post('rank');
                
                
                $additional_array = array(
                  'first_name' => $first,  
                  'last_name' => $last,  
                  'rank' => $rank,  
                  'address' => $this->input->post('address'),
                  'created_on' => now(),
                  'picture' => empty($uploaded_image_data['upload_data']['file_name'])? '' : $uploaded_image_data['upload_data']['file_name'],
                  'phone' => $this->input->post('phone')  
                );
                
                $id = $this->soldier_model->add_soldier($additional_array);
                
                if($id!=FALSE)
                {
                    $this->data['status'] = 1;
                    $this->data['message'] = 'Soldier info added successfully';
                }
                else
                {
                    $this->data['status'] = 0;
                    $this->data['message'] = 'Soldier info is not added successfully';
                }
            }
            else
            {
                $this->data['status'] = 0;
                $this->data['message'] = validation_errors();
            }
        }
        
        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name'),
        );
        
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name'),
        );
        
        $this->data['rank'] = array(
            'name' => 'rank',
            'id' => 'rank',
            'type' => 'text',
            'value' => $this->form_validation->set_value('rank'),
        );
        
        $this->data['address'] = array(
            'name' => 'address',
            'id' => 'address',
            'type' => 'text',
            'value' => $this->form_validation->set_value('address'),
        );
        
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone'),
        );
        
        $this->data['submit_add_soldier'] = array(
            'name' => 'submit_add_soldier',
            'id' => 'submit_add_soldier',
            'type' => 'submit',
            'value' => 'Add',
        );
        
        $this->load->view('templates/header.php',$this->data);
        $this->load->view('add_soldier',$this->data);
        $this->load->view('templates/footer.php',$this->data);
    }
    
    
    public function edit_soldier_info($id)
    {
        
        $this->data['message'] = '';
        
        $this->form_validation->set_rules('first_name','First Name','xss_clean|required');
        $this->form_validation->set_rules('last_name','Last Name','xss_clean|required');
        $this->form_validation->set_rules('rank','Rank','xss_clean|required');
        $this->form_validation->set_rules('address','Address','xss_clean');
        $this->form_validation->set_rules('phone','Phone','xss_clean');
        
        
        if($this->input->post('submit_edit_soldier'))
        {
            if($this->form_validation->run() == true)
            {

                $first = $this->input->post('first_name');
                $last = $this->input->post('last_name');
                $rank = $this->input->post('rank');
                
                
                $additional_array = array(
                  'first_name' => $first,  
                  'last_name' => $last,  
                  'rank' => $rank,  
                  'address' => $this->input->post('address'),
                  'phone' => $this->input->post('phone')  
                );
                
                $flag = $this->soldier_model->update_soldier_info($id,$additional_array);
                
                if($flag != FALSE)
                {
                    $this->data['status'] = 1;
                    $this->data['message'] = 'Soldier info update successful';
                }
                else
                {
                    $this->data['status'] = 0;
                    $this->data['message'] = 'Soldier info update unsuccessful';
//                    $this->edit_soldier_info($id);
                }
            }
        }
        
        $soldier_info = $this->soldier_model->get_soldier_info($id)->result_array();
        
        if(!empty($soldier_info))
        {
            $soldier_info = $soldier_info[0];
        }
        
        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $soldier_info['first_name']
        );
        
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $soldier_info['last_name']
        );
        
        $this->data['rank'] = array(
            'name' => 'rank',
            'id' => 'rank',
            'type' => 'text',
            'value' => $soldier_info['rank']
        );
        
        $this->data['address'] = array(
            'name' => 'address',
            'id' => 'address',
            'type' => 'text',
            'value' => $soldier_info['address']
        );
        
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $soldier_info['phone']
        );
        
        $this->data['submit_edit_soldier'] = array(
            'name' => 'submit_edit_soldier',
            'id' => 'submit_edit_soldier',
            'type' => 'submit',
            'value' => 'Update',
        );
        
        $this->data['id'] = $id;
        $this->load->view('templates/header.php',$this->data);
        $this->load->view('edit_soldier',$this->data);
        $this->load->view('templates/footer.php',$this->data);
 
    }
    
    public function show_all_soldiers()
    {
        $this->data['message'] = '';
        
        $all_soldiers_info_array = $this->soldier_model->get_all_soldiers()->result_array();
        $this->data['all_soldiers_info'] = $all_soldiers_info_array;
        
        $this->load->view('templates/header',  $this->data);
        $this->load->view('show_all_soldiers',  $this->data);
        $this->load->view('templates/footer',  $this->data);
        
    }
    
    public function search_soldier()
    {
        $this->data['message'] = '';
        
        $all_soldiers_info_array = $this->soldier_model->get_all_soldiers(1)->result_array();
        $this->data['soldier'] = array();
        $this->data['soldier'] = $all_soldiers_info_array;
        
        $this->load->view('templates/header',  $this->data);
        $this->load->view('search_soldier',  $this->data);
        $this->load->view('templates/footer',  $this->data);
    }
    
    public function add_soldier_remark()
    {
        $description = $_POST['description'];
        $soldier_id = $_POST['soldier_id'];
        
        $data = array(
            'description' => $description,
            'soldier_id' => $soldier_id,
            'created_on' => now()
        );
        
        $id = $this->soldier_model->add_soldier_remark($data);
        
        $response = array();
        if($id!=FALSE)
        {
            $response['status'] = 1;
            $response['message'] = 'Remark is added successfully';
            
        }
        else
        {
            $response['status'] = 0;
            $response['message'] = 'Remark add is unsuccessful';
            
        }
        
        echo json_encode($response);
    }
    
    public function test($hello)
    {
        $date = date('d-m-Y');
        $hello = explode('-', $date);
        print_r($hello);exit;
        
    }
    
}
