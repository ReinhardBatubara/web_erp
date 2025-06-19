<html>
    <head>
        <title>Laporan Pemasukan Hasil Produksi</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>../css/print.css">
    </head>
    <body>
        <center>
            <div style="width: 750px;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="head_data">
                    <tr>
                        <td width="100%" align="center" colspan="2" style="border-bottom: 3px #000 solid;padding-bottom: 5px;">
                            <span style="font-size: 17px;font-weight: bold;"><?php echo $company->name ?></span><br/>
                            <span><?php echo nl2br($company->address) ?></span><br/>
                        </td>
                    </tr>
                    <tr>
                        <td width="100%" align="center" colspan="2" style="padding-top: 10px">
                            <h3>LAPORAN PEMASUKAN HASIL PRODUKSI</h3>
                            <span style="font-weight: bold;">Periode : <?php echo date('d-m-Y', strtotime($datefrom)) . " s/d " . date('d-m-Y', strtotime($dateto)) ?></span>
                        </td>
                    </tr>                    
                </table>
                <table border='0' width='100%' class="data_table" cellpadding="0" cellspacing="0" style="margin-top: 15px;">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%" align="center">Item Code</th>
                            <th width="50%" align="center">Item Description</th>
                            <th width="10%" align="center">Unit Code</th>
                            <th width="15%" align="center">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 5;
                        if (!empty($report)) {
                            $no = 1;
                            foreach ($report as $result) {
                                ?>
                                <tr valign="top">
                                    <td align="right"><?php echo $no++ ?></td>
                                    <td><?php echo $result->item_code ?></td>
                                    <td><?php echo $result->item_description ?></td>
                                    <td align="center"><?php echo $result->unitcode ?></td>
                                    <td align="right"><?php echo $result->qty ?></td>
                                </tr>
                                <?php
                            }
                            if ($count > 0) {
                                for ($i = 0; $i <= 10; $i++) {
                                    ?>
                                    <tr>
                                        <td align="right">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="right">&nbsp;</td>
                                    </tr>
                                    <?php
                                }
                            }
                        } else {
                            for ($i = 0; $i <= 10; $i++) {
                                ?>
                                <tr>
                                    <td align="right">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="right">&nbsp;</td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <table width="100%">
                    <tr>
                        <td style="border-bottom: 1px #000 solid;">&nbsp;</td>
                    </tr>
                </table>
            </div>
        </center>
    </body>
</html>