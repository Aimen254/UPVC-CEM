<?php echo e(Form::open(['route' => ['usrimg.assign' ],'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
      
        <div class="col-6 form-group">
        <input class="form-control" type="hidden" name="id" id="imageid" value="<?php echo e($data->id); ?>">
            <?php echo e(Form::label('assign', __('Assign to'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('assign[]', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required'))); ?>

        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH /home2/babarras/public_html/resources/views/image/assign.blade.php ENDPATH**/ ?>