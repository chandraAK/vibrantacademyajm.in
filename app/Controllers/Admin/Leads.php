<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LeadModel;

class Leads extends BaseController
{
    protected $leadModel;

    public function __construct()
    {
        $this->leadModel = new LeadModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $class  = $this->request->getGet('class');
        $date   = $this->request->getGet('date');

        $data = [
            'title'      => 'Manage Leads - Vibrant Academy Admin',
            'leads'      => $this->leadModel->getFilteredLeads($search, $class, $date),
            'search'     => $search,
            'class'      => $class,
            'date'       => $date,
            'class_list' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', 'NEET', 'IIT-JEE', 'Others'],
        ];

        return view('admin/leads/index', $data);
    }

    public function view($id)
    {
        $lead = $this->leadModel->find($id);

        if (!$lead) {
            return redirect()->to('admin/leads')->with('error', 'Lead not found');
        }

        $data = [
            'title' => 'View Lead - Vibrant Academy Admin',
            'lead'  => $lead,
        ];

        return view('admin/leads/view', $data);
    }

    public function delete($id)
    {
        if (!$this->leadModel->find($id)) {
            return redirect()->to('admin/leads')->with('error', 'Lead not found');
        }

        $this->leadModel->delete($id);
        return redirect()->to('admin/leads')->with('success', 'Lead deleted successfully');
    }

    public function bulkDelete()
    {
        $ids = $this->request->getPost('ids');
        
        if (empty($ids)) {
            return redirect()->to('admin/leads')->with('error', 'No leads selected');
        }

        $this->leadModel->whereIn('id', $ids)->delete();
        return redirect()->to('admin/leads')->with('success', count($ids) . ' leads deleted successfully');
    }

    public function export()
    {
        $leads = $this->leadModel->findAll();

        $filename = 'leads_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        
        // CSV Headers
        fputcsv($output, ['ID', 'Name', 'Mobile', 'Address', 'Class/Course', 'School Name', 'IP Address', 'Created At']);

        foreach ($leads as $lead) {
            fputcsv($output, [
                $lead['id'],
                $lead['name'],
                $lead['mobile'],
                $lead['address'],
                $lead['class'],
                $lead['school_name'],
                $lead['ip_address'],
                $lead['created_at'],
            ]);
        }

        fclose($output);
        exit;
    }
}