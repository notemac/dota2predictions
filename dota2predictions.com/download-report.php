<?php

require_once './db.php';
require 'vendor/autoload.php';


function getScorecard($db)
{
    $query = "SELECT score FROM `factor`";
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
    $scorecard = [];
    $rows = [];
    for ($i = 0; $i < 6; ++$i) { // 6 факторов
        // фактор состоит из 5 категорий (интервалов)
        $rows[] = mysqli_fetch_assoc($result)['score'];
        $rows[] = mysqli_fetch_assoc($result)['score'];
        $rows[] = mysqli_fetch_assoc($result)['score'];
        $rows[] = mysqli_fetch_assoc($result)['score'];
        $rows[] = mysqli_fetch_assoc($result)['score'];
        // меняем порядок факторов
        if ($i == 0) $scorecard['counters'] = [$rows[3], $rows[1], $rows[0], $rows[2], $rows[4]];
        else if ($i == 1) $scorecard['death_l25'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        else if ($i == 2) $scorecard['hwr_avg'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        else if ($i == 3) $scorecard['lm_avg'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        else if ($i == 4) $scorecard['pwinrate'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        else if ($i == 5) $scorecard['winrate6'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        // обнуляем rows
        $rows = [];
    }
    // Константа
    $scorecard['const'] = mysqli_fetch_assoc($result)['score'];
    // Параметры масштабирования
    $query = "SELECT score, odds, pdo FROM `model`";
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
    $params = mysqli_fetch_assoc($result);
    $scorecard['score'] = $params['score'];
    $scorecard['odds'] = $params['odds'];
    $scorecard['pdo'] = $params['pdo'];
    return $scorecard;
}

function createReport($scorecard) {
    $file = 'report.xlsx';
    $spreadsheet = PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $worksheet = $spreadsheet->getActiveSheet();
    // https://phpspreadsheet.readthedocs.io/en/latest/topics/accessing-cells/
    $worksheet->getCell('B1')->setValue('Дата создания: '.date('D M d, Y G:i'));
    $worksheet->getCell('H4')->setValue($scorecard['score']);
    $worksheet->getCell('I4')->setValue($scorecard['odds']);
    $worksheet->getCell('J4')->setValue($scorecard['pdo']);
    $worksheet->getCell('J10')->setValue($scorecard['const']);
    $worksheet->fromArray(array_chunk($scorecard['counters'], 1), NULL, 'J11' );
    $worksheet->fromArray(array_chunk($scorecard['death_l25'], 1), NULL, 'J16');
    $worksheet->fromArray(array_chunk($scorecard['hwr_avg'], 1), NULL, 'J21');
    $worksheet->fromArray(array_chunk($scorecard['lm_avg'], 1), NULL, 'J26');
    $worksheet->fromArray(array_chunk($scorecard['pwinrate'], 1), NULL, 'J31');
    $worksheet->fromArray(array_chunk($scorecard['winrate6'], 1), NULL, 'J36');
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save($file);
    return $file;
}

$db = db_connect();
$file = createReport(getScorecard($db));
db_close($db);

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}


// $file = 'report.xlsx';






// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// $spreadsheet = new Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();
// $sheet->setCellValue('A1', 'Hello World !');

// $arrayData = [
//     [NULL, 2010, 2011, 2012],
//     ['Q1',   12,   15,   21],
//     ['Q2',   56,   73,   86],
//     ['Q3',   52,   61,   69],
//     ['Q4',   30,   32,    0],
// ];
// $sheet->fromArray(
//         $arrayData,  // The data to set
//         NULL,        // Array values with this value will not be set
//         'C3'         // Top left coordinate of the worksheet range where
//         //    we want to set these values (default is A1)
//     );

// $writer = new Xlsx($spreadsheet);
// $writer->save('hello world.xlsx');

?>