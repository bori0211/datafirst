#!/usr/bin/php
<?php

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$selected_file = "./excel_sample2.xlsx";
$file_type = pathinfo($selected_file, PATHINFO_EXTENSION);

echo $file_type;

if (strtolower($file_type) == 'xls') {
	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
} else if (strtolower($file_type) == 'xlsx') {
	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
} else {
	echo '처리할 수 있는 엑셀 파일이 아닙니다';
	exit;
}

echo "123";

$spreadsheet = $reader->load($selected_file);	
//$spreadData = $spreadsheet->getActiveSheet()->toArray();


$worksheet = $spreadsheet->getActiveSheet();



$prev_cht_num = "";
$prev_test_date = "";

foreach ($worksheet->getRowIterator() as $RowNum => $row) {
    
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false); // This loops through all cells,
                                                       //    even if a cell value is not set.
                                                       // For 'TRUE', we loop through cells
                                                       //    only when their value is set.
                                                       // If this method is not called,
                                                       //    the default value is 'false'.
    echo $RowNum . "\n";
    
    
	//$cht_num = $Row[5];
	//$test_date = $Row[6];
	//$test_item_code = $Row[8];
	//$result = $Row[11];
    
    $result = array("RowNum" => $RowNum);
    
    foreach ($cellIterator as $CellNum => $cell) {
        
        echo $CellNum . ":";
        
        echo $cell->isMergeRangeValueCell() . ":";
        
        //$cell->isMergeRangeValueCell();
        
        //var_dump($cell);
        
        if ($CellNum == "B") {
        	//echo $cell->getValue() . ":";
        	if ($cell->isMergeRangeValueCell()) {
        		$prev_cht_num = (String)$cell->getValue();
        	}
        	
        	$result["cht_num"] = $prev_cht_num;
        }
        
        if ($CellNum == "C") {
        	//echo $cell->getValue() . ":";
        	if ($cell->isMergeRangeValueCell()) {
        		$prev_test_date = (String)$cell->getValue();
        	}
        	
        	$result["test_date"] = $prev_test_date;
        }
        
        if ($CellNum == "F") {
        	//echo $cell->getValue() . ":";
        	$result["test_item_code"] = (String)$cell->getValue();
        }
        
        if ($CellNum == "G") {
        	//echo $cell->getValue() . ":";
        	$result["result"] = (String)$cell->getValue();
        }
    }
    
    var_dump($result);
    
    //list("test_date" => $scheme, "cht_num" => $host, "test_item_code" => $path, "result" => $result) = $result;
    
    //var_dump($scheme);
}


//var_dump($spreadData);


//var_dump(count($spreadData));

/*
for ($i = 0; $i < count($spreadData); $i++) {
	var_dump($spreadData[$i]);
}
*/


/*
				foreach ($spreadData as $RowNum => $Row) {
					//if ($RowNum <= 2) continue; // Title
					//if ($RowNum > 3) echo ', ';
					
					//var_dump($Row);
					
					//echo $Row;
					//echo '{"RowNum": ' . $RowNum . ', "row": ' . json_encode(get_pat_test_result_row($mysqli, $RowNum, $Row)) . '}';
				}
*/



/*
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');
*/
?>
