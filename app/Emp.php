<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Emp extends Model {
    protected $fillable = [
        'id', 'name', 'age', 'skills', 'address', 'designation'
    ];
}
