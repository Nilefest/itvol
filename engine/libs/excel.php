<?php

class excelLibrary {
    
    private $phpExcel;
    private $activeSheet;
    private $objectWrite;
    
    function __construct(){
        include_once 'excel/PHPExcel.php';
        $this->phpExcel = new PHPExcel();
    }
    
    public function readFileToArray($path = false){
        if(!file_exists($path)) return false;
        
        $excel = PHPExcel_IOFactory::load($path);
        
        $lists = array();
        foreach($excel->getWorksheetIterator() as $worksheet) {
            $lists[] = $worksheet->toArray();
        }
        return $lists[0];
    }
    
    public function addSheet($title = 'my_title'){
        $this->phpExcel->setActiveSheetIndex(0);
        $this->activeSheet = $this->phpExcel->getActiveSheet();
        $this->activeSheet->setTitle($title);
    }
    
    public function fillSheet($array = array()){
        $col_width = array();
        $n_row = 1;
        foreach($array as $row){
            $n_col = "A";
            foreach($row as $cell){
                $this->activeSheet->setCellValue($n_col.$n_row, $cell);
                if(!isset($col_width[$n_col])) $col_width[$n_col] = 0;
                if($col_width[$n_col] < strlen($cell)){
                    $col_width[$n_col] = (strlen($cell) < 60 ? strlen($cell) : $col_width[$n_col]);
                    if($col_width[$n_col] < 5) $col_width[$n_col] = 5;
                    $this->activeSheet->getColumnDimension($n_col)->setWidth($col_width[$n_col] * 0.7);
                }
                $n_col++;
            }
            $n_row++;
        }
    }
    
    public function downloadExcel($name = 'export_excel'){
        include_once 'excel/PhpExcel/Writer/Excel5.php';
        //include("PhpExcel/Writer/Excel5.php");
        $this->objectWrite = new PHPExcel_Writer_Excel5($this->phpExcel);
        header('Content-Type:  application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
        header('Cache-Control: max-age=0');
        $this->objectWrite->save('php://output');
    }

    public function getExcelByArr($arr = array(array()), $file_name = 'noname', $title = 'page'){
        $this->addSheet($title);
        $this->fillSheet($arr);
        $this->downloadExcel($file_name);
    }
    
}