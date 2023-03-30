<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restourant extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'email',
        'password',
        'image',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
