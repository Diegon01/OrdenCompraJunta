<?php

namespace App\Models;

use CodeIgniter\Model;

class RubroModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'rubros';
    protected $primaryKey       = 'codigo';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['codigo', 'nombre', 'saldo']; // Define the allowed fields

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function productosDeOrdenDeCompra()
    {
        return $this->hasMany('App\Models\ProductoDeOrdenDeCompraModel', 'rubro_codigo', 'codigo');
    }
}
