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

$this->excel->getActiveSheet()->setTitle('Quotation');
$this->excel->getActiveSheet()->setCellValue('A1', $company->name);
$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$this->excel->getActiveSheet()->mergeCells('A1:I1');
$this->excel->getActiveSheet()->setCellValue('A2', $company->address);
$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(11);
$this->excel->getActiveSheet()->mergeCells('A2:I2');
$this->excel->getActiveSheet()->setCellValue('A3', "Telp. " . $company->telp . " Fax. " . $company->fax);
$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(11);
$this->excel->getActiveSheet()->mergeCells('A3:I3');



$this->excel->getActiveSheet()->setCellValue('A5', "TO : " . $quotation->to);
$this->excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(10);
$this->excel->getActiveSheet()->mergeCells('A5:F5');
$this->excel->getActiveSheet()->setCellValue('A6', "COMPANY : " . $quotation->company);
$this->excel->getActiveSheet()->getStyle('A6')->getFont()->setSize(10);
$this->excel->getActiveSheet()->mergeCells('A6:F6');
$this->excel->getActiveSheet()->setCellValue('A7', "PROJECT : " . $quotation->project);
$this->excel->getActiveSheet()->getStyle('A7')->getFont()->setSize(10);
$this->excel->getActiveSheet()->mergeCells('A7:F7');


$this->excel->getActiveSheet()->setCellValue('G5', "DATE : " . date('d-M-y', strtotime($quotation->date)));
$this->excel->getActiveSheet()->getStyle('G5')->getFont()->setSize(10);
$this->excel->getActiveSheet()->mergeCells('G5:I5');
$this->excel->getActiveSheet()->setCellValue('G6', "REF : " . $quotation->ref);
$this->excel->getActiveSheet()->getStyle('G6')->getFont()->setSize(10);
$this->excel->getActiveSheet()->mergeCells('G6:I6');
$this->excel->getActiveSheet()->setCellValue('G7', "CURRENCY : " . $quotation->currency);
$this->excel->getActiveSheet()->getStyle('G7')->getFont()->setSize(10);
$this->excel->getActiveSheet()->mergeCells('G7:I7');


$this->excel->getActiveSheet()->setCellValue('A9', "QUOTATION-NO." . $quotation->number);
$this->excel->getActiveSheet()->getStyle('A9')->getFont()->setSize(16);
$this->excel->getActiveSheet()->mergeCells('A9:I9');
$this->excel->getActiveSheet()->getStyle('A9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);

$col = 0;
$row = 10;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'NO');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(4);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ":" . $coloum[$col] . "" . ($row + 1));
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'ITEM CODE');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(20);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ":" . $coloum[$col] . "" . ($row + 1));
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'ITEM PICTURE');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(20);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ":" . $coloum[$col] . "" . ($row + 1));
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'DIMMENSION (mm)');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);

$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ":" . $coloum[$col + 2] . "" . $row);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . ($row + 1), 'W');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setBold(true);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(5);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . ($row + 1), 'D');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setBold(true);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(5);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . ($row + 1), 'H');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getFont()->setBold(true);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . ($row + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(5);


$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'FINISHING');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(20);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ":" . $coloum[$col] . "" . ($row + 1));
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'PRICE');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(15);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ":" . $coloum[$col] . "" . ($row + 1));
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'REMARK');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(20);
$this->excel->getActiveSheet()->mergeCells($coloum[$col] . "" . $row . ":" . $coloum[$col] . "" . ($row + 1));
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$row = $row + 2;
$no = 1;
foreach ($quotationdetail as $result) {
    $col = 0;
    $this->excel->getActiveSheet()->getRowDimension($row)->setRowHeight(50);
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $no++);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->modelcode . "\n" . $result->modelname);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $col++;
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    if ($result->images != "") {
        if ($result->modelid != 0) {
            $path = 'files/model/' . $result->images;
        } else {
            $path = 'files/' . $result->images;
        }
        if (file_exists($path)) {
            $objDrawing->setPath($path);
            $objDrawing->setWidthAndHeight(45, 45);
            $objDrawing->setResizeProportional(true);
            $objDrawing->setOffsetX(10);
            $objDrawing->setOffsetY(10);
            $objDrawing->setCoordinates($coloum[$col] . "" . $row);
            $objDrawing->setWorksheet($this->excel->getActiveSheet());
        }
    }

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->item_size_w);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->item_size_d);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->item_size_h);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->finishing);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->price);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->remark);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $row++;
}

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
$this->excel->getActiveSheet()->getStyle("A10:" . $coloum[$col] . "" . ($row - 1))->applyFromArray($styleArray);

$col = 0;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, "Note: The prices are ex warehouse");
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);


$filename = "QUOTATION-NO." . $quotation->number . ".xls";
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
$objWriter->save('php://output');
