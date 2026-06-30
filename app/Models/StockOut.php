<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    use HasFactory;

    protected $table = 'stock_outs';

    protected $fillable = ['item_id', 'qty', 'date', 'notes'];

    // Relasi ke tabel Item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}