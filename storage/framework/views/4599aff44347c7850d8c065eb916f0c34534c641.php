

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Windows')); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script>
        $(document).on("change", ".change-pipeline select[name=default_pipeline_id]", function () {
            $('#change-pipeline').submit();
        });
    </script>
<script>
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
    $(document).ready(function(){
    <!-- $('.btnprn').printPage(); -->
    <!-- $('.btnprn').window.print();
    }); -->

</script>
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
            
                <div class="col-md-3 ">
               
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
                                   <img src="<?php echo e((!empty($window->image))? asset(Storage::url("uploads/windows/".$window->image)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-80">
                           </div>
                          
                        </div>
                      
                    </div>

                </div>
                <div  class="col-md-6 ">
                    <div class= "row">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-body table-border-style">
                                    <table class="table " id="myTable" >
                                        <thead>
                                        <tr>
                                                <th></th>
                                                <th></th>
                                                <th><?php echo e(__('Total SQF')); ?></th>
                                         
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td>Width</td>
                                                <td><?php echo e($width); ?></td>
                                                <td><?php echo e($width); ?></td>
                                            </tr
                                            <tr>
                                                <td>Height</td>
                                                <td><?php echo e($height); ?></td>
                                                <td><?php echo e($height); ?></td>
                                            </tr
                                           
                                            <tr>
                                                <td><?php echo e($count); ?></td>
                                                <td></td>
                                                   <td><?php echo e($sqf); ?></td>
                                            </tr
                                        
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                </div>
            </div>
            <?php if($window->designtype == "sliding"): ?>
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th><?php echo e(__('UPVC Profile')); ?></th>
                                                <th><?php echo e(__('Wx2')); ?></th>
                                                <th><?php echo e(__('Hx2')); ?></th>
                                                <th><?php echo e(__('Total')); ?></th>
                                                <th><?php echo e(__('Prof.L=18')); ?></th>
                                                <th><?php echo e(__('Kg')); ?></th>
                                                <th><?php echo e(__('Rate')); ?></th>
                                                <th><?php echo e(__('Amount')); ?></th>
                                         
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td>Outer frame </td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 2); ?></td>
                                            <td><?php echo e($outerrn); ?></td>
                                            <?php
                                           $outprf =  $outerrn / 18 ;
                                           $outerprofile = ceil($outprf);
                                          $outerprice = $window->prices->outerprice;
                                          $outeramount = $outerprice * $outerprofile;
                                            ?>
                                            <td><?php echo e($outerprofile); ?></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->outerprice); ?>PKR</td> 
                                        <td><?php echo e($outeramount); ?>PKR</td> 
                                        </tr
                                        <tr>
                                            <td>Sliding Sacht </td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 4); ?></td>
                                            <td><?php echo e($slidern); ?></td>
                                            <?php
                                              $slidprf =  $slidern / 18 ;
                                               $slideprofile = ceil($slidprf);
                                              $slideprice =      $window->prices   ->slideprice;
                                             $slideamount = $slideprice *            $slideprofile;
                                            ?>
                                            <td><?php echo e($slideprofile); ?></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->slideprice); ?>PKR</td> 
                                            <td><?php echo e($slideamount); ?>PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Net Frame </td>
                                            <td><?php echo e($width); ?></td>
                                            <td><?php echo e($height * 2); ?></td>
                                            <td><?php echo e($netframrn); ?></td>
                                            <?Php
                                            $netprf =  $netframrn / 18 ;
                                           $netprofile = ceil($netprf);
                                          $netprice = $window->prices->netprice;
                                          $netamount = $netprice * $netprofile;
                                            ?>
                                            <td><?php echo e($netprofile); ?></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->netprice); ?>PKR</td> 
                                        <td><?php echo e($netamount); ?>PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Sliding Frame Beeding </td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 4); ?></td>
                                            <td><?php echo e($slidebeedrn); ?></td>
                                              <?Php
                                            $slidbeedprf =  $slidebeedrn / 18 ;
                                           $slidebeedprfile = ceil($slidbeedprf);
                                          $beedprice = $window->prices->slidebeedprice;
                                          $slidebeedamount = $beedprice * $slidebeedprfile;
                                            ?>
                                            <td><?php echo e($slidebeedprfile); ?></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->slidebeedprice); ?>PKR</td> 
                                           <td><?php echo e($slidebeedamount); ?>PKR</td> 
                                        </tr>
                                         <tr>
                                            <td>Inter Lock</td>
                                            <td></td>
                                            <td><?php echo e($height * 2); ?></td>
                                            <td><?php echo e($interlockrn); ?></td>
                                              <?Php
                                            $interlkprf =  $interlockrn / 18 ;
                                           $interlockprofile = ceil($interlkprf);
                                          $interlkprice = $window->prices->	interlockprice;
                                          $interlockamount = $interlkprice * $interlockprofile;
                                            ?>
                                            <td><?php echo e($interlockprofile); ?></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->	interlockprice); ?>PKR</td> 
                                        <td><?php echo e($interlockamount); ?>PKR</td> 
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th><?php echo e(__('Steeel Reinforcement')); ?></th>
                                                <th><?php echo e(__('Wx2')); ?></th>
                                                <th><?php echo e(__('Hx2')); ?></th>
                                                <th><?php echo e(__('Total')); ?></th>
                                                <th><?php echo e(__('Prof.L=18')); ?></th>
                                                <th><?php echo e(__('Kg')); ?></th>
                                                <th><?php echo e(__('Rate')); ?></th>
                                                <th><?php echo e(__('Amount')); ?></th>
                                         
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td>Outer steel frame </td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 2); ?></td>
                                            <td><?php echo e($outersteelrn); ?></td>
                                            <?php
                                             $outersteelprofile = $outersteelrn/8;
                                            $outersteelprice = $window->prices->outersteelprice;
                                             $outersteelamount = $outersteelprofile* $outersteelprice;
                                            ?>
                                            <td></td> 
                                            <td><?php echo e($outersteelprofile); ?></td>
                                            <td><?php echo e($window->prices->outersteelprice); ?>PKR</td> 
                                          <td><?php echo e($outersteelamount); ?>PKR</td> 
                                        </tr>
                                          <tr>
                                            <td>Sliding Steel Sacht </td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 4); ?></td>
                                            <td><?php echo e($slidesteelrn); ?></td>
                                                                                        <?php
                                                                                    $slidesteelprofile = $slidesteelrn/ 8;
                                           $slidesteelprice = $window->prices->slidesteelprice;
                                             $slidesteelamount = $slidesteelprofile * $slidesteelprice;
                                            ?>
                                            <td></td> 
                                            <td><?php echo e($slidesteelprofile); ?></td>
                                            <td><?php echo e($window->prices->slidesteelprice); ?>PKR</td> 
                                           <td><?php echo e($slidesteelamount); ?>PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Net steel Frame </td>
                                            <td></td>
                                            <td><?php echo e($height * 2); ?></td>
                                            <td><?php echo e($netframesteelrn); ?></td>
                                            <?php
                                            $netsteelprofile = $netframesteelrn/8;
                                            $netsteelprice = $window->prices->netsteelprice;
                                             $netsteelamount = $netsteelprofile* $netsteelprice;
                                            ?>
                                            <td></td> 
                                            <td><?php echo e($netsteelprofile); ?></td>
                                            <td><?php echo e($window->prices->netsteelprice); ?>PKR</td> 
                                        <td><?php echo e($netsteelamount); ?>PKR</td> 
                                        </tr>
                                       
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                
                  <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th><?php echo e(__('Allied Material')); ?></th>
                                                <th><?php echo e(__('Wx2')); ?></th>
                                                <th><?php echo e(__('Hx2')); ?></th>
                                                <th><?php echo e(__('Total')); ?></th>
                                                <th><?php echo e(__('Prof.L=18')); ?></th>
                                                <th><?php echo e(__('Kg')); ?></th>
                                                <th><?php echo e(__('Rate')); ?></th>
                                                <th><?php echo e(__('Amount')); ?></th>
                                         
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td>Net </td>
                                            <td><?php echo e($width); ?></td>
                                            <td><?php echo e($height * 2); ?></td>
                                            <td><?php echo e($netrn); ?></td>
                                            <?php
                                            $netprofile = $netrn / 4;
                                            $nettprofile = ceil($netprofile);
                                            $nettprice = $window->prices->nettprice;
                                            $nettamount = $nettprofile * $nettprice;
                                            ?>
                                            <td><?php echo e($nettprofile); ?></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->nettprice); ?>PKR</td> 
                                        <td><?php echo e($nettamount); ?>PKR</td> 
                                        </tr
                                        <tr>
                                            <td>Gaskit EPDM </td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 4); ?></td>
                                            <td><?php echo e($gaskitrn); ?></td>
                                            <?php
                                            $gaskitprice = $window->prices->gaskitprice;
                                            $gaskitamount = $gaskitrn*              $gaskitprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->gaskitprice); ?>PKR</td> 
                                            <td><?php echo e($gaskitamount); ?>PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Netting Gaskit</td>
                                           <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 2); ?></td>
                                            <td><?php echo e($netgaskitrn); ?></td>
                                             <?php
                                            $netgaskitprice= $window->prices->netgaskitprice;
                                            $netgaskitamount = $netgaskitrn * $netgaskitprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->netgaskitprice); ?>PKR</td> 
                                        <td><?php echo e($netgaskitamount); ?>PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Sliding Brush role</td>
                                           <td><?php echo e($width); ?></td>
                                            <td><?php echo e($height * 4); ?></td>
                                            <td><?php echo e($brushrolrn); ?></td>
                                              <?php
                                            $slidingbrushprice= $window->prices->slidingbrushprice;
                                            $slidingbrushamount = $brushrolrn * $slidingbrushprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->slidingbrushprice); ?>PKR</td> 
                                        <td><?php echo e($slidingbrushamount); ?>PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Aluminium Rail</td>
                                           <td><?php echo e($width); ?></td>
                                            <td></td>
                                            <td><?php echo e($aluminiumrn); ?></td>
                                            <?php
                                            $aluminiumrailprice= $window->prices->aluminiumrailprice;
                                            $aluminiumrailamount = $aluminiumrn * $aluminiumrailprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->aluminiumrailprice); ?>PKR</td> 
                                        <td><?php echo e($aluminiumrailamount); ?>PKR</td> 
                                        </tr>
                                          <tr>
                                                                                    <?php  
                                             $totalexpense =  $outeramount+     $slideamount+$netamount+$slidebeedamount+$interlockamount+$outersteelamount+$slidesteelamount+$netsteelamount+$nettamount+$gaskitamount+$netgaskitamount+$slidingbrushamount+$aluminiumrailamount;              ?>
                                            <td></td>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td> 
                                            <td>Profile+steel+Allied Cost</td>
                                            <td><?php echo e($totalexpense); ?>PKR</td>
                                        </tr>
                                         <tr>
                                            <td></td>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td> 
                                            <td>Hardware Cost</td>
                                            <td><?php echo e($hardwarecost); ?>PKR</td>
                                        </tr>
                                         <tr>
                                            <td></td>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td> 
                                            <td>Total Cost</td>
                                            <td><?php echo e($totalcost); ?>PKR</td>
                                        </tr>
                                       
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th><?php echo e(__('GearLock/Latchlock')); ?></th>
                                                <th><?php echo e(__('Slidding keep Window X 3')); ?></th>
                                                <th><?php echo e(__('Flat handle')); ?></th>
                                                <th><?php echo e(__('Sash Roler per window 2')); ?></th>
                                                <th><?php echo e(__('Dummy wheel Per window 2')); ?></th>
                                                <th><?php echo e(__('Netting wheel per window 2')); ?></th>
                                                <th><?php echo e(__('Silicon Per window 2')); ?></th>
                                                <th><?php echo e(__('Fixer per window 2')); ?></th>
                                                <th><?php echo e(__('Wind Break Bridge  per window 2')); ?></th>
                                                <th><?php echo e(__('Stoper per window 2')); ?></th>
                                                <th><?php echo e(__('Bumper Block 6')); ?></th>
                                                 <th><?php echo e(__('Steel Taping Screw')); ?></th>
                                            <th><?php echo e(__('Concrete Screw')); ?></th>
                                                    <th><?php echo e(__('Total Expense')); ?></th>
                                                        <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <?php 
                                         $sashrollqty = $window->pricesqty->sashrollqty *  $count;
                                        $bumperblockqty = $window->pricesqty->bumperblockqty * $count;
                                        $dummywheelqty = $window->pricesqty->dummywheelqty *  $count;
                                        $flathandleqty = $window->pricesqty->flathandleqty * $count;
                                        $netwheelqty = $window->pricesqty->netwheelqty *  $count;
                                        $stopperqty = $window->pricesqty->stopperqty *  $count;
                                        $windbreakqty = $window->pricesqty->windbreakqty *  $count;
                                        $siliconqty = $window->pricesqty->siliconqty *  $count;
                                        $fixerqty = $window->pricesqty->fixerqty * $count;
                                        $slidekeepqty = $window->pricesqty->slidekeepqty *  $count;
                                        $steeltapqty = $window->pricesqty->steeltapqty *  $count;
                                        $conscrewqty = $window->pricesqty->conscrewqty *  $count;
                                        $gearqty = $count;
                                        $latchlockqty = $count;
                                        $siliconqty = $count *2;
                                        
                                         $sashroll = $sashrollqty *  $window->pricesqty->sashrollrate;
                                        $bumperblock = $bumperblockqty *  $window->pricesqty->bumperblockrate;
                                        $dummywheel = $dummywheelqty *  $window->pricesqty->dummywheelrate;
                                        $flathandle = $flathandleqty *  $window->pricesqty->flathandlerate;
                                        $netwheel = $netwheelqty *  $window->pricesqty->netwheelrate;
                                        $stopper = $stopperqty *  $window->pricesqty->stopperrate;
                                        $windbreak = $windbreakqty *  $window->pricesqty->windbreakrate;
                                        $silicon = $siliconqty *  $window->pricesqty->siliconrate;
                                        $fixer = $fixerqty *  $window->pricesqty->fixerrate;
                                        $slidekeep = $slidekeepqty *  $window->pricesqty->slidekeeprate;
                                        $steeltap = $steeltapqty *  $window->pricesqty->steeltaprate;
                                        $conscrew = $conscrewqty *  $window->pricesqty->conscrewrate;
                                         $gearprice = $gearqty *  	$window->prices->gearprice;
                                         $latchlockprice = $latchlockqty *  	$window->prices->latchlockprice;
                                         $total =$sashroll+ $bumperblock+ $dummywheel + $flathandle + $netwheel + $stopper +  $windbreak + $silicon + $fixer + $slidekeep + $steeltap + $conscrew ;
                                        
                                        ?>
                                        
                                        <?php if(!empty( $window->projwinacces)): ?>
                                        <tr>
                                           <?php if(!empty($window->projwinacces->gearlockrate)): ?>
                                            <td><?php echo e($gearprice); ?>PKR</td>
                                            <?php
                                             $locktype = $gearprice;
                                            ?>
                                            <?php else: ?>
                                            <td><?php echo e($latchlockprice); ?>PKR</td>
                                              <?php
                                             $locktype = $latchlockprice;
                                            ?>
                                            <?php endif; ?>
                                            <?php
                                             $totalacs =$sashroll+ $bumperblock+        $dummywheel + $flathandle +             $netwheel + $stopper +  $windbreak      + $silicon + $fixer + $slidekeep +      $steeltap + $conscrew + $locktype ;
                                            ?>
                                            <td><?php echo e($slidekeep); ?>PKR</td>
                                            <td><?php echo e($flathandle); ?>PKR</td>
                                            <td><?php echo e($sashroll); ?>PKR</td>
                                            <td><?php echo e($dummywheel); ?>PKR</td> 
                                            <td><?php echo e($netwheel); ?>PKR</td> 
                                            <td><?php echo e($silicon); ?>PKR</td> 
                                            <td><?php echo e($fixer); ?>PKR</td> 
                                            <td><?php echo e($windbreak); ?>PKR</td> 
                                            <td><?php echo e($stopper); ?>PKR</td>
                                            <td><?php echo e($bumperblock); ?>PKR</td>
                                             <td><?php echo e($steeltap); ?>PKR</td>
                                            <td><?php echo e($conscrew); ?>PKR</td>
                                            <td><?php echo e($totalacs); ?>PKR</td> 
                    <td>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-size="md" data-url="<?php echo e(route('slideacess.edit',$window->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" class="btn btn-sm">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                    
                                                </div>
                                            </td>
                                                </tr>
                                        <?php else: ?>
                                        <tr><td>No data exist</td></tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
        
                    </div>
                </div>
            <?php elseif($window->designtype == "fix"): ?>
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                             <th></th>                                      <th><?php echo e(__('Wx2')); ?></th>
                                            <th><?php echo e(__('Hx2')); ?></th>
                                            <th><?php echo e(__('Total')); ?></th>
                                            <th><?php echo e(__('Prof.L=18')); ?></th>
                                            <th><?php echo e(__('Kg')); ?></th>
                                            <th><?php echo e(__('Rate')); ?></th>
                                            <th><?php echo e(__('Amount')); ?></th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                                <td>Outer frame </td>
                                                <td><?php echo e($width * 2); ?></td>
                                                <td><?php echo e($height * 2); ?></td>
                                                <td><?php echo e($outerrn); ?></td>
                                                <?php
                                               $outprf =  $outerrn / 18 ;
                                               $outerprofile = round($outprf,2);
                                              $outerprice = $window->prices->outerprice;
                                              $outeram = $outerprice * $outprf;
                                             $outeramount = round($outeram,2);
                                                ?>
                                                <td><?php echo e($outerprofile); ?></td> 
                                                <td></td>
                                                <td><?php echo e($window->prices->outerprice); ?>PKR</td> 
                                            <td><?php echo e($outeramount); ?>PKR</td> 
                                        </tr>
                                        
                                        <tr>
                                            <td>Outer steel frame </td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 2); ?></td>
                                            <td><?php echo e($outersteelrn); ?></td>
                                            <?php
                                            $outersteelprofile = $outersteelrn/8;
                                            $outersteelprice = $window->prices->outersteelprice;
                                             $outersteelamount = $outersteelprofile* $outersteelprice;
                                            ?>
                                            <td></td> 
                                            <td><?php echo e($outersteelprofile); ?></td>
                                            <td><?php echo e($window->prices->outersteelprice); ?>PKR</td> 
                                        <td><?php echo e($outersteelamount); ?>PKR</td>
                                        
                                        </tr>
                                        
                                        <tr>
                                            <td>Casement Beeding 5mm</td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 2); ?></td>
                                            <td><?php echo e($slidebeedrn); ?></td>
                                              <?Php
                                            $slidbeedprf =  $slidebeedrn / 18 ;
                                           $slidebeedprfile =round($slidbeedprf,2);
                                          $beedprice = $window->prices->slidebeedprice;
                                          $slidebeedam = $beedprice * $slidebeedprfile;
                                         $slidebeedamount = round($slidebeedam,2);
                                          
                                            ?>
                                            <td><?php echo e($slidebeedprfile); ?></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->slidebeedprice); ?>PKR</td> 
                                            <td><?php echo e($slidebeedamount); ?>PKR</td> 
                                        </tr>
                                        
                                        <tr>
                                            <td>Gaskit EPDM </td>
                                            <td><?php echo e($width * 4); ?></td>
                                            <td><?php echo e($height * 4); ?></td>
                                            <td><?php echo e($gaskitrn); ?></td>
                                            <?php
                                            $gaskitprice = $window->prices->gaskitprice;
                                            $gaskitamount = $gaskitrn * $gaskitprice;
                                               
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->gaskitprice); ?>PKR</td> 
                                            <td><?php echo e($gaskitamount); ?>PKR</td> 
                                        </tr>
                                                                                  <tr>                                      <?php                                   $siliconprice =$window->pricesqty->siliconrate ;
                                                                                  $siliconqty =$window->pricesqty->siliconqty * $count;
                                            $siliconrate = $siliconprice *
                                            $siliconqty;
                                             $totalexpense =  $outeramount+     $outersteelamount+$slidebeedamount+$gaskitamount + $siliconrate;              ?>
                                             <td></td>
                                            <td></td>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td> 
                                            <td><h6>FixFrame Profile Cost</h6></td>
                                            <td><?php echo e($totalexpense); ?>PKR</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                            <th><?php echo e(__('Steel Taping Screw')); ?></th>
                                            <th><?php echo e(__('Concrete Screw')); ?></th>
                                            <th><?php echo e(__('Silicon')); ?></th>
                                            <th><?php echo e(__('Total Expense')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <?php if(!empty( $window->projwinacces)): ?>
                                        <?php
                                         $steeltapqty = $window->pricesqty->steeltapqty *  $count;
                                        $conscrewqty = $window->pricesqty->conscrewqty *  $count;
                                        $steeltap = $steeltapqty *  $window->pricesqty->steeltaprate;
                                        $conscrew = $conscrewqty *  $window->pricesqty->conscrewrate;
                                        $total = $steeltap + $conscrew +$siliconrate;
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo e($steeltap); ?>PKR</td>
                                            <td><?php echo e($conscrew); ?>PKR</td>
                                            <td><?php echo e($siliconrate); ?>PKR</td> 
                                            <td><?php echo e($total); ?>PKR</td>
                                             <td>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-size="md" data-url="<?php echo e(route('slideacess.edit',$window->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" class="btn btn-sm">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <?php else: ?>
                                        <tr><td>No data exist</td></tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
        
                    </div>
                </div>
            <?php elseif($window->designtype == "open"): ?>
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                            <tr>
                                               <th></th>                                     <th><?php echo e(__('Wx2')); ?></th>
                                            <th><?php echo e(__('Hx2')); ?></th>
                                            <th><?php echo e(__('Total')); ?></th>
                                            <th><?php echo e(__('Prof.L=18')); ?></th>
                                            <th><?php echo e(__('Kg')); ?></th>
                                            <th><?php echo e(__('Rate')); ?></th>
                                            <th><?php echo e(__('Amount')); ?></th>
                                        </tr>
                                    
                                        
                                    
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td>OuterWard/Inward Frame</td>
                                                <td><?php echo e($width * 2); ?></td>
                                                <td><?php echo e($height * 2); ?></td>
                                                <td><?php echo e($outerrn); ?></td>
                                                <?php
                                               $outprf =  $outerrn / 18 ;
                                               $outerprofile = ceil($outprf);
                                              $outerprice = $window->prices->outerprice;
                                              $outeramount = $outerprice * $outprf;
                                                ?>
                                                <td><?php echo e($outerprofile); ?></td> 
                                                <td></td>
                                                <td><?php echo e($window->prices->outerprice); ?>PKR</td> 
                                            <td><?php echo e(round( $outeramount,2)); ?>PKR</td> 
                                            </tr>
                                            
                                        <tr>
                                                <td>Window Outward/Inward SAsh </td>
                                                <td><?php echo e($width * 4); ?></td>
                                                <td><?php echo e($height * 4); ?></td>
                                                <td><?php echo e($slidern); ?></td>
                                                <?php
                                                  $slidprf =  $slidern / 18 ;
                                               $slideprofile = round($slidprf,2);
                                              $slideprice = $window->prices->slideprice;
                                              $slideamount = $slideprice * $slidprf;
                                                ?>
                                                <td><?php echo e($slideprofile); ?></td> 
                                                <td></td>
                                                <td><?php echo e($window->prices->slideprice); ?>PKR</td> 
                                            <td><?php echo e(round($slideamount,2)); ?>PKR</td> 
                                        </tr>
                                          <tr>
                                            <td>WindowSashBeed </td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 4); ?></td>
                                            <td><?php echo e($slidebeedrn); ?></td>
                                              <?Php
                                            $slidbeedprf =  $slidebeedrn / 18 ;
                                           $slidebeedprfile = round($slidbeedprf,2);
                                          $beedprice = $window->prices->slidebeedprice;
                                          $slidebeedamount = $beedprice * $slidbeedprf;
                                            ?>
                                            <td><?php echo e($slidebeedprfile); ?></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->slidebeedprice); ?>PKR</td> 
                                            <td><?php echo e(round($slidebeedamount,2)); ?>PKR</td> 
                                        </tr>
                                         <tr>
                                            <td>Outer steel frame </td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 2); ?></td>
                                            <td><?php echo e($outersteelrn); ?></td>
                                            <?php
                                            $outersteelprofile = $outersteelrn/8;
                                            $outersteelprice = $window->prices->outersteelprice;
                                             $outersteelamount = $outersteelprofile* $outersteelprice;
                                            ?>
                                            <td></td> 
                                            <td><?php echo e($outersteelprofile); ?></td>
                                            <td><?php echo e($window->prices->outersteelprice); ?>PKR</td> 
                                        <td><?php echo e($outersteelamount); ?>PKR</td>
                                        
                                        </tr>
                                         <tr>
                                            <td>Window Sash Steel </td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 4); ?></td>
                                            <td><?php echo e($slidesteelrn); ?></td>
                                                                                        <?php
                                                                                    $slidesteelprofile = $slidesteelrn/ 8;
                                           $slidesteelprice = $window->prices->slidesteelprice;
                                             $slidesteelamount = $slidesteelprofile * $slidesteelprice;
                                            ?>
                                            <td></td> 
                                            <td><?php echo e($slidesteelprofile); ?></td>
                                            <td><?php echo e($window->prices->slidesteelprice); ?>PKR</td> 
                                        <td><?php echo e($slidesteelamount); ?>PKR</td> 
                                        </tr>
                                         <tr>
                                            <td>Gaskit EPDM </td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 4); ?></td>
                                            <td><?php echo e($gaskitrn); ?></td>
                                            <?php
                                            $gaskitprice = $window->prices->gaskitprice;
                                            $gaskitamount = $gaskitrn * $gaskitprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->gaskitprice); ?>PKR</td> 
                                            <td><?php echo e($gaskitamount); ?>PKR</td> 
                                        </tr>
                                         <tr>
                                            <td>Gaskit EPDM </td>
                                            <td><?php echo e($width * 2); ?></td>
                                            <td><?php echo e($height * 2); ?></td>
                                            <td><?php echo e($xgaskitrn); ?></td>
                                            <?php
                                            $gaskitprice = $window->prices->gaskitprice;
                                            $xgaskitamount = $xgaskitrn * $gaskitprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->gaskitprice); ?>PKR</td> 
                                            <td><?php echo e($xgaskitamount); ?>PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Gaskit EPDM Beeding</td>
                                            <td><?php echo e($height * 4); ?></td>
                                            <td></td>
                                            <td><?php echo e($gaskitbeedrn); ?></td>
                                            <?php
                                            $gaskitprice = $window->prices->gaskitbeedprice;
                                            $gaskitbeedamount = $gaskitbeedrn * $gaskitprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td><?php echo e($window->prices->gaskitbeedprice); ?>PKR</td> 
                                            <td><?php echo e($gaskitbeedamount); ?>PKR</td> 
                                        </tr>
                                         <tr>                                      <?
                                             $totalexpense =  $outeramount+  $slideamount+ $outersteelamount+$slidebeedamount+$slidesteelamount+$gaskitamount + $gaskitbeedamount + $xgaskitamount;              ?>
                                             <td></td>
                                            <td></td>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td> 
                                            <td><h6>Profile Cost</h6></td>
                                            <td><?php echo e(round($totalexpense,2)); ?>PKR</td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                            <th><?php echo e(__('Outward casement gear')); ?></th>
                                            <th><?php echo e(__('Window stay 1 in 1')); ?></th>
                                            <th><?php echo e(__('Friction stay hindge 2 in 1')); ?></th>
                                            <th><?php echo e(__('Pencil hinges')); ?></th>
                                            <th><?php echo e(__('Flat handle')); ?></th>
                                            <th><?php echo e(__('2D hinges')); ?></th>
                                            <th><?php echo e(__('3D Hindges')); ?></th>
                                            <th><?php echo e(__('Openable keep')); ?></th>
                                            <th><?php echo e(__('T-Lock')); ?></th>
                                            <th><?php echo e(__('Cockspur Handle')); ?></th>
                                            <th><?php echo e(__('Silicon ')); ?></th>
                                            <th><?php echo e(__('Total Expense')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <?php if(!empty( $window->projwinacces)): ?>
                                        <tr>
                                        <?php
                                         $siliconqty = $window->openpricesqty->siliconqty * $count;
                                        $silicon = $siliconqty *  $window->openpricesqty->siliconrate;
                                        $outwardcaseqty = $window->openpricesqty->outwardcaseqty * $count;
                                        $outwardcase = $outwardcaseqty * $window->openpricesqty->outwardcaserate;
                                        $windowstayqty =  $window->openpricesqty->windowstayqty * $count;
                                        $windowstay= $windowstayqty * $window->openpricesqty->windowstayrate;
                                        $frictionstayqty =  $window->openpricesqty->frictionstayqty * $count;
                                        $frictionstay= $frictionstayqty *  $window->openpricesqty->frictionstayrate;
                                        $pencilhindgeqty =  $window->openpricesqty->pencilhindgeqty * $count;
                                        $pencilhindge= $pencilhindgeqty * $window->openpricesqty->pencilhindgerate;
                                         $flathandleqty =$window->openpricesqty->flathandleqty * $count;
                                        $flathandle= $flathandleqty * $window->openpricesqty->flathandlerate;
                                        $twoDhindgesqty = $window->openpricesqty->twoDhindgesqty * $count;
                                        $twoDhindges= $twoDhindgesqty * $window->openpricesqty->twoDhindgesrate;
                                        $thDhindgesqty = $window->openpricesqty->thDhindgesqty * $count;
                                        $thDhindges = $thDhindgesqty * $window->openpricesqty->thDhindgesrate;
                                        $openablekeepqty =  $window->openpricesqty->openablekeepqty * $count;
                                        $openablekeep = $openablekeepqty * $window->openpricesqty->openablekeeprate	;
                                         $cockspurqty =  $window->openpricesqty->cockspurqty * $count;
                                        $cockspurrate = $cockspurqty * $window->openpricesqty->cockspurrate	;
                                        $Tlockqty = $window->openpricesqty->Tlockqty * $count;
                                        $Tlock = $Tlockqty * $window->openpricesqty->Tlockrate	;
                                        ?>
                                            <td><?php echo e($outwardcase); ?>PKR</td>
                                            <td><?php echo e($windowstay); ?>PKR</td>
                                            <td><?php echo e($frictionstay); ?>PKR</td> 
                                            <td><?php echo e($pencilhindge); ?>PKR</td> 
                                            <td><?php echo e($flathandle); ?>PKR</td> 
                                            <td><?php echo e($twoDhindges); ?>PKR</td> 
                                            <td><?php echo e($thDhindges); ?>PKR</td> 
                                            <td><?php echo e($openablekeep); ?>PKR</td> 
                                            <td><?php echo e($Tlock); ?>PKR</td> 
                                            <td><?php echo e($cockspurrate); ?>PKR</td> 
                                            <td><?php echo e($silicon); ?>PKR</td>
                                            <td><?php echo e($window->projwinacces->total); ?>PKR</td>
                                             <td>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-size="md" data-url="<?php echo e(route('slideacess.edit',$window->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" class="btn btn-sm">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <?php else: ?>
                                        <tr><td>No data exist</td></tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
        
                    </div>
                </div>
            <?php elseif($window->designtype == "door"): ?>
            
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th><?php echo e(__('Profile')); ?></th>
                                                <th><?php echo e(__('Outer Frame')); ?></th>
                                                <th><?php echo e(__('OuterSteelFrame')); ?></th>
                                                <th><?php echo e(__('Gaskit EMBD')); ?></th>
                                                <th><?php echo e(__('Door SAsh')); ?></th>
                                                <th><?php echo e(__('DoorSashSteel')); ?></th>
                                                <th><?php echo e(__('Gaskit EMBD')); ?></th>
                                                <th><?php echo e(__('WindowSashBeed')); ?></th>
                                                <th><?php echo e(__('Gaskit Beeding')); ?></th>
                                                <th><?php echo e(__('Fix Panel')); ?></th>
                                                    <th><?php echo e(__('Total Expense')); ?></th>
                                         
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td><?php echo e($window->frame); ?>PKR</td>
                                            <td><?php echo e($window->outeramount); ?>PKR</td>
                                            <td><?php echo e($window->outersteelamount); ?>PKR</td>
                                            <td><?php echo e($window->gaskitamount); ?>PKR</td>
                                            <td><?php echo e($window->slideamount); ?>PKR</td>
                                            <td><?php echo e($window->slidesteelamount); ?>PKR</td>
                                            <td><?php echo e($window->xgaskitamount); ?>PKR</td>
                                            <td><?php echo e($window->slidebeedamount); ?>PKR</td>
                                            <td><?php echo e($window->gaskitbeedamount); ?>PKR</td>
                                            <td><?php echo e($window->fixpanelamount); ?>PKR</td>
                                            <td><?php echo e($window->totalexpense); ?>PKR</td> 
                    
                                                </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                            <th><?php echo e(__('Imported handle espanglet+ cylider')); ?></th>
                                            <th><?php echo e(__('Imported handle and cylinder ')); ?></th>
                                            <th><?php echo e(__('Imported Handle ')); ?></th>
                                            <th><?php echo e(__('T-Lock ')); ?></th>
                                            <th><?php echo e(__('Cockspurhandle ')); ?></th>
                                            <th><?php echo e(__('3d hinges 6 in1 ')); ?></th>
                                            <th><?php echo e(__(' 2d hinges 6 in1 ')); ?></th>
                                             <th><?php echo e(__('Silicon ')); ?></th>
                                            <th><?php echo e(__('Total Expense')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <?php if(!empty( $window->projwinacces)): ?>
                                        <tr>
                                            <td><?php echo e($window->projwinacces->imphandlesprate); ?>PKR</td>
                                            <td><?php echo e($window->projwinacces->imphandlecylrate); ?>PKR</td>
                                            <td><?php echo e($window->projwinacces->imphandlerate); ?>PKR</td> 
                                            <td><?php echo e($window->projwinacces->Tlockrate); ?>PKR</td> 
                                            <td><?php echo e($window->projwinacces->cockspurrate); ?>PKR</td> 
                                            <td><?php echo e($window->projwinacces->twoDhindgesrate); ?>PKR</td> 
                                            <td><?php echo e($window->projwinacces->thDhindgesrate); ?>PKR</td> 
                                            <td><?php echo e($window->projwinacces->siliconrate); ?>PKR</td>
                                            <td><?php echo e($window->projwinacces->total); ?>PKR</td>
                                             <td>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-size="md" data-url="<?php echo e(route('slideacess.edit',$window->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" class="btn btn-sm">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <?php else: ?>
                                        <tr><td>No data exist</td></tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
        
                    </div>
                </div>
            <?php else: ?>
            <?php endif; ?>
        </div>

</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/projectwindows/view.blade.php ENDPATH**/ ?>