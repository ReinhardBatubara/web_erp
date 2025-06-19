<form id="goodsreceive_search_form" method="post" novalidate onsubmit="return false;">
    <table width="310" border="0">
        <tr>
            <td width="25%" align="right"><label class="field_label">GR NO : </label></td>
            <td width="75%">
                <input type="text"
                       class="easyui-validatebox" 
                       name="number" 
                       id="gr_number_s" 
                       style="width: 150px"
                       onkeyup="if (event.keyCode === 13) {goodsreceive_search();}" 
                       />
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Date From : </label></td>
            <td valign="middle">
                <input type="text" size="13" class="easyui-datebox" name="datefrom" id="gr_datefrom_s" data-options="formatter:myformatter,parser:myparser"/>
                To : 
                <input type="text" size="13" class="easyui-datebox" name="dateto" id="gr_dateto_s" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">PO NO : </label></td>
            <td>
                <input type="text" 
                       style="width: 150px"
                       class="easyui-validatebox" 
                       name="po" 
                       id="gr_po_s"  
                       onkeyup="if (event.keyCode === 13) {goodsreceive_search();}
                       "/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Vendor :</label></td>
            <td>
                <input type="text" name="vendorid" panelWidth="200" id="gr_vendor_id_s" class="easyui-combobox" data-options="
                       valueField: 'id',
                       textField: 'text',
                       url: '<?php echo site_url('vendor/get_remote_data') ?>'" mode="remote" style="width: 150px">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">No SJ : </label></td>
            <td>
                <input type="text"  style="width: 150px" class="easyui-validatebox" name="no_sj" id="gr_no_sj_s" onkeyup="if (event.keyCode === 13) {goodsreceive_search();}" />
            </td>
        </tr>
        <tr>
            <td style="padding-top: 10px" colspan="2" align="center">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="goodsreceive_search()">Find</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="goodsreceive_print_detail()">Print</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="$('#goodsreceive_search_form').form('clear');goodsreceive_search()">Clear</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="$('#goodsreceive_menu_search').tooltip('hide');">Close</a>
            </td>
        </tr>
    </table>   
</form>