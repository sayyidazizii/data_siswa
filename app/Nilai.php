<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $connection = 'pgsql_external';
    protected $table = 'nilais';
    protected $primaryKey = 'id';
    protected $fillable = ['nis','nilai'];
}
