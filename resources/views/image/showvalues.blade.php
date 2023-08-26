
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
            
                <div class="col-md-3">
               
                    <div class="card text-center">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <div class=" badge bg-primary p-2 px-3 rounded">
                                    
                                         {{ ucfirst($image->name) }}
                                    </div>
                                </h6>

                            </div>

                          
                        </div>
                        <div class="card-body full-card">
                           <div class="img-fluid rounded-circle card-avatar">
                                  <img src="{{(!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="kal" class="img-user wid-140 ">
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
                                        <th>{{__('OuterWidth')}}</th>
                                        <th>{{__('OuterHeight')}}</th>
                                        <th>{{__('InnerWidth')}}</th>
                                        <th>{{__('InnerHeight')}}</th>
                                        <th>{{__('FixWidth')}}</th>
                                        <th>{{__('FixHeight')}}</th>
                                         <th>{{__('Total Expense')}}</th>
                                    </tr>
                                  
                                    </thead>
                                    <tbody >
                                     
                                         
                                                <td>{{ $window->outerwidth }}</td>
                                                <td>{{$window->outerheight }}</td> 
                                                <td>{{ $window->innerwidth }}</td> 
                                                <td>{{ $window->innerheight }}</td> 
                                                <td>{{ $window->fixwidth }}</td> 
                                                <td>{{ $window->fixheight }}</td> 
                                          <td>{{ $window->totalexpense }}</td>
                                               
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
                                        <th>{{__('Aluminium Rail')}}</th>
                                        <th>{{__('Brush Rolls')}}</th>
                                        <th>{{__('Bumper Block')}}</th>
                                        <th>{{__('Double Tap On Screen')}}</th>
                                        <th>{{__('Dummy Wheels')}}</th>
                                        <th>{{__('Fiber Net Roll ')}}</th>
                                        <th>{{__('Flat Handle')}}</th>
                                        <th>{{__('Fly Screen Sliding Wheel ')}}</th>
                                        <th>{{__('Fly Screen Gask')}}</th>
                                        <th>{{__('Gear Handler')}}</th>
                                        <th>{{__('sliding Gear Keeps')}}</th>
                                        <th>{{__('Sliding Gears')}}</th>
                                        <th>{{__('Sliding Gear Wheels')}}</th>
                                        <th>{{__('Stoppers')}}</th>
                                        <th>{{__('Wind Break Bridge')}}</th>
                                    </tr>
                                
                                    </thead>
                                    <tbody >
                                        @foreach ($access as $acces)
                                            <tr>
                                                <td>{{ $acces->aluminium_rail }}PKR</td>
                                                <td>{{ $acces->brush_rolls }}PKR</td> 
                                                <td>{{ $acces->bumpler_block }}PKR</td> 
                                                <td>{{ $acces->DTape_screws }}PKR</td> 
                                                <td>{{ $acces->dummy_wheels }}PKR</td> 
                                                <td>{{ $acces->fiber_net }}PKR</td> 
                                                <td>{{ $acces->flat_handle }}PKR</td> 
                                                <td>{{ $acces->fly_screen_gaskit }}PKR</td> 
                                                <td>{{ $acces->fly_screen_slidingwheel }}PKR</td> 
                                                <td>{{ $acces->gear_handles }}PKR</td> 
                                                <td>{{ $acces->sliding_gearkeep }}PKR</td> 
                                                <td>{{ $acces->sliding_gear }}PKR</td> 
                                                <td>{{ $acces->sliding_gearwheels }}PKR</td> 
                                                <td>{{ $acces->stoppers }}PKR</td> 
                                                <td>{{ $acces->wind_break }}PKR</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        
            </div>
           
        </div>
</div>



@endsection

