<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// $fileName = 'teste.xlsx';
// $fileName = "teste3.csv";
$fileName = "https://cdluploadhml2.blob.core.windows.net/upload/importacoes/IMPORTACAO_1_PRODUTOR_teste.xlsx";
$fileExtension = '';
$fileRead = [];

function GetFileExtension (string $name): string
{
    $nameArray = explode(".", $name);

    if ($nameArray[count($nameArray) - 1] == 'xlsx' || $nameArray[count($nameArray) - 1] == 'xls') {
        return 'xlsx';
    } else if ($nameArray[count($nameArray) - 1] == 'csv') {
        return 'csv';
    } else return '';
}

$fileExtension = GetFileExtension($fileName);

if ($fileExtension === 'xlsx') {
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadSheet = $reader->load($fileName);
    $spreadSheet = $spreadSheet->getActiveSheet()->toArray();

    foreach ($spreadSheet as $line) {
        if(count(array_filter($line)) > 0) {
            array_push($fileRead, $line);
        }
    }

    // TODO retornar o &fileRead
} else if ($fileExtension === 'csv') {
    if (($handle = fopen($fileName, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $line = explode(";", $data[0]);
            // $line = explode(",", $data[0]);

            if(count($line) > 0 && $line[0] !== '') {
                array_push($fileRead, $line);
            }
        }
        fclose($handle);
        $sss  = $fileRead[5000];
        $sddss  = $fileRead[5000];

        // TODO retornar o &fileRead
    }
}
