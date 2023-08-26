<?php echo e(Form::open(['route' => ['usrimg.status' ],'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
      
        <div class="col-sm-6">
            <div class="form-group">
                <input class="form-control" type="hidden" name="id" id="imageid" value="<?php echo e($data->id); ?>">
                <?php echo e(Form::label('status', __('Status'), ['class' => 'form-label'])); ?>

                <select name="status" id="status" class="form-control main-element select2">
                    <?php $__currentLoopData = \App\Models\UserWindow::$windows_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH /home2/babarras/public_html/resources/views/image/status.blade.php ENDPATH**/ ?>