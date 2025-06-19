<html>
    <head>
        <title>Sales Order History</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>../css/print.css">
    </head>
    <body>
        <center>
            <div style="width: 1000px;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="head_data">
                    <tr>
                        <td width="100%" align="center" style="border-bottom: 2px #000 solid">
                            <span style="font-size: 14px;font-weight: bold;"><?php echo $company->name ?></span><br/>
                            <span style="font-size: 12px;"><?php echo nl2br($company->address) ?></span><br/>                                                        
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><h2 style="margin-top: 10px;">Sales Order History</h2><br/></td>
                    </tr>
                    <tr>
                        <td align="center">
                            <span class="data_label">From : <?php echo date('d M Y', strtotime($datefrom)) . " To " . date('d M Y', strtotime($dateto)) ?></span>
                        </td>
                    </tr>
                </table>
                <table width="100%" border='0' class="data_table" cellpadding="0" cellspacing="0" style="margin-top: 5px;">
                    <thead>
                        <tr>
                            <th width="2%" style="border: 1px black solid;">No</th>
                            <th style="border: 1px black solid;" align="center">Customer Name</th>
                            <th width="70" style="border: 1px black solid;" align="center">SO NO</th>
                            <th width="70" style="border: 1px black solid;" align="center">Order Date</th>
                            <th width="100" style="border: 1px black solid;" align="center">Item Code</th>
                            <th width="150" style="border: 1px black solid;" align="center">Item Description</th>
                            <th width="100" style="border: 1px black solid;" align="center">Finishing</th>
                            <th width="40" style="border: 1px black solid;" align="center">Width</th>
                            <th width="40" style="border: 1px black solid;" align="center">Depth</th>
                            <th width="40" style="border: 1px black solid;" align="center">Height</th>
                            <th width="40" style="border: 1px black solid;" align="center">Qty</th>
                            <th width="80" style="border: 1px black solid;" align="center">Unit Price</th>                            
                            <th width="80" style="border: 1px black solid;" align="center">Total Price</th>                                                        
                            <th width="50" style="border: 1px black solid;" align="center">Curr</th>
                            <th width="40" style="border: 1px black solid;" align="center">Qty Shipped</th>
                            <th width="40" style="border: 1px black solid;" align="center">Balance Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //print_r($item);
                        if (!empty($item)) {
                            $no = 1;
                            foreach ($item as $result) {
                                ?>
                                <tr>
                                    <td align="right" style="border-left: 1px #000 solid;border-right: 1px #000 solid;padding-right: 2px;"><?php echo $no++ ?></td>
                                    <td style="border-right: 1px #000 solid"><?php echo $result->customer ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->sonumber ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo date('d M Y',  strtotime($result->date)); ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->itemcode ?></td>
                                    <td style="border-right: 1px #000 solid"><?php echo $result->itemdescription ?></td>                                    
                                    <td style="border-right: 1px #000 solid"><?php echo $result->finishing ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->width ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->depth ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->height ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->qty ?></td>
                                    <td style="border-right: 1px #000 solid;padding-right: 5px;" align="right"><?php echo number_format($result->price,2,'.',',') ?></td>
                                    <td style="border-right: 1px #000 solid;padding-right: 5px;" align="right"><?php echo number_format($result->total_price,2) ?></td>                                    
                                    <td style="border-right: 1px #000 solid;" align="center"><?php echo $result->currency ?></td>                                    
                                    <td style="border-right: 1px #000 solid;padding-right: 5px;" align="right"><?php echo $result->qty_ship ?></td>  
                                    <td style="border-right: 1px #000 solid;padding-right: 5px;" align="right"><?php echo $result->balance_qty ?></td>
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