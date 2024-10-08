<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class CommonExport extends DefaultValueBinder implements WithCustomValueBinder, FromView, WithDefaultStyles, WithTitle, ShouldAutoSize
{
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return $this->view;
    }

    /**
     * スタイルを設定する
     * @return array
     */
    public function defaultStyles(Style $defaultStyle)
    {
        // Or return the styles array
        return [
            'font' => [
                'name'   => 'YuGothic',
                'size' => 11,
            ],
        ];
    }

    /**
     * シート名を設定する
     * @return string
     */
    public function title(): string
    {
        return '一覧表';
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            //ここに追加する
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}
