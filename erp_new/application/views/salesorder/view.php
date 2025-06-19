<div class="easyui-layout" data-options="fit:true">        
    <div data-options="region:'center'" title="Sales Order">
        <div id="salesorder_toolbar" style="padding-bottom: 2px;"> 
            <form id="salesorder_search_form2" style="margin: 0" onsubmit="return false">
                <table>
                    <tr>
                        <td>SO Number</td>
                        <td>
                            <input type="text" 
                                   class="easyui-validatebox" 
                                   id="salesorder_sonumber_s"
                                   name="sonumber"
                                   style="width: 100px;margin: 0 10px 0 0px;"
                                   onkeyup="if (event.keyCode === 13) {
                                               salesorder_search();
                                           }" 
                                   />
                            Date From <input type="text" size="12" style="height: 20px" class="easyui-datebox" id="salesorder_datefrom_s" name="datefrom" data-options="formatter:myformatter,parser:myparser"/>
                            <label class="field_label">To :</label>
                            <input type="text" size="12" style="height: 20px" class="easyui-datebox" id="salesorder_dateto_s" name="dateto" data-options="formatter:myformatter,parser:myparser"/>
                            Order By
                            <input class="easyui-combobox" name="orderby" id="orderby_salesorder_s" data-options="
                                   url: '<?php echo site_url('customer/get') ?>',
                                   method: 'post',
                                   valueField: 'id',
                                   textField: 'name',
                                   panelHeight: '200',
                                   panelWidth:'200',
                                   mode: 'remote',
                                   formatter: format_order_by2"
                                   style="width: 120px">
                            <script type="text/javascript">
                                function format_order_by2(row) {
                                    return '<span>' + row.code + '<br/>' + row.name + '</span><br/>';
                                }
                            </script>
                            
                            Ship To
                            <input class="easyui-combobox" name="shipto" id="orderby_shipto_s" data-options="
                                   url: '<?php echo site_url('customer/get') ?>',
                                   method: 'post',
                                   valueField: 'id',
                                   textField: 'name',
                                   panelHeight: '200',
                                   panelWidth:'200',
                                   mode: 'remote',
                                   formatter: format_order_by3"
                                   style="width: 120px">
                            <script type="text/javascript">
                                function format_order_by3(row) {
                                    return '<span>' + row.code + '<br/>' + row.name + '</span><br/>';
                                }
                            </script>
                            PO No <input type="text" size="10" class="easyui-validatebox" name="po_no" id="salesorder_po_s"/>

                        </td>
                        <td>            
                            <!--<a id="salesorder_menu_search" href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true"> Search Detail</a>-->

                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="salesorder_search()">Find</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="salesorder_add()">Add</a>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" id="salesorder_edit" plain="true" onclick="salesorder_edit()">Edit</a>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id="salesorder_delete" plain="true" onclick="salesorder_delete()">Delete</a>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-dollar" id="salesorder_edit_price" plain="true" onclick="salesorder_edit_price()">Edit Price</a>            
                            <!--            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-close" id="salesorder_cancel" plain="true" onclick="salesorder_cancel()">Cancel</a>-->
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-process" id="salesorder_process" plain="true" onclick="salesorder_process()">Submit >></a>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-revision" id="salesorder_revision" plain="true" onclick="salesorder_revision()">Revision <<</a>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-payment" id="salesorder_set_down_payment" plain="true" onclick="salesorder_set_down_payment()">Set Down Payment</a>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-view_detail_item" id="salesorder_preview" plain="true" onclick="salesorder_preview()">Preview</a>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" id="salesorder_print" plain="true" onclick="salesorder_print()">Print</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <table id="salesorder" data-options="
               url:'<?php echo site_url('salesorder/get') ?>',
               method:'post',
               border:false,
               singleSelect:true,
               fit:true,
               rownumbers:true,
               fitColumns:false,
               pagination:true,               
               pageSize:30,
               pageList: [30, 50, 70, 90, 110],
               striped:true,
               idField: 'id',
               sortName:'id',
               sortOrder:'desc',
               toolbar:'#salesorder_toolbar'">
            <thead>
                <tr>
                    <th field="so_chck" checkbox="true"></th>
                    <th field="sonumber" width="80" align="center" sortable="true">SO</th>
                    <th field="date_format" width="70" align="center" sortable="true">Date</th>
                    <th field="customerorder" width="150" halign="center" sortable="true">Order By</th>
                    <th field="customershipto" width="150" halign="center">Ship To</th>
                    <th field="po_no" width="80" halign="center" sortable="true">PO</th>
                    <th field="terms" width="60" align="center">Terms</th>
                    <th field="shipdate_format" width="70" align="center" sortable="true">Expected<br/>Delivery</th>
                    <th field="shipvia" width="60" align="center" sortable="true">Ship Via</th>
                    <th field="salesman" width="90" halign="center" sortable="true">Salesman</th>
                    <th field="sub_total" width="90" halign="center" align="right" formatter="formatPrice">Sub Total</th>
                    <th field="discount" width="90" halign="center" align="right" formatter="formatPrice">Discount</th>
                    <th field="ppn" width="90" halign="center" align="right" formatter="formatPrice">Tax</th>
                    <th field="estimatedfreight" width="90" align="center">Estimated<br/>Freight</th>
                    <th field="total" width="90" halign="center" align="right" formatter="formatPrice">Total Order</th>
                    <th field="bank_account" 
                        width="90" 
                        halign="center"
                        data-options="formatter: function(value,row,index){
                        if(row.bankaccountid != '0'){
                        return row.account_number + '|' + row.bank;
                        }
                        }">Pay To</th>
                    <th field="currency" width="50" align="center">Curr</th>
                    <th field="down_payment_nominal" width="100" halign="center"  align="right" formatter="formatPrice">Down<br/>Payment</th>
                    <th field="down_payment_date" width="80" align="center" formatter="myFormatDate">Date<br/>Down Payment </th>
                    <th field="preparedby" width="90" halign="center">Prepared<br/>By</th>
                    <th field="approvedby" width="90" halign="center">Approved<br/>By</th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            $(function () {
                $('#salesorder').datagrid({
                    onSelect: function (value, row, index) {
                        $('#salesorderdetail').datagrid('reload', {
                            salesorderid: row.id
                        });
                        if (row.open === 't') {
                            $('#salesorder_edit').linkbutton('disable');
                            $('#salesorder_delete').linkbutton('disable');
                            $('#salesorder_edit_price').linkbutton('disable');
                            $('#salesorder_cancel').linkbutton('disable');
                            $('#salesorder_process').linkbutton('disable');
                            $('#salesorderdetail_add').linkbutton('disable');
                            $('#salesorderdetail_edit').linkbutton('disable');
                            $('#salesorderdetail_delete').linkbutton('disable');
                            $('#salesorderdetail_edit_finishing').linkbutton('disable');
                            $('#salesorderdetail_edit_upholstry').linkbutton('disable');
                            $('#salesorderdetail_edit_specification').linkbutton('disable');
                            $('#salesorder_revision').linkbutton('enable');
                        } else {
                            $('#salesorder_edit').linkbutton('enable');
                            $('#salesorder_delete').linkbutton('enable');
                            $('#salesorder_edit_price').linkbutton('enable');
                            $('#salesorder_cancel').linkbutton('enable');
                            $('#salesorder_process').linkbutton('enable');
                            $('#salesorderdetail_add').linkbutton('enable');
                            $('#salesorderdetail_edit').linkbutton('enable');
                            $('#salesorderdetail_delete').linkbutton('enable');
                            $('#salesorderdetail_edit_finishing').linkbutton('enable');
                            $('#salesorderdetail_edit_upholstry').linkbutton('enable');
                            $('#salesorderdetail_edit_specification').linkbutton('enable');
                            $('#salesorder_revision').linkbutton('disable');
                        }
                    },
                    rowStyler: function (index, row) {
                        if (row.open == 'f') {
                            return 'background-color:#ffcccc';
                        }
                    }
                });

                $('#salesorder_menu_search').tooltip({
                    content: $('<div></div>'),
                    showEvent: 'click',
                    hideEvent: 'none',
                    deltaX: -150,
                    /*onUpdate: function(content) {
                     content.panel({
                     width: 350,
                     border: true,
                     title: 'Search',
                     href: base_url + 'salesorder/load_search_form'
                     });
                     },*/
                    onShow: function () {
                        var t = $(this);
                        t.tooltip('tip').unbind().bind('mouseenter', function () {
                            t.tooltip('show');
                        });
                    }
                });
            });

        </script>
    </div>
    <div 
        data-options="region:'south',split:true" 
        style="height:50%;border: none;" 
        href="<?php echo site_url('salesorder/view_detail') ?>">

    </div>
</div>
<script src="js/salesorder.js"></script>