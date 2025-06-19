<div class="easyui-layout" data-options="fit:true">        
    <div region="north" title="Costing" border="true" split="true" style="height: 300px;border-bottom: none;">
        <div class="easyui-layout" fit="true">        
            <div data-options="region:'center'" style="border-left: none" href="<?php echo site_url('costing/view') ?>">
            </div>
            <div data-options="region:'east',split:true" collapsible="false" style="width:260px;">
                <div id="tt-costing" class="easyui-tabs" border="none" data-options="fit:true,tabPosition:'top',tabHeight:20">
                    <div title="Costing Summary" style="border:none">
                        <table id="costing-summary"></table>
                        <script type="text/javascript">
                            $('#costing-summary').propertygrid({
                                url: '<?php echo site_url('costing/get_summary'); ?>',
                                showGroup: false,
                                border: false,
                                fit: true,
                                fitColumns: true,
                                columns: [[
                                        {field: 'name', title: 'Category', width: 100},
                                        {field: 'value', title: 'Total', width: 90, align: 'right', halign: 'center'}
                                    ]]
                            });
                        </script>
                    </div>
                    <div title="Image">
                        <table width="100%">
                            <tr>
                                <td align="center" height="200">
                                    <b/><br/>
                                    <img src="files/no-image.jpg" id="image-costing" style="max-width: 200px;max-height: 200px;"/>
                                </td>                  
                            </tr>
<!--                            <tr>
                                <td align="center">
                                    <button class="button" onclick="costing_change_image()">Change Image</button>
                                </td>
                            </tr>-->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div region="center" 
         title="Detail" 
         collapsible="false" 
         split="true" 
         href="<?php echo site_url('costing/load_detail') ?>">        
    </div>
</div>
<?php
$this->load->view('costing/add');
//$this->load->view('costing/change_image');
