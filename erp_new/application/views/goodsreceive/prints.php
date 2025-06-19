<html>
    <head>
        <title>Goods Receive</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>../css/print.css">
    </head>
    <body>
        <center>
            <div style="width: 800px;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="100%" align="center" colspan="2">
                            <?php $this->load->view('head'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" style="padding: 15px 0px 15px 0px">
                            <span class="title">Goods Receive (GR)</span>
                        </td>
                    </tr>
                    <tr valign="top" class="head_data">
                        <td width="50%">
                            <table width="100%">
                                <tr>
                                    <td width="30%" class="data_label">G.R Number</td>
                                    <td width="1%" align="center">:</td>
                                    <td width="69%"><?php echo $goodsreceive->number ?></td>
                                </tr>
                                <tr>
                                    <td class="data_label">Date </td>
                                    <td>:</td>
                                    <td><?php echo date('d-m-Y', strtotime($goodsreceive->date)); ?></td>
                                </tr>
                                <tr>
                                    <td class="data_label">Vendor</td>
                                    <td align="center">:</td>
                                    <td><?php echo $goodsreceive->vendor ?></td>
                                </tr>
                            </table>
                        </td>
                        <td width="50%">
                            <table width="100%">                                
                                <tr>
                                    <td width="30%" class="data_label">D.O Number</td>
                                    <td width="1%">:</td>
                                    <td width="69%"><?php echo $goodsreceive->no_sj; ?></td>
                                </tr>
                                <tr>
                                    <td class="data_label">D.O Date</td>
                                    <td>:</td>
                                    <td><?php echo $goodsreceive->do_date; ?></td>
                                </tr>
                                <tr>
                                    <td class="data_label">Check By</td>
                                    <td>:</td>
                                    <td><?php echo $goodsreceive->checked; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table border='0' width='100%' cellpadding="0" cellspacing="0" style="margin-top: 5px;">
                    <thead>
                        <tr>
                            <th width="5%" style="border-width: 1px 1px 1px 1px; border-color: black;border-style:solid;padding: 2px;">No</th>
                            <th width="15%" style="border-width: 1px 1px 1px 0; border-color: black;border-style:solid;padding: 2px;" align="center">Item Code</th>
                            <th width="30%" style="border-width: 1px 1px 1px 0; border-color: black;border-style:solid;padding: 2px;" align="center">Item Description</th>
                            <th width="5%" style="border-width: 1px 1px 1px 0; border-color: black;border-style:solid;padding: 2px;" align="center">UoM</th>
                            <th width="10%" style="border-width: 1px 1px 1px 0; border-color: black;border-style:solid;padding: 2px;" align="center">Qty</th>
                            <th width="10%" style="border-width: 1px 1px 1px 0; border-color: black;border-style:solid;padding: 2px;" align="center">P.O Number</th>
                            <th width="25%" style="border-width: 1px 1px 1px 0; border-color: black;border-style:solid;padding: 2px;" align="center">Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 10;
                        $no = 1;
                        foreach ($goodsreceivedetail as $result) {
                            ?>
                            <tr valign="top">
                                <td style="border-width: 0 1px 0 1px; border-color: black;border-style:solid;padding: 2px;" align="right"><?php echo $no++ ?></td>
                                <td style="border-width: 0 1px 0 0; border-color: black;border-style:solid;padding: 2px;"><?php echo $result->itemcode ?></td>
                                <td style="border-width: 0 1px 0 0; border-color: black;border-style:solid;padding: 2px;"><?php echo $result->itemdescription ?></td>
                                <td style="border-width: 0 1px 0 0; border-color: black;border-style:solid;padding: 2px;" align="center"><?php echo $result->unitcode ?></td>
                                <td style="border-width: 0 1px 0 0; border-color: black;border-style:solid;padding: 2px;" align="center"><?php echo $result->qty ?></td>
                                <td style="border-width: 0 1px 0 0; border-color: black;border-style:solid;padding: 2px;" align="center"><?php echo $result->po_no ?></td>
                                <td style="border-width: 0 1px 0 0; border-color: black;border-style:solid;padding: 2px;"><?php echo $result->remark ?></td>
                            </tr>
                            <?php
                            $counter--;
                        }

                        if ($counter > 0) {
                            for ($i = 0; $i < $counter; $i++) {
                                ?>
                                <tr>
                                    <td style="border-width: 0 1px 0 1px; border-color: black;border-style:solid;">&nbsp;</td>
                                    <td style="border-width: 0 1px 0 0; border-color: black;border-style:solid;">&nbsp;</td>
                                    <td style="border-width: 0 1px 0 0; border-color: black;border-style:solid;">&nbsp;</td>
                                    <td style="border-width: 0 1px 0 0; border-color: black;border-style:solid;">&nbsp;</td>
                                    <td style="border-width: 0 1px 0 0; border-color: black;border-style:solid;">&nbsp;</td>
                                    <td style="border-width: 0 1px 0 0; border-color: black;border-style:solid;">&nbsp;</td>
                                    <td style="border-width: 0 1px 0 0; border-color: black;border-style:solid;">&nbsp;</td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        <tr>
                            <td style="border-width: 0 1px 1px 1px; border-color: black;border-style:solid;">&nbsp;</td>
                            <td style="border-width: 0 1px 1px 0; border-color: black;border-style:solid;">&nbsp;</td>
                            <td style="border-width: 0 1px 1px 0; border-color: black;border-style:solid;">&nbsp;</td>
                            <td style="border-width: 0 1px 1px 0; border-color: black;border-style:solid;">&nbsp;</td>
                            <td style="border-width: 0 1px 1px 0; border-color: black;border-style:solid;">&nbsp;</td>
                            <td style="border-width: 0 1px 1px 0; border-color: black;border-style:solid;">&nbsp;</td>
                            <td style="border-width: 0 1px 1px 0; border-color: black;border-style:solid;">&nbsp;</td>
                        </tr>
                    </tbody>
                </table><br/>
                <span style="float: left;font-style: italic;font-size: 7.5pt;margin-top: 5px;">Print on : <?php echo date('d/m/Y h:i:s') ?></span>
            </div>
        </center>
    </body>
</html>