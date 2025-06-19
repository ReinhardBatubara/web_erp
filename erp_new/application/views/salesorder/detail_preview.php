<?php
if ($type == "print") {
    ?>
    <html>
        <head>
            <title>Sales Order Preview Detail</title>
            <style>
                *{
                    font-size: 8pt;
                    font-family: Tahoma;
                }
            </style>
        </head>
        <body>
            <?php
        }
        ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding: 10px 5px 10px 5px;font-size: 7pt;">              
            <tr>
                <td>
                    <strong>PT. ALLEGRA LIVING</strong><br/>
                    Semarang-Indonesia<br/><br/><br/>
                    <strong>ORDER CONFIRMATION</strong>
                    <table width="400">
                        <tr>
                            <td width="14%">Customer</td>
                            <td width="1%">:</td>
                            <td width="85%"><?php echo $salesorder->customerorder ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?php echo nl2br($salesorder->address_orderby) ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="margin-top: 15px" cellpadding="0" cellspacing="0">
                        <thead style="background:#cccccc">
                            <tr>
                                <th width="30" rowspan="2" style="border: 1px solid;font-weight: bold;padding: 2px;" align="center">No</th>
                                <th width="120" rowspan="2" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;font-size: 7pt;padding: 2px;" align="center">PRODUCT PHOTO</th>
                                <th width="80" rowspan="2" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;font-size: 7pt;padding: 2px;" align="center">ITEM CODE</th>
                                <th width="120" rowspan="2" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;font-size: 7pt;padding: 2px;" align="center">ITEM NAME</th>
                                <th width="120" rowspan="2" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;font-size: 7pt;padding: 2px;" align="center">MATERIAL</th>
                                <th width="100" rowspan="2" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;font-size: 7pt;padding: 2px;" align="center">FINISHING</th>
                                <th width="80" rowspan="2" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;font-size: 7pt;padding: 2px;" align="center">REMARK</th>
                                <th width="80" rowspan="2" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;font-size: 7pt;padding: 2px;" align="center">FABRIC</th>
                                <th colspan="3" style="border-right: 1px solid;border-top: 1px solid;font-weight: bold;padding: 2px;" align="center">ITEM SIZE(MM)</th>
                                <th width="40" rowspan="2" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;font-size: 8pt;padding: 2px;" align="center">M3</th>
                                <th width="40" rowspan="2" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;font-size: 8pt;padding: 2px;" align="center">QTY</th>
                                <th width="80" rowspan="2" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;font-size: 8pt;padding: 2px;" align="center">UNIT PRICE</th>
                                <th width="80" rowspan="2" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-size: 8pt;padding: 2px;" align="center">TOTAL PRICE</th>
                            </tr>
                            <tr>

                                <th width="40" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;padding: 2px;" align="center">W</th>
                                <th width="40" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;padding: 2px;" align="center">D</th>
                                <th width="40" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;padding: 2px;" align="center">H</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 12;
                            if (!empty($salesorderdetail)) {
                                $no = 1;
                                //print_r($salesorderdetail);
                                foreach ($salesorderdetail as $result) {
                                    ?>
                                    <tr>
                                        <td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="center"><?php echo $no++; ?></td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="center">
                                            <?php
                                            if (!empty($result->images)) {
                                                if ($type == "print") {
                                                    ?>
                                                    <img src="../../../../files/model/<?php echo $result->images ?>" style="max-width: 60px;max-height: 60px "/>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="files/model/<?php echo $result->images ?>" style="max-width: 60px;max-height: 60px "/>
                                                    <?php
                                                }
                                            }
                                            ?>&nbsp;
                                        </td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;" align="center"><?php echo $result->code ?></td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;"><?php echo $result->name ?></td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="center"><?php echo $result->material ?>&nbsp;</td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="center"><?php echo $result->finishing ?>&nbsp;</td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="center"><?php echo $result->remark ?>&nbsp;</td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="center"><?php echo $result->fabric ?>&nbsp;</td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="center"><?php echo $result->itemsize_mm_w ?>&nbsp;</td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="center"><?php echo $result->itemsize_mm_d ?>&nbsp;</td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="center"><?php echo $result->itemsize_mm_h ?>&nbsp;</td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="center"><?php echo number_format((($result->itemsize_mm_w * $result->itemsize_mm_d * $result->itemsize_mm_h) / 1000000000), 2) ?>&nbsp;</td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="center"><?php echo $result->qty ?></td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="center"><?php echo number_format($result->unitprice, 2) ?>&nbsp;</td>
                                        <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px;font-size: 7pt;" align="right"><?php echo number_format($result->amount, 2) ?>&nbsp;</td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td style="border-left: 1px #000 solid;border-bottom: 1px solid;border-right: 1px solid;">&nbsp;</td>
                                    <td style="border-right: 1px solid;border-bottom: 1px solid;">No Data.......</td>
                                    <td style="border-right: 1px solid;border-bottom: 1px solid;">&nbsp;</td>
                                    <td style="border-right: 1px solid;border-bottom: 1px solid;">&nbsp;</td>
                                    <td style="border-right: 1px solid;border-bottom: 1px solid;">&nbsp;</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <?php
        if ($type == "print") {
            ?>
            <script>window.print();window.close();</script>
        </body>
    </html>
<?php } ?>
