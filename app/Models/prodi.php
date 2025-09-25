<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prodi extends Model
{
   protected $fillable = ['nama', 'kode', 'fakultas_id'];
        
        
        public function fakultas()
        {
            return $this ->belongsTo(
                fakultas::class, 'fakultas_id', 'id'
            );
        }

    
}
