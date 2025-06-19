<div class="easyui-layout" data-options="fit:true">        
    <div region="center" style="border: none;" title="Return From Production">
        <div id="productionreturn_toolbar" style="padding-bottom: 0;">
            <form id="productionreturn_form_search2" style="margin-bottom: 0px">
                RTN : 
                <input type="text" 
                       size="12" 
                       name="number"
                       class="easyui-validatebox" 
                       onkeyup="if (event.keyCode === 13) {
                           productionreturn_search2()
                       }"/>  
                Date From :
                <input type="text" size="15" name="datefrom" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
                To :
                <input type="text" size="15" name="dateto" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
                Return By :
                <input type="text" name="returnby" id="return_employeeid" mode="remote" style="width: 100px"/>
                <script type="text/javascript">
                    $('#return_employeeid').combogrid({
                        panelWidth: 450,
                        idField: 'id',
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
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="productionreturn_search2()"></a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="productionreturn_add()">Add</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="productionreturn_edit()">Edit</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="productionreturn_delete()">Delete</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="productionreturn_print()">Print</a>                
            </form>
        </div>
        <table id="productionreturn" data-options="  
               method:'post',
               border:true,       
               singleSelect:true,
               fit:true,
               pageSize:30,
               pageList: [30, 50, 70, 90, 110],
               rownumbers:true,
               fitColumns:false,
               striped:true,
               pagination:true,
               sortName:'id',
               sortOrder:'desc',
               toolbar:'#productionreturn_toolbar'">
            <thead>
                <tr>
                    <th field="chck" checkbox="true"></th>
                    <th field="number" width="90" halign="center" sortable="true">RTN</th>            
                    <th field="date_f" width="80" align="center" sortable="true">Date</th>
                    <th field="return_by" width="150" halign="center" sortable="true">Return By</th>
                    <th field="receive_by" width="150" halign="center" sortable="true">Receive By</th>
                    <th field="remark" width="500" halign="center" sortable="true">Remark</th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            $(function () {
                $('#productionreturn').datagrid({
                    url: '<?php echo site_url('productionreturn/get') ?>',
                    onSelect: function (rowIndex, rowData) {
                        $('#productionreturndetail').datagrid('reload', {
                            productionreturnid: rowData.id
                        });
                    }
                });
            });
        </script>
    </div>
    <div region="south" split="true" style="height:50%;border: none;" title="Item" collapsible="false">
        <?php $this->load->view('productionreturn/detail/view'); ?>
    </div>
</div>
<?php
$this->load->view('productionreturn/add');
?>