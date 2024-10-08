<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtColorPattern extends Model
{
    use HasFactory;

    /**
     * カラーパターンマスタ
     * @var string
     */
    protected $table = 'mt_color_patterns';

    /**
     * @return BelongsTo
     */
    public function mtColor1()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_1');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor2()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_2');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor3()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_3');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor4()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_4');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor5()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_5');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor6()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_6');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor7()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_7');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor8()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_8');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor9()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_9');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor10()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_10');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor11()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_11');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor12()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_12');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor13()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_13');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor14()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_14');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor15()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_15');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor16()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_16');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor17()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_17');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor18()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_18');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor19()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_19');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor20()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id_20');
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
        return self::query()->select('color_pattern_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('color_pattern_cd', $code)->first();
    }

}
