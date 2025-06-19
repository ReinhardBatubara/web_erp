<div id="costing_toolbar" style="padding-bottom: 0px;">   
    <form id="costing_search_form1" style="margin-bottom: 0px" onsubmit="return false;">
        Item Code/Name: 
        <input type="text" 
               size="15" 
               name="itemcode" 
               class="easyui-validatebox"
               onkeyup="if (event.keyCode == 13) {
                           costing_search();
                       }"/>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="costing_search()"></a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="costing_add()"> Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="costing_edit()"> Edit</a>  
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-calculate" plain="true" onclick="costing_calculate()">Calculate</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="costing_approve()">Approve</a>
        <a href="javascript:void(0)" 
           class="easyui-menubutton" 
           iconCls="icon-more" 
           plain="true"
           data-options="menu:'#mm-costing-more'">More</a>
    </form>
</div>
<div id="mm-costing-more" class="easyui-menu">
    <div onclick="costing_print()" iconCls="icon-print"><span>Print</span></div>
    <div onclick="costing_set_to_model()" iconCls="icon-define"><span>Define to Model</span></div>
    <div onclick="costing_delete()" iconCls="icon-remove"><span>Delete</span></div>
</div>
<table id="costing" data-options="
       url:'<?php echo site_url('costing/get'); ?>',
       method:'post',
       border:false,       
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       striped:true,
       idField: 'id',
       pagination:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#costing_toolbar'">
    <thead frozen="true">
        <tr>
            <!--<th field="costing_chck" checkbox="true" rowspan="2"></th>-->
            <th field="id" width="20" sortable="true" rowspan="2" align="center">ID</th>
            <th field="item_code" width="80" halign="center" rowspan="2" sortable="true">Item Code</th>
            <th field="original_code" width="80" rowspan="2" halign="center" sortable="true">Original Code</th>
            <th field="item_name" width="120" rowspan="2" halign="center" sortable="true">Item Name</th>    
            <th align="center" colspan="3">Dimension</th>
        </tr>
        <tr>
            <th field="dw" width="30" align="center">W</th>
            <th field="dh" width="30" align="center">H</th>
            <th field="dd" width="30" align="center">D</th>
        </tr>
    </thead>
    <thead>
        <tr>                     
            <th field="date" width="65" align="center"  formatter="myFormatDate">Date</th>
            <th field="rate" width="70" align="right" halign="center"  formatter="formatPrice">Rate</th>
            <th field="material_price" width="80" align="right" halign="center"  formatter="formatPrice">Material Price</th>
            <th field="carving" width="80" align="right" halign="center"  formatter="formatPrice">Carving</th>
            <th field="labour_cost_percentage" width="60" align="right" halign="center"  hidden="true">Labour %</th>
            <th field="labour_cost" width="80" align="right" halign="center"  formatter="formatPrice">Labour</th>
            <th field="manufacture_cost" width="80" align="right" halign="center"  formatter="formatPrice">Manufacture</th>
            <th field="xfactor_percentage" width="60" align="right" halign="center"  hidden="true">X Factor %</th>
            <th field="xfactor" width="80" align="right" halign="center"  formatter="formatPrice">X Factor</th>
            <th field="overhead_percentage" width="80" align="right" halign="center"  hidden="true">Overhead %</th>
            <th field="overhead" width="80" align="right" halign="center"  formatter="formatPrice">Overhead</th>
            <th field="shipment_cost_expense" width="60" align="right" halign="center"  hidden="true">Shipment Expense</th>
            <th field="shipment_cost" width="80" align="right" halign="center"  formatter="formatPrice">Shipment</th>
            <th field="total" width="80" align="right" halign="center"  formatter="formatPrice">Total</th>
            <th field="margin_percentage" width="80" align="right" halign="center"  hidden="true">Margin %</th>
            <th field="margin" width="80" align="right" halign="center"  formatter="formatPrice">Margin</th>
            <th field="total_price" width="80" align="right" halign="center"  formatter="formatPrice">Total Price</th>
            <th field="total_to_rate" width="80" align="right" halign="center"  formatter="formatPrice">Round Up</th>
            <th field="selling_price_percentage" width="80" align="right" halign='center'  hidden="true" formatter="formatPrice">Selling Price %</th>
            <th field="selling_price" width="80" align="right" halign='center'  formatter="formatPrice">Selling Price</th>
            <th field="final_selling_price" width="100" align="right" halign='center'  formatter="formatPrice">Final selling Price</th>
            <th field="date_approve" width="65" align="center"  formatter="myFormatDate">Date Approve</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#costing').datagrid({
//            onLoadSuccess: function (data) {
//                $(this).datagrid('selectRow', 0);
//            },
            onHeaderContextMenu: function (e, field) {
                e.preventDefault();
                if (!cmenu) {
                    createColumnMenu();
                }
                cmenu.menu('show', {
                    left: e.pageX,
                    top: e.pageY
                });
            },
            onSelect: function (rowIndex, rowData) {
                $('#costing-summary').datagrid('load', {
                    costingid: rowData.id
                });
                var costing_tabs = $('#costing_tabs').tabs('getSelected');
                var costing_tab_index = $('#costing_tabs').tabs('getTabIndex', costing_tabs);
                switch (costing_tab_index) {
                    case 0:
                        $('#costingdetail').datagrid({
                            url: '<?php echo site_url('costing/get_material') ?>',
                            queryParams: {
                                costingid: rowData.id
                            }
                        });
                        break;
                    case 1:
                        $('#t_cost_sheet').load(base_url + 'costing/prints/' + rowData.id);
                        break;
                    case 2:
                        $('#t_cost_bom').load(base_url + 'model/prints/' + rowData.modelid);
                        break;
                    case 3:
                        $('#besi_pipa_kotak').datagrid('load', {
                            costingid: rowData.id
                        });
                        $('#besi_pipa_bulat').datagrid('load', {
                            costingid: rowData.id
                        });
                        $('#besi_as_kotak_or_strip_plate_or_plat').datagrid('load', {
                            costingid: rowData.id
                        });
                        $('#besi_as_bulat').datagrid('load', {
                            costingid: rowData.id
                        });
                        $('#besi_plat_siku').datagrid('load', {
                            costingid: rowData.id
                        });

                        $('#stainless_pipa_kotak').datagrid('load', {
                            costingid: rowData.id
                        });
                        $('#stainless_pipa_bulat').datagrid('load', {
                            costingid: rowData.id
                        });
                        $('#stainless_as_kotak_or_strip_plate_or_plat').datagrid('load', {
                            costingid: rowData.id
                        });
                        $('#stainless_as_bulat').datagrid('load', {
                            costingid: rowData.id
                        });
                        $('#stainless_plat_siku').datagrid('load', {
                            costingid: rowData.id
                        });

                        $('#kuningan_as_kotak_or_strip_plate_or_plat').datagrid('load', {
                            costingid: rowData.id
                        });
                        $('#kuningan_as_bulat').datagrid('load', {
                            costingid: rowData.id
                        });

                        $('#besi_total_luas').load(base_url + 'costing/get_total_luas/' + rowData.id + '/1');
                        $('#stainless_total_luas').load(base_url + 'costing/get_total_luas/' + rowData.id + '/2');
                        $('#kuningan_total_luas').load(base_url + 'costing/get_total_luas/' + rowData.id + '/3');

                        $('#besi_total_kg').load(base_url + 'costing/get_total_kg/' + rowData.id + '/1');
                        $('#stainless_total_kg').load(base_url + 'costing/get_total_kg/' + rowData.id + '/2');
                        $('#kuningan_total_kg').load(base_url + 'costing/get_total_kg/' + rowData.id + '/3');
                        break;
                    default:
                }
                if (rowData.images != null) {
                    $('#image-costing').attr('src', 'files/model/' + rowData.images);
                } else {
                    $('#image-costing').attr('src', 'files/model/no-image.jpg');
                }
                $('#costingdetail-load-price').show();
                $('#costingdetail-save-loaded-price').hide();
                $('#costingdetail-cancel-save-loaded-price').hide();
            },
            rowStyler: function (index, row) {
                if (row.approved === 'f') {
                    return 'background-color:#ffd9d9;';
                }
            }
        });

        var cmenu;
        function createColumnMenu() {
            cmenu = $('<div/>').appendTo('body');
            cmenu.menu({
                onClick: function (item) {
                    if (item.iconCls === 'icon-ok') {
                        $('#costing').datagrid('hideColumn', item.name);
                        cmenu.menu('setIcon', {
                            target: item.target,
                            iconCls: 'icon-empty'
                        });
                    } else {
                        $('#costing').datagrid('showColumn', item.name);
                        cmenu.menu('setIcon', {
                            target: item.target,
                            iconCls: 'icon-ok'
                        });
                    }
                }
            });
            var fields = $('#costing').datagrid('getColumnFields');
            for (var i = 0; i < fields.length; i++) {
                var field = fields[i];
                var col = $('#costing').datagrid('getColumnOption', field);
                cmenu.menu('appendItem', {
                    text: col.title,
                    name: field,
                    iconCls: 'icon-ok'
                });
            }
        }

    });
</script>