<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Todo extends Model
{
    protected $table = "todos";
    use HasFactory;

    protected $fillable =
     ['user_id',
     'title',
     'description',
     'status'];
}
