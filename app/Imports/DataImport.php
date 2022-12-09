<?php

namespace App\Imports;

use App\Models\RawData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    public function model(array $row) {
        return new RawData([
           'username' => isset($row['username']) ? trim($row['username']) : '',
           'score' => isset($row['score']) ? trim($row['score']) : '',
           'at' => isset($row['at']) ? trim($row['at']) : '',
           'content' => isset($row['content']) ? trim($row['content']) : '',
        ]);
    }
}
