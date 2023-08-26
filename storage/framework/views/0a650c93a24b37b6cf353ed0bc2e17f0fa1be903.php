
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Images')); ?> <?php if($pipeline): ?> - <?php echo e($pipeline->name); ?> <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
 
$(document).ready(function(){
    $('#select_id').on('change', function() {
        var val = $(this).val();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1)
    });
  });
});
</script>

<script>
    function printme(){
        window.print();
    }
</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Image')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
        <a href="#" onclick="printme();" data-size="lg" data-url="" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Print Data')); ?>" class="btn btn-sm btn-primary btnprn">
            <i class="fa fa-print"></i>
        </a>
      
        <a href="#" data-size="lg" data-url="<?php echo e(route('images.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create New User')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($pipeline): ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
      
                            <table class="table datatable" >
                                <thead>
                                <tr>
                                   
                                 
                                   
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Image')); ?></th>
                                   
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                             
                                </thead>
                                <tbody id="myTable">
                                   
                                <?php if(count($images) > 0): ?>
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     
                                     <tr>
                                        
                                         <td><?php echo e($image->name); ?></td>
                                         <td scope="row">
                                        
                                                    <?php if(!empty($image->image)): ?>
                                            <!--<img alt="image" data-toggle="tooltip" data-original-title="<?php echo e($image->name); ?>" <?php if($image->image): ?> src="<?php echo e(asset('/formulaimages/'.$image->image)); ?>" <?php endif; ?>  width="35" height="35">-->
                                                                                       <img src="<?php echo e((!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-80 rounded-circle">

                                            <?php else: ?>
                                                <a href="#" class="btn btn-sm btn-secondary btn-icon rounded-pill">
                                                    <span class="btn-inner--icon"><i class="ti ti-times-circle"></i></span>
                                                </a>
                                            <?php endif; ?>
                                        

                                        

                                         </td>
                                        <!-- <img alt="image" data-toggle="tooltip" data-original-title="<?php echo e($image->name); ?>" <?php if($image->image): ?> src="<?php echo e(asset('/images/'.$image->image)); ?>" <?php endif; ?>  width="35" height="35"> -->

                                       
                                             <td class="Action">
                                                        
                                                 <a href="<?php echo e(route('images.show',$image->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-title="<?php echo e(__('Lead Detail')); ?>">
                                                     <i class="fa fa-eye "></i>
                                                 </a>
                                                 <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(route('images.edit',$image->id)); ?>" data-ajax-popup="true" data-size="xl" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Lead Edit')); ?>">
                                                     <i class="fa fa-pencil "></i>
                                                 </a>
                                                       
                                             </td>
                                     </tr>
                                   
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr class="font-style">
                                        <td colspan="6" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                    </tr>
                                <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/image/index.blade.php ENDPATH**/ ?>