<html>
    <head>
        <title>Print Critical Job Order</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/print.css') ?>"/>
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <span style="font-size: 20px;font-weight: bold;"><?php echo $company->name ?></span><br/>
                    <span style="font-size: 12px;"><?php echo nl2br($company->address) ?></span><br/>
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 2px #000 solid;font-size: 24px;font-weight: bold;padding-top: 20px;">
                    Critical Job Order
                </td>
            </tr>
            <tr>
                <td style="padding-top: 10px;">
                    <table class="data_table">
                        <thead>
                            <tr>
                                <th width="20" rowspan="2">No</th>
                                <th width="80" rowspan="2">Expected Delivery</th>
                                <th width="100" rowspan="2">Serial</th>
                                <th width="100" rowspan="2">Item Code</th>
                                <th width="100" rowspan="2">Original Code</th>
                                <th width="100" rowspan="2">Item Name</th>
                                <th colspan="3">Product Size</th>
                                <th colspan="3">Packaging Size</th>
                                <th width="150" rowspan="2">Customer</th>
                                <th width="100" rowspan="2">PO</th>
                                <th width="100" rowspan="2">JO</th>
                                <th width="100" rowspan="2">SO</th>
                            </tr>
                            <tr>
                                <th width="30">W</th>
                                <th width="30">D</th>
                                <th width="30">H</th>
                                <th width="30">W</th>
                                <th width="30">D</th>
                                <th width="30">H</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//                            print_r($product);
                            if (!empty($product)) {
                                $no = 1;
                                foreach ($product as $result) {
                                    ?>
                                    <tr>
                                        <td align="right"><?php echo $no++;?></td>
                                        <td align="center"><?php echo date('d/mY',  strtotime($result->expected_delivery_date));?></td>
                                        <td><?php echo $result->serial;?></td>
                                        <td><?php echo $result->modelcode;?></td>
                                        <td><?php echo $result->originalcode;?></td>
                                        <td><?php echo $result->modelname;?></td>
                                        <td align="center"><?php echo $result->size_w;?></td>
                                        <td align="center"><?php echo $result->size_d;?></td>
                                        <td align="center"><?php echo $result->size_h;?></td>
                                        <td align="center"><?php echo $result->packing_size_w;?></td>
                                        <td align="center"><?php echo $result->packing_size_d;?></td>
                                        <td align="center"><?php echo $result->packing_size_h;?></td>
                                        <td><?php echo "<b>".$result->customer_code."</b><br/>".$result->customer;?></td>
                                        <td><?php echo $result->po_no;?></td>
                                        <td><?php echo $result->jo_no;?></td>
                                        <td><?php echo $result->so_no;?></td>
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
    </body>
</html>
