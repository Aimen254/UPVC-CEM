@extends('layouts.admin')
@section('page-title')
    {{__('Manage Product & Services')}}
@endsection
@push('css-page')
  
    
@endpush
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Product & Services')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
 
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="{{__('Import')}}" data-url="{{ route('productservice.file.import') }}" data-ajax-popup="true" data-title="{{__('Import product CSV file')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
      
    </div>
@endsection

@section('content')
 
<div class="row" >
        <div class="col-xxl-12">
        @foreach($projs as $img)
            <div class="row">
            
                <div class="col-md-3">
               
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
                                 <img id="myFrame" src="@if(!empty($proj->image)) {{asset('/formulaimages/'.$proj->image)}} @endif" alt="kal" class="img-user wid-30 width="500" height="200" ">
                           </div>
                          
                        </div>
                      
                    </div>

                </div>

                <div class="col-md-9">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
      
                            <table class="table " id="myTable" >
                                <thead>
                                <tr>
                                    <th class="text-center" >{{__('Final sizes')}}</th>
                                    <th></th>
                                    <th class="text-center" width="25%">{{__('Steel')}}</th>
                                </tr>
                             
                              
                                </thead>
                                <tbody >
                              
                                <tr>
                                    <th>{{__('Width')}}</th>
                                    <th>{{__('Height')}}</th>
                                    <th>{{__('Width')}}</th>
                                    <th>{{__('Height')}}</th>
                                </tr>
                                <tr>
                                    <td>{{$img->widthmm}}</td> 
                                    <td>{{$img->heightmm}}</td> 
                                </tr>
                             
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
        
            </div>
        @endforeach
        </div>
</div>
@endsection
