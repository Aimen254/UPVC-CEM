

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
    function printme(){
        window.print();
    }
</script>
<script>
var fb=  $('.fbam').html();
    $(document).on('keyup', '.rate', function () {
        var rate = $('.rate').val();
      var sqf =  $('.sqf').html();
      var am = sqf * rate;
      $('.amount').html(am);
        })
    
    $(document).on('keyup', '.nontempsqf', function () {
    var sqf = $('.nontempsqf').val();
    var rate =  $('.nontemprate').html();
    var am = sqf * rate;
    $('.nontempam').html(am);
    var refam=  $('.refam').html();
    var addref = parseFloat(refam) + parseFloat(am);
    $('.refam').html(addref);
 
        })
         
    $(document).on('keyup', '.dgsqf', function () {
    var sqf = $('.dgsqf').val();
    var rate =  $('.dgrate').html();
    var am = sqf * rate;
    $('.dgam').html(am);
    var refam=  $('.refam').html();
    var addref = parseFloat(refam) + parseFloat(am);
    $('.refam').html(addref);
  
        })
               
    $(document).on('keyup', '.dggbsqf', function () {
    var sqf = $('.dggbsqf').val();
    var rate =  $('.dggbrate').html();
    var am = sqf * rate;
    $('.dggbam').html(am);
    var refam=  $('.refam').html();
    var addref = parseFloat(refam) + parseFloat(am);
    $('.refam').html(addref);

        })

    $(document).on('keyup', '.archsqf', function () {
    var sqf = $('.archsqf').val();
    var rate =  $('.archrate').html();
    var am = sqf * rate;
    $('.archam').html(am);
    var refam=  $('.refam').html();
    var addref = parseFloat(refam) + parseFloat(am);
    $('.refam').html(addref);

        })

    $(document).on('keyup', '.fitsqf', function () {
    var sqf = $('.fitsqf').val();
    var rate =  $('.fitrate').html();
    var am = sqf * rate;
    $('.fitam').html(am);
    var refam=  $('.refam').html();
    var addref = parseFloat(refam) + parseFloat(am);
    $('.refam').html(addref);

        })
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
            <div class="col-md-3 col-md-offset-5">
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
                                <img id="myFrame" src="<?php echo e(url('/assets/images/upvc.png')); ?>" alt="kal" class="img-user width="300" height="100" ">
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body ">
                        <h2>We are an offer based Company. We promise to beat any like to like quote.</h2>
                           <h6 class="inline-block">Ref:Rav/00ZaQuote <h6>
                           <h6 class="inline-block">Contact #:0347-9298691 <h6>
                           <h6 class="inline-block">Office #:0347-9298691 <h6>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                            TENTATIVE  QUOTE BASED ON APPROXIMATE SIZE  
                            </h6>
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>       
                            </tr>
                            </thead>
                            <tbody >
                                <tr>
                                <td>customer</td>
                                <td></td>
                                </tr>
                                <tr>
                                <td>address</td>
                                <td></td>
                                </tr>
                                <tr>
                                <td>contact</td>
                                <td></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table ">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th ></th>
                                <th>No</th>  
                                <th>SFT</th> 
                                <th>Rate</th>
                                <th>Amount</th>    
                            </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td></td>
                                    <td width="25%">Windows (Sliding  ) </td>
                                    <td><?php echo e($slidecount); ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td >Windows (Fix) </td>
                                    <td><?php echo e($fixcount); ?></td>
                                    <td class="sqf"><?php echo e($sqfall); ?></td>
                                    <td>
                                    <input type="number" value="<?php echo e($rateper); ?>" class="form-control w-50 rate" name="rate">
                                    </td>
                                    <td class="amount"><?php echo e($amountall); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td >Windows (open) </td>
                                    <td><?php echo e($opencount); ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td ><h6>Product Description:</h6>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td ><h6>GLASS : 6 MM Clear Glass Non-Tempered</h6></td>
                                    <td></td>
                                    <td>
                                    <input type="number" value="" class="form-control w-50 nontempsqf" name="nontempsqf">
                                    </td>
                                    <td class="nontemprate">250</td>
                                    <td class="nontempam"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td ><h6>GLASS : 6 MM Clear Glass DG </h6></td>
                                    <td></td>
                                    <td>
                                      <input type="number" value="" class="form-control w-50 dgsqf" name="dgsqf">
                                    </td>
                                    <td class="dgrate">500</td>
                                    <td class="dgam"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td ><h6>GLASS : 6 MM Clear Glass DG+GB Both Sides Tempered</h6></td>
                                    <td></td>
                                    <td>
                                      <input type="number" value="" class="form-control w-50 dggbsqf" name="dggbsqf">
                                    </td>
                                    <td class="dggbrate">650</td>
                                    <td class="dggbam"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td ><h6>Arch making and bending with Glass </h6></td>
                                    <td></td>
                                    <td>
                                      <input type="number" value="" class="form-control w-50 archsqf" name="archsqf">
                                    </td>
                                    <td  class="archrate">3500</td>
                                    <td class="archam"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td ><h6>Net Total</h6></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="amount refam"><?php echo e($amountall); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td ><h6>Fitting Charges </h6></td>
                                    <td></td>
                                    <td>
                                      <input type="number" value="" class="form-control w-50 fitsqf" name="fitsqf">
                                    </td>
                                    <td class="fitrate">60</td>
                                    <td class="fitam"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td ><h6>Carriage UPVC & Glass- @ Actual (Payable by Customer)</h6></td>
                                    <td></td>
                                    <td></td>
                                    <td>0</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td ><h6>GRAND TOTAL</h6></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="amount refam"><?php echo e($amountall); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                            Terms and Conditions
                            </h6>
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                     <ul>
                        <li> Mode of Payment:</li>
                        <li>70% advance payment.</li>
                        <li>30% before delivery of windows and doors from factory (Ex Work). Installation charges to be paid after installation on site.</li>
                        <li>Prices are exclusive of all applicable TAXES and validity of this offer is 15 days from the date of its issuance. </li>
                        <li> Price of clear, coloured and reflective glass may vary at the time of placement of final order of glass (Based on prevailing market rate.)</li>
                        <li> With every change in quotation layout/drawing, previous quotation will be considered as VOID</li>
                        <li>Any error in calculation is liable for correction.</li>
                     </ul>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/projectwindows/clientquote.blade.php ENDPATH**/ ?>