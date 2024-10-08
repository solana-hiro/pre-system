<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MtUser extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * ユーザマスタ
     * @var string
     */
    protected $table = 'mt_users';

    protected $guard = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_cd', 'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @return BelongsTo
     */
    public function defDepartment()
    {
        return $this->belongsTo(DefDepartment::class, 'id', 'def_department_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }

    /**
     * @return HasMany
     */
    public function mtUser1Security()
    {
        return $this->belongsTo(MtUser1Security::class, 'mt_user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function mtUser2Security()
    {
        return $this->belongsTo(MtUser2Security::class, 'mt_user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function mtUser3Security()
    {
        return $this->belongsTo(MtUser3Security::class, 'mt_user_id', 'id');
    }

    /**
     * IDによるCode取得
     * @param $id
     * @return $model
     */
    static public function getCodeById($id) {
        return self::query()->select('user_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('user_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $model
     */
    static public function getNameById($id)
    {
        return self::query()->select('user_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @return $model
     */
    static public function getNameByCode($code)
    {
        return self::query()->select('user_name')->where('user_cd', $code)->first();
    }

}
