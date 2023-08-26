
<?php
    $profile=asset(Storage::url('uploads/avatar/'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Assign Formulas')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Client')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
        <div class="col-xxl-12">
            <div class="row">
              <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <div class=" badge bg-primary p-2 px-3 rounded">
                                        <?php echo e(ucfirst($image->name)); ?>

                                    </div>
                                </h6>

                            </div>

                            

                        </div>
                           <div class="card-body full-card">
                           <div class="img-fluid rounded-circle card-avatar">
                                <a href="<?php echo e(route('imgformulas.show', $image->id)); ?>"  >
                                        <img src="<?php echo e((!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-140">
                                        </a>
                            </div>
                            <h4 class=" mt-2 text-primary">
                                <a href="#" data-size="lg" data-url="<?php echo e(route('formasign.create', $image)); ?>" data-ajax-popup="true"  data-bs-toggle="tooltip" title="<?php echo e(__('Assign Formula')); ?>"  class="btn btn-sm btn-primary">
                                    <i class="ti ti-plus"></i>
                                </a>
                                 <a href="#" class="mx-3 btn btn-sm  btn-primary" data-url="<?php echo e(route('formasign.edit',$image->id)); ?>" data-ajax-popup="true"  data-size="xl" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"  data-title="<?php echo e(__('Product Edit')); ?>">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                  <!--<a href="<?php echo e(route('formasign.edit',$image->id)); ?>" class="mx-3 btn btn-sm  btn-primary" >-->
                                  <!--                      <i class="ti ti-pencil"></i>-->
                                  <!--                  </a>-->
                            </h4>
                          
                        </div>
                      
                    </div>

                </div>
                

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/assignformulas/allimages.blade.php ENDPATH**/ ?>