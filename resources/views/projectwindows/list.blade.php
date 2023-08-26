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
         <a href="{{ route('projcut.sheet',$id) }}" class="btn btn-sm btn-primary">
                {{__('Cutting Sheet')}}
        </a>
    </div>
@endsection

@section('content')
 
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>{{__('Profile')}}</th>
                            <th>{{__('Design')}}</th>
                            <th>{{__('DesignType')}}</th>
                            <th>{{__('Windowtype')}}</th>
                            <th>{{__('Company')}}</th>         
                            <th class="text-end">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($projs as $key => $project)
                                <tr>
                                    <td>{{ $project->frame }}</td>
                                    <td scope="row">
                                
                                        @if(!empty($project->image))
                                    
                                            <img src="{{(!empty($project ->image))?
                                            asset(Storage::url("uploads/windows/".$project->image)): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="kal" class="img-user wid-80">

                                        @else
                                        <a href="#" class="btn btn-sm btn-secondary btn-icon rounded-pill">
                                            <span class="btn-inner--icon"><i class="ti ti-times-circle"></i></span>
                                        </a>
                                        @endif

                                    </td>
                                    <td>{{ $project->designtype }}</td>
                                    <td>{{ $project->designtyperatio }}</td>
                                    <td>{{  $project->company }}</td>
                                    <td>
                                        <div class="action-btn bg-primary ms-2">
                                            <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{ route('projwin.edit',$project->id) }}" data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title="{{__('FinalValues')}}" data-title="{{__(' Add Final Values')}}">
                                                <i class="ti ti-pencil text-white"></i>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
