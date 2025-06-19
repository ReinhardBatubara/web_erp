<div class="easyui-layout" data-options="fit:true">        
    <div region="center" style="border: none;" title="Stock Out to Outsource">
        <div id="stockouttooutsource_toolbar" style="padding-bottom: 0;">
            <form id="stockouttooutsource_form_search2" style="margin-bottom: 0px">
                OTS : 
                <input type="text" 
                       size="12" 
                       name="number"
                       class="easyui-validatebox" 
                       onkeyup="if (event.keyCode === 13) {
                                   stockout_to_outsource_search2()
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
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="stockout_to_outsource_search2()">Search</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="stockout_to_outsource_add()">Add</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="stockout_to_outsource_edit()">Edit</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="stockout_to_outsource_delete()">Delete</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="stockout_to_outsource_print()">Print</a>                
            </form>
        </div>
        <table id="sto_os" data-options="  
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
               toolbar:'#stockouttooutsource_toolbar'">
            <thead>
                <tr>
                    <th field="chck" checkbox="true"></th>
                    <th field="number" width="90" halign="center" sortable="true">No</th>            
                    <th field="date_f" width="80" align="center" sortable="true">Date</th>
                    <th field="vendor" width="180" halign="center" sortable="true">Vendor</th>
                    <th field="remark" width="600" halign="center" sortable="true">Remark</th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            $(function () {
                $('#sto_os').datagrid({
                    url: '<?php echo site_url('stockouttooutsource/get') ?>',
                    onSelect: function (rowIndex, rowData) {
                        $('#sto_os_detail').datagrid('reload', {
                            sto_so_id: rowData.id
                        });
                    }
                });
            });
        </script>
    </div>
    <div region="south" split="true" style="height:250px;border: none;" title="Item" collapsible="false">
        <?php $this->load->view('stockouttooutsource/detail/view'); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('../js/stockout.js') ?>"></script>