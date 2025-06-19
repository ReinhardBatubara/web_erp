<html>
    <head>
        <title>Goods Receive</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>../css/print.css">
    </head>
    <body>
        <center>
            <div style="width: 850px;">
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
                </table>
                <table border='0' width='100%' class="data_table" cellpadding="0" cellspacing="0" style="margin-top: 5px;">
                    <thead>
                        <tr>
                            <th width="2%">No</th>
                            <th width="10%" align="center">GR No #</th>
                            <th width="8%" align="center">Date</th>
                            <th width="10%" align="center">PO #</th>
                            <th width="18%" align="center">Vendor</th>
                            <th width="10%" align="center">Item Code</th>
                            <th width="25%" align="center">Item Description</th>
                            <th width="8%" align="center">Unit Code</th>
                            <th width="10%" align="center">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($goodsreceive)) {
                            $no = 1;
                            foreach ($goodsreceive as $result) {
                                ?>
                                <tr valign="top">
                                    <td align="right"><?php echo $no++ ?></td>
                                    <td align="center"><?php echo $result->gr_number ?></td>
                                    <td align="center"><?php echo date('d/m/Y', strtotime($result->gr_date)); ?></td>
                                    <td align="center"><?php echo $result->po_number ?></td>
                                    <td><?php echo $result->vendor ?></td>
                                    <td align="center"><?php echo $result->itemcode ?></td>
                                    <td><?php echo $result->itemdescription ?></td>
                                    <td align="center"><?php echo $result->unitcode ?></td>
                                    <td align="right"><?php echo $result->qty ?></td>

                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td align="right" colspan="5">No Data..</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <span style="float: left;font-style: italic;font-size: 7.5pt;margin-top: 2px;">Print on : <?php echo date('d/m/Y h:i:s') ?></span>
            </div>
        </center>
    </body>
</html>