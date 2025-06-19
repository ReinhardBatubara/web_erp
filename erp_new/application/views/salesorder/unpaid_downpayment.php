<div id="unpaid_down_payment_toolbar" style="padding-bottom: 0px;">
    <form id="unpaid_down_payment_form" style="margin-bottom: 0px" onsubmit="return false;">
        <span style="display: inline-block;padding-top: 2px;">
            Date : 
            <input type="text" size="10" name="date" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
            -
            <input type="text" size="10" name="date" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
        </span>
        <span style="display: inline-block;padding-top: 2px;">
            Customer:
            <input class="easyui-combobox" name="customerid" data-options="
                   url: '<?php echo site_url('customer/get') ?>',
                   method: 'post',
                   valueField: 'id',
                   textField: 'name',
                   panelHeight: '200',
                   mode: 'remote',
                   onSelect:function(){
                    $('#unpaid_down_payment').datagrid('reload', $('#unpaid_down_payment_form').serializeObject());
                   }"
                   style="width: 100px">
        </span>
        <span style="display: inline-block;padding-top: 2px;">
            SO : <input type="text" size="10" name="so_no" class="easyui-validatebox" onkeypress="if (event.keyCode === 13) {
                        $('#unpaid_down_payment').datagrid('reload', $('#unpaid_down_payment_form').serializeObject());
                    }"/>
        </span>
        <span style="display: inline-block;padding-top: 2px;">
            PO : <input type="text" size="10" name="po_no" class="easyui-validatebox" onkeypress="if (event.keyCode === 13) {
                        $('#unpaid_down_payment').datagrid('reload', $('#unpaid_down_payment_form').serializeObject());
                    }"/>
        </span>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="$('#unpaid_down_payment').datagrid('reload', $('#unpaid_down_payment_form').serializeObject());"></a>
    </form>
</div>
<table id="unpaid_down_payment" data-options="
       'url':'<?php echo site_url('salesorder/get_unpaid_down_payment') ?>',
       method:'post',
       title:'Unpaid Down Payment',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#unpaid_down_payment_toolbar'">
    <thead>
        <tr>
            <th field="customerorder" width="150" halign="center">Customer</th>            
            <th field="sonumber" width="100" align="center">SO</th>
            <th field="date_format" width="70" align="center">Date</th>
            <th field="po_no" width="130" halign="center">PO</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#unpaid_down_payment').datagrid({});
    });
</script>