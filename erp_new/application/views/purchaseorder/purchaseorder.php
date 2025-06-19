<div id="purchaseorder_toolbar" style="padding-bottom: 2px;">
    <?php if (in_array('edit', $action)) { ?>
        <a href="javascript:void(0)" id="po_edit" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="purchaseorder_edit()"> Edit</a>
    <?php }if (in_array('open_po_to_receive', $action)) { ?>
        <a href="javascript:void(0)" id="po_open" class="easyui-linkbutton" iconCls="icon-open" plain="true" onclick="purchaseorder_open()"> Open PO to Receive</a>    
    <?php }if (in_array('close_po', $action)) { ?>
        <a href="javascript:void(0)" id="po_close" class="easyui-linkbutton" iconCls="icon-close" plain="true" onclick="purchaseorder_close()"> Close PO</a>
    <?php }if (in_array('print', $action)) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="purchaseorder_print()"> Print</a>
    <?php } ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="purchaseorder_change_vendor()">Change Vendor</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-outstanding" plain="true" onclick="purchaseorder_outstanding()">Outstanding Receive</a>
    <a id="purchaseorder_menu_search" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" style="float: right;">Search</a>
</div>
<table id="purchaseorder" data-options="
       url:'<?php echo site_url('purchaseorder/get') ?>',
       method:'post',
       border:true,       
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       pagination:true,     
       pageList: [30, 50, 70, 90, 110],
       pageSize:30,
       sortName:'number',
       sortOrder:'desc',
       idField:'id',
       toolbar:'#purchaseorder_toolbar'">
    <thead>
        <tr>
            <th field="chck" checkbox="true"></th>
            <th field="number" width="90" halign="center" sortable="true">PO NO</th>            
            <th field="purchaserequest" width="90" halign="center" sortable="true">PR NO</th>
            <th field="date" formatter="myFormatDate" width="80" align="center" sortable="true">Date</th>
            <!--<th field="department" width="140" halign="center" sortable="true">Department</th>-->
            <th field="vendor" width="140" halign="center" sortable="true">Vendor</th>            
            <th field="sub_total" width="100" halign="center" align="right" formatter="formatPrice" sortable="true">Sub Total</th>
            <th field="discount" width="100" halign="center" align="right" formatter="formatPrice" sortable="true">Discount</th>
            <th field="tax" width="100" halign="center" align="right" formatter="formatPrice" sortable="true">Tax</th>
            <th field="grand_total" width="100" halign="center" align="right" formatter="formatPrice" sortable="true">Grand Total</th>
            <th field="currency" width="60" align="center" sortable="true">Currency</th>
            <th field="terms" width="70" align="center" sortable="true">Terms</th>
            <th field="fob" width="70" align="center" sortable="true">FOB</th>
            <th field="ship_via" width="70" align="center" sortable="true">Ship Via</th>
            <th field="expected_date" formatter="myFormatDate"  width="70" align="center" sortable="true">Expected date</th>
            <th field="label_status" width="70" align="center" sortable="true">Status</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#purchaseorder').datagrid({
            onSelect: function (value, row, index) {
                $('#purchaseorderdetail').datagrid('reload', {
                    purchaseorderid: row.id
                });
                if (row.status === '0' || row.status === '2' || row.status === '3') {//New PO
                    if (row.status === '0' || row.status === '3') {
                        $('#po_open').linkbutton('enable');
                    } else {
                        $('#po_open').linkbutton('disable');
                    }
                    $('#po_close').linkbutton('disable');
                } else if (row.status === '1') {// PO Open
                    $('#po_close').linkbutton('enable');
                    $('#po_open').linkbutton('disable');
                }
            },
            rowStyler: function (index, row) {
//                console.log(row.date_diff);
                if (row.status === '0') {
                    return 'background-color:#fffff2'; //New PO     
                } else if (row.status === '1') {
                    if (parseFloat(row.date_diff) > 2) {
                        return 'background-color:#ea060b';// PO Open 99ff99                       
                    } else {
                        return 'background-color:#99ff99';// PO Open
                    }
                } else if (row.status === '3') {
                    return 'background-color:#fec0c1';// PO CLose
                }
            }
        });

        $('#purchaseorder_menu_search').tooltip({
            position: 'bottom',
            content: $('<div></div>'),
            showEvent: 'click',
            hideEvent: 'none',
            deltaX: -150,
            onUpdate: function (content) {
                content.panel({
                    width: 320,
                    border: true,
                    title: 'Search',
                    href: base_url + 'purchaseorder/search_form'
                });
            },
            onShow: function () {
                var t = $(this);
                t.tooltip('tip').unbind().bind('mouseenter', function () {
                    t.tooltip('show');
                });
            }
        });
    });
</script>