<div class="easyui-layout" data-options="fit:true">        
    <div region="west" split="true" style="width: 450px;border-left: none">
        <?php $this->load->view('pricecomparison/itemlist') ?>
    </div>
    <div region="center" style="border-right: none">
        <?php $this->load->view('pricecomparison/vendorlist') ?>
    </div>
</div>