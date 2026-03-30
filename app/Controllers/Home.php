<?php

namespace App\Controllers;

use App\Models\LeadModel;

class Home extends BaseController
{
    protected $leadModel;

    public function __construct()
    {
        $this->leadModel = new LeadModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Vibrant Academy - Best Coaching Institute in Ajmer',
            'meta_desc'   => 'Vibrant Academy offers top coaching for Classes 1-12, NEET, IIT-JEE preparation in Ajmer. 13+ years of excellence in education.',
            'institute'   => [
                'name'    => 'Vibrant Academy',
                'address' => 'P21, Shakti Nagar, Subash Nagar, Ajmer - 305001',
                'phone'   => '9983537405',
                'email'   => 'support@vibrantacademyajm.in',
                'experience' => '13+ Years',
            ],
            'courses' => [
                ['icon' => 'fa-graduation-cap', 'title' => 'Classes 1-12', 'desc' => 'Comprehensive coaching for all subjects'],
                ['icon' => 'fa-stethoscope', 'title' => 'NEET Preparation', 'desc' => 'Medical entrance exam preparation'],
                ['icon' => 'fa-atom', 'title' => 'IIT-JEE Preparation', 'desc' => 'Engineering entrance exam coaching'],
                ['icon' => 'fa-trophy', 'title' => 'Competitive Exams', 'desc' => 'Olympiads, NTSE, and other exams'],
            ],
            'why_us' => [
                ['icon' => 'fa-chalkboard-teacher', 'title' => 'Experienced Faculty', 'desc' => 'Expert teachers with proven track record'],
                ['icon' => 'fa-chart-line', 'title' => 'Proven Results', 'desc' => 'Consistent top ranks in competitive exams'],
                ['icon' => 'fa-user-friends', 'title' => 'Personalized Attention', 'desc' => 'Small batch sizes for individual focus'],
                ['icon' => 'fa-clipboard-check', 'title' => 'Regular Tests', 'desc' => 'Weekly assessments and progress tracking'],
            ],
        ];

        return view('frontend/home', $data);
    }

    public function submitInquiry()
    {
        if (!$this->request->is('post')) {
            return redirect()->to('/');
        }

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
                'errors' => [
                    'max_length' => 'Address cannot exceed 500 characters',
                ],
            ],
            'class' => [
                'rules'  => 'required|in_list[1,2,3,4,5,6,7,8,9,10,11,12,NEET,IIT-JEE,Others]',
                'errors' => [
                    'required' => 'Please select a class/course',
                    'in_list'  => 'Please select a valid class/course',
                ],
            ],
            'school_name' => [
                'rules'  => 'permit_empty|max_length[100]',
                'errors' => [
                    'max_length' => 'School name cannot exceed 100 characters',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $this->validator->getErrors(),
                'token'   => csrf_hash(),
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
                'message' => 'Thank you! Your inquiry has been submitted successfully. We will contact you soon.',
                'token'   => csrf_hash(),
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Lead submission failed: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
                'token'   => csrf_hash(),
            ]);
        }
    }
}