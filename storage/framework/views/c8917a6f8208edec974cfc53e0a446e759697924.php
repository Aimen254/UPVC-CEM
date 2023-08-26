<?php echo e(Form::model($milestone, array('route' => array('assign.window.update', $milestone->id),'enctype' => 'multipart/form-data', 'method' => 'POST'))); ?>

<div class="modal-body">
<div class="row">
        <div class="col-6 form-group">
            <label><strong>Outer Frame Price</strong></label><br/>
            <input class="form-control" type="number" name="outerprice" id="outerprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Outward/Inward Slash Price</strong></label><br/>
                <input class="form-control" type="number" name="slideprice" id="slideprice">
        </div>
        <div class="col-6 form-group">
            <label><strong>Openable Net Sash</strong></label><br/>
            <input class="form-control" type="number" name="netprice" id="netprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Sash Beeding Frame Price</strong></label><br/>
                <input class="form-control" type="number" name="slidebeedprice" id="slidebeedprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Outer Frame Steel Price</strong></label><br/>
                <input class="form-control" type="number" name="outersteelprice" id="outersteelprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Sash steel Price</strong></label><br/>
                <input class="form-control" type="number" name="slidesteelprice" id="slidesteelprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Net Sash Steel</strong></label><br/>
                <input class="form-control" type="number" name="nettprice" id="nettprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Gaskit EPDM</strong></label><br/>
                <input class="form-control" type="number" name="gaskitprice" id="gaskitprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Gaskit EPDM 2X</strong></label><br/>
                <input class="form-control" type="number" name="xgaskitprice" id="gaskitprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Gaskit EPDM Beeding</strong></label><br/>
                <input class="form-control" type="number" name="gaskitbeedprice" id="gaskitbeedprice">
        </div>
         <div class="col-6 form-group">
                <label><strong>Fly Screen</strong></label><br/>
                <input class="form-control" type="number" name="flyscreen" id="flyscreen">
        </div>
         <div class="col-6 form-group">
                <label><strong>Netting Gasket</strong></label><br/>
                <input class="form-control" type="number" name="netgaskitprice" id="gaskitbeedprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Cockspur Handle</strong></label><br/>
                <input class="form-control" type="number" name="cockspurprice" id="cockspurprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Gear Handle</strong></label><br/>
                <input class="form-control" type="number" name="gearprice" >
        </div>
         <div class="col-6 form-group">
                <label><strong>OuterFrame Weight</strong></label><br/>
                <input class="form-control" type="number" name="outerw" step="any">
        </div>
         <div class="col-6 form-group">
                <label><strong>Outward/Inward Slash Weight</strong></label><br/>
                <input class="form-control" type="number" name="slidew" step="any">
        </div>
                 <div class="col-6 form-group">
                <label><strong>Sash Beeding weight</strong></label><br/>
                <input class="form-control" type="number" name="beedingw" step="any">
        </div>
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
<?php echo e(Form::close()); ?><?php /**PATH /home2/babarras/public_html/resources/views/assignwindow/openaddprice.blade.php ENDPATH**/ ?>