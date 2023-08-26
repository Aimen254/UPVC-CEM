<?php echo e(Form::open(['route' => ['usrimg.store'],'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-6 form-group">
            <label class="">Name</label>
            <input class="form-control" type="hidden" name="id" id="imageid" value="<?php echo e($image->id); ?>">
            <input class="form-control" value="<?php echo e($image->name); ?>" type="text" name="name" id="name">
        </div>
        <div class="col-12 form-group">
            <!--<label class="">Name</label>-->
           <img src="<?php echo e((!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-140 ">
             
        </div>
        <div class="col-12 form-group">
            <label><strong>Width</strong></label><br/>
            <input class="form-control" type="number" name="width" id="width">
        </div>
        <div class="col-12 form-group">
                <label><strong>Height</strong></label><br/>
                <input class="form-control" type="number" name="height" id="height">
        </div>
         <div class="col-12 form-group">
            <?php echo e(Form::label('products', __('Projects'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('products[]', $products,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required'))); ?>

        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH /home2/babarras/public_html/resources/views/image/usercreate.blade.php ENDPATH**/ ?>