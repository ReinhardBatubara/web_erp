<div class="easyui-layout" fit="true">
    <div region="north" border="false" style="padding:3px 5px;background:#efefef;">
        <form id="stock_card_form" style="margin: 0" onsubmit="return false">
            Item : 
            <input type="text" 
                   name="itemid"                           
                   style="width: 120px"
                   url='<?php echo site_url('item/get_for_combo') ?>'
                   valueField="id"
                   textField="code"
                   panelWidth="200"
                   data-options="formatter:ItemFormat"
                   class="easyui-combobox"
                   />
            <script>
                function ItemFormat(row) {
                    var s = '<span style="font-weight:bold">' + row.code + '</span><br/>' +
                            '<span style="color:#888;font-size:7.5pt">Desc: ' + row.description + '</span><br/>' +
                            '<span>Unit Code: ' + row.unitcode + '</span><br/>';
                    return s;
                }
            </script>
            Date:
            <input type="text" style="width: 100px" class="easyui-datebox" required="true" name="start_date" data-options="formatter:myformatter,parser:myparser"/>
            -
            <input type="text" style="width: 100px" class="easyui-datebox" required="true" name="end_date" data-options="formatter:myformatter,parser:myparser"/>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-preview" onclick="item_stock_out_preview()">Preview</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="item_stock_out_print()">Print</a>
        </form>
    </div>
    <div region="center" border="false" style="padding:10px" id="stock_card_temp">
        
    </div>
</div>