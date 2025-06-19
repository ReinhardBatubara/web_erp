<div id="pr_by_item_toolbar" style="padding-bottom: 2px;min-height: 23px">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="purchaserequestdetail_edit_for_view_detail()">Edit Item</a>                            
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit-price" plain="true" onclick="purchaserequestdetail_edit_vendor_price_trigger_from_view_detail()">Edit Vendor Price</a>                            
    <a id="purchaserequest_by_item_menu_search" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" style="float: right;">Search</a>
</div>
<table id="pr_by_item" data-options="
       url:'<?php echo site_url('purchaserequestdetail/get_by_item') ?>',
       method:'post',
       title:'Purchase Request Items',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       sortName:'pr_number',
       sortOrder:'desc',
       toolbar:'#pr_by_item_toolbar'">
    <thead frozen="true">
        <tr>            
            <th field="pr_number" width="80" align="center" sortable="true">PR NO</th>
            <th field="pr_date" formatter="myFormatDate" width="70" align="center" sortable="true">PR Date</th>
            <th field="mr_number" width="80" align="center" sortable="true">MR NO</th>
            <!--<th field="departmentid" width="150" halign="center" sortable="true" data-options="formatter:function(value,row,index){return row.department}">Department</th>-->
        </tr>
    </thead>
    <thead>
        <tr>
            <th field="vendor" width="150" halign="center" sortable="true">Vendor</th>
            <th field="itemcode" width="100" halign="center" sortable="true">Item Code</th>
            <th field="itemdescription" width="250" halign="center" sortable="true">Item Description</th>
            <th field="unitcode" width="60" align="center" sortable="true">UoM</th>
            <th field="qty" width="60" align="center" sortable="true">Qty</th>          
            <th field="price" width="90" halign="center" align="right" sortable="true">Unit Price</th>
            <th field="currency" width="50" align="center" sortable="true">Currency</th>
            <th field="total" width="100" halign="center" align="right" sortable="true">Sub Total</th>
            <th field="discount" width="80" halign="center" align="right" sortable="true">Discount</th>
            <th field="tax" width="80" halign="center" align="right" sortable="true">Tax</th>
            <th field="amount" width="110" halign="center" align="right" sortable="true">Amount</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#pr_by_item').datagrid({
            onDblClickRow:function(value,row,data){
                purchaserequestdetail_edit_for_view_detail();
            },
            onRowContextMenu:function(e, index, row){
                $(this).datagrid('selectRow',index);
                e.preventDefault();
                if (!cmenu){
                    createColumnMenu(row);
                }
                cmenu.menu('show', {
                    left:e.pageX,
                    top:e.pageY
                });
            }
        });
        $('#purchaserequest_by_item_menu_search').tooltip({
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
                    href: base_url + 'purchaserequestdetail/search_form_pr_by_item'
                });
            },
            onShow: function() {
                var t = $(this);
                t.tooltip('tip').unbind().bind('mouseenter', function() {
                    t.tooltip('show');
                });
            }
        });
        
        var cmenu;
        function createColumnMenu(row){
            cmenu = $('<div/>').appendTo('body');
            cmenu.menu();
            cmenu.menu('appendItem', {
                text: 'Edit Item',
                name: 'edit',
                iconCls: 'icon-ok',
                onclick:function(){
                    purchaserequestdetail_edit_for_view_detail();
                }
            });
            cmenu.menu('appendItem', {
                text: 'Edi Vendor Price',
                name: 'cmenu_edit_vendor_price',
                iconCls: 'icon-edit-price',
                onclick:function(){
                    purchaserequestdetail_edit_vendor_price_trigger_from_view_detail();
                }
            });
        }
    });
</script>
<?php
$this->load->view('purchaserequest/detail/edit_for_view_detail');
