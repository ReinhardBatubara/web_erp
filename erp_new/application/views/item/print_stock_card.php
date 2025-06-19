<?php
if ($flag === "print") {
    ?>
    <html>
        <head>
            <title>STOCK CARD</title>
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
        <div style="width: 600px">
            <table width="100%">
                <tr>
                    <td colspan="3" width="100%" align="center"><strong style="font-size: 16px">STOCK CARD</strong></td>
                </tr>
                <tr>
                    <td width="20%"><strong>Item Code</strong></td>
                    <td width="80%">: &nbsp;</td>
                </tr>
                <tr>
                    <td width="20%"><strong>Item Description</strong></td>
                    <td width="80%">: &nbsp;</td>
                </tr>
                <tr>
                    <td width="20%"><strong>UoM</strong></td>
                    <td width="80%">: &nbsp;</td>
                </tr>
                <tr>
                    <td><strong>Price</strong></td>
                    <td>: </td>
                </tr>
            </table>
            <table width="100%" style="border: 1px #000 solid;border-collapse: collapse;margin-top: 15px">
                <thead>
                    <tr>
                        <th width="10%" style="border: 1px solid;font-weight: bold;" align="center">Date</th>
                        <th width="30%" style="border: 1px solid;font-weight: bold;" align="center">Description</th>
                        <th width="10%" style="border: 1px solid;font-weight: bold;" align="center">In</th>
                        <th width="10%" style="border: 1px solid;font-weight: bold;" align="center">Out</th>
                        <th width="10%" style="border: 1px solid;font-weight: bold;" align="center">Balance</th>
                        <th width="30%" style="border: 1px solid;font-weight: bold;" align="center">Remark</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" style="border: 1px solid;">Last Balance&nbsp;</td>
                        <td style="border: 1px solid;">&nbsp;</td>
                        <td style="border: 1px solid;">&nbsp;</td>
                        <td style="border: 1px solid;" align="right">&nbsp;</td>
                        <td style="border: 1px solid;">&nbsp;</td>
                    </tr>
                    <?php
                    $count = 10;
                    if (!empty($item)) {
                        ?>

                        <?php
                        foreach ($item as $result) {
                            ?>
                            <tr>
                                <td style="border: 1px solid;"><?php echo date('d/m/Y', strtotime($result->trans_time)) ?></td>
                                <td style="border: 1px solid;"><?php echo $result->reff ?></td>
                                <td style="border: 1px solid;" align="right">
                                    <?php
                                    if ($result->status == 1) {
                                        echo $result->qty_in_small_unit;
                                        $last_balance = $last_balance + $result->qty_in_small_unit;
                                    }
                                    ?>&nbsp;
                                </td>
                                <td style="border: 1px solid;" align="right">
                                    <?php
                                    if ($result->status == 0) {
                                        echo $result->qty_in_small_unit;
                                        $last_balance = $last_balance - $result->qty_in_small_unit;
                                    }
                                    ?>&nbsp;
                                </td>
                                <td style="border: 1px solid;" align="right"><?php echo $last_balance; ?>&nbsp;</td>
                                <td style="border: 1px solid;"><?php echo $result->remark ?>&nbsp;</td>
                            </tr>
                            <?php
                            $count--;
                        }
                        for ($i = 0; $i < $count; $i++) {
                            ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        if ($flag) {
            ?>
        </body>
    </html>
    <?php
}
?>

