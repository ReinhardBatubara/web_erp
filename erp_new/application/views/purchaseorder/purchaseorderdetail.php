<div id="purchaseorderdetail_toolbar" style="padding-bottom: 2px;min-height: 25px;">
  <a id="purchaseorderdetail_menu_search" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" style="float: right;">Search</a>
</div>
<table id="purchaseorderdetail" data-options="
       url:'<?php echo site_url('purchaseorderdetail/get') ?>',
       title:'Purchaser Order Items',
       method:'post',
       border:true,       
       singleSelect:true,
       fit:true,
       rownumber:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#purchaseorderdetail_toolbar'">
  <thead>        
    <tr>
      <th field="chck" checkbox="true"></th>
      <th field="itemcode" width="80" halign="center" sortable="true">Item</th>
      <th field="itemdescription" width="200" halign="center" sortable="true">Description</th>
      <th field="unitcode" width="50" align="center" sortable="true">Unit</th>
      <th field="qty" width="50" align="center">Qty</th>
      <th field="price" width="100" halign="center" align="right" formatter="formatPrice" sortable="true">Unit Price</th>
      <th field="subtotal" width="100" halign="center" align="right" formatter="formatPrice">Sub Total</th>
      <th field="discount" width="100" halign="center" align="right" formatter="formatPrice">Discount</th>
      <th field="ppn" width="100" halign="center" align="right" formatter="formatPrice">Tax</th>
      <th field="amount" width="100" halign="center" align="right" formatter="formatPrice">Amount</th>
      <th field="status" width="60" align="center" sortable="true">Status</th>
      <th field="receive_status" width="120" sortable="true">Receipt</th>
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#purchaseorderdetail').datagrid();

    $('#purchaseorderdetail_menu_search').tooltip({
      position: 'left',
      content: $('<div></div>'),
      showEvent: 'click',
      hideEvent: 'none',
      onUpdate: function(content) {
        content.panel({
          width: 320,
          border: true,
          title: 'Search',
          href: base_url + 'purchaseorderdetail/search_form'
        });
      },
      onShow: function() {
        var t = $(this);
        t.tooltip('tip').unbind().bind('mouseenter', function() {
          t.tooltip('show');
        });
      }
    });
  });
</script>

