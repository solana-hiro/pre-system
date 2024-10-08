<?php

namespace App\Repositories\Analyse;

interface AnalyseRepositoryInterface
{
    /* 検索用 */
    public function search($params);

    /* CSVダウンロード用 */
    public function csv($params);
}
