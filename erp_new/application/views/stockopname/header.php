<div id="stockopname_toolbar" style="padding-bottom: 0px;">
    <form id="stockopname_search_form" onsubmit="stockopname_search();
            return false;" style="margin: 0px;">
            NO : <input type="text" name="stockopname_no" style="width: 100px" onkeyup="if(event.keyCode===13){stockopname_search()}" class="easyui-validatebox"/>
        Date : <input type="text" style="width: 90px" name="datefrom" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/> - 
        <input type="text" style="width: 90px" name="dateto" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
        Warehouse : 
        <input type="text"
               name="warehouseid" 
               id="item_search_warehouseid" 
               class="easyui-combobox" 
               url="<?php echo site_url('warehouse/get') ?>"
               data-options="
               valueField: 'id',
               textField: 'code',
               onChange:function(o,n){stockopname_search()}" 
               style="width: 80px" 
               panelHeight="auto">
        Posting Date : <input type="text" style="width: 90px" name="posting_datefrom" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/> - 
        <input type="text" style="width: 90px" name="posting_dateto" class="easyui-datebox" id="po_datefrom_s" data-options="formatter:myformatter,parser:myparser"/>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" onclick="stockopname_search()"> Search</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="stockopname_add()"> Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" onclick="stockopname_edit()"> Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" onclick="stockopname_delete()"> Delete</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-posting" onclick="stockopname_posting()"> Posting</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="stockopname_print()"> Print</a>

    </form>
</div>
<table id="stockopname" data-options="
       url:'<?php echo site_url('stockopname/get') ?>',
       method:'post',
       title:'Stock Opname',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:50,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#stockopname_toolbar'">
    <thead>
        <tr>
            <th field="stockopname_no" width="100" align="center">No.</th>
            <th field="date" width="100" align="center" formatter='myFormatDate'>Date</th>
            <th field="warehouse_name" width="100" halign="center">Warehouse</th>
            <th field="status" width="100" align="center" data-options="formatter:function(value,row){
                if(value == '0'){
                return 'Draft'
                }else if(value == '2'){
                return 'Posted';
                }
                }">Status</th>
            <th field="posting_time" width="100" align="center" formatter='myFormatDateTime'>Posting Time</th>
            <th field="description" width="300" halign="center">Description</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#stockopname').datagrid({
            onSelect: function (index, row) {
                $('#stockopname_detail').datagrid({
                    url: '<?php echo site_url('stockopname/detail_get') ?>',
                    queryParams: {
                        stockopnameid: row.id
                    }
                });

                if (row.status === '2') {
                    $('a[onclick="stockopname_edit()"]').linkbutton('disable');
                    $('a[onclick="stockopname_delete()"]').linkbutton('disable');
                    $('a[onclick="stockopname_posting()"]').linkbutton('disable');

                    $('a[onclick="stockopname_detail_add()"]').linkbutton('disable');
                    $('a[onclick="stockopname_detail_edit()"]').linkbutton('disable');
                    $('a[onclick="stockopname_detail_delete()"]').linkbutton('disable');
                } else {
                    $('a[onclick="stockopname_edit()"]').linkbutton('enable');
                    $('a[onclick="stockopname_delete()"]').linkbutton('enable');
                    $('a[onclick="stockopname_posting()"]').linkbutton('enable');

                    $('a[onclick="stockopname_detail_add()"]').linkbutton('enable');
                    $('a[onclick="stockopname_detail_edit()"]').linkbutton('enable');
                    $('a[onclick="stockopname_detail_delete()"]').linkbutton('enable');
                }
            }
        });
    });
</script>

