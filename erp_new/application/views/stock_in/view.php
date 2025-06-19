<div class="easyui-layout" data-options="fit:true">        
    <div region="center" style="border: none;" title="Stock In">
        <div id="stock_in_toolbar" style="padding-bottom: 0;">
            <form id="stock_in_form_search2" style="margin-bottom: 0px">
                BPnP : 
                <input type="text" 
                       size="12" 
                       name="bpnp"
                       class="easyui-validatebox" 
                       onkeyup="if (event.keyCode === 13) {
                                   stock_in_search2()
                               }"/>  
                Date From :
                <input type="text" size="15" name="datefrom" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
                To :
                <input type="text" size="15" name="dateto" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
                Vendor :
                <input id="text" 
                       name="vendorid" 
                       class="easyui-combobox" data-options="
                       valueField: 'id',
                       textField: 'text',
                       url: '<?php echo site_url('vendor/get_remote_data') ?>'" 
                       mode="remote" 
                       panelWidth="200"
                       style="width: 100px" 
                       required="true" >
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="stock_in_search2()"></a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="stock_in_add()">Add</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="stock_in_edit()">Edit</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="stock_in_delete()">Delete</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="stock_in_print()">Print</a>                
            </form>
        </div>
        <table id="stock_in" data-options="  
               method:'post',
               border:true,       
               singleSelect:true,
               fit:true,
               rownumbers:true,
               fitColumns:false,
               striped:true,
               pagination:true,
               sortName:'id',
               sortOrder:'desc',
               toolbar:'#stock_in_toolbar'">
            <thead>
                <tr>
                    <th field="chck" checkbox="true"></th>
                    <th field="bpnp" width="90" halign="center" sortable="true">BPnP</th>            
                    <th field="date" width="80" align="center" formatter="myFormatDate" sortable="true">Date</th>
                    <th field="vendor" width="180" halign="center" sortable="true">Vendor</th>
                    <th field="employee_receive" width="200" halign="center" sortable="true">Receive By</th>
                    <th field="remark" width="400" halign="center" sortable="true">Remark</th>

                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            $(function () {
                $('#stock_in').datagrid({
                    url: '<?php echo site_url('goodsreceive/stock_in_get') ?>',
                    onSelect: function (rowIndex, rowData) {
                        $('#stock_in_detail').datagrid('reload', {
                            stock_in_id: rowData.id
                        });
                    }
                });
            });
        </script>
    </div>
    <div region="south" split="true" style="height:50%;border: none;" title="Item" collapsible="false">
        <?php $this->load->view('stock_in/detail/view'); ?>
    </div>
</div>