<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Proposal Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('change', '.status_change', function () {
            var status = this.value;
            var url = $(this).data('url');
            $.ajax({
                url: url + '?status=' + status,
                type: 'GET',
                cache: false,
                success: function (data) {
                },
            });
        });

        $('.cp_link').on('click', function () {
            var value = $(this).attr('data-link');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(value).select();
            document.execCommand("copy");
            $temp.remove();
            show_toastr('success', '<?php echo e(__('Link Copy on Clipboard')); ?>')
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
    <li class="breadcrumb-item"><a href="<?php echo e(route('proposal.index')); ?>"><?php echo e(__('Proposal')); ?></a></li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('send proposal')): ?>
        <?php if($proposal->status!=4): ?>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row timeline-wrapper">
                                <div class="col-md-6 col-lg-4 col-xl-4">
                                    <div class="timeline-icons"><span class="timeline-dots"></span>
                                        <i class="ti ti-plus text-primary"></i>
                                    </div>
                                    <h6 class="text-primary my-3"><?php echo e(__('Create Proposal')); ?></h6>
                                    <p class="text-muted text-sm mb-3"><i class="ti ti-clock mr-2"></i><?php echo e(__('Created on ')); ?><?php echo e(\Auth::user()->dateFormat($proposal->issue_date)); ?></p>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit proposal')): ?>
                                        <a href="<?php echo e(route('proposal.edit',\Crypt::encrypt($proposal->id))); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i class="ti ti-pencil mr-2"></i><?php echo e(__('Edit')); ?></a>

                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-4">
                                    <div class="timeline-icons"><span class="timeline-dots"></span>
                                        <i class="ti ti-mail text-warning"></i>
                                    </div>
                                    <h6 class="text-warning my-3"><?php echo e(__('Send Proposal')); ?></h6>
                                    <p class="text-muted text-sm mb-3">
                                        <?php if($proposal->status!=0): ?>
                                            <i class="ti ti-clock mr-2"></i><?php echo e(__('Sent on')); ?> <?php echo e(\Auth::user()->dateFormat($proposal->send_date)); ?>

                                        <?php else: ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('send proposal')): ?>
                                                <small><?php echo e(__('Status')); ?> : <?php echo e(__('Not Sent')); ?></small>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </p>

                                    <?php if($proposal->status==0): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('send proposal')): ?>
                                            <a href="<?php echo e(route('proposal.sent',$proposal->id)); ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('Mark Sent')); ?>"><i class="ti ti-send mr-2"></i><?php echo e(__('Send')); ?></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-4">
                                    <div class="timeline-icons"><span class="timeline-dots"></span>
                                        <i class="ti ti-report-money text-info"></i>
                                    </div>
                                    <h6 class="text-info my-3"><?php echo e(__('Proposal Status')); ?></h6>
                                    <small>
                                        <?php if($proposal->status == 0): ?>
                                            <span class="badge bg-primary p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 1): ?>
                                            <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 2): ?>
                                            <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 3): ?>
                                            <span class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 4): ?>
                                            <span class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php endif; ?>
                                    </small>
                                    <br>
                                    <div class="float-right mt-2 col-md-3 float-end ml-5" data-toggle="tooltip" data-original-title="<?php echo e(__('Click to change status')); ?>">
                                        <select class="form-control status_change select2" name="status" data-url="<?php echo e(route('proposal.status.change',$proposal->id)); ?>">
                                            <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>" <?php echo e(($proposal->status==$k)?'selected':''); ?>><?php echo e($val); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(\Auth::user()->type=='company'): ?>
        <?php if($proposal->status!=0): ?>
            <div class="row justify-content-between align-items-center mb-3">
                <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                    <div class="all-button-box mx-2">
                        <a href="<?php echo e(route('proposal.resent',$proposal->id)); ?>" class="btn btn-primary"><?php echo e(__('Resend Proposal')); ?></a>
                    </div>
                    <div class="all-button-box">
                        <a href="<?php echo e(route('proposal.pdf', Crypt::encrypt($proposal->id))); ?>" class="btn btn-primary" target="_blank"><?php echo e(__('Download')); ?></a>
                         <a href="#" onclick="printme();" data-size="lg" data-url="" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Print Data')); ?>" class="btn btn-sm btn-primary btnprn">
                            <i class="fa fa-print"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                <div class="all-button-box">
                    <a href="<?php echo e(route('proposal.pdf', Crypt::encrypt($proposal->id))); ?>" class="btn btn-xs btn-white btn-icon-only width-auto" target="_blank"><?php echo e(__('Download')); ?></a>
                       <a href="#" onclick="printme();" data-size="lg" data-url="" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Print Data')); ?>" class="btn btn-sm btn-primary btnprn">
                            <i class="fa fa-print"></i>
                        </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice">
                        <div class="invoice-print">
                            <div class="row invoice-title mt-2">
                                <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                                    <h2><?php echo e(__('Proposal')); ?></h2>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                                    <h3 class="invoice-number"><?php echo e(Auth::user()->proposalNumberFormat($proposal->proposal_id)); ?></h3>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 ">
                                    <div class="card text-center">
                                       <div class="card-header border-0 pb-0">
                                        </div>
                                        <div class="card-body full-card">
                                            <div class="img-fluid rounded-circle card-avatar">
                                                <img src="<?php echo e(asset('assets/images/upvc.png')); ?>" alt="kal" class="img-user wid-200 ">
                                                <h3 class="invoice-number">We are an offer based Company. We 
                                                 promise to beat a
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                            <div class="row">
                                <div class="col text-end">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="me-4">
                                            <small>
                                                <strong><?php echo e(__('Issue Date')); ?> :</strong><br>
                                                <?php echo e(\Auth::user()->dateFormat($proposal->issue_date)); ?><br><br>
                                            </small>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php if(!empty($customer->billing_name)): ?>
                                    <div class="col">
                                        <small class="font-style">
                                            <strong><?php echo e(__('Billed To')); ?> :</strong><br>
                                            <?php echo e(!empty($customer->billing_name)?$customer->billing_name:''); ?><br>
                                            <?php echo e(!empty($customer->billing_phone)?$customer->billing_phone:''); ?><br>
                                            <?php echo e(!empty($customer->billing_address)?$customer->billing_address:''); ?><br>
                                            <?php echo e(!empty($customer->billing_zip)?$customer->billing_zip:''); ?><br>
                                            <?php echo e(!empty($customer->billing_city)?$customer->billing_city:'' .', '); ?> <?php echo e(!empty($customer->billing_state)?$customer->billing_state:'',', '); ?> <?php echo e(!empty($customer->billing_country)?$customer->billing_country:''); ?><br>
                                            <strong><?php echo e(__('Tax Number ')); ?> : </strong><?php echo e(!empty($customer->tax_number)?$customer->tax_number:''); ?>


                                        </small>
                                    </div>
                                <?php endif; ?>


                                <?php if(App\Models\Utility::getValByName('shipping_display')=='on'): ?>
                                    <div class="col">
                                        <small>
                                            <strong><?php echo e(__('Shipped To')); ?> :</strong><br>
                                            <?php echo e(!empty($customer->shipping_name)?$customer->shipping_name:''); ?><br>
                                            <?php echo e(!empty($customer->shipping_phone)?$customer->shipping_phone:''); ?><br>
                                            <?php echo e(!empty($customer->shipping_address)?$customer->shipping_address:''); ?><br>
                                            <?php echo e(!empty($customer->shipping_zip)?$customer->shipping_zip:''); ?><br>
                                            <?php echo e(!empty($customer->shipping_city)?$customer->shipping_city:'' . ', '); ?> <?php echo e(!empty($customer->shipping_state)?$customer->shipping_state:'' .', '); ?>,<?php echo e(!empty($customer->shipping_country)?$customer->shipping_country:''); ?><br>
                                            <strong><?php echo e(__('Tax Number ')); ?> : </strong><?php echo e(!empty($customer->tax_number)?$customer->tax_number:''); ?>


                                        </small>
                                    </div>
                                <?php endif; ?>
                                    <div class="col">
                                        <div class="float-end mt-3">
                                        <?php echo DNS2D::getBarcodeHTML( route('proposal.link.copy',\Illuminate\Support\Facades\Crypt::encrypt($proposal->id)), "QRCODE",2,2); ?>

                                        </div>
                                    </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <small>
                                        <strong><?php echo e(__('Status')); ?> :</strong><br>
                                        <?php if($proposal->status == 0): ?>
                                            <span class="badge bg-primary p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 1): ?>
                                            <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 2): ?>
                                            <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 3): ?>
                                            <span class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 4): ?>
                                            <span class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php endif; ?>
                                    </small>
                                </div>


                            </div>

                            <?php if(!empty($customFields) && count($proposal->customField)>0): ?>
                                <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col text-end">
                                        <small>
                                            <strong><?php echo e($field->name); ?> :</strong><br>
                                            <?php echo e(!empty($proposal->customField)?$proposal->customField[$field->id]:'-'); ?>

                                            <br><br>
                                        </small>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="font-weight-bold"><?php echo e(__('Product Summary')); ?></div>
                                    <small><?php echo e(__('All items here cannot be deleted.')); ?></small>
                                    <div class="table-responsive mt-2">
                                        <table class="table mb-0 ">
                                            <tr>
                                                <th class="text-dark" data-width="40">#</th>
                                                <th class="text-dark"><?php echo e(__('Product')); ?></th>
                                                <th class="text-dark"><?php echo e(__('Quantity')); ?></th>
                                                <th class="text-dark"><?php echo e(__('Rate')); ?></th>
                                                <th class="text-dark"><?php echo e(__('Tax')); ?></th>
                                                <th class="text-dark"> <?php if($proposal->discount_apply==1): ?><?php echo e(__('Discount')); ?><?php endif; ?></th>
                                                <th class="text-dark"><?php echo e(__('Description')); ?></th>
                                                <th class="text-end text-dark" width="12%"><?php echo e(__('Price')); ?><br>
                                                    <small class="text-danger font-weight-bold"><?php echo e(__('before tax & discount')); ?></small>
                                                </th>
                                            </tr>
                                            <?php
                                                $totalQuantity=0;
                                                $totalRate=0;
                                                $totalTaxPrice=0;
                                                $totalDiscount=0;
                                                $taxesData=[];
                                            ?>

                                            <?php $__currentLoopData = $iteams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$iteam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!empty($iteam->tax)): ?>
                                                    <?php
                                                        $taxes=App\Models\Utility::tax($iteam->tax);
                                                        $totalQuantity+=$iteam->quantity;
                                                        $totalRate+=$iteam->price;
                                                        $totalDiscount+=$iteam->discount;
                                                        foreach($taxes as $taxe){
                                                            $taxDataPrice=App\Models\Utility::taxRate($taxe->rate,$iteam->price,$iteam->quantity);
                                                            if (array_key_exists($taxe->name,$taxesData))
                                                            {
                                                                $taxesData[$taxe->name] = $taxesData[$taxe->name]+$taxDataPrice;
                                                            }
                                                            else
                                                            {
                                                                $taxesData[$taxe->name] = $taxDataPrice;
                                                            }
                                                        }
                                                    ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <td><?php echo e($key+1); ?></td>
                                                    <td><?php echo e(!empty($iteam->product)?$iteam->product->name:''); ?></td>
                                                    <td><?php echo e($iteam->quantity); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($iteam->price)); ?></td>
                                                    <td>
                                                        <?php if(!empty($iteam->tax)): ?>
                                                            <table>
                                                                <?php $totalTaxRate = 0;?>
                                                                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $taxPrice=App\Models\Utility::taxRate($tax->rate,$iteam->price,$iteam->quantity);
                                                                        $totalTaxPrice+=$taxPrice;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo e($tax->name .' ('.$tax->rate .'%)'); ?></td>
                                                                        <td><?php echo e(\Auth::user()->priceFormat($taxPrice)); ?></td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </table>
                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($proposal->discount_apply==1): ?>
                                                            <?php echo e(\Auth::user()->priceFormat($iteam->discount)); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e(!empty($iteam->description)?$iteam->description:'-'); ?></td>
                                                    <td class="text-end"><?php echo e(\Auth::user()->priceFormat(($iteam->price*$iteam->quantity))); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <tfoot>
                                            <tr>
                                                <td></td>
                                                <td><b><?php echo e(__('Total')); ?></b></td>
                                                <td><b><?php echo e($totalQuantity); ?></b></td>
                                                <td><b><?php echo e(\Auth::user()->priceFormat($totalRate)); ?></b></td>
                                                <td><b><?php echo e(\Auth::user()->priceFormat($totalTaxPrice)); ?></b></td>
                                                <td>
                                                    <?php if($proposal->discount_apply==1): ?>
                                                        <b><?php echo e(\Auth::user()->priceFormat($totalDiscount)); ?></b>
                                                    <?php endif; ?>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td class="text-end"><b><?php echo e(__('Sub Total')); ?></b></td>
                                                <td class="text-end"><?php echo e(\Auth::user()->priceFormat($proposal->getSubTotal())); ?></td>
                                            </tr>
                                            <?php if($proposal->discount_apply==1): ?>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="text-end"><b><?php echo e(__('Discount')); ?></b></td>
                                                    <td class="text-end"><?php echo e(\Auth::user()->priceFormat($proposal->getTotalDiscount())); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if(!empty($taxesData)): ?>
                                                <?php $__currentLoopData = $taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-end"><b><?php echo e($taxName); ?></b></td>
                                                        <td class="text-end"><?php echo e(\Auth::user()->priceFormat($taxPrice)); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td class="blue-text text-end"><b><?php echo e(__('Total')); ?></b></td>
                                                <td class="blue-text text-end"><?php echo e(\Auth::user()->priceFormat($proposal->getTotal())); ?></td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <br>
                                <br>
                                <div>
                                    
                                </div>
                                <h3 >Terms and Conditions</h3>
                                <h5>1. Mode of Payment:</h5>
                                <p> a. 70% advance payment. <br>
                                    b. 30% before delivery of windows and doors from factory (Ex Work). Installation charges to be paid after installation on site. <br>
                                    c. Prices are exclusive of all applicable TAXES and validity of this offer is 15 days from the date of its issuance. <br>
                                    d: Price of clear, coloured and reflective glass may vary at the time of placement of final order of glass (Based on prevailing market rate.) <br>
                                    e. With every change in quotation layout/drawing, previous quotation will be considered as VOID <br>
                                    f. Any error in calculation is liable for correction. <br>
                                    g. Any M.O.U signed via mutual consent between customer and Safe Style will supersedes on any terms and conditions mentioned in this quotation.
                                </p>
                                <h5>2. Warranty:</h5>
                                <p>a. 10 years for profile against all kind of defects. b. 01 year for hardware and fly-net. <br>
                                b. Warranty becomes invalid if the payments are not made as per above mentioned terms.

                                </p>
                                <h5>3. Delivery Period:</h5>
                                <p> a. 35-40 working days after on site final sizes or 70% payment which ever is later. Installation time for frames will be 5-6 days. <br>
                                    b. Glass processing will take 15-25 working days after installation of frames. <br>
                                    c. Company shall not be responsible for any delay due to force majeure such as fire, flood, earthquake, strike, lockout etc. beyond its control. <br>
                                    d. Due to prevailing situation of Electricity/Power Cutoff, Safe Style will only deliver the job on time if customer pays separate charges for usage of
                                </p>
                                <h5>4. Client's Responsibilities:</h5>
                                <p> a. Supply of scaffolding if required for installation. <br>
                                    b. All corners of aperture should be at 90 degree for better finishing purpose otherwise company will not be held liable for shabby fitting. <br>
                                    c. Supply templates for Arch/Curve shape windows. <br>
                                    d. Customer is required to thoroughly check sizes and shapes of all windows in estimate and sign each page/measurement otherwise it will be considered final. <br>
                                    e. Windows will be fabricated according to the minimum size of openings with 3-8 mm tolerance margin for expansion and contraction. <br>
                                    f. Company shall not be responsible for any damage to UPVC frames if the glass is fitted by client's own arrangements or due to other vendors on site. <br>
                                </p>
                                <h5>5. Important:</h5>
                                <p>  Installation of Windows is recommended as per following construction stage <br>
                                    a. Installation of Frames: After 1st coat of paint. <br>
                                    b. Installation of Sash/Glass/ Hardware: After complete flooring and cleaning of building. <br>
                                    c. Window installation should be the last and final project of construction to avail perfect functionality of hardware and neat and clean windows. <br>
                                    d. Early installation will be done at Owner’s risk. <br>
                                    e. Profile's protective sheet must be removed within 10 days after installation to avoid permanent printing marks on profile. <br>
                                    f. With every change in quotation layout/drawing, previous quotation will be considered as VOID. <br>
                                </p>
                                <h6 class="text-center">Client Acceptance</h6>
                                <h6 >For Safe Style </h6>
                            </div
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/proposal/view.blade.php ENDPATH**/ ?>