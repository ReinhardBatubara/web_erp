<form id="goodsreceive-input" method="post" novalidate onsubmit="return false;">
    <table width="100%" border="0">
        <tr>
            <td width="20%" align="right"><label class="field_label">Date : </label></td>
            <td width="20%"><input type="text" size="15" class="easyui-datebox" required="true" id="gr_date" data-options="formatter:myformatter,parser:myparser"/></td>
            <td width="20%"></td>
            <td width="20%" align="right"><label class="field_label">NO SJ : </label></td>
            <td width="20%"><input type="text" class="easyui-validatebox" id="gr_no_sj"  required="true" size="20"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">PO :</label></td>
            <td>
                <input type="text" size="20" name="gr_purchaseorderid" id="gr_purchaseorderid" required="true"/>
                <script>
                    $('#gr_purchaseorderid').combogrid({
                        panelWidth: 400,
                        idField: 'id',
                        mode: 'remote',
                        fitColumns:true,                            
                        textField: 'number',
                        url: '<?php echo site_url('purchaseorder/get_available_to_receive_by_warehouse') ?>',
                        columns: [[
                                {field: 'id', hidden: true},
                                {field: 'number', title: 'PO Number', width: 120},
                                {field: 'date_modify', title: 'Date', width: 80},
                                {field: 'vendor', title: 'Vendor', width: 200}
                            ]],
                        onSelect: function(rowIndex, rowData) {
                            $('#po_vendor').val(rowData.vendor);
                            $('#list_item_receive').datagrid('reload', {
                                purchaseorderid: rowData.id
                            });
                        }
                    });
                </script>                    
            </td>
            <td>&nbsp;</td>
            <td align="right"><label class="field_label">Checked By : </label></td>
            <td>
                <input type="text" name="gr_checked_by" id="gr_checked_by" mode="remote" style="width: 150px" required="true"/>
                <script type="text/javascript">
                    $('#gr_checked_by').combogrid({
                        panelWidth: 400,
                        idField: 'id',
                        fitColumns:true,
                        textField: 'name',
                        url: '<?php echo site_url('employee/get_remote_data') ?>',
                        columns: [[
                                {field: 'id', title: 'ID', width: 60},
                                {field: 'name', title: 'Name', width: 100},
                                {field: 'department', title: 'Department', width: 100},
                                {field: 'jobtitle', title: 'Job Title', width: 100}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Vendor : </label></td>
            <td colspan="2"><input type="text" class="easyui-validatebox" size="30" readonly id="po_vendor"/></td>                
            <td align="right">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>            
        <tr>
            <td colspan="5" height="200">                    
                <table id="list_item_receive" 
                       class="easyui-datagrid"
                       url='<?php echo site_url('purchaseorderdetail/get_available_to_receive_by_warehouse') ?>'
                       method ='post'
                       pagination = 'true'
                       title = 'List Item'
                       method = 'post'
                       border = 'true'
                       singleSelect = 'true'
                       fit ='true'
                       rownumbers = 'true'
                       fitColumns = 'true'
                       idField= 'id'>
                    <thead>
                        <tr>
                            <th field="id" hidden="true"></th>
                            <th field="itemcode" width="100" halign="center">Item</th>            
                            <th field="itemdescription" width="200" halign="center">Description</th>
                            <th field="unitcode" width="50" align="center">Unit</th>
                            <th field="qty" width="80" align="center">Order</th>
                            <th field="qty_ots" width="80" align="center">Outstanding</th>
                            <th field="qty_receive" width="60" align="center" data-options="editor:{type:'numberbox',option:{precision:2,min:0},required:true}">Receive</th>
                            <?php
                            if ($this->session->userdata('optiongroup') == -1) {
                                ?>
                                <th width="100" data-options="
                                    field:'warehouseid',
                                    formatter:function(value,row){
                                    return row.warehousename;
                                    },
                                    editor:{
                                    type:'combobox',
                                    options: {
                                    valueField: 'warehouseid',
                                    textField: 'warehousename',
                                    panelHeight: 'auto',
                                    panelWidth: '100'
                                    }
                                    }" align="center">Store To</th>
                                <?php } ?>
                        </tr>
                    </thead>
                </table>
                <script type="text/javascript">
                    var gr_lastIndex = null;
                    var _warehouse = null;
                    $(function() {
                        $('#list_item_receive').datagrid({
                            onDblClickRow: function(rowIndex, row) {                                
                                $('#list_item_receive').datagrid('beginEdit', rowIndex);
                                if(user_option_group == -1){
                                    _warehouse = $(this).datagrid('getEditor', {index: rowIndex, field: 'warehouseid'});
                                    _warehouse.target.combobox('reload', base_url + 'item/get_warehouse/' + row.itemid);
                                }
                                gr_lastIndex = rowIndex;               
                            },
                            onClickRow: function() {
                                if(user_option_group == -1){
                                    var ed = $(this).datagrid('getEditor', {index: gr_lastIndex, field: 'warehouseid'});
                                    if(ed !== null){
                                        var warehousename = $(ed.target).combobox('getText');
                                        $('#list_item_receive').datagrid('getRows')[gr_lastIndex]['warehousename'] = warehousename;
                                    }
                                }
                                $('#list_item_receive').datagrid('endEdit', gr_lastIndex);
                            }
                        });
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td width="20%" align="right"><label class="field_label">Remark :</label></td>
            <td colspan="4" width="80%">
                <textarea id="remark" style="width: 90%;height: 50px;"></textarea>
            </td>
        </tr>
    </table>        
</form>