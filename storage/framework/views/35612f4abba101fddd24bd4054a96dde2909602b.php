
<?php
    $profile=asset(Storage::url('uploads/avatar/'));
?>
<?php $__env->startSection('page-title'); ?>
<?php echo e($user->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        $(".list-group-item").click(function(){
            $('.list-group-item').filter(function(){
                return this.href == id;
            }).parent().removeClass('text-primary');
        });
    </script>
    <script>
         function search(){
    
  var  filter, filtertwo,filterthree, table, tr, td, tdtwo, i;
  var name = document.getElementById("name");
  var who = document.getElementById("who");
  var quote = document.getElementById("quote");
  filter = name.value.toUpperCase();
  filtertwo = who.value.toUpperCase();
   filterthree = quote.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    tdtwo = tr[i].getElementsByTagName("td")[5];
       tdthree = tr[i].getElementsByTagName("td")[6];
    if (td) {
      if ((td.innerHTML.toUpperCase().indexOf(filter) > -1) && (tdtwo.innerHTML.toUpperCase().indexOf(filtertwo) > -1)  && (tdthree.innerHTML.toUpperCase().indexOf(filterthree) > -1) ) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  } 

}
    </script>
    <script>
    function printme(){
        window.print();
    }
        function show(){
        $("#filters").show();
    }
</script>
    <script>
 $(document).ready(function(){
    $('#select_id').on('change', function() {
        var val = $(this).val();
    $("#usercard").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1)
    });
  });
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
<!--<?php if(session()->has('data')): ?>-->
<!--    <script type="text/javascript">-->
<!--    $("#moncount").show();-->
<!--    $("#count").hide();-->
<!--    </script>-->
<!--<?php else: ?>-->
<!-- <script type="text/javascript">-->

<!--    $("#count").show();-->
<!--    </script>-->
<!--<?php endif; ?>-->
// <script>
//     $('input[type=month]').change(function () {
//          $("#moncount").show();
//           $("#count").hide();
//     this.form.submit();
// });
// </script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('users.index')); ?>"><?php echo e(__('User')); ?></a></li>
    <li class="breadcrumb-item"> <?php echo e($user->name); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
      
                <a href="#" onclick="printme();"  title="<?php echo e(__('Print Data')); ?>" class="btn btn-sm btn-primary btnprn">
  <i class="fa fa-print"></i>
        </a>
       
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
          <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-12">
                  <div class="card">
                       <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-success">
                                            <i class="ti ti-test-pipe"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Pipeline')); ?></p>
                                            <h5 class="mb-0 text-success"><?php echo e($user->default_pipeline); ?></h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-warning">
                                            <i class="ti ti-test-pipe"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Total Leads')); ?></p>
                                            <h5 class="mb-0 text-success"><?php echo e($leadCount); ?></h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-info">
                                            <i class="fa fa-quote-left"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Quoations')); ?></p>
                                            <h5 class="mb-0 text-info"><?php echo e(($quote)); ?></h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-login"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Last Login')); ?></p>
                                            <h5 class="mb-0 text-info"><?php echo e(($user->last_login_at)); ?></h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-user"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Type')); ?></p>
                                            <h5 class="mb-0 text-primary"><?php echo e(($user->type)); ?></h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
                </div>
            </div>
            <div id="users_products">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-end">
                                            <a href="#" data-size="md" data-url="<?php echo e(route('users.edit',$user->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Add User')); ?>" class="btn btn-sm btn-primary">
                                                <i class="ti ti-plus"></i>
                                            </a>
                                        </div>
                                        <h5><?php echo e(__('User')); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                <tr>
                                                    <th><?php echo e(__('Name')); ?></th>
                                                    <th><?php echo e(__('Email')); ?></th>
                                                    <th><?php echo e(__('Image')); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                              
                                                                <p class="mb-0"><?php echo e($user->name); ?></p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="d-flex align-items-center">
                                                              
                                                              <p class="mb-0"><?php echo e($user->email); ?></p>
                                                          </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?> class="wid-30 rounded-circle me-3" alt="avatar image">
                                                            </div>
                                                        </td>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit user')): ?>
                                                            <td>
                                                                <div class="action-btn bg-danger ms-2">
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id],'id'=>'delete-form-'.$user->id]); ?>

                                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>

                                                                    <?php echo Form::close(); ?>

                                                                </div>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                              
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-end">
                                            <a href="#" data-size="md" data-url="<?php echo e(route('users.edit',$user->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Upgrade Plan')); ?>" class="btn btn-sm btn-primary">
                                                <i class="ti ti-plus"></i>
                                            </a>
                                        </div>
                                        <h5><?php echo e(__('Plans')); ?></h5>

                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                <tr>
                                                    <th><?php echo e(__('Plan')); ?></th>
                                                    <th><?php echo e(__('Plan Expire date')); ?></th>
                                                    <th><?php echo e(__('Requested Plan')); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
        
                                                    <tr>
                                                        <td>
                                                            <?php echo e($user->plan); ?>

                                                        </td>
                                                        <td>
                                                           <?php echo e($user->plan_expirey_date); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($user->requested_plan); ?>

                                                        </td>
                                                    
                                                    </tr>
                                            
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <!--       <div class="row">-->
            <!--            <div class="col-sm-12">-->
            <!--                  <h5><?php echo e(__('Leads')); ?></h5>-->
            <!--                <div class="card-body row kanban-wrapper horizontal-scroll-cards" >-->
            <!--                    <?php $__currentLoopData = $user->leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
            <!--                    <div class="col">-->
            <!--                        <div class="card" data-id="<?php echo e($lead->id); ?>">-->
            <!--                            <div class="pt-3 ps-3">-->
            <!--                                <?php ($labels = $lead->labels()); ?>-->
            <!--                                <?php if($labels): ?>-->
            <!--                                    <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
            <!--                                        <div class="badge-xs badge bg-<?php echo e($label->color); ?> p-2 px-3 rounded"><?php echo e($label->name); ?></div>-->
            <!--                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
            <!--                                <?php endif; ?>-->
            <!--                            </div>-->
            <!--                            <div class="card-header border-0 pb-0 position-relative">-->
            <!--                                <h5><a href="<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view lead')): ?><?php if($lead->is_active): ?><?php echo e(route('leads.show',$lead->id)); ?><?php else: ?>#<?php endif; ?> <?php else: ?>#<?php endif; ?>"><?php echo e($lead->name); ?></a></h5>-->
            <!--                                <div class="card-header-right">-->
            <!--                                <p><?php echo e(!empty($lead->stage)?$lead->stage->name:'-'); ?></p>-->
            <!--                                </div>-->
            <!--                            </div>-->
                                      
            <!--                            <div class="card-body">-->
            <!--                                <div class="d-flex align-items-center justify-content-between">-->
                                              
            <!--                                    <div class="user-group">-->
            <!--                                        <?php $__currentLoopData = $lead->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
            <!--                                            <img src="<?php if($user->avatar): ?> <?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?> <?php else: ?> <?php echo e(asset('storage/uploads/avatar/avatar.png')); ?> <?php endif; ?>" alt="image" data-bs-toggle="tooltip" title="<?php echo e($user->name); ?>">-->
            <!--                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
            <!--                                    </div>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
            <!--                </div>-->
                        

            <!--        </div>-->
            
            <!--</div>-->
        </div>
</div

  <div class="row">
            <div class="d-flex align-items-center justify-content-end">
                <div class="class="col-auto float-end ms-2 mt-4">
                    <a href="#"  title="<?php echo e(__('filters')); ?>" onclick="show()" class="btn btn-sm btn-primary">
                        Advance Filters
                    </a>
                </div>
            </div>
            <br>
            <div class="col-xl-12">
            <?php
                    $leas = $user->leads();
            ?>
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <div class="row" id="filters" style="display:none;">
                                    <div class="col-md-2">
                                        <select name="" id="name" class="form-control">
                                        <option value="name">name</option> 
                                            <?php $__currentLoopData = $name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option ><?php echo e($nam); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="who" name="who" onchange="myFunctionwho()" class="form-control filter-select" placeholder="who is he">                       
                                             <option value="whoishe">whoishe</option> 
                                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option ><?php echo e($result); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="quote" name="quote" class="form-control">                       
                                            <option value="Quotation">Quotation</option>
                                            <!-- <option selected="selected">Java</option>  -->
                                                <option value="sent"> Sent</option>
                                                <option value="sent">Not sent</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                       <button class="btn btn-primary" id="search" onclick="search()" >search</button>
                                    </div>
                            </div>
                            <table class="table datatable" >
                                <thead>
                                <tr>
                                   
                                    <th>  <?php echo e(__('Date')); ?>

                                    </th>
                                   
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Subject')); ?></th>
                                    <th><?php echo e(__('Stage')); ?></th>
                                    <th><?php echo e(__('Users')); ?></th>
                                    <th><?php echo e(__('Address')); ?></th>
                                    <th><?php echo e(__('Reporter')); ?></th>
                                  
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                                <tr>
                                    <td> 
                                           <label for="">Date</label>
                                            <select id="select_id" name="actors">                       
                                                <option value=""</option>
                                                <!-- <option selected="selected">Java</option>  -->
                                                <?php $__currentLoopData = $user->leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option ><?php echo $lead->created_at; ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                    </td>
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                 
                                <?php if(count($user->leads) > 0): ?>
                            
                                    <?php $__currentLoopData = $user->leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  
                                       <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $use): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($lead->created_at); ?></td>
                                            <td><?php echo e($lead->name); ?></td>
                                            <td><?php echo e($lead->subject); ?></td>
                                            <td><?php echo e(!empty($lead->stage)?$lead->stage->name:'-'); ?></td>
                                            <td>
                                                <?php $__currentLoopData = $lead->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="#" class="btn btn-sm mr-1 p-0 rounded-circle">
                                                        <img alt="image" data-toggle="tooltip" data-original-title="<?php echo e($user->name); ?>" <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?> class="rounded-circle " width="25" height="25">
                                                    </a>
                                                    <p class="mb-0"><?php echo e($user->name); ?></p>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td><?php echo e($lead->area); ?></td>
                                            <td>
                                             <?php echo e($use->name); ?>

                                            </td>
                                          
                                          
                                            <?php if(Auth::user()->type != 'Client'): ?>
                                                <td class="Action">
                                                    <span>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view lead')): ?>
                                                            <?php if($lead->is_active): ?>
                                                                <div class="action-btn bg-warning ms-2">
                                                                <a href="<?php echo e(route('leads.show',$lead->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-title="<?php echo e(__('Lead Detail')); ?>">
                                                                    <i class="ti ti-eye text-white"></i>
                                                                </a>
                                                            </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit lead')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(route('leads.edit',$lead->id)); ?>" data-ajax-popup="true" data-size="xl" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Lead Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete lead')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['leads.destroy', $lead->id],'id'=>'delete-form-'.$lead->id]); ?>

                                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" ><i class="ti ti-trash text-white"></i></a>

                                                                <?php echo Form::close(); ?>

                                                             </div>

                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
   
        
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/user/show.blade.php ENDPATH**/ ?>