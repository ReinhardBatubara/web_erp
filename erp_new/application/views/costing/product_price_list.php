<div id="product_price_list_toolbar" style="padding-bottom: 0px;">
    <form id="product_price_list_search_form" style="margin-bottom: 0px" onsubmit="return false;">
        Item Code/Name: 
        <input type="text" 
               size="25" 
               name="itemcode" 
               class="easyui-validatebox"
               onkeyup="if (event.keyCode == 13) {
                           costing_product_price_list_search()
                       }"/>        
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="costing_product_price_list_search()"></a>
        <?php if (in_array('edit_price', $action) || $this->session->userdata('id') == 'admin') { ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="costing_product_price_list_edit()">Edit Price</a>
        <?php } if (in_array('edit_rate', $action) || $this->session->userdata('id') == 'admin') { ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-rate" plain="true" onclick="costing_product_price_list_edit_rate()">Edit Rate</a>
        <?php } ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="costing_product_price_list_print()">Print</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="costing_product_price_list_excel()">Export to Excel</a>
    </form>
</div>
<table id="product_price_list" data-options="
       url:'<?php echo site_url('costing/product_price_list_get') ?>',
       method:'post',
       title: 'Product Price List',
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
       toolbar:'#product_price_list_toolbar'">
    <thead>
        <tr>
            <th field="image_location" width="60" halign="center" rowspan="2" >Photo</th>
            <th field="original_code" width="90" halign="center" rowspan="2" >Item Code</th>
            <th field="item_name" width="180" halign="center" sortable="true" rowspan="2" >Item Name</th>
            <th field="date" width="65" align="center" rowspan="2" formatter="myFormatDate">Date</th>
            <th align="center" colspan="3">Item Size (MM)</th>
            <th align="center" colspan="3">Item Size (INC)</th>
            <th align="center" colspan="3">PACKAGING SIZE (INC)</th>
            <th align="center" colspan="4">SEAT</th>
            <th field="usd_price" width="100" align="right" halign='center' rowspan="2" formatter="formatPrice">USD Price</th>
            <th field="usd_optional_price" width="100" align="right" halign='center' rowspan="2" formatter="formatPrice">USD Price<br/>(Optional)</th>
            <th field="idr_price" width="100" align="right" halign='center' rowspan="2" formatter="formatPrice">IDR Price</th>
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
        $('#product_price_list').datagrid({
        });
    });

    function product_price_list_display_image(value, row, index) {
        return "<center><img src='files/model/" + value + "' style='max-width:40px;max-height:40px;padding:1px;border:none;'></center>";
    }
</script>

