<center>
    <div style="width: 800px;">
        <table cellpadding="0" cellspacing="0" width="100%" style="margin: 5px 0 5px 0;background: #dedede;">
            <tr>
                <td colspan="2" style="font-size: 16px;font-weight: bold;padding: 3px">Price Comparison List</td>
            </tr>
            <tr>
                <td width="50" style="font-size: 14px;font-weight: bold;padding: 3px">PR No </td>
                <td style="font-size: 14px;font-weight: bold;padding: 3px">: 30193</td>
            </tr>
        </table>       
        <table border='0' width='100%' style="font-size: 10px;border-collapse: collapse;" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th width="2%" style="border: 1px black solid;">No</th>
                    <th width="23%" style="border: 1px black solid;" align="center">Item</th>
                    <th width="70%" style="border: 1px black solid;" align="center">Price Information</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                $amount = 0;
                foreach ($purchaserequestdetail as $result) {
                    $amount += $result->amount;
                    ?>
                    <tr>
                        <td align="center" style="padding-left:5px;border: 1px black solid;" valign="top"><?php echo $number++ ?></td>
                        <td valign="top" style="padding-left:5px;border: 1px black solid;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 12px;">
                                <tr valign="top">
                                    <td width="40">Item Code</td>
                                    <td width="5">:</td>
                                    <td><?php echo $result->itemcode ?></td>
                                </tr>
                                <tr valign="top">
                                    <td>Description</td>
                                    <td width="5">:</td>
                                    <td><?php echo $result->itemdescription ?></td>
                                </tr>
                                <tr valign="top">
                                    <td>Quantity</td>
                                    <td width="5">:</td>
                                    <td><?php echo $result->qty ?></td>
                                </tr>
                                <tr valign="top">
                                    <td>Last Purchase</td>
                                    <td width="5">:</td>
                                    <td></td>
                                </tr>
                                <tr valign="top">
                                    <td>Date</td>
                                    <td width="5">:</td>
                                    <td></td>
                                </tr>
                                <tr valign="top">
                                    <td>Price</td>
                                    <td width="5">:</td>
                                    <td></td>
                                </tr>
                            </table>
                        </td>
                        <td valign="top" style="padding-left:3px;border: 1px black solid;">
                            <table width="100%" style="font-size: 10px;">
                                <thead>
                                    <tr>
                                        <th width="30%" style="border-bottom: 1px black solid;">Supplier/Vendor</th>
                                        <th width="5%"style="border-bottom: 1px black solid;">Currency</th>
                                        <th width="15%"style="border-bottom: 1px black solid;">Unit Price</th>
                                        <th width="15%"style="border-bottom: 1px black solid;">Discount</th>
                                        <th width="15%"style="border-bottom: 1px black solid;">PPn</th>
                                        <th width="20%"style="border-bottom: 1px black solid;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $pricecomparison = $this->model_pricecomparison->select_result_by_purchase_request_detail_id($result->id);
                                    foreach ($pricecomparison as $resultpricecomparison) {
                                        $bgcolor = "";
                                        if ($resultpricecomparison->used == 1) {
                                            $bgcolor = "bgcolor='#d3d3d3'";
                                        }
                                        ?>
                                        <tr <?php echo $bgcolor ?>>
                                            <td><?php echo $resultpricecomparison->vendor ?></td>
                                            <td align="center"><?php echo $resultpricecomparison->currency ?></td>
                                            <td align="right"><?php echo number_format($resultpricecomparison->price, 2, '.', ',') ?></td>
                                            <td align="right"><?php echo number_format($resultpricecomparison->discount, 2, '.', ',') ?></td>
                                            <td align="right"><?php echo number_format($resultpricecomparison->ppn, 2, '.', ',') ?></td>
                                            <td align="right"><?php echo number_format($resultpricecomparison->amount, 2, '.', ',') ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <?php
                }
                ?>                
            </tbody>
            <tfoot>
                <tr>                    
                    <th colspan="2" style="border: 1px black solid;" align="center">Total</th>
                    <th width="70%" style="border: 1px black solid;" align="left">&nbsp;<?php echo number_format($amount, 2, '.', ',') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</center>