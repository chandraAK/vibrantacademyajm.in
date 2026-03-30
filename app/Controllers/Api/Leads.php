<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\LeadModel;

class Leads extends BaseController
{
    protected $leadModel;

    public function __construct()
    {
        $this->leadModel = new LeadModel();
    }

    public function create()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'name' => [
                'rules'  => 'required|min_length[3]|max_length[100]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required'    => 'Name is required',
                    'min_length'  => 'Name must be at least 3 characters',
                    'regex_match' => 'Name can only contain letters and spaces',
                ],
            ],
            'mobile' => [
                'rules'  => 'required|regex_match[/^[6-9]\d{9}$/]',
                'errors' => [
                    'required'    => 'Mobile number is required',
                    'regex_match' => 'Please enter a valid 10-digit Indian mobile number',
                ],
            ],
            'address' => [
                'rules'  => 'permit_empty|max_length[500]',
            ],
            'class' => [
                'rules'  => 'required|in_list[1,2,3,4,5,6,7,8,9,10,11,12,NEET,IIT-JEE,Others]',
            ],
            'school_name' => [
                'rules'  => 'permit_empty|max_length[100]',
            ],
        ];

        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $data = [
            'name'        => esc($this->request->getPost('name')),
            'mobile'      => esc($this->request->getPost('mobile')),
            'address'     => esc($this->request->getPost('address')),
            'class'       => esc($this->request->getPost('class')),
            'school_name' => esc($this->request->getPost('school_name')),
            'ip_address'  => $this->request->getIPAddress(),
            'user_agent'  => $this->request->getUserAgent()->getAgentString(),
        ];

        try {
            $this->leadModel->insert($data);
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Thank you! Your inquiry has been submitted successfully.',
            ]);
        } catch (\Exception $e) {
            log_message('error', 'API Lead submission failed: ' . $e->getMessage());
            
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ]);
        }
    }
}