<?php echo e(Form::model($form, array('route' => array('formasign.update', $form->id), 'method' => 'PUT'))); ?><div class="modal-body">
<div class="row">
        <div class="col-6 form-group">
            
            <?php echo e(Form::hidden('image_id', null, array('class' => 'form-control','required'=>'required'))); ?>

            <?php echo e(Form::label('imagename', __('Name'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('imagename',null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-12 form-group">
            <label class="">Name</label>
            <img src="<?php if(!empty($image->image)): ?> <?php echo e(asset('/formulaimages/'.$image->image)); ?> <?php endif; ?>" alt="kal" class="img-user wid-30 width="500" height="200" ">
             
        </div>
    
        <div class="col-12 form-group">
        <?php echo e(Form::label('formula_id', __('Formulas'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('formula_id[]', $formulas,null, array('class' => 'form-control select2','id'=>'choices-multiple3','multiple'=>''))); ?>

        </div>
           <?php if($image->type == "Sliding Sash"): ?>
                <div class="col-12 form-group">
            <?php echo e(Form::label('acess_id', __('Accessories'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('acess_id[]',  $slidingaccess,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required'))); ?>

        </div>
         <?php elseif($image->type == "Openable door"): ?>
           <div class="col-12 form-group">
            <?php echo e(Form::label('acess_id', __('Accessories'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('acess_id[]', $openabledooraccess,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required'))); ?>

        </div>
        <?php elseif($image->type == "Openable windows"): ?>
        <div class="col-12 form-group">
            <?php echo e(Form::label('acess_id', __('Accessories'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('acess_id[]', $openablewindaccess,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required'))); ?>

        </div>
        <?php else: ?>
        <div class="col-12 form-group">
            <?php echo e(Form::label('acess_id', __('Accessories'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('acess_id[]', $access,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required'))); ?>

        </div>
        <?php endif; ?>

    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<script>
$('select').selectpicker();
</script>

<?php /**PATH /home2/babarras/public_html/resources/views/assignformulas/edit.blade.php ENDPATH**/ ?>