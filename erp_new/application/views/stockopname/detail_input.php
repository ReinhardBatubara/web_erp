<form id="stokopname_detail_input_form" method="post" novalidate class="table_form" style="padding: 2px">
    <table width="100%" border="0">
        <tr>
            <td width="30%"><strong>Item</strong></td>
            <td>    
                <input type="text" 
                       name="itemid" 
                       class="easyui-combobox" 
                       mode='remote'
                       methode='POST'
                       url='<?php echo site_url("item/get_in_warehouse/" . $warehouseid . "/" . $warehouseid) ?>'
                       valueField="id"
                       textField="description"
                       style="width: 100%" 
                       data-options='formatter:function(row){
                       var f = "<span style=font-weight:bold>" + row.code + "</span><br/>" +
                       "<span style=color:#888;font-size:7.5pt>Desc: " + row.description + "</span><br/>";
                       return f;        
                       },
                       onSelect:function(row){
                       $("#son_d_uom").combobox("clear");
                       $("#son_d_uom").combobox("reload", base_url + "itemwarehousestock/get/" + row.id);
                       }'/>
            </td>
        </tr>  
        <tr>
            <td><strong>UoM</strong></td>
            <td>
                <input id="son_d_uom" 
                       name="unitcode" 
                       panelHeight="auto"
                       required="true"
                       valueField="unitcode"
                       textField="unitcode"
                       class="easyui-combobox"
                       style="width: 100px;"
                       data-options="onSelect:function(row){
                       $('#son_system_stock').numberbox('setValue',row.qty);
                       console.log(row.qty);
                       }"
                       />
            </td>
        </tr>
        <tr>
            <td><strong>System Stock</strong></td>
            <td>
                <input id="son_system_stock" 
                       name="stock" 
                       readonly="true"
                       precision='4'
                       decimalSeparator='.'
                       groupSeparator=','
                       class="easyui-numberbox"
                       style="width: 100px;"
                       />
            </td>
        </tr>
        <tr>
            <td><strong>Real Stock</strong></td>
            <td>
                <input id="son_real_stock" 
                       name="real_stock" 
                       precision='4'
                       required='true'
                       class="easyui-numberbox"
                       style="width: 100px;"
                       data-options="onChange:function(n,o){
                       var sys_stock = $('#son_system_stock').numberbox('getValue');
                       if(sys_stock === ''){
                       sys_stock = 0;
                       }
                       var diff = n - sys_stock;
                       console.log(diff);
                       $('#son_difference').numberbox('setValue',diff);
                       }"
                       />
                <script>
                    $('#son_real_stock').on('keyUp', function (event) {
                        console.log(event.keyCode);
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td><strong>Difference</strong></td>
            <td>
                <input id="son_difference" 
                       name="difference" 
                       precision='4'
                       class="easyui-numberbox"
                       style="width: 100px;"
                       readonly
                       />
            </td>
        </tr>
    </table>        
</form>

<script type="text/javascript">
    $.extend($.fn.numberbox.defaults.rules, {
        check_ots_mw_qty: {
            validator: function (value, param) {
                return (parseFloat(value) <= parseFloat($(param[0]).val())) && (parseFloat(value) > 0);
            },
            message: 'Out of Outsanding'
        }
    });
</script>
