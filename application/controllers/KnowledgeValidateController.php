<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KnowledgeValidateController extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model(['TacitKnowledgeModel', 'ExplicitKnowledgeModel', 'HelperModel', 'UserModel', 'NotificationModel']);

        if ($this->session->userdata('logged_in') != 1) {
            return redirect(base_url('login'));
        }
    }

	public function index()
	{
        if ($this->session->userdata('role_id') == 0) {
            $data['knowledges'] = $this->HelperModel->getWithUnion()->result();
        }
        if ($this->session->userdata('role_id') == 1) {
            $data['knowledges'] = $this->HelperModel->getWithUnionKasi()->result();
        }

        $this->load->view('templates/header');
		$this->load->view('knowledge_validate/index', $data);
        $this->load->view('templates/footer');
	}

    public function show($id)
    {
        $data['knowledge'] = $this->TacitKnowledgeModel->getById($id)->row();

        $this->load->view('templates/header');
        $this->load->view('knowledge_validate/show', $data);
        $this->load->view('templates/footer');
    } 
    
    public function show_tacit($id)
    {
        $data['knowledge'] = $this->TacitKnowledgeModel->getById($id)->row();

        $this->load->view('templates/header');
        $this->load->view('knowledge_validate/show', $data);
        $this->load->view('templates/footer');
    } 
    
    public function show_explicit($id)
    {
        $data['knowledge'] = $this->ExplicitKnowledgeModel->getById($id)->row();

        $this->load->view('templates/header');
        $this->load->view('knowledge_validate/show', $data);
        $this->load->view('templates/footer');
    }     

    public function accept_by_admin($id)
    {
        $data = array(
            'status' => 1,
            'updater_id' => $this->session->userdata('id'),
            'updated_at' => date("Y-m-d H-i-s")
        );
        
        $knowledge = $this->HelperModel->getWithUnionById($id)->row();

        if ($knowledge->is_tacit == 1) {            
            $this->TacitKnowledgeModel->update($data, $id);
        }else{
            $this->ExplicitKnowledgeModel->update($data, $id);
        }
        $this->session->set_flashdata('success', "Success accept Knowledge!");
        return redirect(base_url('knowledge_validate'));
    }

    public function reject_by_admin($id)
    {
        $data = array(
            'status' => 3,
            'updater_id' => $this->session->userdata('id'),
            'updated_at' => date("Y-m-d H-i-s")
        );
        $knowledge = $this->HelperModel->getWithUnionById($id)->row();

        if ($knowledge->is_tacit == 1) {            
            $this->TacitKnowledgeModel->update($data, $id);
        }else{
            $this->ExplicitKnowledgeModel->update($data, $id);
        }
        $this->session->set_flashdata('warning', "This Knowledge has been rejected!");
        return redirect(base_url('knowledge_validate'));
    }    

    public function accept_by_kasi($id)
    {
        $data = array(
            'status' => 4,
            'updater_id' => $this->session->userdata('id'),
            'updated_at' => date("Y-m-d H-i-s")
        );
        $knowledge = $this->HelperModel->getWithUnionByIdKasi($id)->row();

        $user_id = $this->session->userdata('id');
        if ($knowledge->is_visible_to_visitor == 1) {
            $users = $this->UserModel->getWithoutMe($user_id)->result();
        }else{
            $users = $this->UserModel->getWithoutMeAndExlude($user_id)->result();
        }
        
        $created_at = date("Y-m-d H-i-s");
        foreach ($users as $key => $value) {
            $notif = array(
                'user_id' => $value->id,
                'knowledge_id' => $knowledge->id,
                'title' => $knowledge->title,
                'content' => $knowledge->content,
                'is_tacit' => $knowledge->is_tacit,
                'is_read' => 0,
                'created_at' => $created_at
            );
            $this->NotificationModel->insert($notif);
        }

        if ($knowledge->is_tacit == 1) {                
            $this->TacitKnowledgeModel->update($data, $id);
        }else{
            $this->ExplicitKnowledgeModel->update($data, $id);
        }

        $this->session->set_flashdata('success', "Success accept Knowledge!");
        return redirect(base_url('knowledge_validate'));
    }

    public function reject_by_kasi($id)
    {
        $data = array(
            'status' => 5,
            'updater_id' => $this->session->userdata('id'),
            'updated_at' => date("Y-m-d H-i-s")
        );
        $knowledge = $this->HelperModel->getWithUnionById($id)->row();
        if ($knowledge->is_tacit == 1) {            
            $this->TacitKnowledgeModel->update($data, $id);
        }else{
            $this->ExplicitKnowledgeModel->update($data, $id);
        }
        $this->session->set_flashdata('warning', "This Knowledge has been rejected!");
        return redirect(base_url('knowledge_validate'));
    }        
}
