<?php echo e(Form::model($milestone, array('route' => array('open.assign.access.store', $milestone->id),'enctype' => 'multipart/form-data', 'method' => 'POST'))); ?>

<div class="modal-body">
<div class="row">
        
        <div class="col-6 form-group">
            <input type="checkbox" value="silicon" name="silicon">Silicon<br/> 
            <input class="form-control" type="number" name="siliconqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="siliconrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="outwardcase" name="outwardcase">outwardcasement<br/> 
            <input class="form-control" type="number" name="outwardcaseqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="outwardcaserate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="windowstay" name="windowstay">windowstay<br/> 
            <input class="form-control" type="number" name="windowstayqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="windowstayrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="frictionstay" name="frictionstay">frictionstay<br/> 
            <input class="form-control" type="number" name="frictionstayqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="frictionstayrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="pencilhindge" name="pencilhindge">pencilhindge<br/> 
            <input class="form-control" type="number" name="pencilhindgeqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="pencilhindgerate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="flathandle" name="flathandle">flathandle<br/> 
            <input class="form-control" type="number" name="flathandleqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="flathandlerate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>

        <div class="col-6 form-group">
            <input type="checkbox" value="twoDhindges" name="twoDhindges">2D hindges<br/> 
            <input class="form-control" type="number" name="twoDhindgesqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="twoDhindgesrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>

        <div class="col-6 form-group">
            <input type="checkbox" value="thDhindges" name="thDhindges">3D hindges<br/> 
            <input class="form-control" type="number" name="thDhindgesqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="thDhindgesrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>

        
        <div class="col-6 form-group">
            <input type="checkbox" value="openablekeep" name="openablekeep">openablekeep<br/> 
            <input class="form-control" type="number" name="openablekeepqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="openablekeeprate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>

        <div class="col-6 form-group">
            <input type="checkbox" value="Tlock" name="Tlock">Tlock<br/> 
            <input class="form-control" type="number" name="Tlockqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="Tlockrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>

        <div class="col-6 form-group">
            <input type="checkbox" value="cockspur" name="cockspur">Cockspur Handle<br/> 
            <input class="form-control" type="number" name="cockspurqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="cockspurrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
      
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
<?php echo e(Form::close()); ?><?php /**PATH /home2/babarras/public_html/resources/views/assignwindow/openaccesscreate.blade.php ENDPATH**/ ?>