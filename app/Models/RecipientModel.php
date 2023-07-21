<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipientModel extends Model
{
    // Nama Tabel
    protected $table = 'recipients';
    protected $allowedFields = ['name', 'number', 'country_code'];
    protected $returnType = 'object';

    public function getData($id = null)
    {
        if ($id) {
            return $this->where(['id' => $id])->first();
        }

        return $this->findAll();
    }
}
