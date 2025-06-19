<div id="tracking_toolbar" style="padding-bottom: 2px;padding-top: 2px;">
    <span style="display: inline-block">
        Serial
        <input type="text" 
               class="easyui-validatebox" 
               id="t_serial"
               style="width: 100px;margin: 0 10px 0 0px;"
               onkeyup="if (event.keyCode === 13) {
                           tracking_search();
                       }"
               />
    </span>
    <span style="display: inline-block">
        Item Code <input type="text" 
                         class="easyui-validatebox" 
                         id="t_itemcode" 
                         style="width: 100px;margin: 0 10px 0 0px;"
                         onkeyup="if (event.keyCode === 13) {
                                     tracking_search();
                                 }" 
                         />
    </span>
    <span style="display: inline-block">
        Item Name <input type="text" 
                         class="easyui-validatebox" 
                         id="t_itemname" 
                         style="width: 100px;margin: 0 10px 0 0px;" 
                         onkeyup="if (event.keyCode === 13) {
                                     tracking_search();
                                 }" 
                         />
    </span>
    <span style="display: inline-block">
        JO No <input type="text" 
                     class="easyui-validatebox" 
                     id="t_jo_no" 
                     style="width: 100px;margin: 0 10px 0 0px;"
                     onkeyup="if (event.keyCode === 13) {
                                 tracking_search();
                             }" />
    </span>
    <span style="display: inline-block">
        SO No <input type="text" 
                     class="easyui-validatebox" 
                     id="t_so_no" 
                     style="width: 100px;margin: 0 10px 0 0px;"
                     onkeyup="if (event.keyCode === 13) {
                                 tracking_search();
                             }" 
                     />
    </span>
    <span style="display: inline-block">
        PO No <input type="text" 
                     class="easyui-validatebox" 
                     id="t_po_no"
                     style="width: 100px;margin: 0 10px 0 0px;"
                     onkeyup="if (event.keyCode === 13) {
                                 tracking_search();
                             }" 
                     />
    </span>
    <span style="display: inline-block">
        Customer           
        <input class="easyui-combobox" name="customerid" id="t_customerid" data-options="
               url: '<?php echo site_url('customer/get') ?>',
               method: 'post',
               valueField: 'id',
               textField: 'name',
               panelHeight: '200',
               panelWidth:'150',
               mode: 'remote',
               formatter: format_t_customerid_s,
               onSelect:function(row){tracking_search()}"
               style="width: 100px">
        <script type="text/javascript">
            function format_t_customerid_s(row) {
                return '<span>' + row.code + '<br/>' + row.name + '</span>';
            }
        </script>
    </span>
    <span style="display: inline-block;">
        Order Type 
        <select name="order_type" class="easyui-combobox" data-options="onChange:function(n,o){tracking_search()}" id="tracking_order_type" panelHeight="auto">
            <option value=""></option>
            <option value="Order">Order</option>
            <option value="Stock/Sample">Stock/Sample</option>
        </select>
    </span>
    <span style="display: inline-block;">
        Position 
        <select name="process_id" class="easyui-combobox" 
                data-options="onChange:function(n,o){tracking_search()}" id="tracking_process_id_s" 
                panelHeight="auto" PanelWidth="200" style="width: 100px;">
            <option value=""></option>
            <?php
            foreach ($process as $result) {
                echo "<option value=" . $result->id . ">" . $result->name . "</option>";
            }
            ?>
        </select>
    </span>

    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="tracking_search()"></a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-csv" plain="true" onclick="tracking_import_process()">Import Process</a>
    <!--                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-history" plain="true" onclick="tracking_view_history()">History</a>-->
    <a href="javascript:void(0)" class="easyui-menubutton" iconCls="icon-edit" plain="true" data-options="menu:'#mm-tracking-edit'" id="tracking-edit">Edit</a>
    <a href="javascript:void(0)" class="easyui-menubutton" iconCls="icon-back" plain="true" data-options="menu:'#mm-tracking-back'" id="tracking-back">Back To</a>                
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-make-to-stock" plain="true" onclick="tracking_make_to_stock()">Make to Stock</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-finished" plain="true" onclick="tracking_edit(7, 'ot')">Finished / Packing Out</a>
    <a href="javascript:void(0)" class="easyui-menubutton" iconCls="icon-print" plain="true" data-options="menu:'#mm-print-target'" id="tracking-back">Print Target</a>

</div>
<div id="mm-tracking-edit" class="easyui-menu">
    <?php
    foreach ($process as $result) {
        if($result->id != 8){
        ?>
        <div onclick="tracking_edit(<?php echo $result->id ?>, 'in')">
            <span><?php echo $result->name ?></span>            
        </div>
        <?php
        }
    }
    ?>
</div>
<div id="mm-tracking-back" class="easyui-menu">
    <?php
    foreach ($process as $result) {
        if ($result->id != 8) {
            ?>
            <div onclick="tracking_back_item(<?php echo $result->id ?>)"><span><?php echo $result->name ?></span></div>
            <?php
        }
    }
    ?>
</div>
<div id="mm-print-target" class="easyui-menu">
    <?php
    foreach ($process as $result) {
        if ($result->id != 8) {
            ?>
            <div onclick="tracking_print_target(<?php echo $result->id ?>)"><span><?php echo $result->name ?></span></div>
            <?php
        }
    }
    ?>
</div>

<table id="tracking" data-options="
       url:'<?php echo site_url('tracking/get') ?>',
       method:'post',
       border:true,
       title:'Tracking',
       singleSelect:true,
       pageList: [30, 50, 70, 90, 110],
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       checkOnSelect: false,
       selectOnCheck: false,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#tracking_toolbar'">
    <thead frozen="true">
        <tr> 
            <th field="tracking_chck" checkbox="true"></th>
            <th field="serial" width="60" halign="center" sortable="true">Serial</th>
            <!--<th field="modelcode" width="70" halign="center" sortable="true">Item Code</th>-->
            <th field="originalcode" width="70" halign="center" sortable="true">Original<br/>Code</th>
            <th field="modelname" width="90" halign="center" sortable="true">Item Name</th>
            <th field="po_no" width="70" halign="center" sortable="true">PO</th>
            <th field="customer_code" width="50" align="center" sortable="true">Cust<br/>omer</th>
            <th field="position" width="80" halign="center" sortable="true">Position</th>
        </tr>
    </thead>
    <thead>
        <tr>
            <th field="order_type" width="60" align="center" rowspan="3" sortable="true">Type</th>
            <th field="jo_no" width="70" align="center" rowspan="3" sortable="true">JO</th>
            <th field="so_no" width="80" align="center" rowspan="3" sortable="true">SO</th>
            <th field="finishing" width="80" halign="center" rowspan="3" sortable="true">Finishing</th>                
            <th colspan="3" rowspan="2">Size</th>
            <th colspan="3" rowspan="2">Packaging Size</th>
            <th colspan="6" rowspan="2">Target Completion</th>
            <th colspan="32">Production Process</th>
            <th field="remark" width="280" halign="center" rowspan="3" formatter="trackingRemarkFormat">Remark</th>            
        </tr>
        <tr>
            <th colspan="4" align="center">Rough Mill</th>
            <th colspan="4" align="center">Machine/Assembly</th>
            <th colspan="4" align="center">Carving</th>
            <th colspan="4" align="center">Sanding</th>
            <th colspan="4" align="center">Finishing</th>
            <th colspan="4" align="center">Upholstry</th>
            <th colspan="4" align="center">Packaging</th>
            <th colspan="4" align="center">Shipment</th>
        </tr>
        <tr>
            <th field="size_w" width="30" align="center">W</th>
            <th field="size_d" width="30" align="center">D</th>
            <th field="size_h" width="30" align="center">H</th>
            <th field="packing_size_w" width="30" align="center">W</th>
            <th field="packing_size_d" width="30" align="center">D</th>
            <th field="packing_size_h" width="30" align="center">H</th>
            <th field="tc_ms" width="55" align="center" formatter="myFormatDate_d_f_y">MS</th>
            <th field="tc_carving" width="55" align="center" formatter="myFormatDate_d_f_y">CARVING</th>
            <th field="tc_sand" width="55" align="center" formatter="myFormatDate_d_f_y">SAND</th>
            <th field="tc_fin" width="55" align="center" formatter="myFormatDate_d_f_y">FIN</th>
            <th field="tc_uph" width="55" align="center" formatter="myFormatDate_d_f_y">UPH</th>
            <th field="tc_pack" width="55" align="center" formatter="myFormatDate_d_f_y">PACK</th>
            <!-- Rough mill -->
            <th field="rm_in" width="55" align="center" formatter="myFormatDate_d_f_y">In</th>
            <th field="rm_out" width="55" align="center" formatter="myFormatDate_d_f_y">Out</th>
            <th field="rm_aging" width="40" align="center">Aging</th>
            <th field="rm_lt" width="30" align="center">LT</th>
            <!-- MACHINE -->
            <th field="mc_in" width="55" align="center" formatter="myFormatDate_d_f_y" styler="mc_late_style">In</th>
            <th field="mc_out" width="55" align="center" formatter="myFormatDate_d_f_y" styler="mc_late_style">Out</th>
            <th field="mc_aging" width="40" align="center" styler="mc_late_style">Aging</th>
            <th field="mc_lt" width="30" align="center" styler="mc_late_style">LT</th>
            <!-- CARVING -->
            <th field="cv_in" width="55" align="center" formatter="myFormatDate_d_f_y" styler="cv_late_style">In</th>
            <th field="cv_out" width="55" align="center" formatter="myFormatDate_d_f_y" styler="cv_late_style">Out</th>
            <th field="cv_aging" width="40" align="center" styler="cv_late_style">Aging</th>
            <th field="cv_lt" width="30" align="center" styler="cv_late_style">LT</th>
            <!-- SANDING -->
            <th field="sn_in" width="55" align="center" formatter="myFormatDate_d_f_y" styler="sn_late_style">In</th>
            <th field="sn_out" width="55" align="center" formatter="myFormatDate_d_f_y" styler="sn_late_style">Out</th>
            <th field="sn_aging" width="40" align="center" styler="sn_late_style">Aging</th>
            <th field="sn_lt" width="30" align="center" styler="sn_late_style">LT</th>
            <!-- FINISHING -->
            <th field="fn_in" width="55" align="center" formatter="myFormatDate_d_f_y" styler="fn_late_style">In</th>
            <th field="fn_out" width="55" align="center" formatter="myFormatDate_d_f_y" styler="fn_late_style">Out</th>
            <th field="fn_aging" width="40" align="center" styler="fn_late_style">Aging</th>
            <th field="fn_lt" width="30" align="center" styler="fn_late_style">LT</th>
            <!-- UPHOLSTERY -->
            <th field="up_in" width="55" align="center" formatter="myFormatDate_d_f_y" styler="up_late_style">In</th>
            <th field="up_out" width="55" align="center" formatter="myFormatDate_d_f_y" styler="up_late_style">Out</th>
            <th field="up_aging" width="40" align="center" styler="up_late_style">Aging</th>
            <th field="up_lt" width="30" align="center" styler="up_late_style">LT</th>
            <!-- PACKING -->            
            <th field="pack_in" width="55" align="center" formatter="myFormatDate_d_f_y" styler="pack_late_style">In</th>
            <th field="pack_out" width="55" align="center" formatter="myFormatDate_d_f_y" styler="pack_late_style">Out</th>
            <th field="pack_aging" width="40" align="center" styler="pack_late_style">Aging</th>
            <th field="pack_lt" width="30" align="center" styler="pack_late_style">LT</th>
            <!-- Shipping -->
            <th field="ship_date" width="55" align="center" formatter="myFormatDate_d_f_y">DATE</th>
            <th field="ship_to" width="100" align="center">TO</th>
            <th field="ship_aging" width="40" align="center">AGING</th>
            <th field="ship_lt" width="30" align="center">LT</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    var trck_last_index_select = -1;
    $(function () {
        $('#tracking').datagrid({
            //            onSelect:function(index,row){
            //                if(trck_last_index_select != -1){
            //                    $(this).datagrid('unselectRow',trck_last_index_select);
            //                }
            //                trck_last_index_select = index;
            //            },
            onRowContextMenu: function (e, index, row) {
                $(this).datagrid('selectRow', index);
                e.preventDefault();
                if (!cmenu_tracking) {
                    createColumnMenu(row);
                }
                cmenu_tracking.menu('show', {
                    left: e.pageX,
                    top: e.pageY
                });
            },
            onCheck: function (index, row) {
                $('#tracking').datagrid('unselectAll');
                //                if(row_s != null){
                //                    alert(row_s.index);
                //                    //$('#tracking').datagrid('unselectRow',row_s.index);
                //                }
            },
            onLoad: function () {
                $('#tracking').datagrid('uncheckAll');
                $('#tracking').datagrid('unselectAll');
            }
        });

        var cmenu_tracking;
        function createColumnMenu(row) {
            cmenu_tracking = $('<div/>').appendTo('body');
            cmenu_tracking.menu();
            cmenu_tracking.menu('appendItem', {
                text: 'View Detail',
                name: 'Detail',
                iconCls: 'icon-preview',
                onclick: function () {
                    var row_select = $('#tracking').datagrid('getSelected');

                    $('#tracking_dialog_d').dialog({
                        title: 'Detail',
                        width: 750,
                        height: 600,
                        closed: false,
                        cache: false,
                        href: base_url + 'tracking/view_detail/' + row_select.serial,
                        modal: true,
                        resizable: true,
                        top: 50,
                        buttons: [
                            {
                                text: 'Close',
                                iconCls: 'icon-remove',
                                handler: function () {
                                    $('#tracking_dialog_d').dialog('close');
                                }
                            }
                        ]
                    });
                }
            });
        }
    });

    function trackingRemarkFormat(value, row, index) {
        var rmk = '';
        if (value.length > 35) {
            rmk = value.substring(0, 35) + '...';
        } else {
            rmk = value;
        }
        var s = rmk + " <a href='javascript:void(0)' onclick='tracking_view_remark(" + row.id + ")'><i>Detail<i/></a>";
        return s;
    }

    function mc_late_style(index, row) {
        if (row.mc_lt != '0') {
            return 'background-color:#ff7d7d;';
        }
    }

    function cv_late_style(index, row) {
        if (row.cv_lt != '0') {
            return 'background-color:#ff7d7d;';
        }
    }

    function sn_late_style(index, row) {
        if (row.sn_lt != '0') {
            return 'background-color:#ff7d7d;';
        }
    }

    function fn_late_style(index, row) {
        if (row.fn_lt != '0') {
            return 'background-color:#ff7d7d;';
        }
    }

    function up_late_style(index, row) {
        if (row.up_lt != '0') {
            return 'background-color:#ff7d7d;';
        }
    }
    function pack_late_style(index, row) {
        if (row.pack_lt != '0') {
            return 'background-color:#ff7d7d;';
        }
    }
</script>
<div id="tracking_dialog_d"></div>
<?php
$this->load->view('tracking/import_process');
//$this->load->view('tracking/finish');




