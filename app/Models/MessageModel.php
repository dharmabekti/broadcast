<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = 'messages';
    protected $allowedFields = ['message', 'status'];
    protected $returnType = 'object';

    public function getData($id = null)
    {
        if ($id) {
            return $this->where(['id' => $id])->first();
        }

        return $this->findAll();
    }

    public function inactivatedAll()
    {
        return $this->db->table($this->table)->update(['status' => 0]);
    }

    public function getDataActive()
    {
        return $this->where(['status' => 1])->first();
    }
}
