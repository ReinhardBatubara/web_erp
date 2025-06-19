<html>
    <head>
        <title>Stock Opname</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/print.css') ?>"/>
        <style>
            *{
                margin:0 5px 0 2px;
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
                        Stock Opname
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 20px;">
                        <table width="60%">
                            <tr>
                                <td width="50%">
                                    <table width="100%">
                                        <tr>
                                            <td><strong>NO.</strong></td>
                                            <td>:</td>
                                            <td><?php echo $stockopname->stockopname_no ?></td>
                                        </tr>
                                        <tr>
                                            <td width="49%"><strong>Date</strong></td>
                                            <td width='1%'>:</td>
                                            <td width="50%"><?php echo $stockopname->date ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Warehouse</strong></td>
                                            <td>:</td>
                                            <td><?php echo $stockopname->warehouse_name ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Description</strong></td>
                                            <td>:</td>
                                            <td><?php echo $stockopname->description ?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="50%">
                                    &nbsp;
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 10px;">
                        <table class="data_table" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="min-width:20px;">No</th>
                                    <th style="min-width:90px;">Item Code</th>
                                    <th style="min-width:220px;">Item Description</th>
                                    <th style="min-width:90px;">Item Group</th>
                                    <th style="min-width:60px;">Uom</th>
                                    <th style="min-width:100px;">System Stock</th>
                                    <th style="min-width:100px;">Real Stock</th>                                
                                    <th style="min-width:100px;">Difference</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                print_r($stockopname_detail);
                                if (!empty($stockopname_detail)) {
                                    $no = 1;
                                    foreach ($stockopname_detail as $result) {
                                        ?>
                                        <tr>
                                            <td align="right"><?php echo $no++; ?></td>
                                            <td><?php echo $result->item_code; ?></td>
                                            <td><?php echo $result->item_description; ?></td>
                                            <td><?php echo $result->item_group_code; ?></td>
                                            <td align="center"><?php echo $result->unitcode; ?></td>
                                            <td align="right"><?php echo $result->stock; ?></td>
                                            <td align="right"><?php echo $result->real_stock; ?></td>
                                            <td align="right"><?php echo $result->difference; ?></td>
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
