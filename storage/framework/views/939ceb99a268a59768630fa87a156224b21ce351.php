
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Product & Services')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
  
    
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Product & Services')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
 
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="<?php echo e(__('Import')); ?>" data-url="<?php echo e(route('productservice.file.import')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Import product CSV file')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
      
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 
<div class="row" >
        <div class="col-xxl-12">
        <?php $__currentLoopData = $projs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
            
                <div class="col-md-3">
               
                    <div class="card text-center">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <div class=" badge bg-primary p-2 px-3 rounded">
                                    
                                       
                                    </div>
                                </h6>

                            </div>

                          
                        </div>
                        <div class="card-body full-card">
                           <div class="img-fluid rounded-circle card-avatar">
                                 <img id="myFrame" src="<?php if(!empty($proj->image)): ?> <?php echo e(asset('/formulaimages/'.$proj->image)); ?> <?php endif; ?>" alt="kal" class="img-user wid-30 width="500" height="200" ">
                           </div>
                          
                        </div>
                      
                    </div>

                </div>

                <div class="col-md-9">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
      
                            <table class="table " id="myTable" >
                                <thead>
                                <tr>
                                    <th class="text-center" ><?php echo e(__('Final sizes')); ?></th>
                                    <th></th>
                                    <th class="text-center" width="25%"><?php echo e(__('Steel')); ?></th>
                                </tr>
                             
                              
                                </thead>
                                <tbody >
                              
                                <tr>
                                    <th><?php echo e(__('Width')); ?></th>
                                    <th><?php echo e(__('Height')); ?></th>
                                    <th><?php echo e(__('Width')); ?></th>
                                    <th><?php echo e(__('Height')); ?></th>
                                </tr>
                                <tr>
                                    <td><?php echo e($img->widthmm); ?></td> 
                                    <td><?php echo e($img->heightmm); ?></td> 
                                </tr>
                             
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
        
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/projectwindows/allcutsheet.blade.php ENDPATH**/ ?>