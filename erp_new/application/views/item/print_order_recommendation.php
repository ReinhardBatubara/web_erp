<html>
    <head>
        <title>Print Order Order Recommendation</title>
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
                    Order Recommendation Item
                </td>
            </tr>
            <tr>
                <td style="padding-top: 10px;">
                    <table class="data_table">
                        <thead>
                            <tr>
                                <th width="20">No</th>
                                <th width="100">Item Code</th>
                                <th width="300">Item Description</th>
                                <th width="120">Item Group</th>
                                <th width="80">Category</th>
                                <th width="50">Base Unit</th>
                                <th width="80">Current Stock</th>
                                <th width="80">RoP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//                            print_r($item);
                            if (!empty($item)) {
                                $no = 1;
                                foreach ($item as $result) {
                                    ?>
                                    <tr>
                                        <td align="right"><?php echo $no++;?></td>
                                        <td><?php echo $result->code;?></td>
                                        <td><?php echo $result->description;?></td>
                                        <td><?php echo $result->itemgroup;?></td>
                                        <td><?php echo $result->category_f;?></td>
                                        <td><?php echo $result->unitcode;?></td>
                                        <td align="right"><?php echo $result->stock;?></td>
                                        <td align="right"><?php echo $result->reorderpoint;?></td>    
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
