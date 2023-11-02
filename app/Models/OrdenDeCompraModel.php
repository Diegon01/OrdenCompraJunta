<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdenDeCompraModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ordenesdecompra';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['posibles_proveedores', 'descripcion', 'solicitante_id', 'estado', 'Contador_Aprobado', 'Presidente_Aprobado', 'Secretario_Aprobado', 'licitacion', 'Presidente_Autorizado', 'Ofertas_Ingresadas'];

    // Dates
    protected $useTimestamps = true;
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
        return $this->hasMany('App\Models\ProductoDeOrdenDeCompraModel', 'orden_id', 'id');
    }

    public function proveedores()
    {
        return $this->belongsToMany(ProveedorModel::class, 'Enlace_OrdenesProveedores', 'orden_id', 'proveedor_id');
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'solicitante_id', 'id');
    }
}
