<html>
    <head>
        <title>Raw Material</title>
        <link rel="stylesheet" type="text/css" href="../../css/print.css">
    </head>
    <body>
        <table width="1000" border="0" align="center">
            <tr>
                <td colspan="3" width="100%">
                    <table width="100%" style="font-weight: bold;">
                        <tr>
                            <td width="10%">Item</td>
                            <td width="90%">: <?php echo $costing->item_name?></td>
                        </tr>
                        <tr>
                            <td width="10%">Size</td>
                            <td width="90%">: <?php echo "W: ".$costing->dw.", H: ".$costing->dh.", D: ".$costing->dd?></td>
                        </tr>
                        <tr>
                            <td width="10%">Volume</td>
                            <td width="90%">: <?php echo (($costing->dw * $costing->dh * $costing->dd)/1000000000) ." M3"?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr valign="top">
                <td width="33%">
                    <table width="100%">
                        <tr>
                            <td width="100%">
                                BJ Besi : 7,850 Kg/M3, 
                                Total luas :  <?php echo $this->model_rawmaterial->get_total_luas($costingid, 1) ?> ,
                                Total Kg : <?php echo $this->model_rawmaterial->get_total_kg($costingid, 1) ?>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" class="data_table2">
                        <caption>PIPA KOTAK</caption>
                        <thead>
                            <tr>
                                <th width="28%" align="center">Tebal Plat</th>
                                <th width="17%" align="center">Tebal</th>
                                <th width="10%" align="center">Lebar</th>
                                <th width="10%" align="center">Panjang</th>
                                <th width="7%" align="center">Qty</th>
                                <th width="14%" align="center">M2</th>
                                <th width="14%" align="center">Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = $this->model_rawmaterial->select_by_costingid_rawcategoryid_rawtypeid($costingid, 1, 1);
                            $min_col = 4;
                            $total_qty = 0;
                            $total_m2 = 0;
                            $total_kg = 0;
                            if (!empty($record)) {
                                foreach ($record as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->tebalplat ?></td>
                                        <td align="center"><?php echo $result->tebal ?></td>
                                        <td align="center"><?php echo $result->lebar ?></td>
                                        <td align="center"><?php echo $result->panjang ?></td>
                                        <td align="center"><?php echo $result->qty ?></td>
                                        <td align="right"><?php echo $result->m2 ?></td>
                                        <td align="right"><?php echo $result->kg ?></td>
                                    </tr>
                                    <?php
                                    $total_qty += $result->qty;
                                    $total_m2 += $result->m2;
                                    $total_kg += $result->kg;

                                    if ($min_col != 0) {
                                        $min_col -= 1;
                                    }
                                }
                            }

                            for ($i = 0; $i < $min_col; $i++) {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <td align="center"><b>Total</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><?php echo $total_qty ?></td>
                                <td align="right"><?php echo $total_m2 ?></td>
                                <td align="right"><?php echo $total_kg ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <table width="100%" class="data_table2">
                        <caption>PIPA BULAT</caption>
                        <thead>
                            <tr>
                                <th width="28%" align="center">Tebal Plat</th>
                                <th width="17%" align="center">D. Luar</th>
                                <th width="10%" align="center">Rad</th>
                                <th width="10%" align="center">Panjang</th>
                                <th width="7%" align="center">Qty</th>
                                <th width="14%" align="center">M2</th>
                                <th width="14%" align="center">Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = $this->model_rawmaterial->select_by_costingid_rawcategoryid_rawtypeid($costingid, 1, 2);
                            $min_col = 4;
                            $total_qty = 0;
                            $total_m2 = 0;
                            $total_kg = 0;
                            if (!empty($record)) {
                                foreach ($record as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->tebalplat ?></td>
                                        <td align="center"><?php echo $result->diameter ?></td>
                                        <td align="center"><?php echo $result->radius ?></td>
                                        <td align="center"><?php echo $result->panjang ?></td>
                                        <td align="center"><?php echo $result->qty ?></td>
                                        <td align="right"><?php echo $result->m2 ?></td>
                                        <td align="right"><?php echo $result->kg ?></td>
                                    </tr>
                                    <?php
                                    $total_qty += $result->qty;
                                    $total_m2 += $result->m2;
                                    $total_kg += $result->kg;

                                    if ($min_col != 0) {
                                        $min_col -= 1;
                                    }
                                }
                            }

                            for ($i = 0; $i < $min_col; $i++) {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <td align="center"><b>Total</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><?php echo $total_qty ?></td>
                                <td align="right"><?php echo $total_m2 ?></td>
                                <td align="right"><?php echo $total_kg ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <table width="100%" class="data_table2">
                        <caption>AS KOTAK/STRIP PLATE/PLAT</caption>
                        <thead>
                            <tr>
                                <th width="28%" align="center">Penampang</th>
                                <th width="17%" align="center">Tebal</th>
                                <th width="10%" align="center">Lebar</th>
                                <th width="10%" align="center">Panjang</th>
                                <th width="7%" align="center">Qty</th>
                                <th width="14%" align="center">M2</th>
                                <th width="14%" align="center">Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = $this->model_rawmaterial->select_by_costingid_rawcategoryid_rawtypeid($costingid, 1, 3);
                            $min_col = 4;
                            $total_qty = 0;
                            $total_m2 = 0;
                            $total_kg = 0;
                            if (!empty($record)) {
                                foreach ($record as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->penampang ?></td>
                                        <td align="center"><?php echo $result->tebal ?></td>
                                        <td align="center"><?php echo $result->lebar ?></td>
                                        <td align="center"><?php echo $result->panjang ?></td>
                                        <td align="center"><?php echo $result->qty ?></td>
                                        <td align="right"><?php echo $result->m2 ?></td>
                                        <td align="right"><?php echo $result->kg ?></td>
                                    </tr>
                                    <?php
                                    $total_qty += $result->qty;
                                    $total_m2 += $result->m2;
                                    $total_kg += $result->kg;

                                    if ($min_col != 0) {
                                        $min_col -= 1;
                                    }
                                }
                            }

                            for ($i = 0; $i < $min_col; $i++) {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <td align="center"><b>Total</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><?php echo $total_qty ?></td>
                                <td align="right"><?php echo $total_m2 ?></td>
                                <td align="right"><?php echo $total_kg ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <table width="100%" class="data_table2">
                        <caption>AS BULAT</caption>
                        <thead>
                            <tr>
                                <th width="28%" align="center">Penampang</th>
                                <th width="17%" align="center">D. Luar</th>
                                <th width="10%" align="center">Rad</th>
                                <th width="10%" align="center">Panjang</th>
                                <th width="7%" align="center">Qty</th>
                                <th width="14%" align="center">M2</th>
                                <th width="14%" align="center">Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = $this->model_rawmaterial->select_by_costingid_rawcategoryid_rawtypeid($costingid, 1, 4);
                            $min_col = 4;
                            $total_qty = 0;
                            $total_m2 = 0;
                            $total_kg = 0;
                            if (!empty($record)) {
                                foreach ($record as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->penampang ?></td>
                                        <td align="center"><?php echo $result->diameter ?></td>
                                        <td align="center"><?php echo $result->radius ?></td>
                                        <td align="center"><?php echo $result->panjang ?></td>
                                        <td align="center"><?php echo $result->qty ?></td>
                                        <td align="right"><?php echo $result->m2 ?></td>
                                        <td align="right"><?php echo $result->kg ?></td>
                                    </tr>
                                    <?php
                                    $total_qty += $result->qty;
                                    $total_m2 += $result->m2;
                                    $total_kg += $result->kg;

                                    if ($min_col != 0) {
                                        $min_col -= 1;
                                    }
                                }
                            }

                            for ($i = 0; $i < $min_col; $i++) {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <td align="center"><b>Total</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><?php echo $total_qty ?></td>
                                <td align="right"><?php echo $total_m2 ?></td>
                                <td align="right"><?php echo $total_kg ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <table width="100%" class="data_table2">
                        <caption>PLAT SIKU</caption>
                        <thead>
                            <tr>
                                <th width="28%" align="center">Penampang</th>
                                <th width="17%" align="center">Tebal</th>
                                <th width="10%" align="center">Lebar</th>
                                <th width="10%" align="center">Panjang</th>
                                <th width="7%" align="center">Qty</th>
                                <th width="14%" align="center">M2</th>
                                <th width="14%" align="center">Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = $this->model_rawmaterial->select_by_costingid_rawcategoryid_rawtypeid($costingid, 1, 5);
                            $min_col = 4;
                            $total_qty = 0;
                            $total_m2 = 0;
                            $total_kg = 0;
                            if (!empty($record)) {
                                foreach ($record as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->penampang ?></td>
                                        <td align="center"><?php echo $result->tebal ?></td>
                                        <td align="center"><?php echo $result->lebar ?></td>
                                        <td align="center"><?php echo $result->panjang ?></td>
                                        <td align="center"><?php echo $result->qty ?></td>
                                        <td align="right"><?php echo $result->m2 ?></td>
                                        <td align="right"><?php echo $result->kg ?></td>
                                    </tr>
                                    <?php
                                    $total_qty += $result->qty;
                                    $total_m2 += $result->m2;
                                    $total_kg += $result->kg;

                                    if ($min_col != 0) {
                                        $min_col -= 1;
                                    }
                                }
                            }

                            for ($i = 0; $i < $min_col; $i++) {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <td align="center"><b>Total</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><?php echo $total_qty ?></td>
                                <td align="right"><?php echo $total_m2 ?></td>
                                <td align="right"><?php echo $total_kg ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="34%">
                    <table width="100%">
                        <tr>
                            <td width="100%">
                                BJ Stainless : 7,750 Kg/M3, 
                                Total luas :  <?php echo $this->model_rawmaterial->get_total_luas($costingid, 2) ?> ,
                                Total Kg : <?php echo $this->model_rawmaterial->get_total_kg($costingid, 2) ?>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" class="data_table2">
                        <caption>PIPA KOTAK</caption>
                        <thead>
                            <tr>
                                <th width="28%" align="center">Tebal Plat</th>
                                <th width="17%" align="center">Tebal</th>
                                <th width="10%" align="center">Lebar</th>
                                <th width="10%" align="center">Panjang</th>
                                <th width="7%" align="center">Qty</th>
                                <th width="14%" align="center">M2</th>
                                <th width="14%" align="center">Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = $this->model_rawmaterial->select_by_costingid_rawcategoryid_rawtypeid($costingid, 2, 1);
                            $min_col = 4;
                            $total_qty = 0;
                            $total_m2 = 0;
                            $total_kg = 0;
                            if (!empty($record)) {
                                foreach ($record as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->tebalplat ?></td>
                                        <td align="center"><?php echo $result->tebal ?></td>
                                        <td align="center"><?php echo $result->lebar ?></td>
                                        <td align="center"><?php echo $result->panjang ?></td>
                                        <td align="center"><?php echo $result->qty ?></td>
                                        <td align="right"><?php echo $result->m2 ?></td>
                                        <td align="right"><?php echo $result->kg ?></td>
                                    </tr>
                                    <?php
                                    $total_qty += $result->qty;
                                    $total_m2 += $result->m2;
                                    $total_kg += $result->kg;

                                    if ($min_col != 0) {
                                        $min_col -= 1;
                                    }
                                }
                            }

                            for ($i = 0; $i < $min_col; $i++) {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <td align="center"><b>Total</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><?php echo $total_qty ?></td>
                                <td align="right"><?php echo $total_m2 ?></td>
                                <td align="right"><?php echo $total_kg ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <table width="100%" class="data_table2">
                        <caption>PIPA BULAT</caption>
                        <thead>
                            <tr>
                                <th width="28%" align="center">Tebal Plat</th>
                                <th width="17%" align="center">D. Luar</th>
                                <th width="10%" align="center">Rad</th>
                                <th width="10%" align="center">Panjang</th>
                                <th width="7%" align="center">Qty</th>
                                <th width="14%" align="center">M2</th>
                                <th width="14%" align="center">Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = $this->model_rawmaterial->select_by_costingid_rawcategoryid_rawtypeid($costingid, 2, 2);
                            $min_col = 4;
                            $total_qty = 0;
                            $total_m2 = 0;
                            $total_kg = 0;
                            if (!empty($record)) {
                                foreach ($record as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->tebalplat ?></td>
                                        <td align="center"><?php echo $result->diameter ?></td>
                                        <td align="center"><?php echo $result->radius ?></td>
                                        <td align="center"><?php echo $result->panjang ?></td>
                                        <td align="center"><?php echo $result->qty ?></td>
                                        <td align="right"><?php echo $result->m2 ?></td>
                                        <td align="right"><?php echo $result->kg ?></td>
                                    </tr>
                                    <?php
                                    $total_qty += $result->qty;
                                    $total_m2 += $result->m2;
                                    $total_kg += $result->kg;

                                    if ($min_col != 0) {
                                        $min_col -= 1;
                                    }
                                }
                            }

                            for ($i = 0; $i < $min_col; $i++) {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <td align="center"><b>Total</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><?php echo $total_qty ?></td>
                                <td align="right"><?php echo $total_m2 ?></td>
                                <td align="right"><?php echo $total_kg ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <table width="100%" class="data_table2">
                        <caption>AS KOTAK/STRIP PLATE/PLAT</caption>
                        <thead>
                            <tr>
                                <th width="28%" align="center">Penampang</th>
                                <th width="17%" align="center">Tebal</th>
                                <th width="10%" align="center">Lebar</th>
                                <th width="10%" align="center">Panjang</th>
                                <th width="7%" align="center">Qty</th>
                                <th width="14%" align="center">M2</th>
                                <th width="14%" align="center">Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = $this->model_rawmaterial->select_by_costingid_rawcategoryid_rawtypeid($costingid, 2, 3);
                            $min_col = 4;
                            $total_qty = 0;
                            $total_m2 = 0;
                            $total_kg = 0;
                            if (!empty($record)) {
                                foreach ($record as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->penampang ?></td>
                                        <td align="center"><?php echo $result->tebal ?></td>
                                        <td align="center"><?php echo $result->lebar ?></td>
                                        <td align="center"><?php echo $result->panjang ?></td>
                                        <td align="center"><?php echo $result->qty ?></td>
                                        <td align="right"><?php echo $result->m2 ?></td>
                                        <td align="right"><?php echo $result->kg ?></td>
                                    </tr>
                                    <?php
                                    $total_qty += $result->qty;
                                    $total_m2 += $result->m2;
                                    $total_kg += $result->kg;

                                    if ($min_col != 0) {
                                        $min_col -= 1;
                                    }
                                }
                            }

                            for ($i = 0; $i < $min_col; $i++) {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <td align="center"><b>Total</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><?php echo $total_qty ?></td>
                                <td align="right"><?php echo $total_m2 ?></td>
                                <td align="right"><?php echo $total_kg ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <table width="100%" class="data_table2">
                        <caption>AS BULAT</caption>
                        <thead>
                            <tr>
                                <th width="28%" align="center">Penampang</th>
                                <th width="17%" align="center">D. Luar</th>
                                <th width="10%" align="center">Rad</th>
                                <th width="10%" align="center">Panjang</th>
                                <th width="7%" align="center">Qty</th>
                                <th width="14%" align="center">M2</th>
                                <th width="14%" align="center">Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = $this->model_rawmaterial->select_by_costingid_rawcategoryid_rawtypeid($costingid, 2, 4);
                            $min_col = 4;
                            $total_qty = 0;
                            $total_m2 = 0;
                            $total_kg = 0;
                            if (!empty($record)) {
                                foreach ($record as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->penampang ?></td>
                                        <td align="center"><?php echo $result->diameter ?></td>
                                        <td align="center"><?php echo $result->radius ?></td>
                                        <td align="center"><?php echo $result->panjang ?></td>
                                        <td align="center"><?php echo $result->qty ?></td>
                                        <td align="right"><?php echo $result->m2 ?></td>
                                        <td align="right"><?php echo $result->kg ?></td>
                                    </tr>
                                    <?php
                                    $total_qty += $result->qty;
                                    $total_m2 += $result->m2;
                                    $total_kg += $result->kg;

                                    if ($min_col != 0) {
                                        $min_col -= 1;
                                    }
                                }
                            }

                            for ($i = 0; $i < $min_col; $i++) {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <td align="center"><b>Total</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><?php echo $total_qty ?></td>
                                <td align="right"><?php echo $total_m2 ?></td>
                                <td align="right"><?php echo $total_kg ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <table width="100%" class="data_table2">
                        <caption>PLAT SIKU</caption>
                        <thead>
                            <tr>
                                <th width="28%" align="center">Penampang</th>
                                <th width="17%" align="center">Tebal</th>
                                <th width="10%" align="center">Lebar</th>
                                <th width="10%" align="center">Panjang</th>
                                <th width="7%" align="center">Qty</th>
                                <th width="14%" align="center">M2</th>
                                <th width="14%" align="center">Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = $this->model_rawmaterial->select_by_costingid_rawcategoryid_rawtypeid($costingid, 2, 5);
                            $min_col = 4;
                            $total_qty = 0;
                            $total_m2 = 0;
                            $total_kg = 0;
                            if (!empty($record)) {
                                foreach ($record as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->penampang ?></td>
                                        <td align="center"><?php echo $result->tebal ?></td>
                                        <td align="center"><?php echo $result->lebar ?></td>
                                        <td align="center"><?php echo $result->panjang ?></td>
                                        <td align="center"><?php echo $result->qty ?></td>
                                        <td align="right"><?php echo $result->m2 ?></td>
                                        <td align="right"><?php echo $result->kg ?></td>
                                    </tr>
                                    <?php
                                    $total_qty += $result->qty;
                                    $total_m2 += $result->m2;
                                    $total_kg += $result->kg;

                                    if ($min_col != 0) {
                                        $min_col -= 1;
                                    }
                                }
                            }

                            for ($i = 0; $i < $min_col; $i++) {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <td align="center"><b>Total</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><?php echo $total_qty ?></td>
                                <td align="right"><?php echo $total_m2 ?></td>
                                <td align="right"><?php echo $total_kg ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="33%">             
                    <table width="100%">
                        <tr>
                            <td width="100%">
                                BJ Kuningan : 8,430 Kg/M3, 
                                Total luas :  <?php echo $this->model_rawmaterial->get_total_luas($costingid, 3) ?> ,
                                Total Kg : <?php echo $this->model_rawmaterial->get_total_kg($costingid, 3) ?>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" class="data_table2">
                        <caption>AS KOTAK/STRIP PLATE/PLAT</caption>
                        <thead>
                            <tr>
                                <th width="28%" align="center">Penampang</th>
                                <th width="17%" align="center">Tebal</th>
                                <th width="10%" align="center">Lebar</th>
                                <th width="10%" align="center">Panjang</th>
                                <th width="7%" align="center">Qty</th>
                                <th width="14%" align="center">M2</th>
                                <th width="14%" align="center">Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = $this->model_rawmaterial->select_by_costingid_rawcategoryid_rawtypeid($costingid, 3, 3);
                            $min_col = 4;
                            $total_qty = 0;
                            $total_m2 = 0;
                            $total_kg = 0;
                            if (!empty($record)) {
                                foreach ($record as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->penampang ?></td>
                                        <td align="center"><?php echo $result->tebal ?></td>
                                        <td align="center"><?php echo $result->lebar ?></td>
                                        <td align="center"><?php echo $result->panjang ?></td>
                                        <td align="center"><?php echo $result->qty ?></td>
                                        <td align="right"><?php echo $result->m2 ?></td>
                                        <td align="right"><?php echo $result->kg ?></td>
                                    </tr>
                                    <?php
                                    $total_qty += $result->qty;
                                    $total_m2 += $result->m2;
                                    $total_kg += $result->kg;

                                    if ($min_col != 0) {
                                        $min_col -= 1;
                                    }
                                }
                            }

                            for ($i = 0; $i < $min_col; $i++) {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <td align="center"><b>Total</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><?php echo $total_qty ?></td>
                                <td align="right"><?php echo $total_m2 ?></td>
                                <td align="right"><?php echo $total_kg ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <table width="100%" class="data_table2">
                        <caption>AS BULAT</caption>
                        <thead>
                            <tr>
                                <th width="28%" align="center">Penampang</th>
                                <th width="17%" align="center">D. Luar</th>
                                <th width="10%" align="center">Rad</th>
                                <th width="10%" align="center">Panjang</th>
                                <th width="7%" align="center">Qty</th>
                                <th width="14%" align="center">M2</th>
                                <th width="14%" align="center">Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = $this->model_rawmaterial->select_by_costingid_rawcategoryid_rawtypeid($costingid, 3, 4);
                            $min_col = 4;
                            $total_qty = 0;
                            $total_m2 = 0;
                            $total_kg = 0;
                            if (!empty($record)) {
                                foreach ($record as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->penampang ?></td>
                                        <td align="center"><?php echo $result->diameter ?></td>
                                        <td align="center"><?php echo $result->radius ?></td>
                                        <td align="center"><?php echo $result->panjang ?></td>
                                        <td align="center"><?php echo $result->qty ?></td>
                                        <td align="right"><?php echo $result->m2 ?></td>
                                        <td align="right"><?php echo $result->kg ?></td>
                                    </tr>
                                    <?php
                                    $total_qty += $result->qty;
                                    $total_m2 += $result->m2;
                                    $total_kg += $result->kg;

                                    if ($min_col != 0) {
                                        $min_col -= 1;
                                    }
                                }
                            }

                            for ($i = 0; $i < $min_col; $i++) {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?> 
                            <tr>
                                <td align="center"><b>Total</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><?php echo $total_qty ?></td>
                                <td align="right"><?php echo $total_m2 ?></td>
                                <td align="right"><?php echo $total_kg ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>