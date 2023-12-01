<?php

/**
 * Settings Model
 *
 * Settings Model manages Settings operation.
 *
 * @category   Settings
 * @package    Tuhospedaje
 * @author     Techvillage Dev Team
 * @copyright  2020 Techvillage
 * @license
 * @version    2.7
 * @link       http://techvill.net
 * @since      Version 1.3
 * @deprecated None
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Settings extends Model
{
    protected $table    = 'settings';
    public $timestamps  = false;

    protected $fillable = ['value'];

    public static function getAll()
    {
        $settings = parent::all();
        foreach ($settings as $setting) {
            $cacheKey = config('cache.prefix') . '.settings.' . $setting->name;
            Cache::put($cacheKey, $setting->value, 30 * 86400);
        }
        return $settings;
    }
}
