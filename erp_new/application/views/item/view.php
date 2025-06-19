<div class="easyui-layout" data-options="fit:true">       
    <div data-options="region:'center'">
        <!--        <div class="easyui-layout" data-options="fit:true"> 
                    <div data-options="region:'center'" title="Item">-->
        <?php $this->load->view('item/item') ?>
        <!--            </div>-->
        <!--            <div region="east" collapsible="false" title="Image" split="true" style="width: 250px;">
                        <table width="100%">
                            <tr>
                                <td align="center">
                                    <b/><br/>
                                    <img src="files/no-image.jpg" id="image-item" style="max-width: 120px;max-height: 120px;;width: 150px;height: 150px;"/>
                                </td>                  
                            </tr>
                            <tr>
                                <td align="center">
        <?php if (in_array('change_image', $action)) { ?>
                                                                <button class="button" onclick="item_change_image()">Change Image</button>
        <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </div>-->
        <!--        </div>        -->
    </div>
    <?php
    if (in_array($this->session->userdata('department'), array(9, 7, 2)) || $this->session->userdata('id') == 'admin') {
        ?>
        <div data-options="region:'south',split:true" style="height:30%;border-left: none;border-bottom: none;border-top: none;">
            <div class="easyui-layout" data-options="fit:true" border="false"> 
                <div data-options="region:'west'" title="Unit Group And Price" style="width: 35%;" collapsible="false" split="true">
                    <?php $this->load->view('item/itemunitprice/view') ?>
                </div>
                <div data-options="region:'center'" title="Unit Conversion">
                    <?php $this->load->view('item/itemunitrelation/view') ?>
                </div>
                <div region="east" collapsible="false" title="Stock On Hand" split="true" style="width: 35%;">
                    <?php $this->load->view('item/itemwarehousestock/view') ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>