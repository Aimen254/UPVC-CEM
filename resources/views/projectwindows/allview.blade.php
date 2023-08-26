
@extends('layouts.admin')
@section('page-title')
    {{__('Manage Windows')}} 
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
@endpush
@push('script-page')
    <script src="{{asset('css/summernote/summernote-bs4.js')}}"></script>
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

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Windows')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
       
    </div>
@endsection

@section('content')
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
                                 <img id="myFrame" src="@if(!empty($window->image)) {{asset('/formulaimages/'.$window->image)}} @endif" alt="kal" class="img-user wid-30 width="500" height="200" ">
                           </div>
                          
                        </div>
                      
                    </div>

                </div>
            </div>
            @if($window->designtype == "sliding Total cost")
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th>{{__('Profile')}}</th>
                                                <th>{{__('Quantity')}}</th>
                                                <th>{{__('OuterFrameAmount')}}</th>
                                                <th>{{__('SlideSashAmount')}}</th>
                                                <th>{{__('NetSAshAmount')}}</th>
                                                <th>{{__('SlidingBeedAmount')}}</th>
                                                <th>{{__('OuterFrameSteel')}}</th>
                                                <th>{{__('SlideSteel')}}</th>
                                                <th>{{__('NetSteel')}}</th>
                                                <th>{{__('InterlockAmount')}}</th>
                                                    <th>{{__('Total Expense')}}</th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td>{{ $window->frame }}PKR</td>
                                            <td>{{ $window->quantity }}PKR</td>
                                            <td>{{ $window->outeramount }}PKR</td>
                                            <td>{{  $window->slideamount }}PKR</td>
                                            <td>{{ $window->netamount}}PKR</td> 
                                            <td>{{ $window->slidebeedamount }}PKR</td> 
                                            <td>{{ $window->outersteelamount}}PKR</td> 
                                            <td>{{ $window->slidesteelamount }}PKR</td> 
                                            <td>{{ $window->netsteelamount }}PKR</td> 
                                            <td>{{ $window->typeamount }}PKR</td> 
                                            <td>{{ $window->totalexpense }}PKR</td> 
                    
                                                </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
            @elseif($window->designtype == "fix total cost")
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th>{{__('Profile')}}</th>
                                                <th>{{__('OuterFrame')}}</th>
                                                <th>{{__('OuterFrameSteel')}}</th>
                                                <th>{{__('CasementBeed')}}</th>
                                                <th>{{__('Gaskit EMBD')}}</th>
                                                    <th>{{__('Total Expense')}}</th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td>{{ $window->frame }}PKR</td>
                                            <td>{{ $window->outeramount }}PKR</td>
                                            <td>{{ $window->outersteelamount}}PKR</td> 
                                            <td>{{ $window->slidebeedamount }}PKR</td>
                                            <td>{{ $window->gaskitamount }}PKR</td>
                                            <td>{{ $window->totalexpense }}PKR</td> 
                    
                                                </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
               
            
            @elseif($window->designtype == "openable total cost")
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th>{{__('Profile')}}</th>
                                                <th>{{__('OuterWard/Inward Frame')}}</th>
                                                <th>{{__('Window Outward/Inward SAsh')}}</th>
                                                <th>{{__('WindowSashBeed')}}</th>
                                                <th>{{__('OuterSteelFrame')}}</th>
                                                <th>{{__('WindowSashSteel')}}</th>
                                                <th>{{__('Gaskit EMBD')}}</th>
                                                <th>{{__('Gaskit EMBD')}}</th>
                                                <th>{{__('Gaskit Beeding')}}</th>
                                                    <th>{{__('Total Expense')}}</th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td>{{ $window->frame }}PKR</td>
                                            <td>{{ $window->outeramount }}PKR</td>
                                            <td>{{  $window->slideamount }}PKR</td>
                                            <td>{{ $window->slidebeedamount }}PKR</td>
                                            <td>{{ $window->outersteelamount}}PKR</td> 
                                            <td>{{ $window->slidesteelamount }}PKR</td> 
                                            <td>{{ $window->gaskitamount }}PKR</td>
                                            <td>{{ $window->xgaskitamount }}PKR</td>
                                            <td>{{ $window->gaskitbeedamount }}PKR</td>
                                            <td>{{ $window->totalexpense }}PKR</td> 
                    
                                                </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
            @elseif($window->designtype == "door total cost")
            
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th>{{__('Profile')}}</th>
                                                <th>{{__('Outer Frame')}}</th>
                                                <th>{{__('OuterSteelFrame')}}</th>
                                                <th>{{__('Gaskit EMBD')}}</th>
                                                <th>{{__('Door SAsh')}}</th>
                                                <th>{{__('DoorSashSteel')}}</th>
                                                <th>{{__('Gaskit EMBD')}}</th>
                                                <th>{{__('WindowSashBeed')}}</th>
                                                <th>{{__('Gaskit Beeding')}}</th>
                                                <th>{{__('Fix Panel')}}</th>
                                                    <th>{{__('Total Expense')}}</th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td>{{ $window->frame }}PKR</td>
                                            <td>{{ $window->outeramount }}PKR</td>
                                            <td>{{ $window->outersteelamount}}PKR</td>
                                            <td>{{ $window->gaskitamount }}PKR</td>
                                            <td>{{  $window->slideamount }}PKR</td>
                                            <td>{{ $window->slidesteelamount }}PKR</td>
                                            <td>{{ $window->xgaskitamount }}PKR</td>
                                            <td>{{ $window->slidebeedamount }}PKR</td>
                                            <td>{{ $window->gaskitbeedamount }}PKR</td>
                                            <td>{{ $window->fixpanelamount }}PKR</td>
                                            <td>{{ $window->totalexpense }}PKR</td> 
                    
                                                </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
            @else
            @endif
        </div>

</div>


@endsection

