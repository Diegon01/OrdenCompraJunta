<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdenProveedorModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'Enlace_OrdenesProveedores';
    protected $primaryKey       = 'proveedor_id'; // Clave principal compuesta
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['proveedor_id', 'orden_id']; // Define the allowed fields

    
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

    public function proveedor()
    {
        return $this->belongsTo('App\Models\ProveedorModel', 'proveedor_id', 'id');
    }

    public function ordendecompra()
    {
        return $this->belongsTo('App\Models\OrdenDeCompraModel', 'orden_id', 'id');
    }
}
