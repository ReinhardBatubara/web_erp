<html>
    <head>
        <title>Material Request Plan</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>../css/print.css">
    </head>
    <body>
        <center>
            <div style="width: 760px;border: 1px #000 dashed;padding: 10px;margin: 10px;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="head_data">
                    <tr>
                        <td width="100%" align="center" style="border-bottom: 2px #000 solid">
                            <span style="font-size: 14px;font-weight: bold;"><?php echo $company->name ?></span><br/>
                            <span style="font-size: 12px;"><?php echo nl2br($company->address) ?></span><br/>                                                        
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><h2 style="margin-top: 10px;">Material Request Plan</h2><br/></td>
                    </tr>
                    <tr>
                        <td>
                            <span class="data_label">Job Order :</span> <?php echo $joborder->joborder_no ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="data_label">Project Name : </span><?php echo $joborder->project_name ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="data_label">Week : </span><?php echo $joborder->week ?>
                        </td>
                    </tr>
                </table>
                <table border='0' width='100%' class="data_table" cellpadding="0" cellspacing="0" style="margin-top: 5px;">
                    <thead>
                        <tr>
                            <th width="2%" style="border: 1px black solid;">No</th>
                            <th width="10%" style="border: 1px black solid;" align="center">Item Code</th>
                            <th width="35%" style="border: 1px black solid;" align="center">Item Description</th>
                            <th width="5%" style="border: 1px black solid;" align="center">Unit</th>
                            <th width="8%" style="border: 1px black solid;" align="center">Required</th>
                            <th width="8%" style="border: 1px black solid;" align="center">Qty on hand</th>
                            <th width="8%" style="border: 1px black solid;" align="center">On Purchase</th>
                            <th width="8%" style="border: 1px black solid;" align="center">Allocated</th>                            
                            <th width="8%" style="border: 1px black solid;" align="center">Available</th>                            
                            <th width="8%" style="border: 1px black solid;" align="center">Need Purchase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($mrp)) {
                            $no = 1;
                            foreach ($mrp as $result) {
                                ?>
                                <tr>
                                    <td align="right" style="border-left: 1px #000 solid;border-right: 1px #000 solid;padding-right: 2px;"><?php echo $no++ ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->itemcode ?></td>
                                    <td style="border-right: 1px #000 solid"><?php echo $result->itemdescription ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->unitcode ?></td>
                                    <td style="border-right: 1px #000 solid" align="right"><?php echo $result->final_required ?></td>
                                    <td style="border-right: 1px #000 solid" align="right"><?php echo $result->stock_onhand ?></td>
                                    <td style="border-right: 1px #000 solid" align="right"><?php echo $result->stock_onpurchase ?></td>
                                    <td style="border-right: 1px #000 solid" align="right"><?php echo $result->stock_allocated ?></td>                                    
                                    <td style="border-right: 1px #000 solid" align="right"><?php echo $result->total_available ?></td>
                                    <td style="border-right: 1px #000 solid" align="right" style="border-right: 1px #000 solid"><?php echo $result->required_qty ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            
                        }
                        ?>
                        <tr style="background: none">
                            <td style="border-top:1px solid #000;" colspan="10">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <span style="float: left;font-style: italic;font-size: 7.5pt;margin-top: 2px;">Print on : <?php echo date('d/m/Y h:i:s') ?></span><br/>
            </div>
        </center>
    </body>
</html>