<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CommonImport implements ToArray, WithHeadingRow
{
    /**
     * @param array $row
     * @return array
     */
    public function array(array $rows)
    {
        return $rows;
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'SHIFT-JIS'
        ];
    }
}
