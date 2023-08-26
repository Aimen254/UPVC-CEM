@extends('layouts.admin')
@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp
@section('page-title')
    {{__('Select Image and Add Values')}}
@endsection
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Client')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        
    </div>
@endsection
@section('content')
<div class="row">
        <div class="col-xxl-12">
            <div class="row">
              @foreach($images as $image)
              
                <div class="col-md-4">
               
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
                                       <a href="{{ route('usrimg.list', $image) }}" > <img src="{{(!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="kal" class="img-user wid-140 ">
                                       </a>
                            </div>
                            <h4 class=" mt-2 text-primary">
                                <a href="#" data-size="lg" data-url="{{ route('usrimg.create', $image) }}" data-ajax-popup="true"  data-bs-toggle="tooltip" title="{{__('Add Values')}}"  class="btn btn-sm btn-primary">
                                    <i class="ti ti-plus"></i>
                                </a>
                            </h4>
                          
                        </div>
                      
                    </div>

                </div>
                
              @endforeach
            </div>
        </div>
    </div>
@endsection
