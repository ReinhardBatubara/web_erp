<div id="product_without_price_toolbar" style="padding-bottom: 0px;">
    <form id="product_without_price_search_form" style="margin-bottom: 0px" onsubmit="return false;">
        Item Code/Name: 
        <input size="25" 
               name="q" 
               class="easyui-validatebox"
               onkeyup="if (event.keyCode === 13) {
                           $('#product_without_price').datagrid('reload', $('#product_without_price_search_form').serializeObject());
                       }"/>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="$('#product_without_price').datagrid('reload', $('#product_without_price_search_form').serializeObject());"></a>
    </form>
</div>

<table id="product_without_price" data-options="
       url:'<?php echo site_url('model/product_without_price_get') ?>',
       method:'post',
       title: 'Product Without Price',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       idField:'id',
       sortName:'id',
       autoRowHeight:true,
       sortOrder:'desc',
       toolbar:'#product_without_price_toolbar'">
    <thead>
        <tr>    
            <th field="code" width="90" halign="center" rowspan="2" >Item Code</th>
            <th field="name" width="180" halign="center" sortable="true" rowspan="2" >Item Name</th>
            <th align="center" colspan="3">Item Size (MM)</th>
            <th align="center" colspan="3">Item Size (INC)</th>
            <th align="center" colspan="3">PACKAGING SIZE (INC)</th>
            <th align="center" colspan="4">SEAT</th>
        </tr>
        <tr>
            <th field="itemsize_mm_w" width="40" align="center">W</th>
            <th field="itemsize_mm_d" width="40" align="center">D</th>
            <th field="itemsize_mm_h" width="40" align="center">H</th>
            <th field="itemsize_inc_w" width="40" align="center">W</th>
            <th field="itemsize_inc_h" width="40" align="center">D</th>
            <th field="itemsize_inc_d" width="40" align="center">H</th>
            <th field="packagingsize_mm_w" width="50" align="center">W</th>
            <th field="packagingsize_mm_h" width="50" align="center">D</th>
            <th field="packagingsize_mm_d" width="50" align="center">H</th>
            <th field="seat_width" width="50" align="center">WIDTH</th>
            <th field="seat_depth" width="50" align="center">DEPTH</th>
            <th field="seat_height" width="50" align="center">HEIGHT</th>
            <th field="arm_height" width="80" align="center">ARM HEIGHT</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#product_without_price').datagrid({});
    });
</script>