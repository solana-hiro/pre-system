<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Style;

class MtCustomerExport implements FromView, WithDefaultStyles
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
        return [
            'font' => [
                'name'   => 'YuGothic',
                'size' => 11,
            ],
        ];
    }
}
?>
