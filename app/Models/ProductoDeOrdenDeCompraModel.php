<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoDeOrdenDeCompraModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'productoordencompra';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['nombre', 'precio_estimado', 'rubro_codigo', 'orden_id']; // Define the allowed fields

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

    public function rubro()
    {
        return $this->belongsTo('App\Models\RubroModel', 'rubro_codigo', 'codigo');
    }
    
    public function ordenDeCompra()
    {
        return $this->belongsTo('App\Models\OrdenDeCompraModel', 'orden_id', 'id');
    }
}
