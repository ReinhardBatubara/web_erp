<div id="po_item_toolbar" style="min-height: 23px">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-close" plain="true" onclick="purchaseorder_item_change_status('close')">Close</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-open" plain="true" onclick="purchaseorder_item_change_status('open')">Open</a>
    <a id="purchaseorder_by_item_menu_search" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" style="float: right;">Search</a>
</div>
<table id="po_item" data-options="
       url:'<?php echo site_url('purchaseorderdetail/get_all') ?>',
       method:'post',
       title:'Purchase Order Item Detail',
       border:true,
       singleSelect:false,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       idField:'id',
       sortName:'po_number',
       sortOrder:'desc',
       toolbar:'#po_item_toolbar'">
    <thead>
        <tr>
            <th field="po_item_chck" checkbox="true"></th>            
            <th field="status" width="40"align="center" sortable="true">Status</th>
            <th field="po_number" width="80" halign="center" sortable="true">PO NO</th>
            <th field="pr_number" width="80" halign="center" sortable="true">PR NO</th>
<!--            <th field="mr_number" width="80" halign="center" sortable="true">MR NO</th>            -->
            <th field="po_date" width="80" align="center" sortable="true">PO Date</th>
            <!--<th field="department" width="120" halign="center" sortable="true">Department</th>-->
            <th field="vendor" width="150" halign="center" sortable="true">Vendor</th>
            <th field="itemcode" width="100" halign="center" sortable="true">Item Code</th>
            <th field="itemdescription" width="250" halign="center" sortable="true">Item Description</th>
            <th field="unitcode" width="60" align="center" sortable="true">Unit Code</th>
            <th field="qty" width="60" align="center" sortable="true">Order Qty</th>
            <th field="qty_ots" width="70" align="center" sortable="true">Outstanding</th>            
            <th field="price" width="90" halign="center" align="right" sortable="true">Unit Price</th>
            <th field="currency" width="50" align="center" sortable="true">Curr</th>
            <th field="subtotal" width="100" halign="center" align="right" sortable="true" formatter="formatPrice">Sub Total</th>
            <th field="discount" width="80" halign="center" align="right" sortable="true" formatter="formatPrice">Discount</th>
            <th field="ppn" width="80" halign="center" align="right" sortable="true" formatter="formatPrice">Tax</th>
            <th field="amount" width="110" halign="center" align="right" sortable="true" formatter="formatPrice">Amount</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#po_item').datagrid({            
            onCheck:function(index,row){
                if(row.status == 'finish'){
                    $('#po_item').datagrid('uncheckRow',index);
                }
            },onSelect:function(index,row){
                if(row.status == 'finish'){                    
                    $('#po_item').datagrid('unselectRow',index);
                    $('#po_item').datagrid('uncheckRow',index);
                    $.messager.alert('Finish Receive', 'This item already finish receive', 'warning');
                }
            }
        });
        $('#purchaseorder_by_item_menu_search').tooltip({
            position: 'bottom',
            content: $('<div></div>'),
            showEvent: 'click',
            hideEvent: 'none',
            deltaX: -170,
            onUpdate: function (content) {
                content.panel({
                    width: 370,
                    border: true,
                    title: 'Search',
                    href: base_url + 'purchaseorderdetail/search_form_po_by_item'
                });
            },
            onShow: function() {
                var t = $(this);
                t.tooltip('tip').unbind().bind('mouseenter', function() {
                    t.tooltip('show');
                });
            }
        });
    });
</script>
<div id="temp_close_item"></div>