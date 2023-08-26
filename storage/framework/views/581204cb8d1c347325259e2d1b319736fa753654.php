<?php echo e(Form::model($milestone, array('route' => array('assign.window.update', $milestone->id),'enctype' => 'multipart/form-data', 'method' => 'POST'))); ?>

<div class="modal-body">
<div class="row">
        <div class="col-6 form-group">
            <label><strong>Outer Frame Price</strong></label><br/>
            <input class="form-control" type="number" name="outerprice" id="outerprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Sliding Slash Price</strong></label><br/>
                <input class="form-control" type="number" name="slideprice" id="slideprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Net Frame Price</strong></label><br/>
                <input class="form-control" type="number" name="netprice" id="netprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Sliding Beeding Frame Price</strong></label><br/>
                <input class="form-control" type="number" name="slidebeedprice" id="slidebeedprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>InterLock</strong></label><br/>
                <input class="form-control" type="number" name="interlockprice" id="interlockprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Outer Frame Steel Price</strong></label><br/>
                <input class="form-control" type="number" name="outersteelprice" id="outersteelprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Sliding Steel Sash Price</strong></label><br/>
                <input class="form-control" type="number" name="slidesteelprice" id="slidesteelprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Net Frame SteelPrice</strong></label><br/>
                <input class="form-control" type="number" name="netsteelprice" id="netsteelprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Net</strong></label><br/>
                <input class="form-control" type="number" name="nettprice" id="nettprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Gas Kit EPDM</strong></label><br/>
                <input class="form-control" type="number" name="gaskitprice" id="gaskitprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Netting Gas Kit</strong></label><br/>
                <input class="form-control" type="number" name="netgaskitprice" id="netgaskitprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Sliding Brush role</strong></label><br/>
                <input class="form-control" type="number" name="slidingbrushprice" id="	slidingbrushprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Aluminium Rail</strong></label><br/>
                <input class="form-control" type="number" name="aluminiumrailprice" id="aluminiumrailprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Gear Handle</strong></label><br/>
                <input class="form-control" type="number" name="gearprice" id="gearprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>LatchLock</strong></label><br/>
                <input class="form-control" type="number" name="latchlockprice" id="latchlockprice">
        </div>
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
<?php echo e(Form::close()); ?><?php /**PATH /home2/babarras/public_html/resources/views/assignwindow/addprice.blade.php ENDPATH**/ ?>