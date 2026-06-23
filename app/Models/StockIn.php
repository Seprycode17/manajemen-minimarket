<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database secara eksplisit (opsional)
    protected $table = 'stock_ins';

    protected $fillable = ['item_id', 'supplier_id', 'qty', 'date'];

    // Relasi ke tabel Item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Relasi ke tabel Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}