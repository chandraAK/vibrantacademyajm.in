<?php

namespace App\Models;

use CodeIgniter\Model;

class LeadModel extends Model
{
    protected $table            = 'leads';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 'mobile', 'address', 'class', 'school_name', 
        'ip_address', 'user_agent', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'name'   => 'required|min_length[3]|max_length[100]',
        'mobile' => 'required|min_length[10]|max_length[15]',
        'class'  => 'required',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Name is required',
            'min_length' => 'Name must be at least 3 characters',
        ],
        'mobile' => [
            'required'   => 'Mobile number is required',
            'min_length' => 'Invalid mobile number',
        ],
        'class' => [
            'required' => 'Class/Course selection is required',
        ],
    ];

    public function getTodayCount()
    {
        return $this->where('DATE(created_at)', date('Y-m-d'))->countAllResults();
    }

    public function getWeekCount()
    {
        return $this->where('created_at >=', date('Y-m-d', strtotime('-7 days')))->countAllResults();
    }

    public function getMonthCount()
    {
        return $this->where('MONTH(created_at)', date('m'))
                    ->where('YEAR(created_at)', date('Y'))
                    ->countAllResults();
    }

    public function getRecentLeads($limit = 10)
    {
        return $this->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->find();
    }

    public function getFilteredLeads($search = null, $class = null, $date = null)
    {
        $builder = $this->builder();

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('name', $search)
                    ->orLike('mobile', $search)
                    ->orLike('school_name', $search)
                    ->groupEnd();
        }

        if (!empty($class)) {
            $builder->where('class', $class);
        }

        if (!empty($date)) {
            $builder->where('DATE(created_at)', $date);
        }

        return $builder->orderBy('created_at', 'DESC')->get()->getResultArray();
    }
}