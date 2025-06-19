<div id="vendor_toolbar" style="padding-bottom: 0;">     
    <form id="vendor_search_form" onsubmit="vendor_search();return false;">       
    Code : 
    <input type="text" 
           size="12" 
           class="easyui-validatebox" 
           id="vendor_code_s" 
           onkeyup="if (event.keyCode == 13) {
                       vendor_search()
                   }"
           />    
    Name : 
    <input type="text" 
           size="12" 
           class="easyui-validatebox" 
           id="vendor_name_s" 
           onkeyup="if (event.keyCode == 13) {
                       vendor_search()
                   }"
           />    
    Address : 
    <input type="text" 
           size="20" 
           class="easyui-validatebox" 
           id="vendor_address_s"
           onkeyup="if (event.keyCode == 13) {
                       vendor_search()
                   }"
           />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="vendor_search()"> Search</a>
    <?php
    if (in_array('add', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="vendor_add()">Add</a>
        <?php
    }if (in_array('edit', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="vendor_edit()">Edit</a>
        <?php
    }if (in_array('delete', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="vendor_delete()">Delete</a>
        <?php
    }
    ?>
    </form>
</div>
<table id="vendor" data-options="
       url:'<?php echo site_url('vendor/get') ?>',
       method:'post',
       title:'Vendor',
       border:true,
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#vendor_toolbar'">
    <thead>
        <tr>
            <th field="id"hidden="true"></th>            
            <th field="code" width="100" align="center" sortable="true">Code</th>
            <th field="name" width="120" halign="center" sortable="true">Name</th>
            <th field="currency" width="120" halign="center" sortable="true">Currency</th>
            <th field="taxable" width="80" align="center" sortable="true">Taxable</th>
            <th field="payment_terms" width="100" align="center" sortable="true">Payment Terms</th>
            <th field="address1" width="200" halign="center" sortable="true">Address</th>
            <th field="city" width="100" align="center" sortable="true">City</th>
            <th field="state" width="100" align="center" sortable="true">State</th>
            <th field="zipcode" width="100" align="center">Zip Code</th>
            <th field="country" width="100" align="center" sortable="true">Country</th>
            <th field="contact" width="100" halign="center">Contact Person</th>
            <th field="service" width="200" halign="center" sortable="true">Service</th>
            <th field="phone" width="100" halign="center" sortable="true">Phone</th>
            <th field="fax" width="100" align="center">Fax</th>
            <th field="email" width="100" align="center">Email</th>         
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#vendor').datagrid({});
    });
</script>
<?php
$this->load->view('vendor/add');
