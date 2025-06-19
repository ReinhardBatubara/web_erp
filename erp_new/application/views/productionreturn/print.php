<html>
    <head>
        <title>Return Production</title>
        <style>
            .mydatatabel{
                font-size:12px;
                font-family:Arial,Helvetica,sans-serif;
            }
            .mydatatabel th{
                padding: 5px;
            }
            .mydatatabel td{
                padding: 5px 0 0 0;
            }
        </style>

    </head>
    <body>
        <?php $this->load->view('head'); ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">                    
            <tr>
                <td  align="center" style="padding: 15px 0px 15px 0px">
                    <span style="font-size: 16px;font-weight: bold;font-family: Helvetica,Tahoma">RETURN PRODUCTION</span>
                </td>
            </tr>
            <tr valign="top">
                <td>
                    <table width="50%" class="mydatatabel">
                        <tr>
                            <td width="25%"><strong>No</strong></td>
                            <td width="1%" align="center">:</td>
                            <td width="74%"><?php echo $production_return->number ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date</strong></td>
                            <td>:</td>
                            <td><?php echo date('d/m/Y', strtotime($production_return->date)) ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br/>
        <table border='0' width='100%' class="mydatatabel" cellpadding="0" cellspacing="0" style="border-collapse: collapse">
            <thead>
                <tr>
                    <th width="5%"  align="center" style="border: 1px solid #000;">NO</th>
                    <th width="15%" align="center" style="border: 1px solid #000;">ITEM CODE</th>
                    <th width="40%" align="center" style="border: 1px solid #000;">ITEM DESCRIPTION</th>
                    <th width="5%" align="center" style="border: 1px solid #000;">UNIT</th>
                    <th width="10%" align="center" style="border: 1px solid #000;">QTY</th>
                    <th width="35%" align="center" style="border: 1px solid #000;">REMARK</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 10;
                if (!empty($item)) {
                    $no = 1;
                    foreach ($item as $result) {
                        ?>
                        <tr>
                            <td align="center" style="border-width: 0 1px 0 1px; border-style: solid;border-color: black;"><?php echo $no++ ?></td>
                            <td align="center" style="border-width: 0 1px 0 0; border-style: solid;border-color: black;"><?php echo $result->itemcode ?></td>
                            <td align="left" style="border-width: 0 1px 0 0; border-style: solid;border-color: black;"><?php echo $result->itemdescription ?></td>
                            <td align="center" style="border-width: 0 1px 0 0; border-style: solid;border-color: black;"><?php echo $result->unitcode ?></td>
                            <td align="center" style="border-width: 0 1px 0 0; border-style: solid;border-color: black;"><?php echo $result->qty ?></td>
                            <td align="left" style="border-width: 0 1px 0 0; border-style: solid;border-color: black;"><?php echo $result->returntype ?>&nbsp;</td>
                        </tr>
                        <?php
                        $count -= 1;
                    }
                }
                for ($i = 0; $i < $count; $i++) {
                    ?>
                    <tr>
                        <td style="border-width: 0 1px 0 1px; border-style: solid;border-color: black;">&nbsp;</td>
                        <td style="border-width: 0 1px 0 1px; border-style: solid;border-color: black;">&nbsp;</td>
                        <td style="border-width: 0 1px 0 1px; border-style: solid;border-color: black;">&nbsp;</td>
                        <td style="border-width: 0 1px 0 1px; border-style: solid;border-color: black;">&nbsp;</td>
                        <td style="border-width: 0 1px 0 1px; border-style: solid;border-color: black;">&nbsp;</td>
                        <td style="border-width: 0 1px 0 1px; border-style: solid;border-color: black;">&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>
                <tr style="height: 5px">
                    <td style="border-width: 0 1px 1px 1px; border-style: solid;border-color: black;">&nbsp;</td>
                    <td style="border-width: 0 1px 1px 1px; border-style: solid;border-color: black;">&nbsp;</td>
                    <td style="border-width: 0 1px 1px 1px; border-style: solid;border-color: black;">&nbsp;</td>
                    <td style="border-width: 0 1px 1px 1px; border-style: solid;border-color: black;">&nbsp;</td>
                    <td style="border-width: 0 1px 1px 1px; border-style: solid;border-color: black;">&nbsp;</td>
                    <td style="border-width: 0 1px 1px 1px; border-style: solid;border-color: black;">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6"><br/></td>
                </tr>
                <tr valign="top">
                    <td colspan="2" align='right'><strong>Remark : </strong></td>
                    <td colspan="4" style="border-bottom: 1px #000 solid;padding:5px;"><?php echo $production_return->remark ?>&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <br/>
        <table width="100%" border="0" class="mydatatabel">
            <tr valign="top">
                <td align="center" width="25%">
                    <b>Delivered By</b><br/><br/><br/>
                    <br/>
                    <?php echo $production_return->name_return_by ?><br/>
                    <hr style="border: 0; height: 1px; background: #333; width: 80%" />
                </td>
                <td align="center" width="25%">&nbsp;</td>
                <td align="center" width="25%">&nbsp;</td>
                <td align="center" width="25%">
                    <b>Received By</b><br/><br/><br/>
                    <?php echo $production_return->name_receive_by ?><br/>
                    <hr style="border: 0; height: 1px; background: #333; width: 80%" /> 
                    Warehouse Admin
                </td>
            </tr>
        </table>
    </body>
</html>