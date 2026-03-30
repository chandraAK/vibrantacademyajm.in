<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LeadModel;

class Dashboard extends BaseController
{
    protected $leadModel;

    public function __construct()
    {
        $this->leadModel = new LeadModel();
    }

    public function index()
    {
        $data = [
            'title'          => 'Dashboard - Vibrant Academy Admin',
            'total_leads'    => $this->leadModel->countAll(),
            'today_leads'    => $this->leadModel->getTodayCount(),
            'week_leads'     => $this->leadModel->getWeekCount(),
            'month_leads'    => $this->leadModel->getMonthCount(),
            'recent_leads'   => $this->leadModel->getRecentLeads(10),
        ];

        return view('admin/dashboard', $data);
    }
}