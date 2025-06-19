<center>
    <div style="border: 1px #0099cc solid;margin: 2px;width: 99%;">
        <form id="salesinvoice_edit-input" method="post" novalidate>
            <table width="100%" style="margin-top: 5px;" border="0">
                <tr valign="top">
                    <td width="50%">
                        <table width="100%" border="0" cellpadding="0" cellspacing="1">
                            <tr>
                                <td width="25%" align="right"><label class="field_label" style="margin-left: 10px">Invoice No :</label></td>
                                <td width="75%">
                                    <input type="text" name="invoice_no" size="15" disabled/>
                                    <label class="field_label" style="margin-left: 10px">Date : </label>
                                    <input type="text" size="13" class="easyui-datebox" required="true" name="invoice_date" id="invoice_date" data-options="formatter:myformatter,parser:myparser"/>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%">&nbsp;</td>
                </tr>
                <tr valign="top">
                    <td width="50%">
                        <table width="100%" border="0" cellspacing="0">                        
                            <tr>
                                <td width="25%" align="right"><label class="field_label" style="margin-left: 10px">Customer : </label> </td>
                                <td width="75%" >
                                    <select name="customerid" id="customerid" disabled class="easyui-combobox" style="width: 150px" panelWidth="200" required="true">
                                        <option></option>
                                        <?php
                                        foreach ($customer as $result) {
                                            echo "<option value=" . $result->id . ">" . $result->name . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <script type="text/javascript">
                                        $(function () {
                                            $('#customerid').combobox({
                                                onSelect: function (row) {
                                                    $.get(base_url + 'customer/get_address/' + row.value, function (content) {
                                                        $('#bill_to').val(content);
                                                        $('#ship_to').val(content);
                                                    });
                                                }
                                            });
                                        });
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><label class="field_label" style="margin-left: 10px">Bill To : </label></td>
                                <td><textarea class="easyui-textbox" id="bill_to" name="bill_to" style="width:100%;height:40px"></textarea></td>
                            </tr>
                            <tr>
                                <td align="right"><label class="field_label" style="margin-left: 10px">Ship To : </label></td>
                                <td><textarea class="easyui-textbox" id="ship_to" name="ship_to" style="width:100%;height:40px"></textarea></td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%">

                        <table width="100%" border="0" cellspacing="0">                        
                            <tr>
                                <td width="35%" align="right"><label class="field_label" style="margin-left: 10px">Ship Date : </label></td>
                                <td width="65%"><input type="text" size="13" class="easyui-datebox" id="ship_date" name="ship_date" data-options="formatter:myformatter,parser:myparser" required="true"/></td>
                            </tr>
                            <tr>
                                <td align="right"><label class="field_label" style="margin-left: 10px">Ship Via : </label></td>
                                <td>
                                    <select class="easyui-combobox" name="ship_via" id="ship_via" required="true" panelHeight="auto">
                                        <option></option>
                                        <?php
                                        foreach ($shipvia as $result) {
                                            echo "<option value=" . $result->code . ">" . $result->code . "</option>";
                                        }
                                        ?>
                                    </select>    
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><label class="field_label" style="margin-left: 10px">Terms : </label></td>
                                <td><input type="text" id="terms" name="terms" class="easyui-validatebox" size="20"/></td>
                            </tr>
                            <tr>
                                <td align="right"><label class="field_label" style="margin-left: 10px">Currency : </label></td>
                                <td>
                                    <select class="easyui-combobox" id="currency" name='currency' required='true' style="width: 100px">
                                        <option></option>
                                        <?php
                                        foreach ($currency as $result) {
                                            echo "<option value='" . $result->code . "'>" . $result->code . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="200" width="100%">
                        <div id="list_item_invoice_toolbar" style="padding-bottom: 2px;">
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="salesinvoicedetail_add_f_e()"> Add</a>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="salesinvoicedetail_edit_f_e()"> Edit</a>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="salesinvoicedetail_delete_f_e()"> Delete</a>
                        </div>
                        <table id="list_item_invoice"
                               class="easyui-datagrid"
                               url='<?php echo site_url('salesinvoice/get_detail2/' . $salesinvoiceid) ?>'
                               method ='post'
                               title = 'List Item'
                               method = 'post'
                               border = 'true'
                               singleSelect = 'true'
                               fit ='true'
                               rownumbers = 'true'
                               fitColumns = 'true'
                               idField= 'id' 
                               toolbar="#list_item_invoice_toolbar"
                               width="100%">
                            <thead>
                                <tr>       
                                    <th field="modelcode" width="100" halign="center">Item Code</th>   
                                    <th field="modelname" width="200" halign="center">Item Name</th>
                                    <th field="qty" width="100" align="center">Qty</th>
                                    <th field="unitprice" width="100" halign="center" align="right">Unit Price</th>
                                    <th field="discount" width="100" halign="center" align="right">Discount</th>
                                    <th field="tax" width="100" halign="center" align="right">Tax</th>
                                    <th field="amount" width="100" halign="center" align="right">Amount</th>
                                    <th field="ramark" width="100" halign="center" align="right">Remark</th>
                                </tr>
                            </thead>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" width="100%">
                        <table width="100%" border="0" cellspacing="0">
                            <tr valign="top">
                                <td width="60%">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="20%" align="right"><label class="field_label">Say : </label></td>
                                            <td width="80%">
                                                <textarea class="easyui-textbox" name="say" style="width: 100%;height: 60px"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="field_label">Description  : </label></td>
                                            <td>
                                                <textarea class="easyui-textbox" name="description" style="width: 100%;height: 60px"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="40%">
                                    <table width="100%" border="0" cellspacing="0">
                                        <tr>
                                            <td width="40%" align="right"><label class="field_label">Sub Total : </label></td>
                                            <td width="60%">
                                                <input type="text" name="subtotal" id="si_subtotal_e" style="width: 100%;text-align: right;" class="easyui-numberbox"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="field_label">Discount : </label></td>
                                            <td>
                                                <input type="text" name="discount" id="si_discount_e" style="width: 100%;text-align: right;" class="easyui-numberbox"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="field_label">Tax : </label></td>
                                            <td>
                                                <input type="text" name="tax" id="si_tax_e"  style="width: 100%;text-align: right;" class="easyui-numberbox"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="field_label">Total Invoice : </label></td>
                                            <td>
                                                <input type="text" name="totalinvoice" id="si_totalinvoice_e"  style="width: 100%;text-align: right;" class="easyui-numberbox"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="field_label">Down Payment : </label></td>
                                            <td>
                                                <input type="text" name="downpayment" id="si_downpayment_e" style="width: 100%;text-align: right;" class="easyui-numberbox"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="field_label">Balance Payment : </label></td>
                                            <td>
                                                <input type="text" name="balancepayment" id="si_balancepayment_e"  style="width: 100%;text-align: right;" class="easyui-numberbox"/>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</center>