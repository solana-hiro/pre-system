<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtSizePattern extends Model
{
    use HasFactory;

    /**
     * サイズパターンマスタ
     * @var string
     */
    protected $table = 'mt_size_patterns';

    /**
     * @return BelongsTo
     */
    public function mtSize1()
    {
        return $this->belongsTo(MtSize::class, 'id', 'mt_size_id_1');
    }

    /**
     * @return BelongsTo
     */
    public function mtSize2()
    {
        return $this->belongsTo(MtSize::class, 'id', 'mt_size_id_2');
    }

    /**
     * @return BelongsTo
     */
    public function mtSize3()
    {
        return $this->belongsTo(MtSize::class, 'id', 'mt_size_id_3');
    }

    /**
     * @return BelongsTo
     */
    public function mtSize4()
    {
        return $this->belongsTo(MtSize::class, 'id', 'mt_size_id_4');
    }

    /**
     * @return BelongsTo
     */
    public function mtSize5()
    {
        return $this->belongsTo(MtSize::class, 'id', 'mt_size_id_5');
    }

    /**
     * @return BelongsTo
     */
    public function mtSize6()
    {
        return $this->belongsTo(MtSize::class, 'id', 'mt_size_id_6');
    }

    /**
     * @return BelongsTo
     */
    public function mtSize7()
    {
        return $this->belongsTo(MtSize::class, 'id', 'mt_size_id_7');
    }

    /**
     * @return BelongsTo
     */
    public function mtSize8()
    {
        return $this->belongsTo(MtSize::class, 'id', 'mt_size_id_8');
    }

    /**
     * @return BelongsTo
     */
    public function mtSize9()
    {
        return $this->belongsTo(MtSize::class, 'id', 'mt_size_id_9');
    }

    /**
     * @return BelongsTo
     */
    public function mtSize10()
    {
        return $this->belongsTo(MtSize::class, 'id', 'mt_size_id_10');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }


    /**
     * IDによるCode取得
     * @param $id
     * @return $model
     */
    static public function getCodeById($id)
    {
        return self::query()->select('size_pattern_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('size_pattern_cd', $code)->first();
    }
}
