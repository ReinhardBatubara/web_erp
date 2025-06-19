<div id="item_toolbar" style="padding-bottom: 0">  
  <form id="item_search_form2" style="margin-bottom: 0px">
    Item Code /Description: 
    <input type="text" 
           size="12" 
           name="code"
           class="easyui-validatebox"
           onkeypress="if (event.keyCode === 13) {
                 item_search2();
               }"
           />
           <?php
           if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') {
             ?>
      Warehouse : 
      <input type="text"
             name="warehouseid" 
             id="item_search_warehouseid" 
             class="easyui-combobox" 
             url="<?php echo site_url('warehouse/get') ?>"
             data-options="
             valueField: 'id',
             textField: 'partnumber',
             onChange:function(o,n){item_search2()}" 
             style="width: 80px" 
             panelHeight="auto"
             required="true" >
             <?php
           }
           ?>
    Group : 
    <input class="easyui-combobox" name="groupid" data-options="
           url: '<?php echo site_url('groups/get') ?>',
           method: 'post',
           valueField: 'id',
           textField: 'name',
           mode: 'remote',
           panelHeight: '200',
           panelWidth:'200',
           formatter: itemSearchFormatGroup,
           onChange:function(o,n){item_search2()}"
           style="width: 80px" 
           />
    <script type="text/javascript">
      function itemSearchFormatGroup(row) {
        var s = '<span style="font-weight:bold">' + row.code + '</span><br/>' +
                '<span style="color:#888">Name: ' + row.name + '</span><br/>';
        return s;
      }
    </script>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="item_search2()"></a>
    <?php if (in_array('add', $action)) { ?>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="item_add()"> Add</a>
    <?php }if (in_array('edit', $action)) { ?>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="item_edit()"> Edit</a>
    <?php }if (in_array('delete', $action)) { ?>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="item_delete()"> Delete</a>
      <?php
    }
    if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') {
      ?>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-users" plain="true" onclick="item_change_admin()">Change Admin</a>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-disable" plain="true" id="item_disable" onclick="item_disable()">Disable</a>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-enable" plain="true" id="item_enable" onclick="item_enable()">Enable</a>
    <?php } ?>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-stock-card" plain="true" id="item_stock_card" onclick="item_stock_card()">Stock Card</a>
    <a id="item_menu_search" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" style="float: right;"></a>
  </form>
</div>
<table id="item" data-options="
       url:'<?php echo site_url('item/get') ?>',
       method:'post',
       singleSelect:true,
       title:'Item',
       fit:true,
       pageSize:50,
       pageList: [50, 100, 150, 200, 250],
       border:false,
       striped:true,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       nowrap: true,
       idField: 'id',
       scrollbarSize: 5,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#item_toolbar'">
  <thead>
    <tr>           
      <th field="code" width="80" halign="center" fixed="true" sortable="true">Item Code</th>
      <th field="description" width="250" halign="center" fixed="true" sortable="true">Item Description</th>
      <th field="groups" width="80" halign="center" sortable="true">Item group</th>
      <th field="category_f" width="80" align="center" sortable="true">Category</th>
      <th field="unitcode" width="80" align="center" fixed="true" sortable="true">Base Unit</th>
      <th field="isstock" width="50" align="center" fixed="true" sortable="true">Is Stock</th>
      <th field="stock" width="80" align="center" fixed="true" sortable="true">Stock</th>
      <th field="moq" width="50" align="center" fixed="true" sortable="true">MoQ</th>
      <th field="reorderpoint" width="50" align="center" fixed="true" sortable="true">RoP</th>
      <th field="lt" width="60" align="center" fixed="true" sortable="true">Lead Time</th>
      <th field="qccheck" width="50" align="center" fixed="true" sortable="true">Rcve Check</th>
      <th field="active" width="50" align="center" fixed="true" data-options="formatter:
          function(value,row,index){
          if (value == 't'){
          return 'Y';
          } else {
          return 'N';
          }
          }
          " sortable="true">Active</th>
<!--        <th field="images_view" width="80" align="center" fixed="true">Image</th>-->
    </tr>
  </thead>
</table>
<script type="text/javascript">
  var item_selected = 0;
  $(function() {
    $('#item').datagrid({
      onSelect: function(value, row, index) {
        //if (item_selected !== row.id) {
        $('#itemwarehousestock').datagrid('load', {
          itemid: row.id
        });
        $('#itemunitrelation').datagrid('load', {
          itemid: row.id
        });
        $('#itemunitprice').datagrid('load', {
          itemid: row.id
        });
        $('#image-item').attr('src', 'files/' + row.images);
        item_selected = row.id;

        if (row.active == 't') {
          $('#item_disable').linkbutton('enable');
          $('#item_enable').linkbutton('disable');
        } else {
          $('#item_disable').linkbutton('disable');
          $('#item_enable').linkbutton('enable');
        }

        //}
      },
      view: detailview,
      detailFormatter: function(index, row) {
        return '<div class="ddv_item' + row.id + '"></div>';
      },
      onExpandRow: function(index, row) {
        var ddv_item = $(this).datagrid('getRowDetail', index).find('div.ddv_item' + row.id);
        ddv_item.panel({
          border: false,
          cache: true,
          href: base_url + 'item/get_more_information/' + row.id + '/' + row.images,
          onLoad: function() {
            $('#item').datagrid('fixDetailRowHeight', index);
            $('#item').datagrid('selectRow', index);
            $('#item').datagrid('getRowDetail', index).find('form').form('load', row);
          }
        });
        $('#item').datagrid('fixDetailRowHeight', index);
      }
    });
    $('#item_menu_search').tooltip({
      content: $('<div></div>'),
      showEvent: 'click',
      hideEvent: 'none',
      deltaX: -150,
      onUpdate: function(content) {
        content.panel({
          width: 300,
          border: true,
          title: 'Search',
          href: base_url + 'item/load_search_form'
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
  function unit_format(value, row, index) {
    return "<table border='1' width=100%>" +
            "<tr>" +
            "<td>fas</td>" +
            "<td>fs</td>" +
            "</tr>" +
            "<tr>" +
            "<td>fas</td>" +
            "<td>fs</td>" +
            "</tr>" +
            "</table>";
  }
</script>
<?php
$this->load->view('item/add');
$this->load->view('item/edit');
$this->load->view('item/change_image');
