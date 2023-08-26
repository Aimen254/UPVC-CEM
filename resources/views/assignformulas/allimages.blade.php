@extends('layouts.admin')
@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp
@section('page-title')
    {{__('Assign Formulas')}}
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
                                <a href="{{ route('imgformulas.show', $image->id) }}"  >
                                        <img src="{{(!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="kal" class="img-user wid-140">
                                        </a>
                            </div>
                            <h4 class=" mt-2 text-primary">
                                <a href="#" data-size="lg" data-url="{{ route('formasign.create', $image) }}" data-ajax-popup="true"  data-bs-toggle="tooltip" title="{{__('Assign Formula')}}"  class="btn btn-sm btn-primary">
                                    <i class="ti ti-plus"></i>
                                </a>
                                 <a href="#" class="mx-3 btn btn-sm  btn-primary" data-url="{{ route('formasign.edit',$image->id) }}" data-ajax-popup="true"  data-size="xl" data-bs-toggle="tooltip" title="{{__('Edit')}}"  data-title="{{__('Product Edit')}}">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                  <!--<a href="{{ route('formasign.edit',$image->id) }}" class="mx-3 btn btn-sm  btn-primary" >-->
                                  <!--                      <i class="ti ti-pencil"></i>-->
                                  <!--                  </a>-->
                            </h4>
                          
                        </div>
                      
                    </div>

                </div>
                

              @endforeach
            </div>
        </div>
    </div>
@endsection
