<html>
    <head>
        <title>Product Price List</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>../css/print.css">
    </head>
    <body>
        <table align="left">
            <tr>
                <td>
                    <strong>PT. ALLEGRA LIVING</strong><br/>
                    Semarang-Indonesia<br/><br/><br/>
                    <strong>PRODUCT PRICE LIST</strong>
                </td>
            </tr>
        </table><br/><br/><br/><br/><br/><br/>
        <table border="0"  align="left" cellpadding="0" width="1500" cellspacing="0" class="data_table">
            <thead>
                <tr>
                    <th width="20" rowspan="2">No</th>
                    <th width="150" rowspan="2">PRODUCT PHOTO</th>
                    <th width="80" rowspan="2">ITEM CODE</th>
                    <th width="80" rowspan="2">ITEM NAME ORIGINAL</th>
                    <th width="132" rowspan="2">ITEM NAME</th>
                    <th width="56" rowspan="2">CATEGORY</th>
                    <th width="56" rowspan="2">MATERIAL</th>
                    <th width="56" rowspan="2">FINISHING</th>
                    <th colspan="3">ITEM SIZE (mm)</th>
                    <th colspan="3">ITEM SIZE (inc)</th>
                    <th colspan="3">PACKAGING SIZE (mm)</th>
                    <th colspan="4">SEAT</th>
                    <th width="90" rowspan="2">USD PRICE</th>
                    <th width="90" rowspan="2">USD PRICE (Optional)</th>
                    <th width="90" rowspan="2">IDR PRICE</th>
                </tr>
                <tr>
                    <th width="40">W</th>
                    <th width="40">D</th>
                    <th width="40">H</th>
                    <th width="40">W</th>
                    <th width="40">D</th>
                    <th width="40">H</th>
                    <th width="40">W</th>
                    <th width="40">D</th>
                    <th width="40">H</th>
                    <th width="40">W</th>
                    <th width="40">D</th>
                    <th width="40">H</th>
                    <th width="40">ARM HEIGHT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //print_r($item);
                $no = 1;
                foreach ($item as $result) {
                    ?>
                    <tr>
                        <td align="center" class="left_bottom_right_border"><?php echo $no++; ?></td>
                        <td align="center" class="bottom_right_border">
                            <img src="../../files/model/<?php echo $result->imagename ?>" style='max-width:100px;max-height:100px;padding:10px;border:none;'>
                        </td>
                        <td class="bottom_right_border" align="center"><?php echo $result->code ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->originalcode ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->name ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->category ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->material ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->finishing ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->itemsize_mm_w ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->itemsize_mm_d ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->itemsize_mm_h ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->itemsize_inc_w ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->itemsize_inc_d ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->itemsize_inc_h ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->packagingsize_mm_w ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->packagingsize_mm_d ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo $result->packagingsize_mm_h ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo ($result->seat_width != 0 ? $result->seat_width : "") ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo ($result->seat_depth != 0 ? $result->seat_depth : "") ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo ($result->seat_height != 0 ? $result->seat_height : "") ?>&nbsp;</td>
                        <td class="bottom_right_border" align="center"><?php echo ($result->arm_height != 0 ? $result->arm_height : "") ?>&nbsp;</td>
                        <td class="bottom_right_border" align="right"><?php echo number_format($result->usd_price, 0, "", ",") ?>&nbsp;</td>
                        <td class="bottom_right_border" align="right"><?php echo ($result->usd_optional_price != 0 ? number_format($result->usd_optional_price, 0, "", ",") : "") ?>&nbsp;</td>
                        <td class="bottom_right_border" align="right"><?php echo number_format($result->idr_price, 0, "", ",") ?>&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </body>
</html>