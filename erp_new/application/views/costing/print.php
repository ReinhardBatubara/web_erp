<?php
$post_id_ = $this->input->post('id');
if (!empty($post_id_)) {
    ?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">

    <HTML>
        <HEAD>
            <TITLE>Costing</TITLE>
            <STYLE>
                BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Calibri"; font-size:11px }
            </STYLE>
        </HEAD>
        <BODY TEXT="#000000">
            <center>
                <?php
            }
            ?>


            <TABLE FRAME=VOID CELLSPACING=0 COLS=9 RULES=NONE BORDER=0>
                <COLGROUP>
                <COL WIDTH=100>
                <COL WIDTH=10>
                <COL WIDTH=112>
                <COL WIDTH=12>
                <COL WIDTH=92>
                <COL WIDTH=12>
                <COL WIDTH=129>
                <COL WIDTH=86>
                <COL WIDTH=86>
                </COLGROUP>
                <TBODY>
                    <TR>
                        <TD WIDTH=120 HEIGHT=19 ALIGN=LEFT VALIGN=MIDDLE>ITEM NAME</FONT></TD>
                        <TD WIDTH=10 ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000">:</FONT></TD>
                        <TD COLSPAN=7 WIDTH=528 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><?php echo $costing->name ?></FONT></TD>
                    </TR>
                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000">DIMENTION</FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000">:</FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="1802" SDNUM="1033;"><FONT COLOR="#000000"><?php echo $costing->dw ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000">x</FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="555" SDNUM="1033;"><FONT COLOR="#000000"><?php echo $costing->dh ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000">x</FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="805" SDNUM="1033;"><FONT COLOR="#000000"><?php echo $costing->dd ?></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>		
                    <TR>
                        <TD HEIGHT=19 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000">PACKING DIMENTION 1</FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000">:</FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="1952" SDNUM="1033;"><FONT COLOR="#000000"><?php echo $costing->pw ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="705" SDNUM="1033;"><FONT COLOR="#000000"><?php echo $costing->pd ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="955" SDNUM="1033;"><FONT COLOR="#000000"><?php echo $costing->ph ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="1.3142328" SDNUM="1033;0;0.00"><FONT COLOR="#000000"><?php echo number_format(($costing->pw * $costing->pd * $costing->ph) / 1000000000, 2) ?></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=19 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000">PACKING DIMENTION 2</FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000">:</FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;0.00"><FONT COLOR="#000000"><?php echo number_format(($costing->pw2 * $costing->pd2 * $costing->ph2) / 1000000000, 2) ?></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=19 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000">VOLUME PACKING :</FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="1.3142328" SDNUM="1033;0;0.00"><FONT COLOR="#000000"><?php echo number_format(($costing->pw * $costing->pd * $costing->ph) / 1000000000, 2) ?></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=5 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=5 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=3 HEIGHT=56 ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000">Departement</FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=3 ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000">MATERIALS</FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=3 ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000">PERCENTAGE</FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" ALIGN=RIGHT VALIGN=MIDDLE BGCOLOR="#FF8080"><FONT COLOR="#000000">MATERIAL PRICE : </FONT></TD>
                        <TD STYLE="border-top: 1px solid #0066cc; border-bottom: 1px solid #0066cc; border-left: 1px solid #0066cc; border-right: 1px solid #0066cc" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->material_price, 0) ?></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" ALIGN=RIGHT VALIGN=MIDDLE BGCOLOR="#FF8080"><FONT COLOR="#000000">CARVING : </FONT></TD>
                        <TD STYLE="border-top: 1px solid #0066cc; border-bottom: 1px solid #0066cc; border-left: 1px solid #0066cc; border-right: 1px solid #0066cc" ALIGN=CENTER VALIGN=MIDDLE BGCOLOR="#00CCFF" SDVAL="50000" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->carving, 0) ?></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=5 ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000">Roughmill</FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD STYLE="border-top: 1px solid #0066cc; border-bottom: 1px solid #0066cc; border-left: 1px solid #0066cc; border-right: 1px solid #0066cc" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->roughmill, 0) ?></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;0%"><FONT COLOR="#000000">
                                <?php
                                if ($costing->material_price == 0) {
                                    echo "0";
                                } else {
                                    echo number_format(($costing->roughmill * 100 / $costing->material_price), 0);
                                }
                                ?>
                            </FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000">Labour Cost :</FONT></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->labour_cost, 0) ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE BGCOLOR="#00CCFF" SDVAL="0.25" SDNUM="1033;0;0%"><FONT COLOR="#000000"><?php echo $costing->labour_cost_percentage ?> %</FONT></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=5 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000">Machining</FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD STYLE="border-top: 1px solid #0066cc; border-bottom: 1px solid #0066cc; border-left: 1px solid #0066cc; border-right: 1px solid #0066cc" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->machining, 0) ?></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;0%"><FONT COLOR="#000000">
                                <?php
                                if ($costing->material_price == 0) {
                                    echo '0';
                                } else {
                                    echo number_format(($costing->machining * 100 / $costing->material_price), 0);
                                }
                                ?>
                            </FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000">Manufacture Cost :</FONT></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->manufacture_cost, 0) ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=5 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000">Assembling</FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD STYLE="border-top: 1px solid #0066cc; border-bottom: 1px solid #0066cc; border-left: 1px solid #0066cc; border-right: 1px solid #0066cc" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->assembling, 0) ?></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;0%"><FONT COLOR="#000000">
                                <?php
                                if ($costing->material_price == 0) {
                                    echo '0';
                                } else {
                                    echo number_format(($costing->assembling * 100 / $costing->material_price), 0);
                                }
                                ?>
                            </FONT>
                        </TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000">X FACTOR <?php echo $costing->xfactor_percentage ?> % :</FONT></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->xfactor, 0) ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=5 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000">Finishing</FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD STYLE="border-top: 1px solid #0066cc; border-bottom: 1px solid #0066cc; border-left: 1px solid #0066cc; border-right: 1px solid #0066cc" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->finishing, 0) ?></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;0%"><FONT COLOR="#000000">
                                <?php
                                if ($costing->material_price == 0) {
                                    echo '0';
                                } else {
                                    echo number_format(($costing->finishing * 100 / $costing->material_price), 0);
                                }
                                ?>
                            </FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000">Overhead :</FONT></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->overhead, 0) ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE BGCOLOR="#FFFF00" SDVAL="0.26" SDNUM="1033;0;0%"><FONT COLOR="#000000"><?php echo $costing->overhead_percentage ?>%</FONT></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=5 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000">Upholstery</FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD STYLE="border-top: 1px solid #0066cc; border-bottom: 1px solid #0066cc; border-left: 1px solid #0066cc; border-right: 1px solid #0066cc" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->upholstery, 0) ?></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;0%"><FONT COLOR="#000000"><?php
                                if ($costing->material_price == 0) {
                                    echo '0';
                                } else {
                                    echo number_format(($costing->upholstery / $costing->material_price) / 100, 0);
                                }
                                ?>
                            </FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000">Shipment Cost  :</FONT></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0.26284656" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->shipment_cost, 0) ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=5 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000">Packing</FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD STYLE="border-top: 1px solid #0066cc; border-bottom: 1px solid #0066cc; border-left: 1px solid #0066cc; border-right: 1px solid #0066cc" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->packing, 0) ?></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;0%"><FONT COLOR="#000000"><?php
                                if ($costing->material_price == 0) {
                                    echo '0';
                                } else {
                                    echo number_format(($costing->packing * 100 / $costing->material_price), 0);
                                }
                                ?>
                            </FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000">Total :</FONT></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->total, 0) ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=5 ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" COLSPAN=3 ROWSPAN=8 HEIGHT=150 ALIGN=CENTER VALIGN=MIDDLE>
                            <?php
                            $post_id_ = $this->input->post('id');
                            if (!empty($post_id_)) {
                                ?>
                                <img src="../../files/model/<?php echo $costing->model_image ?>" style="max-width: 240px;max-height: 150px "/>
                                <?php
                            } else {
                                ?>
                                <img src="files/model/<?php echo $costing->model_image ?>" style="max-width: 240px;max-height: 150px "/>
                                <?php
                            }
                            ?>
                        </TD>
                        <TD STYLE="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=2 ROWSPAN=4 ALIGN=CENTER VALIGN=MIDDLE><B><FONT FACE="Segoe Print" COLOR="#000000"><?php echo date('d-M-Y', strtotime($costing->date)) ?></FONT></B></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000">Margin <?php echo $costing->margin_percentage ?>% :</FONT></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->margin, 0) ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000">TOTAL PRICE :</FONT></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><?php echo number_format($costing->total_price, 0) ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=2 ROWSPAN=4 ALIGN=CENTER VALIGN=MIDDLE><B><FONT FACE="Segoe Print" COLOR="#000000">COSTING BY :<BR><?php echo $costing->employee_costing_by; ?></FONT></B></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000">USD :</FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="0"><FONT COLOR="#000000"><?php echo number_format($costing->total_to_rate, 0) ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0.000"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE SDNUM="1033;0;0.00"><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=RIGHT VALIGN=MIDDLE SDNUM="1033;0;#,##0"><FONT COLOR="#000000">SELLING PRICE :</FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE SDVAL="0" ><FONT COLOR="#000000"><?php echo number_format($costing->selling_price, 0) ?></FONT></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE BGCOLOR="#00CCFF" SDVAL="0.2" SDNUM="1033;0;0%"><FONT COLOR="#000000"><?php echo $costing->selling_price_percentage ?>%</FONT></TD>
                    </TR>
                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><FONT COLOR="#000000"><BR></FONT></TD>
                    </TR>
                </TBODY>
            </TABLE>
            <!-- ************************************************************************** -->
            <?php
            if (!empty($post_id_)) {
                ?>
            </center>
        </BODY>
    </HTML>
<?php } ?>