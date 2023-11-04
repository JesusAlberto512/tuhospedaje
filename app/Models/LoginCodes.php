<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginCodes extends Model
{
    use HasFactory;
    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [ 'code_id' ];

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

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['verification_code'];

    public static function verifyCode($phone, $code, $id): bool
    {
        $loginCode = self::where([
            ['code_id', '=', $id],
            ['phone', '=', $phone],
            ['verification_code', '=', $code],
        ]);

        if($loginCode->count()){
            return true;
        }
        return false;
    }
}
