
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


<script>
    function printme(){
        window.print();
    }
</script>



@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Windows')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="#" onclick="printme();" data-size="lg" data-url="" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Print Data')}}" class="btn btn-sm btn-primary btnprn">
            <i class="fa fa-print"></i>
        </a>
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
                                        <input type="hidden" value="{{$image->name}}" id="imagname" >
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
      
                            <table class="table" id="myTable" >
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
                                 
                                        <tr>
                                        @if($recent)
                                            <td>{{ $recent->outerwidth }}</td>
                                            <td>{{ $recent->outerheight }}</td> 
                                            <td>{{ $recent->innerwidth }}</td> 
                                            <td>{{ $recent->innerheight }}</td> 
                                            <td>{{ $recent->fixwidth }}</td> 
                                            <td>{{ $recent->fixheight }}</td>
                                            <td>{{ $recent->totalexpense }}</td> 
                                                       @else
                                    <tr class="font-style">
                                        <td colspan="6" class="text-center">{{ __('No data available in table') }}</td>
                                    </tr>
                                @endif
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
                                        @foreach ($raccess as $racces)
                                            <tr>
                                                <td>{{ $racces->aluminium_rail }}PKR</td>
                                                <td>{{ $racces->brush_rolls }}PKR</td> 
                                                <td>{{ $racces->bumpler_block }}PKR</td> 
                                                <td>{{ $racces->DTape_screws }}PKR</td> 
                                                <td>{{ $racces->dummy_wheels }}PKR</td> 
                                                <td>{{ $racces->fiber_net }}PKR</td> 
                                                <td>{{ $racces->flat_handle }}PKR</td> 
                                                <td>{{ $racces->fly_screen_gaskit }}PKR</td> 
                                                <td>{{ $racces->fly_screen_slidingwheel }}PKR</td> 
                                                <td>{{ $racces->gear_handles }}PKR</td> 
                                                <td>{{ $racces->sliding_gearkeep }}PKR</td> 
                                                <td>{{ $racces->sliding_gear }}PKR</td> 
                                                <td>{{ $racces->sliding_gearwheels }}PKR</td> 
                                                <td>{{ $racces->stoppers }}PKR</td> 
                                                <td>{{ $racces->wind_break }}PKR</td>

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


        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
      
                            <table class="table datatable" >
                                <thead>
                                <tr>
                                   
                                   
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Project')}}</th>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('OuterWidth')}}</th>
                                    <th>{{__('OuterHeight')}}</th>
                                    <th>{{__('InnerWidth')}}</th>
                                    <th>{{__('InnerHeight')}}</th>
                                    <th>{{__('FixWidth')}}</th>
                                    <th>{{__('FixHeight')}}</th>
                                    <th>{{__('Total Exdpense')}}</th>
                                      <th>{{__('Created By')}}</th>
                                    <th>{{__('Assign To')}}</th>
                                     <th>{{__('Status')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                              
                                </thead>
                                <tbody >
                                    
                                 @forelse ($assign as $assig)  
                                    @foreach ($datas as $data)
                                      @foreach ($createid as $create)
                                        <tr>
                                            <td>{{ $data->created_at }}</td>
                                            <td>{{$data->project->project_name}}</td>
                                            <td>
                                                     <img src="{{(!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="kal" class="img-user wid-80 ">
                                            </td>
                                          <td>{{ $data->valuesum()}}</td>
                                            <td>{{ $data->outerwidth }}</td>
                                            <td>{{ $data->outerheight }}</td> 
                                            <td>{{ $data->innerwidth }}</td> 
                                            <td>{{ $data->innerheight }}</td> 
                                            <td>{{ $data->fixwidth }}</td> 
                                            <td>{{ $data->fixheight }}</td>
                                            <td>{{ $data->totalexpense }}</td>
                                             @if($create->id == $data->created_by)
                                              <td>{{ $create->name }}</td>
                                              @endif
                                              
                                             @if(Auth::user()->type != 'Admin')
                                                @if($assig->id == $data->assignto)
                                              <td>{{ $assig->name }}</td> 
                                              @else
                                              <td>No Assignee</td> 
                                              @endif
                                            @else
                                            @if(!empty($data->assignto))
                                              <td>{{$assig->name }}</td>
                                            @else
                                            <td>
                                                <div class="action-btn bg-success ms-2">
                                                  
                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{route('usrimg.assigncreate',$data)}}" data-ajax-popup="true" data-size="sl" data-bs-toggle="tooltip" title="{{__('Assign')}}" data-title="{{__('Assign To')}}">
                                                        <i class="ti ti-user text-white"></i>
                                                    </a> 
                                                </div>
                                            </td>
                                            @endif
                                            @endif
                                              @if(Auth::user()->type != 'cutter')
                                            <td>{{ $data->status}}</td> 
                                            @else
                                            <td>
                                                <div class="action-btn bg-success ms-2">
                                                    
                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{route('usrimg.statuscreate',$data)}}" data-ajax-popup="true" data-size="sl" data-bs-toggle="tooltip" title="{{__('status')}}" data-title="{{__('Status')}}">
                                                        <i class="ti ti-list text-white"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            @endif
                                        @if(Auth::user()->type != 'Client')
                                                <td class="Action">
                                                    <span>
                                                  
                                                          
                                                                <div class="action-btn bg-warning ms-2">
                                                                <a href="{{route('usrimg.show',$data->id)}}" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="{{__('View')}}" data-title="{{__('window Detail')}}">
                                                                    <i class="ti ti-eye text-white"></i>
                                                                </a>
                                                            </div>
                                                           
                                                           
                                                  
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['usrimg.destroy', $data->id],'id'=>'delete-form-'.$data->id]) !!}
                                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" ><i class="ti ti-trash text-white"></i></a>
    
                                                                {!! Form::close() !!}
                                                             </div>
    
                                                        
                                                    </span>
                                                </td>
                                        @endif
                                        </tr>
                                      @endforeach  
                            
                                    @endforeach  
                           
                                 @empty  
                                   @foreach ($datas as $data)
                                    @foreach ($createid as $create)
                                      <tr>
                                           <td>{{ $data->created_at }}</td>
                                           <td>{{$data->project->project_name}}</td>
                                            <td>
                                               <img src="{{(!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="kal" class="img-user wid-80 ">
                                            </td>
                                         
                                          <td>{{ $data->outerwidth }} MM          </td>
                                          <td>{{ $data->outerheight }} MM         </td> 
                                          <td>{{ $data->innerwidth }} </td> 
                                          <td>{{ $data->innerheight }}</td> 
                                  
                                          <td>{{ $data->fixwidth }}</td> 
                                          <td>{{ $data->fixheight }}</td> 
                                          @if($create->id == $data         ->created_by)
                                          <td>{{ $create->name }}</td>
                                          @endif
                                          @if(Auth::user()->type == 'Admin')
                                         
                                          <td>
                                              <div class="action-btn bg-success ms-2">
                                             <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{route('usrimg.assigncreate',$data)}}" data-ajax-popup="true" data-size="sl" data-bs-toggle="tooltip" title="{{__('Assign')}}" data-title="{{__('Assign To')}}">
                                                                <i class="ti ti-user text-white"></i>
                                                            </a> 
                                                  <!-- <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{route('usrimg.assigncreate',$data)}}" data-ajax-popup="true" data-size="sl" data-bs-toggle="tooltip" title="{{__('Assign')}}" data-title="{{__('Assign To')}}">
                                                      <i class="ti ti-pencil text-white"></i>
                                                  </a> -->
                                              </div>
                                          </td>
                                          
                                          @endif
                                
                                          @if(Auth::user()->type != 'Cutter')
                                           <td>{{ $data->status}}</td> 
                                          @else
                                          <td>
                                              <div class="action-btn bg-success ms-2">
                                                
                                                  <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{route('usrimg.statuscreate',$data)}}" data-ajax-popup="true" data-size="sl" data-bs-toggle="tooltip" title="{{__('status')}}" data-title="{{__('Assign To')}}">
                                                      <i class="ti ti-pencil text-white"></i>
                                                  </a>
                                              </div>
                                          </td>
                                          @endif
                                          @if(Auth::user()->type != 'Client')
                                              <td class="Action">
                                                  <span>
                                              
                                                      
                                                              <div class="action-btn bg-warning ms-2">
                                                              <a href="{{route('usrimg.show',$data->id)}}" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="{{__('View')}}" data-title="{{__('Lead Detail')}}">
                                                                  <i class="ti ti-eye text-white"></i>
                                                              </a>
                                                          </div>
                                                      
                                                          
                                              
                                                          <div class="action-btn bg-danger ms-2">
                                                              {!! Form::open(['method' => 'DELETE', 'route' => ['usrimg.destroy', $data->id],'id'=>'delete-form-'.$data->id]) !!}
                                                              <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" ><i class="ti ti-trash text-white"></i></a>
                                
                                                              {!! Form::close() !!}
                                                          </div>
                                
                                                      
                                                  </span>
                                              </td>
                                          @endif
                                      </tr>

                                      @endforeach
                                    
                                    @endforeach
                                 @endforelse 
                               
                             

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   

@endsection

