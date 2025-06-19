
<html>
    <head>
        <title>PO Outstanding Receive</title>
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
                            <span class="title">PO Outstanding Receive</span>
                        </td>
                    </tr>
                </table>
                <table border='0' width='100%' class="data_table" cellpadding="0" cellspacing="0" style="margin-top: 5px;">
                    <thead>
                        <tr>
                            <th width="2%">No</th>                            
                            <th>Item Code</th>            
                            <th>Item Description</th>
                            <th>Unit Code</th>
                            <th>Outstanding</th>
                            <th>Qty Order</th>
                            <th>PO #</th>
                            <th>PR #</th>
                            <th>Vendor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($poitem)) {
                            $no = 1;
                            foreach ($poitem as $result) {
                                ?>
                                <tr valign="top">
                                    <td align="right"><?php echo $no++ ?></td>                                    
                                    <td><?php echo $result->item_code ?></td>
                                    <td><?php echo $result->item_description ?></td>
                                    <td align="center"><?php echo $result->unitcode ?></td>
                                    <td align="center"><?php echo $result->qty_ots ?></td>
                                    <td align="center"><?php echo $result->qty ?></td>
                                    <td><?php echo $result->po_number ?></td>
                                    <td><?php echo $result->pr_number ?></td>
                                    <td><?php echo $result->vendor ?></td>
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