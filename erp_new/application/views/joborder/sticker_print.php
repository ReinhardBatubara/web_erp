<html>
    <head>
        <title>&nbsp;</title>
        <style>
            body {
                padding:0px;
                font-size:12px;
                margin:1px;
            }
            @page {size: legal portrait ; margin: 0cm; }
            @media print {
                .page-break {page-break-before: always; }
            }
        </style>
    </head>
    <body>
        <table width="630" align="center">
            <?php
            $page_break = "";
            $no = 0;
            foreach ($item as $result) {
                $page_break = "";
                if ($no % 4 == 0) {
                    $page_break = "class='page-break'";
                }
                ?>
                <tr <?php echo $page_break; ?>>
                    <td>
                        <table border="1" width="100%" style='border-collapse: collapse;font-size: 12px;margin-top: 10px;'>
                            <tr>
                                <td width="70%" height="50" valign="top">
                                    <span style='font-weight: bold;'><u>Shipped To :</u></span>
                                    <br/><span style='font-size: 14px;'><?php echo ucwords(strtolower($result->customer_ship_to)); ?></span>
                                    <br/>
                                    <?php
                                    if ($result->address_shipto == '') {
                                        echo ucwords(strtolower(nl2br($result->customer_address_ship_to)));
                                    } else {
                                        echo ucwords(strtolower(nl2br($result->address_shipto)));
                                    }
                                    ?>
                                </td>
                                <td width="30%" align="center">
                                    <img src="<?php echo site_url('joborder/get_barcode/' . $result->serial) ?>" style="border: none;margin-top: 5px;"/><br/>
                                    <span style="letter-spacing: 3px"><?php echo $result->serial ?></span>
                                </td>
                            </tr>                        
                            <tr>
                                <td >
                                    <table width="100%" style='font-size: 12px;'>  
<!--                                        <tr>
                                            <td>Customer Code</td>
                                            <td>:</td>
                                            <td><?php echo ucwords(strtolower($result->customer_code)); ?></td>
                                        </tr>-->
<!--                                        <tr>
                                            <td>Original Code</td>
                                            <td>:</td>
                                            <td><?php echo ucwords(strtolower($result->originalcode)); ?></td>
                                        </tr>-->
                                        <tr>
                                            <td width="40%">Item Code</td>
                                            <td width="1">:</td>
                                            <td>
                                                <?php
                                                if ($item_code_display == 0) {
                                                    echo ucwords(strtolower($result->modelcode));
                                                } else {
                                                    echo ucwords(strtolower($result->item_customer_code));
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Item Description</td>
                                            <td>:</td>
                                            <td><?php echo ucwords(strtolower($result->modelname)); ?></td>
                                        </tr>
                                        <tr>
                                            <td># PO</td>
                                            <td>:</td>
                                            <td><?php echo $result->po_no ?></td>
                                        </tr>
                                        <tr>
                                            <td>Quantity</td>
                                            <td>:</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>Finishing</td>
                                            <td>:</td>
                                            <td><?php echo ucwords(strtolower($result->finishing)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Upholstery </td>
                                            <td>:</td>
                                            <td><?php echo ucwords(strtolower($result->fabric)); ?></td>
                                        </tr>

                                        <tr>
                                            <td>Remarks  </td>
                                            <td>:</td>
                                            <td>
                                                <?php
                                                if (!empty($result->mirror)) {
                                                    echo ucwords(strtolower($result->mirror)) . "<br>";
                                                }
                                                echo $remark;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        if ($madein == 'true') {
                                            ?>
                                            <tr>
                                                <td>Made In</td>
                                                <td>:</td>
                                                <td>Indonesia</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                                <td align="center">
                                    <?php
                                    if ($result->customer_code == 'A10') {
                                        ?>
                                        <img src='<?php echo base_url() . "files/logo-kennis.png" ?>' style="max-height: 40px;max-width: 40px;border: none;margin-bottom: 15px;margin-top: 5px"/><br/>
                                        <?php
                                    } else {
                                        if ($companylogo == 'true') {
                                            ?>
                                            <img src='<?php echo base_url() . "files/logo-no-backgroung.png" ?>' style="max-height: 40px;max-width: 40px;border: none;margin-bottom: 15px;margin-top: 5px"/><br/>                            
                                            <?php
                                        }
                                    }
                                    ?>
                                    <img src="<?php echo base_url() . "files/model/" . $result->images; ?>" style="max-height: 85px;max-width: 85px;border: none;"/>                            
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
                $no++;
            }
            ?>
        </table>
    </body>
</html>
