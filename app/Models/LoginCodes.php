<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginCodes extends Model
{
    use HasFactory;
    protected $guarded =[];
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'code_id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'login_codes';
}
