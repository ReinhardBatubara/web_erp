<div id="stock_in_all_detail_toolbar" style="padding-bottom: 0;">
    <form id="stock_in_all_detail_form_search" style="margin-bottom: 0">
        Date From : 
        <input type="text" 
               size="13" 
               class="easyui-datebox" 
               id="stock_in_all_detail_datefrom_s" 
               data-options="formatter:myformatter,parser:myparser"
               name="datefrom"
               required="true"
               />
        To :
        <input type="text" 
               size="13" 
               class="easyui-datebox" 
               id="stock_in_all_detail_dateto_s" 
               data-options="formatter:myformatter,parser:myparser"
               name="dateto"
               required="true"
               />
        Item Code : 
        <input type="text" 
               size="8" 
               name="item_code"
               class="easyui-validatebox" 
               id="stock_in_detail_detail_code_s" 
               onkeypress="if (event.keyCode === 13) {
                       stock_in_detail_transaction_search();
                   }"
               />
        Description :
        <input type="text" 
               class="easyui-validatebox" 
               name="item_description"
               id="stock_in_detail_detail_description_s" 
               onkeyup="if (event.keyCode === 13) {
                       stock_in_detail_transaction_search();
                   }"
               />
        <a href="#" onclick="stock_in_detail_transaction_search()" class="easyui-linkbutton" plain="true" iconCls="icon-search"></a>
        <a href="#" onclick="stock_in_detail_transaction_print()" class="easyui-linkbutton" plain="true" iconCls="icon-print">Print</a>
        <a href="#" onclick="stock_in_detail_transaction_excel()" class="easyui-linkbutton" plain="true" iconCls="icon-excel">Excel</a>
    </form>
</div>
<table id="stock_in_all_detail" data-options="       
       method:'post',
       border:true,       
       singleSelect:true,
       title:'Stock In Detail',
       fit:true,
       rownumber:true,
       striped:true,
       fitColumns:false,
       pagination:false,
       rownumbers: true,
       sortName:'transactionid',
       sortOrder:'desc',
       toolbar:'#stock_in_all_detail_toolbar'" class="easyui-datagrid">
    <thead>        
        <tr>      
            <th field="stock_in_number" width="80" halign="center" sortable="true">GR / BPNP</th>
            <th field="date" width="70" align="center" formatter="myFormatDate" sortable="true">Date</th>
            <th field="item_code" width="80" halign="center" sortable="true">Item Code</th>
            <th field="item_description" width="180" halign="center">Item Description</th>
            <th field="unitcode" width="60" align="center">Unit</th>
            <th field="qty" width="70" align="center">Qty</th>
            <th field="store_to" width="80" align="center">Store To</th>
            <th field="vendor_name" width="150" halign="center" sortable="true">Supplier</th>
            <th field="remark" width="150" halign="center">Remark</th>
        </tr>
    </thead>
</table>