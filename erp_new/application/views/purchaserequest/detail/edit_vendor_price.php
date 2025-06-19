
<form id="purchaserequestdetail_edit_vendor_price-input" method="post" novalidate>
    <table width="100%" border="0">            
        <tr>
            <td align="right" width="30%"><label class="field_label">Vendor : </label></td>
            <td width="70%">
                <input id="pr_detail_pricecomparison_id"
                       name="pricecomparisonid"
                       style="width: 200px"
                       required="true"
                       />
                <script>
                    $(function() {                        
                        $('#pr_detail_pricecomparison_id').combogrid({
                            value:'<?php echo $pricecomparisonid ?>',
                            panelWidth: 400,
                            idField: 'id',
                            mode: 'remote',
                            fitColumns:true,
                            editable:false,
                            textField: 'vendor',
                            url: '<?php echo site_url('pricecomparison/get_vendor_list_pritem/' . $pritemid) ?>',
                            columns: [[
                                    {field:'vendor',title:'Vendor',halign:'center',width:120},
                                    {field:'currency',title:'Currency',align:'center',width:50},
                                    {field:'price',title:'Unit Price',halign:'center',align:'right',width:80},
                                    {field:'discount',title:'Discount',halign:'center',align:'right',width:80},
                                    {field:'ppn',title:'Tax',halign:'center',align:'right',width:80},
                                    {field:'amount',title:'Amount',halign:'center',align:'right',width:120}
                                ]],
                            onSelect: function(index, row) {
                                $('#pd_evp_price').numberbox('setValue',row.price);
                                $('#pd_evp_tax').numberbox('setValue',row.ppn);
                                $('#pd_evp_discount').numberbox('setValue',row.discount);
                                $('#pd_evp_vendorid').val(row.vendorid);
                            }
                        });
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Price :</label></td>
            <td>
                <input type="hidden" 
                       name="vendorid" 
                       id="pd_evp_vendorid"
                       />
                <input type="text" 
                       name="price" 
                       id="pd_evp_price" 
                       style="text-align: right;width: 150px" 
                       class="easyui-numberbox" 
                       required="true" 
                       precision="2"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Tax : </label></td>
            <td>
                <input type="text" 
                       name="tax" 
                       id="pd_evp_tax" 
                       style="text-align: right;width: 150px" 
                       class="easyui-numberbox" 
                       precision="2"
                       /></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Discount :</label></td>
            <td>
                <input unit="text" 
                       name="discount" 
                       id="pd_evp_discount" 
                       style="text-align: right;width: 150px" 
                       class="easyui-numberbox" 
                       precision="2"
                       />
            </td>
        </tr>
    </table>       
</form>