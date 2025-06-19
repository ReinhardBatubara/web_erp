<html>
    <head>
        <title>Detail Stock Out Report</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>../css/print.css">
    </head>
    <body>
        <center>
            <div style="width: 850px;border: 1px #000 dashed;padding: 10px;margin: 10px;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="head_data">
                    <tr>
                        <td width="100%" align="center" style="border-bottom: 2px #000 solid">
                            <span style="font-size: 14px;font-weight: bold;"><?php echo $company->name ?></span><br/>
                            <span style="font-size: 12px;"><?php echo nl2br($company->address) ?></span><br/>                                                        
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <h2 style="margin-top: 10px;">DETAIL STOCK OUT REPORT</h2>
                            <br/>
                            <span style="font-weight: bold;">Periode : <?php echo date('d-m-Y', strtotime($datefrom)) . " s/d " . date('d-m-Y', strtotime($dateto)) ?></span>
                        </td>
                    </tr>
                </table>
                <table border='0' width='100%' class="data_table" cellpadding="0" cellspacing="0" style="margin-top: 5px;">
                    <thead>
                        <tr>
                            <th width="2%" style="border: 1px black solid;">No</th>
                            <th width="10%" style="border: 1px black solid;" align="center">STO</th>                            
                            <th width="10%" style="border: 1px black solid;" align="center">Date</th>
                            <th width="8%" style="border: 1px black solid;" align="center">MW/NOTA</th>
                            <th width="8%" style="border: 1px black solid;" align="center">Item Code</th>
                            <th width="37%" style="border: 1px black solid;" align="center">Item Description</th>
                            <th width="5%" style="border: 1px black solid;" align="center">Unit</th>
                            <th width="5%" style="border: 1px black solid;" align="center">Qty</th>
                            <th width="8%" style="border: 1px black solid;" align="center">Out From</th>
                            <th width="17%" style="border: 1px black solid;" align="center">Request By</th>                            
                            <th width="10%" style="border: 1px black solid;" align="center">Require For</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($item)) {
                            //print_r($item);
                            $no = 1;
                            //print_r($item);
                            foreach ($item as $result) {
                                ?>
                                <tr>
                                    <td align="right" style="border-left: 1px #000 solid;border-right: 1px #000 solid;padding-right: 2px;"><?php echo $no++ ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->stockout_number ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo date('d-m-Y', strtotime($result->date)) ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->nota_no ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->item_code ?></td>
                                    <td style="border-right: 1px #000 solid"><?php echo $result->item_description ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->unitcode ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->qty ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->warehouse_name_out ?></td>
                                    <td style="border-right: 1px #000 solid" ><?php echo $result->employee_request_by ?></td>
                                    <td style="border-right: 1px #000 solid" style="border-right: 1px #000 solid"><?php echo $result->stockoutdetail_remark ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            
                        }
                        ?>
                        <tr style="background: none">
                            <td style="border-top:1px solid #000;" colspan="11">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <span style="float: left;font-style: italic;font-size: 7.5pt;margin-top: 2px;">Print on : <?php echo date('d/m/Y h:i:s') ?></span><br/>
            </div>
        </center>
    </body>
</html>
