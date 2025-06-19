<html>
    <head>
        <title>Target Construction</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/print.css">
    </head>
    <body>
        <center>
            <div style="width: 900px;padding: 10px;margin: 10px;overflow-x: visible;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="head_data">                   
                    <tr>
                        <td align="center"><h2 style="margin-top: 10px;">TARGET MACHINE - <?php echo date('d F Y') ?></h2><br/></td>
                    </tr>                    
                </table>
                <table border='0' width='100%' class="data_table2" cellpadding="0" cellspacing="0" style="margin-top: 5px;">
                    <thead>
                        <tr>
                            <th width="2%" style="border: 1px black solid;">No</th>
                            <th width="60" style="border: 1px black solid;" align="center">EXPT. DELIVERY DATE</th>
                            <th width="20" style="border: 1px black solid;" align="center"><p>CUST OMER</p></th>
                            <th width="50" style="border: 1px black solid;" align="center">PROJECT NAME</th>
                            <th width="50" style="border: 1px black solid;" align="center">PO#</th>                   
                            <th width="60" style="border: 1px black solid;" align="center">WEEK</th>    
                            <th width="100" style="border: 1px black solid;" align="center">ITEM</th>
                            <th width="100" style="border: 1px black solid;" align="center">ITEM CODE</th>
                            <th width="100" style="border: 1px black solid;" align="center">ITEM NAME</th>                             
                            <th width="100" style="border: 1px black solid;" align="center">PHOTO</th> 
                            <th width="150" style="border: 1px black solid;" align="center">FINISHING</th>                   
                            <th width="60" style="border: 1px black solid;" align="center">RM OUT</th>                             
                            <th width="20" style="border: 1px black solid;" align="center">AGING</th>
                            <th width="20" style="border: 1px black solid;" align="center">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        if (!empty($item)) {
                            $no = 1;
                            foreach ($item as $result) {
                                ?>
                                <tr>
                                    <td align="right" style="border-left: 1px #000 solid;border-right: 1px #000 solid;padding-right: 2px;"><?php echo $no++ ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo date('d-M-y', strtotime($result->expected_delivery_date)); ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->customer_code ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->project_name ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->po_no ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->week ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->original_code ?></td>
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->item_code ?></td>
                                    <td style="border-right: 1px #000 solid"><?php echo $result->item_name ?></td>
                                    <td style="border-right: 1px #000 solid" align="center">
                                        <img style="max-height: 40px;max-width: 40px;border:none" src="../../files/model/<?php echo $result->images;?>">
                                    </td>             
                                    <td style="border-right: 1px #000 solid" align="center">
                                        <?php
                                        echo $result->finishing;
                                        if ($result->model_finishingcode != $result->joborderitem_finishingcode) {
                                            echo "<br/><b>(SOF)</b>";
                                        }
                                        ?>
                                    </td>                             
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo date('d-M-y', strtotime($result->mc_in)); ?>&nbsp;</td>  
                                    <td style="border-right: 1px #000 solid" align="center"><?php echo $result->mc_aging ?></td>
                                    <td style="border-right: 1px #000 solid" align="center" style="border-right: 1px #000 solid"><?php echo $result->qty;$total += $result->qty; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            
                        }
                        ?>
                        <tr style="background: none">
                            <td style="border-top:1px solid #000;" colspan="13">Grand Total</td>
                            <td style="border-top:1px solid #000;" align="center"><?php echo $total;?></td>
                        </tr>
                    </tbody>
                </table>
                <span style="float: left;font-style: italic;font-size: 7.5pt;margin-top: 2px;">Print on : <?php echo date('d/m/Y h:i:s') ?></span><br/>
            </div>
        </center>
    </body>
</html>