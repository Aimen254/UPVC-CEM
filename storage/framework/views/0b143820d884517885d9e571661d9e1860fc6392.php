<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Leads')); ?> <?php if($pipeline): ?> - <?php echo e($pipeline->name); ?> <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dragula.min.css')); ?>" id="main-style-link">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/plugins/dragula.min.js')); ?>"></script>

  <script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
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
     function show(){
        $("#filters").show();
    }
</script>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function myFunctiontwo() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputtwo");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[5];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Lead')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="<?php echo e(route('leads.index')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Kanban View')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-layout-grid"></i>
        </a>
                <a href="#" onclick="printme();"  title="<?php echo e(__('Print Data')); ?>" class="btn btn-sm btn-primary btnprn">
  <i class="fa fa-print"></i>
        </a>
        <a href="<?php echo e(route('lead.export')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>">
            <i class="ti ti-file-export"></i>
        </a>
        <a href="#" data-size="lg" data-url="<?php echo e(route('leads.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create New User')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($pipeline): ?>
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
                            <table class="table datatable">
                               
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Phone')); ?></th>
                                    <th><?php echo e(__('Stage')); ?></th>
                                    <th><?php echo e(__('Users')); ?></th>
                                    <th><?php echo e(__('Who is he')); ?></th>
                                     <th><?php echo e(__('Quote')); ?></th>
                                     <th><?php echo e(__('Area')); ?></th>
                                     <th><?php echo e(__('Reporter')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                                <tr>
                                    <td> 
                                        <!--<select id="select_id" name="actors">                       -->
                                        <!--    <option value=""</option>-->
                                           
                                        <!--    <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                                        <!--        <option ><?php echo $lead->created_at; ?></option>-->
                                        <!--    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                                        <!--</select>-->
                                   
                                        <div id="location"></div>
                                    </td>
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                <?php if(count($leads) > 0): ?>
                                    <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $use): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         
                                      
                                        <tr>
                                             <td><?php echo e($lead->created_at); ?></td>
                                            <td><?php echo e($lead->name); ?></td>
                                            <td><?php echo e($lead->phone); ?></td>
                                            <td><?php echo e(!empty($lead->stage)?$lead->stage->name:'-'); ?></td>
                                            <td>
                                                  <div class="user-group">
                                                <?php $__currentLoopData = $lead->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="#" class="btn btn-sm mr-1 p-0 rounded-circle">
                                                       <img src="<?php if($user->avatar): ?> <?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?> <?php else: ?> <?php echo e(asset('storage/uploads/avatar/avatar.png')); ?> <?php endif; ?>" alt="image" data-bs-toggle="tooltip" title="<?php echo e($user->name); ?>">
                                                </a>
                                                 <p class="mb-0"><?php echo e($user->name); ?></p>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </td>
                                            <td><?php echo e($lead->whoishe); ?></td>
                                              <?php if($lead->quote == 1): ?>
                                            <td><p>Sent</p></td>
                                            <?php else: ?>
                                            <td><p>Not sent</p></td>
                                            <?php endif; ?>
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
                                         <div class="action-btn bg-danger ms-2">
                                             
                                                            <a href="<?php echo e(route('proposal.create2', $lead->id)); ?>" class="mx-4 btn btn-sm  align-items-center btn" title="<?php echo e(__('Send Quote')); ?>"> <i class="fa fa-quote-left"></i></a>
                                                        </div>
                                         <div class="action-btn bg-success ms-2">
                                                            <a href="<?php echo e(route('lead.increment', $lead->id)); ?>" class="mx-4 btn btn-sm  align-items-center btn" title="<?php echo e(__('Increment')); ?>">
                                                            <i  class="fa fa-percent"></i> 
                                                            </a>
                                                        </div>
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
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/leads/list.blade.php ENDPATH**/ ?>