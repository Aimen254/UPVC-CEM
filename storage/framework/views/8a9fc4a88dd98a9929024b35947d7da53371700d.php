

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Windows')); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>

<script>
    function printme(){
        window.print();
    }
</script>

<script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
$(document).ready(function(){
     $(#myTable).DataTable({
        "info": false,
        "searching": false,
     });
    }); 
</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Windows')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
       
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row" >
        <div class="col-xxl-12">
            <div class="row">
            
                <div class="col-md-3">
               
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
                                  <img src="<?php echo e((!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-140 ">
                           </div>
                          
                        </div>
                      
                    </div>

                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
          
                                <table class="table datatable" id="myTable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('OuterWidth')); ?></th>
                                        <th><?php echo e(__('OuterHeight')); ?></th>
                                        <th><?php echo e(__('InnerWidth')); ?></th>
                                        <th><?php echo e(__('InnerHeight')); ?></th>
                                        <th><?php echo e(__('FixWidth')); ?></th>
                                        <th><?php echo e(__('FixHeight')); ?></th>
                                         <th><?php echo e(__('Total Expense')); ?></th>
                                    </tr>
                                  
                                    </thead>
                                    <tbody >
                                     
                                         
                                                <td><?php echo e($window->outerwidth); ?></td>
                                                <td><?php echo e($window->outerheight); ?></td> 
                                                <td><?php echo e($window->innerwidth); ?></td> 
                                                <td><?php echo e($window->innerheight); ?></td> 
                                                <td><?php echo e($window->fixwidth); ?></td> 
                                                <td><?php echo e($window->fixheight); ?></td> 
                                          <td><?php echo e($window->totalexpense); ?></td>
                                               
                                            </tr>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                       <div class="card">
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
        
                                <table class="table datatable" id="myTable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('Aluminium Rail')); ?></th>
                                        <th><?php echo e(__('Brush Rolls')); ?></th>
                                        <th><?php echo e(__('Bumper Block')); ?></th>
                                        <th><?php echo e(__('Double Tap On Screen')); ?></th>
                                        <th><?php echo e(__('Dummy Wheels')); ?></th>
                                        <th><?php echo e(__('Fiber Net Roll ')); ?></th>
                                        <th><?php echo e(__('Flat Handle')); ?></th>
                                        <th><?php echo e(__('Fly Screen Sliding Wheel ')); ?></th>
                                        <th><?php echo e(__('Fly Screen Gask')); ?></th>
                                        <th><?php echo e(__('Gear Handler')); ?></th>
                                        <th><?php echo e(__('sliding Gear Keeps')); ?></th>
                                        <th><?php echo e(__('Sliding Gears')); ?></th>
                                        <th><?php echo e(__('Sliding Gear Wheels')); ?></th>
                                        <th><?php echo e(__('Stoppers')); ?></th>
                                        <th><?php echo e(__('Wind Break Bridge')); ?></th>
                                    </tr>
                                
                                    </thead>
                                    <tbody >
                                        <?php $__currentLoopData = $access; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acces): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($acces->aluminium_rail); ?>PKR</td>
                                                <td><?php echo e($acces->brush_rolls); ?>PKR</td> 
                                                <td><?php echo e($acces->bumpler_block); ?>PKR</td> 
                                                <td><?php echo e($acces->DTape_screws); ?>PKR</td> 
                                                <td><?php echo e($acces->dummy_wheels); ?>PKR</td> 
                                                <td><?php echo e($acces->fiber_net); ?>PKR</td> 
                                                <td><?php echo e($acces->flat_handle); ?>PKR</td> 
                                                <td><?php echo e($acces->fly_screen_gaskit); ?>PKR</td> 
                                                <td><?php echo e($acces->fly_screen_slidingwheel); ?>PKR</td> 
                                                <td><?php echo e($acces->gear_handles); ?>PKR</td> 
                                                <td><?php echo e($acces->sliding_gearkeep); ?>PKR</td> 
                                                <td><?php echo e($acces->sliding_gear); ?>PKR</td> 
                                                <td><?php echo e($acces->sliding_gearwheels); ?>PKR</td> 
                                                <td><?php echo e($acces->stoppers); ?>PKR</td> 
                                                <td><?php echo e($acces->wind_break); ?>PKR</td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        
            </div>
           
        </div>
</div>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/image/showvalues.blade.php ENDPATH**/ ?>