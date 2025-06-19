<div class="easyui-layout" data-options="fit:true">        
    <div region="center"  title="Purchase Return" border="false">
        <div id="purchasereturn_toolbar" style="padding-bottom: 0;">
            <form id="purchasereturn_form_search2" style="margin-bottom: 0px">
                PRT : 
                <input type="text" 
                       size="12" 
                       name="number"
                       class="easyui-validatebox" 
                       onkeyup="if (event.keyCode === 13) {
                                   purchasereturn_search2()
                               }"/>  
                Date From :
                <input type="text" size="15" name="datefrom" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
                To :
                <input type="text" size="15" name="dateto" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="purchasereturn_search2()">Search</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="purchasereturn_add()">Add</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="purchasereturn_edit()">Edit</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="purchasereturn_delete()">Delete</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="purchasereturn_print()">Print</a>                
            </form>
        </div>
        <table id="purchasereturn" data-options="  
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
               toolbar:'#purchasereturn_toolbar'">
            <thead>
                <tr>
                    <th field="chck" checkbox="true"></th>
                    <th field="number" width="90" halign="center" sortable="true">PRT</th>            
                    <th field="date" width="80" align="center" sortable="true" formatter="myFormatDate">Date</th>
                    <th field="vendor_name" width="200" halign="center" sortable="true">Return To (Vendor)</th>
                    <th field="remark" width="500" halign="center" sortable="true">Remark</th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            $(function () {
                $('#purchasereturn').datagrid({
                    url: '<?php echo site_url('purchasereturn/get') ?>',
                    onSelect: function (rowIndex, rowData) {
                        $('#purchasereturndetail').datagrid('reload', {
                            purchasereturnid: rowData.id
                        });
                    }
                });
            });
        </script>
    </div>
    <div region="south"
         split="true" style="height:50%;border: none;" title="Item" collapsible="false"
         href="<?php echo site_url('purchasereturn/detail_view') ?>">
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>/js/purchasereturn.js"></script>