<table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr valign="top">
        <td width="33%">
            BESI 7850 Kg/m3, Total Luas : <span id="besi_total_luas">0</span> M2, Total Kg : <span id="besi_total_kg">0</span> Kg
            <table width="100%"
                   id="besi_pipa_kotak"
                   class="easyui-datagrid"
                   title="PIPA KOTAK"
                   method='post'
                   border="true"
                   singleSelect="true"
                   pageSize="30"
                   rownumbers="true"
                   fitColumns="false"
                   showFooter="true"
                   striped="true"
                   style="height:150px;"
                   url='<?php echo site_url('costing/get_raw_material/1/1') ?>'
                   >
                <thead>
                    <tr>
                        <th field="tebalplat" width="60" align="center">Tebal Plat</th>
                        <th field="tebal" width="40" align="center">Tebal</th>
                        <th field="lebar" width="40" align="center">Lebar</th>
                        <th field="panjang" width="50" align="center">Panjang</th>
                        <th field="qty" width="25" align="center">Qty</th>
                        <th field="m2" width="50" halign="center" align="right" formatter="formatPrice">M2</th>
                        <th field="kg" width="40" halign="center" align="right" formatter="formatPrice">Kg</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#besi_pipa_kotak').datagrid({
                        toolbar: [{
                                iconCls: 'icon-add',
                                text:'Add',
                                handler: function(){
                                    costing_add_raw_material(1,1,'besi_pipa_kotak');
                                }
                            },{
                                iconCls: 'icon-edit',
                                text:'Edit',
                                handler: function(){
                                    costing_edit_raw_material('besi_pipa_kotak');
                                }
                            },{
                                iconCls: 'icon-remove',
                                text:'Delete',
                                handler: function(){
                                    costing_delete_raw_material('besi_pipa_kotak');
                                }
                            }]
                    });
                });
            </script>
            <br/>
            <table width="100%"
                   id="besi_pipa_bulat"
                   class="easyui-datagrid"
                   title="PIPA BULAT"
                   method='post'
                   border="true"
                   singleSelect="true"
                   pageSize="30"
                   rownumbers="true"
                   fitColumns="false"
                   showFooter="true"
                   striped="true"
                   style="height:150px"
                   url='<?php echo site_url('costing/get_raw_material/1/2') ?>'
                   >
                <thead>
                    <tr>
                        <th field="tebalplat" width="60" align="center">Tebal Plat</th>
                        <th field="diameter" width="40" align="center">D. Luar</th>
                        <th field="radius" width="40" align="center">Radius</th>
                        <th field="panjang" width="50" align="center">Panjang</th>
                        <th field="qty" width="25" align="center">Qty</th>
                        <th field="m2" width="50" halign="center" align="right" formatter="formatPrice">M2</th>
                        <th field="kg" width="40" halign="center" align="right" formatter="formatPrice">Kg</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#besi_pipa_bulat').datagrid({
                        toolbar: [{
                                iconCls: 'icon-add',
                                text:'Add',
                                handler: function(){
                                    costing_add_raw_material(1,2,'besi_pipa_bulat');
                                }
                            },{
                                iconCls: 'icon-edit',
                                text:'Edit',
                                handler: function(){
                                    costing_edit_raw_material('besi_pipa_bulat');
                                }
                            },{
                                iconCls: 'icon-remove',
                                text:'Delete',
                                handler: function(){
                                    costing_delete_raw_material('besi_pipa_bulat');
                                }
                            }]
                    });
                });
            </script>
            <br/>
            <table width="100%"
                   id="besi_as_kotak_or_strip_plate_or_plat"
                   class="easyui-datagrid"
                   title="AS KOTAK/STRIP PLATE/PLAT"
                   method='post'
                   border="true"
                   singleSelect="true"
                   pageSize="30"
                   rownumbers="true"
                   fitColumns="false"
                   showFooter="true"
                   striped="true"
                   style="height:150px"
                   url='<?php echo site_url('costing/get_raw_material/1/3') ?>'
                   >
                <thead>
                    <tr>
                        <th field="penampang" width="60" align="center">Penampang</th>
                        <th field="tebal" width="40" align="center">Tebal</th>
                        <th field="lebar" width="40" align="center">Lebar</th>
                        <th field="panjang" width="50" align="center">Panjang</th>
                        <th field="qty" width="25" align="center">Qty</th>
                        <th field="m2" width="50" halign="center" align="right" formatter="formatPrice">M2</th>
                        <th field="kg" width="40" halign="center" align="right" formatter="formatPrice">Kg</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#besi_as_kotak_or_strip_plate_or_plat').datagrid({
                        toolbar: [{
                                iconCls: 'icon-add',
                                text:'Add',
                                handler: function(){
                                    costing_add_raw_material(1,3,'besi_as_kotak_or_strip_plate_or_plat');
                                }
                            },{
                                iconCls: 'icon-edit',
                                text:'Edit',
                                handler: function(){
                                    costing_edit_raw_material('besi_as_kotak_or_strip_plate_or_plat');
                                }
                            },{
                                iconCls: 'icon-remove',
                                text:'Delete',
                                handler: function(){
                                    costing_delete_raw_material('besi_as_kotak_or_strip_plate_or_plat');
                                }
                            }]
                    });
                });
            </script>
            <br/>
            <table width="100%"
                   id="besi_as_bulat"
                   class="easyui-datagrid"
                   title="AS BULAT"
                   method='post'
                   border="true"
                   singleSelect="true"
                   pageSize="30"
                   rownumbers="true"
                   fitColumns="false"
                   showFooter="true"
                   striped="true"
                   style="height:150px"
                   url='<?php echo site_url('costing/get_raw_material/1/4') ?>'
                   >
                <thead>
                    <tr>
                        <th field="penampang" width="60" align="center">Penampang</th>
                        <th field="diameter" width="40" align="center">D. Luar</th>
                        <th field="radius" width="40" align="center">Radius</th>
                        <th field="panjang" width="50" align="center">Panjang</th>
                        <th field="qty" width="25" align="center">Qty</th>
                        <th field="m2" width="50" halign="center" align="right" formatter="formatPrice">M2</th>
                        <th field="kg" width="40" halign="center" align="right" formatter="formatPrice">Kg</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#besi_as_bulat').datagrid({
                        toolbar: [{
                                iconCls: 'icon-add',
                                text:'Add',
                                handler: function(){
                                    costing_add_raw_material(1,4,'besi_as_bulat');
                                }
                            },{
                                iconCls: 'icon-edit',
                                text:'Edit',
                                handler: function(){
                                    costing_edit_raw_material('besi_as_bulat');
                                }
                            },{
                                iconCls: 'icon-remove',
                                text:'Delete',
                                handler: function(){
                                    costing_delete_raw_material('besi_as_bulat');
                                }
                            }]
                    });
                });
            </script>
            <br/>
            <table width="100%"
                   id="besi_plat_siku"
                   class="easyui-datagrid"
                   title="PLAT SIKU"
                   method='post'
                   border="true"
                   singleSelect="true"
                   pageSize="30"
                   rownumbers="true"
                   fitColumns="false"
                   showFooter="true"
                   striped="true"
                   style="height:150px"
                   url='<?php echo site_url('costing/get_raw_material/1/5') ?>'
                   >
                <thead>
                    <tr>
                        <th field="penampang" width="60" align="center">Penampang</th>
                        <th field="tebal" width="40" align="center">Tebal</th>
                        <th field="lebar" width="40" align="center">Lebar</th>
                        <th field="panjang" width="50" align="center">Panjang</th>
                        <th field="qty" width="25" align="center">Qty</th>
                        <th field="m2" width="50" halign="center" align="right" formatter="formatPrice">M2</th>
                        <th field="kg" width="40" halign="center" align="right" formatter="formatPrice">Kg</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#besi_plat_siku').datagrid({
                        toolbar: [{
                                iconCls: 'icon-add',
                                text:'Add',
                                handler: function(){
                                    costing_add_raw_material(1,5,'besi_plat_siku');
                                }
                            },{
                                iconCls: 'icon-edit',
                                text:'Edit',
                                handler: function(){
                                    costing_edit_raw_material('besi_plat_siku');
                                }
                            },{
                                iconCls: 'icon-remove',
                                text:'Delete',
                                handler: function(){
                                    costing_delete_raw_material('besi_plat_siku');
                                }
                            }]
                    });
                });
            </script>
        </td>
        <td width="34%">
            STAINLESS 7750 Kg/m3, Total Luas : <span id="stainless_total_luas">0</span> M2, Total Kg : <span id="stainless_total_kg">0</span> Kg
            <table width="100%"
                   id="stainless_pipa_kotak"
                   class="easyui-datagrid"
                   title="PIPA KOTAK"
                   method='post'
                   border="true"
                   singleSelect="true"
                   pageSize="30"
                   rownumbers="true"
                   fitColumns="false"
                   showFooter="true"
                   striped="true"
                   style="height:150px;"
                   url='<?php echo site_url('costing/get_raw_material/2/1') ?>'                   
                   >
                <thead>
                    <tr>
                        <th field="tebalplat" width="60" align="center">Tebal Plat</th>
                        <th field="tebal" width="40" align="center">Tebal</th>
                        <th field="lebar" width="40" align="center">Lebar</th>
                        <th field="panjang" width="50" align="center">Panjang</th>
                        <th field="qty" width="25" align="center">Qty</th>
                        <th field="m2" width="50" halign="center" align="right" formatter="formatPrice">M2</th>
                        <th field="kg" width="40" halign="center" align="right" formatter="formatPrice">Kg</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#stainless_pipa_kotak').datagrid({
                        toolbar: [{
                                iconCls: 'icon-add',
                                text:'Add',
                                handler: function(){
                                    costing_add_raw_material(2,1,'stainless_pipa_kotak');
                                }
                            },{
                                iconCls: 'icon-edit',
                                text:'Edit',
                                handler: function(){
                                    costing_edit_raw_material('stainless_pipa_kotak');
                                }
                            },{
                                iconCls: 'icon-remove',
                                text:'Delete',
                                handler: function(){
                                    costing_delete_raw_material('stainless_pipa_kotak');
                                }
                            }]
                    });
                });
            </script>
            <br/>
            <table width="100%"
                   id="stainless_pipa_bulat"
                   class="easyui-datagrid"
                   title="PIPA BULAT"
                   method='post'
                   border="true"
                   singleSelect="true"
                   pageSize="30"
                   rownumbers="true"
                   fitColumns="false"
                   showFooter="true"
                   striped="true"
                   style="height:150px"
                   url='<?php echo site_url('costing/get_raw_material/2/2') ?>'
                   >
                <thead>
                    <tr>
                        <th field="tebalplat" width="60" align="center">Tebal Plat</th>
                        <th field="diameter" width="40" align="center">D. Luar</th>
                        <th field="radius" width="40" align="center">Radius</th>
                        <th field="panjang" width="50" align="center">Panjang</th>
                        <th field="qty" width="25" align="center">Qty</th>
                        <th field="m2" width="50" halign="center" align="right" formatter="formatPrice">M2</th>
                        <th field="kg" width="40" halign="center" align="right" formatter="formatPrice">Kg</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#stainless_pipa_bulat').datagrid({
                        toolbar: [{
                                iconCls: 'icon-add',
                                text:'Add',
                                handler: function(){
                                    costing_add_raw_material(2,2,'stainless_pipa_bulat');
                                }
                            },{
                                iconCls: 'icon-edit',
                                text:'Edit',
                                handler: function(){
                                    costing_edit_raw_material('stainless_pipa_bulat');
                                }
                            },{
                                iconCls: 'icon-remove',
                                text:'Delete',
                                handler: function(){
                                    costing_delete_raw_material('stainless_pipa_bulat');
                                }
                            }]
                    });
                });
            </script>
            <br/>
            <table width="100%"
                   id="stainless_as_kotak_or_strip_plate_or_plat"
                   class="easyui-datagrid"
                   title="AS KOTAK/STRIP PLATE/PLAT"
                   method='post'
                   border="true"
                   singleSelect="true"
                   pageSize="30"
                   rownumbers="true"
                   fitColumns="false"
                   showFooter="true"
                   striped="true"
                   style="height:150px"
                   url='<?php echo site_url('costing/get_raw_material/2/3') ?>'
                   >
                <thead>
                    <tr>
                        <th field="penampang" width="60" align="center">Penampang</th>
                        <th field="tebal" width="40" align="center">Tebal</th>
                        <th field="lebar" width="40" align="center">Lebar</th>
                        <th field="panjang" width="50" align="center">Panjang</th>
                        <th field="qty" width="25" align="center">Qty</th>
                        <th field="m2" width="50" halign="center" align="right" formatter="formatPrice">M2</th>
                        <th field="kg" width="40" halign="center" align="right" formatter="formatPrice">Kg</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#stainless_as_kotak_or_strip_plate_or_plat').datagrid({
                        toolbar: [{
                                iconCls: 'icon-add',
                                text:'Add',
                                handler: function(){
                                    costing_add_raw_material(2,3,'stainless_as_kotak_or_strip_plate_or_plat');
                                }
                            },{
                                iconCls: 'icon-edit',
                                text:'Edit',
                                handler: function(){
                                    costing_edit_raw_material('stainless_as_kotak_or_strip_plate_or_plat');
                                }
                            },{
                                iconCls: 'icon-remove',
                                text:'Delete',
                                handler: function(){
                                    costing_delete_raw_material('stainless_as_kotak_or_strip_plate_or_plat');
                                }
                            }]
                    });
                });
            </script>
            <br/>
            <table width="100%"
                   id="stainless_as_bulat"
                   class="easyui-datagrid"
                   title="AS BULAT"
                   method='post'
                   border="true"
                   singleSelect="true"
                   pageSize="30"
                   rownumbers="true"
                   fitColumns="false"
                   showFooter="true"
                   striped="true"
                   style="height:150px"
                   url='<?php echo site_url('costing/get_raw_material/2/4') ?>'
                   >
                <thead>
                    <tr>
                        <th field="penampang" width="60" align="center">Penampang</th>
                        <th field="diameter" width="40" align="center">D. Luar</th>
                        <th field="radius" width="40" align="center">Radius</th>
                        <th field="panjang" width="50" align="center">Panjang</th>
                        <th field="qty" width="25" align="center">Qty</th>
                        <th field="m2" width="50" halign="center" align="right" formatter="formatPrice">M2</th>
                        <th field="kg" width="40" halign="center" align="right" formatter="formatPrice">Kg</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#stainless_as_bulat').datagrid({
                        toolbar: [{
                                iconCls: 'icon-add',
                                text:'Add',
                                handler: function(){
                                    costing_add_raw_material(2,4,'stainless_as_bulat');
                                }
                            },{
                                iconCls: 'icon-edit',
                                text:'Edit',
                                handler: function(){
                                    costing_edit_raw_material('stainless_as_bulat');
                                }
                            },{
                                iconCls: 'icon-remove',
                                text:'Delete',
                                handler: function(){
                                    costing_delete_raw_material('stainless_as_bulat');
                                }
                            }]
                    });
                });
            </script>
            <br/>
            <table width="100%"
                   id="stainless_plat_siku"
                   class="easyui-datagrid"
                   title="PLAT SIKU"
                   method='post'
                   border="true"
                   singleSelect="true"
                   pageSize="30"
                   rownumbers="true"
                   fitColumns="false"
                   showFooter="true"
                   striped="true"
                   style="height:150px"
                   url='<?php echo site_url('costing/get_raw_material/2/5') ?>'
                   >
                <thead>
                    <tr>
                        <th field="penampang" width="60" align="center">Penampang</th>
                        <th field="tebal" width="40" align="center">Tebal</th>
                        <th field="lebar" width="40" align="center">Lebar</th>
                        <th field="panjang" width="50" align="center">Panjang</th>
                        <th field="qty" width="25" align="center">Qty</th>
                        <th field="m2" width="50" halign="center" align="right" formatter="formatPrice">M2</th>
                        <th field="kg" width="40" halign="center" align="right" formatter="formatPrice">Kg</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#stainless_plat_siku').datagrid({
                        toolbar: [{
                                iconCls: 'icon-add',
                                text:'Add',
                                handler: function(){
                                    costing_add_raw_material(2,5,'stainless_plat_siku');
                                }
                            },{
                                iconCls: 'icon-edit',
                                text:'Edit',
                                handler: function(){
                                    costing_edit_raw_material('stainless_plat_siku');
                                }
                            },{
                                iconCls: 'icon-remove',
                                text:'Delete',
                                handler: function(){
                                    costing_delete_raw_material('stainless_plat_siku');
                                }
                            }]
                    });
                });
            </script>
        </td>
        <td width="33%">
            KUNINGAN 8430 Kg/m3, Total Luas : <span id="kuningan_total_luas">0</span> M2, Total Kg : <span id="kuningan_total_kg">0</span> M2
            <table width="100%"
                   id="kuningan_as_kotak_or_strip_plate_or_plat"
                   class="easyui-datagrid"
                   title="AS KOTAK/STRIP PLATE/PLAT"
                   method='post'
                   border="true"
                   singleSelect="true"
                   pageSize="30"
                   rownumbers="true"
                   fitColumns="false"
                   showFooter="true"
                   striped="true"
                   style="height:150px"
                   url='<?php echo site_url('costing/get_raw_material/3/3') ?>'
                   >
                <thead>
                    <tr>
                        <th field="penampang" width="60" align="center">Penampang</th>
                        <th field="tebal" width="40" align="center">Tebal</th>
                        <th field="lebar" width="40" align="center">Lebar</th>
                        <th field="panjang" width="50" align="center">Panjang</th>
                        <th field="qty" width="25" align="center">Qty</th>
                        <th field="m2" width="50" halign="center" align="right" formatter="formatPrice">M2</th>
                        <th field="kg" width="40" halign="center" align="right" formatter="formatPrice">Kg</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#kuningan_as_kotak_or_strip_plate_or_plat').datagrid({
                        toolbar: [{
                                iconCls: 'icon-add',
                                text:'Add',
                                handler: function(){
                                    costing_add_raw_material(3,3,'kuningan_as_kotak_or_strip_plate_or_plat');
                                }
                            },{
                                iconCls: 'icon-edit',
                                text:'Edit',
                                handler: function(){
                                    costing_edit_raw_material('kuningan_as_kotak_or_strip_plate_or_plat');
                                }
                            },{
                                iconCls: 'icon-remove',
                                text:'Delete',
                                handler: function(){
                                    costing_delete_raw_material('kuningan_as_kotak_or_strip_plate_or_plat');
                                }
                            }]
                    });
                });
            </script>
            <br/>
            <table width="100%"
                   id="kuningan_as_bulat"
                   class="easyui-datagrid"
                   title="AS BULAT"
                   method='post'
                   border="true"
                   singleSelect="true"
                   pageSize="30"
                   rownumbers="true"
                   fitColumns="false"
                   showFooter="true"
                   striped="true"
                   style="height:150px"
                   url='<?php echo site_url('costing/get_raw_material/3/4') ?>'
                   >
                <thead>
                    <tr>
                        <th field="penampang" width="60" align="center">Penampang</th>
                        <th field="diameter" width="40" align="center">D. Luar</th>
                        <th field="radius" width="40" align="center">Radius</th>
                        <th field="panjang" width="50" align="center">Panjang</th>
                        <th field="qty" width="25" align="center">Qty</th>
                        <th field="m2" width="50" halign="center" align="right" formatter="formatPrice">M2</th>
                        <th field="kg" width="40" halign="center" align="right" formatter="formatPrice">Kg</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#kuningan_as_bulat').datagrid({
                        toolbar: [{
                                iconCls: 'icon-add',
                                text:'Add',
                                handler: function(){
                                    costing_add_raw_material(3,4,'kuningan_as_bulat');
                                }
                            },{
                                iconCls: 'icon-edit',
                                text:'Edit',
                                handler: function(){
                                    costing_edit_raw_material('kuningan_as_bulat');
                                }
                            },{
                                iconCls: 'icon-remove',
                                text:'Delete',
                                handler: function(){
                                    costing_delete_raw_material('kuningan_as_bulat');
                                }
                            }]
                    });
                });
            </script>
        </td>
    </tr>
</table>