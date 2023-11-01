<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ofertas';
    protected $primaryKey       = 'producto_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['producto_id', 'proveedor_id', 'precio_oferta', 'notas'];

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

    public function productoordencompra()
    {
        return $this->belongsTo('App\Models\ProductoDeOrdenDeCompraModel', 'producto_id', 'id');
    }
}
