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
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'ITEM CODE');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(10);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'ORIGINAL CODE');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(13);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'ITEM NAME');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(18);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'CATEGORY');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(14);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'FINISHING');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(14);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'MATERIAL');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(15);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'TOP');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(15);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'MIROR/GLASS');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(14);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));


$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'FOAM');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(12);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'INTERLINER');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(12);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'FABRIC');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(12);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'FURING');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(12);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col] . "" . ($row + 1));

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'ACCESSORIES');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(12);
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
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'ITEM SIZE (inc)');
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
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'PACKAGING SIZE 1(mm)');
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
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'PACKAGING SIZE 1(inc)');
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
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'PACKAGING SIZE 2(mm)');
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
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'PACKAGING SIZE 2(inc)');
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
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'SEAT SIZE(mm)');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ':' . $coloum[$col + 3] . "" . $row);


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
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . ($row + 1), 'Arm Height');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(8);


$no = 1;

$row++;

foreach ($model as $result) {
    $row++;

    $col = 0;
    $this->excel->getActiveSheet()->getRowDimension($row)->setRowHeight(11);
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $no++);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->code);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->originalcode);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->name);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->modelcategory);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->finishing);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->material);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->top);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->mirrorglass);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->foam);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->interliner);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->fabric);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->furring);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->accessories);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->itemsize_mm_w);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->itemsize_mm_d);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->itemsize_mm_h);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->itemsize_inc_w);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->itemsize_inc_d);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->itemsize_inc_h);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->packagingsize_mm_w);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->packagingsize_mm_d);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->packagingsize_mm_h);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->packagingsize_inc_w);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->packagingsize_inc_d);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->packagingsize_inc_h);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->packagingsize2_mm_w);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->packagingsize2_mm_d);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->packagingsize2_mm_h);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->packagingsize2_inc_w);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->packagingsize2_inc_d);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->packagingsize2_inc_h);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->seat_width);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->seat_depth);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->seat_height);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->arm_height);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
}

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

$this->excel->getActiveSheet()->getStyle("A5:" . $coloum[$col] . "" . $row)->applyFromArray($styleArray);


$filename = "model.xls";
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
$objWriter->save('php://output');
