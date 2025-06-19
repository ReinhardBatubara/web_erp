<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->excel->setActiveSheetIndex(0);

$coloum = array(
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
    'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB',
    'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN',
    'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
    'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL',
    'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX',
    'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ',
    'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV'
);

$this->excel->getActiveSheet()->setTitle('MODEL');
$this->excel->getActiveSheet()->setCellValue('A1', "");
$this->excel->getActiveSheet()->setCellValue('A2', "");
$this->excel->getActiveSheet()->setCellValue('A3', "");
$this->excel->getActiveSheet()->mergeCells('A1:F1');
$this->excel->getActiveSheet()->mergeCells('A2:F2');
$this->excel->getActiveSheet()->mergeCells('A3:F3');
$col = 0;
$row = 5;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'No');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(4);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'PICTURE');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(10);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'ITEM CODE');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(15);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'ITEM NAME');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(28);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'ITEM SIZE (mm)');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col + 2] . "" . $row);

$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . ($row + 1), 'W');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(5);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . ($row + 1), 'D');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(5);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . ($row + 1), 'H');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(5);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'PRICE');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(18);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'CARVER');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(18);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));


$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'REMARK');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(18);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));


$no = 1;

$row+=2;

foreach ($item as $result) {

    $col = 0;
    $this->excel->getActiveSheet()->getRowDimension($row)->setRowHeight(50);
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $no++);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

    $col++;
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    if ($result->images != "") {
        $path = 'files/model/' . $result->images;
        $objDrawing->setPath($path);
        $objDrawing->setWidthAndHeight(50, 50);
        $objDrawing->setResizeProportional(true);
        $objDrawing->setOffsetX(10);
        $objDrawing->setOffsetY(10);
        $objDrawing->setCoordinates($coloum[$col] . "" . $row);
        $objDrawing->setWorksheet($this->excel->getActiveSheet());
    }

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->code);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setAutoSize(true);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->name);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setAutoSize(true);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->itemsize_mm_w);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->itemsize_mm_d);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->itemsize_mm_h);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->price);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);

    
    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->carver_name);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
    
    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->remark);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
    
    $row++;
}

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

$this->excel->getActiveSheet()->getStyle("A5:" . $coloum[$col] . "" . $row)->applyFromArray($styleArray);


$filename = "file.xls";
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
$objWriter->save('php://output');
