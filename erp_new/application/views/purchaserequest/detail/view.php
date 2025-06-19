<div id="purchaserequestdetail_toolbar" style="padding-bottom: 2px;">    
    <?php
    if ($this->session->userdata('department') == 7) {
        if (in_array('add', $action)) {
            ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="purchaserequestdetail-add" onclick="purchaserequestdetail_add()">Add</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add-child" plain="true" id="purchaserequestdetail-add-from-requisition" onclick="purchaserequestdetail_add_from_requisition()">Add From Requisition</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add-model" plain="true" id="purchaserequestdetail-add-to-outsource" onclick="purchaserequestdetail_add_outsource()">Add Model/Component to Outsource</a>
        <?php }if (in_array('edit', $action)) { ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="purchaserequestdetail-edit" onclick="purchaserequestdetail_edit()">Edit Item</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit-price" plain="true" id="purchaserequestdetail-set-vendor_price" onclick="purchaserequestdetail_set_price()">Set Price</a>
            <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit-price" plain="true" id="purchaserequestdetail-edit-vendor_price" onclick="purchaserequestdetail_edit_vendor_price()">Edit Vendor Price</a>-->
        <?php }if (in_array('delete', $action)) { ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="purchaserequestdetail-remove" onclick="purchaserequestdetail_delete()">Delete</a>
            <?php
        }
    }
    ?>
    <a href="javascript:void(0)" class="easyui-menubutton" iconCls="icon-dollar" data-options="menu:'#mm-pricecomparison'" plain="true"> Price Comparison</a>
    <a id="purchaserequestdetail_menu_search" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" style="float: right;">Search</a>
</div>
<div id="mm-pricecomparison" class="easyui-menu">
    <?php
    if ($this->session->userdata('department') == 7) {
        if (in_array('edit_price_comparison', $action)) {
            ?>
            <div onclick="pricecomparison_view()" iconCls="icon-configuration"><span>Configuration</span></div>
            <?php
        }
    }
    ?>
    <div onclick="pricecomparison_preview()" iconCls="icon-preview"><span>Preview</span></div>
</div>
<table id="purchaserequestdetail" data-options="
       border:false,
       method:'post',       
       singleSelect:true,
       fit:true,
       title:'List Item',
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       idField:'id',
       toolbar:'#purchaserequestdetail_toolbar'">
    <thead>
        <tr>
            <th field="chck" checkbox="true"></th>
            <th field="mr_number" width="80" halign="center">MR No</th>
            <th field="itemcode" width="80" halign="center">Item</th>
            <th field="itemdescription" width="200" halign="center">Description</th>
            <th field="unitcode" width="50" align="center">Unit</th>
            <th field="qty" width="50" align="center">Qty</th>
            <th field="vendor" width="120" halign="center">Vendor</th>
            <th field="currency" width="40" align="center">Curr</th>
            <th field="price" width="100" halign="center" align="right" formatter="formatPrice">Unit Price</th>
            <th field="total" width="100" halign="center" align="right" formatter="formatPrice">Sub Total</th>
            <th field="discount" width="100" halign="center" align="right" formatter="formatPrice">Discount</th>
            <th field="ppn" width="100" halign="center" align="right" formatter="formatPrice">Tax</th>
            <th field="amount" width="150" halign="center" align="right" formatter="formatPrice">Amount</th>

        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#purchaserequestdetail').datagrid({
            onSelect: function (value, row, index) {

            }
        });

        $('#purchaserequestdetail_menu_search').tooltip({
            position: 'left',
            content: function () {
                return $('#purchaserequestdetail_dialog_search');
            },
            showEvent: 'click',
            onShow: function () {
                var t = $(this);
                t.tooltip('tip').unbind().bind('mouseenter', function () {
                    t.tooltip('show');
                });
            }
        });
    });
</script>
<div style="display:none">
    <div id="purchaserequestdetail_dialog_search">
        <table width="300" border="0">
            <tr>
                <td align="right" width="30%">Item :</td>
                <td>
                    <input type="text" size="12" class="easyui-validatebox" id="purchaserequestdetail_code_s" onkeypress="if (event.keyCode === 13) {
                                purchaserequestdetail_search();
                            }" />
                </td>
            </tr>
            <tr>
                <td align="right">Description :</td>
                <td>
                    <input type="text" class="easyui-validatebox" id="purchaserequestdetail_description_s" onkeypress="if (event.keyCode === 13) {
                                purchaserequestdetail_search();
                            }"/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-top: 10px">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="purchaserequestdetail_search()">Find</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="purchaserequestdetail_clear_search()" style="float: right">Clear</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="$('#purchaserequestdetail_menu_search').tooltip('hide');"  style="float: right">Close</a>
                </td>
            </tr>
        </table>   
    </div>
</div>
<?php
$this->load->view('purchaserequest/detail/add');

