<html>
    <head>
        <title>Goods Receive Report</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/print.css') ?>"/>
        <style>
            *{
                margin:2px;
                margin-right:auto;
            }
        </style>
    </head>
    <body>
        <div style="padding-right: 2px;">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>
                    <span style="font-size: 20px;font-weight: bold;"><?php echo $company->name ?></span><br/>
                    <span style="font-size: 11px;"><?php echo nl2br($company->address) ?></span><br/>
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 2px #000 solid;font-size: 18px;font-weight: bold;padding-top: 20px;">
                    Goods Receive Report
                </td>
            </tr>
            <tr>
                <td style="padding-top: 10px;">
                    <table class="data_table" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="min-width:20px;">No</th>
                                <th style="min-width:80px;">GR No</th>
                                <th style="min-width:80px;">GR Date</th>
                                <th style="min-width:80px;">PO No</th>
                                <th style="min-width:80px;">MR No</th>
                                <th style="min-width:120px;">Requested By</th>
                                <th style="min-width:80px;">Department</th>
                                <th style="min-width:90px;">Item Code</th>
                                <th style="min-width:200px;">Item Description</th>
                                <th style="min-width:90px;">Item Group</th>
                                <th style="min-width:50px;">Qty</th>
                                <th style="min-width:60px;">Uom</th>
                                <th style="min-width:150px;">Vendor/Supplier</th>
                                <th style="min-width:120px;">DO No</th>
                                <th style="min-width:100px;">Do Date</th>
                                <th style="min-width:100px;">Received By</th>
                                <th style="min-width:100px;">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//                            print_r($joborder_item);
                            if (!empty($data)) {
                                $no = 1;
                                foreach ($data as $result) {
                                    ?>
                                    <tr>
                                        <td align="right"><?php echo $no++; ?></td>
                                        <td><?php echo $result->gr_no; ?></td>
                                        <td align="center"><?php echo date('d-m-Y',  strtotime($result->date)); ?></td>
                                        <td align="center"><?php echo $result->po_no; ?></td>
                                        <td align="center"><?php echo $result->mr_no; ?></td>
                                        <td><?php echo $result->name_requested; ?></td>
                                        <td><?php echo $result->department_code; ?></td>
                                        <td align="center"><?php echo $result->itemcode; ?></td>
                                        <td><?php echo $result->itemdescription; ?></td>
                                        <td><?php echo $result->item_group; ?></td>
                                        <td align="center"><?php echo $result->qty; ?></td>
                                        <td align="center"><?php echo $result->unitcode; ?></td>
                                        <td><?php echo $result->vendor_name; ?></td>
                                        <td><?php echo $result->no_sj; ?></td>
                                        <td align="center"><?php echo date('d-m-Y',  strtotime($result->do_date)); ?></td>
                                        <td align="center"><?php echo $result->name_receive; ?></td>
                                        <td align="center"><?php echo $result->remark; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        </div>
    </body>
</html>
