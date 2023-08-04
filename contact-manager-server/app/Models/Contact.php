<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'phone',
        'latitude',
        'longtude',
        'user_id',
    ];

    protected $guarded = [];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
