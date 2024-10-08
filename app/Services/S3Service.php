<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

/**
 * S3関連 サービスクラス
 */
class S3Service
{
    /**
     * S3 アップロードサービス
     * @param $param
     * @param $keyId
     * @param $info
     * @return $rows
     */
    public function upload($param, $keyId, $info)
    {
        //形式:{テーブル名}/{レコードを一意に判断するkey}/{カラム名}/ファイル名
        $result = null;
        $tableName = $info['table'];
        foreach ($param as $key => $value) {
            $fileName = $param[$key]->getClientOriginalName();
            $path = $tableName . '/' . $keyId . '/' . $key;
            if (app()->isLocal() || app()->runningUnitTests()) {
                $result[] = Storage::disk('public')->putFileAs($path, $value, $fileName);
            } else {
                $result[] = Storage::disk('s3')->putFileAs($path, $value, $fileName);
            }
        }
        return $result;
    }

    /**
     * S3 コピーサービス
     * @param $oldPath
     * @param $newPath
     * @return $result
     */
    public function copy($oldPath, $newPath)
    {
        if (app()->isLocal()) {
            $result = Storage::disk('public')->copy($oldPath, $newPath);
            return $result;
        }
        $result = Storage::disk('s3')->copy($oldPath, $newPath);
        return $result;
    }

    /**
     * S3 ディレクトリ単位での削除
     * @param $oldPath
     * @param $newPath
     * @return $result
     */
    public function deleteDirectory($param, $keyId, $info)
    {
        $result = null;
        $tableName = $info['table'];
        foreach ($param as $key => $value) {
            $path = $tableName . '/' . $keyId . '/' . $key;
            if (app()->isLocal() || app()->runningUnitTests()) {
                $result[] = Storage::disk('public')->deleteDirectory($path);
            } else {
                $result[] = Storage::disk('s3')->deleteDirectory($path);
            }
        }
        return $result;
    }
}
