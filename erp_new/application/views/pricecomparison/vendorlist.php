<div id="vendorlist_toolbar" style="padding-bottom: 2px;">    
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="pricecomparison_add()"> Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="pricecomparison_edit()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="pricecomparison_delete()"> Delete</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-pointer" plain="true" onclick="pricecomparison_setselected()">Set Selected</a>
</div>
<table id="vendorlist" data-options="
       url:'<?php echo site_url('pricecomparison/get') ?>',
       method:'post',
       border:false,
       title:'Vendor Price',
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       toolbar:'#vendorlist_toolbar'">
    <thead>
        <tr>
            <th field="chck" checkbox="true"></th>
            <th field="id" hidden="true"></th>            
            <th field="vendorid" hidden="true"></th>
            <th field="used" hidden="true"></th>
            <th field="purchaserequestdetailid" hidden="true"></th>
            <th field="vendor" width="200" halign="center">Vendor</th>
            <th field="currency" width="80" align="center">Currency</th>
            <th field="price" width="100" halign="center" align="right">Unit Price</th>
            <th field="discount" width="100" halign="center" align="right">Discount</th>
            <th field="ppn" width="100" halign="center" align="right">Tax</th>
            <th field="amount" width="100" halign="center" align="right">Amount</th>
            <th field="note" width="200" halign="center" align="right">Note</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#vendorlist').datagrid({
            rowStyler: function(index, row) {
                if (row.used === '1') {
                    return 'background-color:#b0ffb0;';
                }
            }
        });
    });
</script>