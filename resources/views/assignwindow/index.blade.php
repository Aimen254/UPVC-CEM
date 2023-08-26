@extends('layouts.admin')
@section('page-title')
    {{__('Manage Images')}} 
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
@endpush
@push('script-page')
    <script src="{{asset('css/summernote/summernote-bs4.js')}}"></script>
    
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Image')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        
      
        <a href="#" data-size="lg" data-url="{{ route('assignwindows.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create New User')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection

@section('content')
    
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
      
                            <table class="table datatable" >
                                <thead>
                                <tr>
                                   
                                 
                                   
                                    <th>{{__('Frames')}}</th>
                                    <th>{{__('Design')}}</th>
                                   <th>{{__('Type')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                             
                                </thead>
                                <tbody id="myTable">
                                   
                                @if(count($images) > 0)
                                @foreach ($images as $image)
                                     
                                     <tr>
                                        
                                         <td>
                                         @if(!empty($image->frame_id))
                                            @php
                                                $frames=\Utility::frame($image->frame_id);
                                            @endphp

                                            @foreach($frames as $frame)
                                                {{ !empty($frame)?$frame->name:''  }}<br>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                         </td>
                                         <!--<td scope="row">-->
                                        
                                         <!--   @if(!empty($image->image))-->
                                            
                                         <!--   <img src="{{(!empty($image->image))? asset(Storage::url("uploads/payment".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="kal" class="img-user wid-80 rounded-circle">-->
                                           
                                         <!--   @else-->
                                         <!--       <a href="#" class="btn btn-sm btn-secondary btn-icon rounded-pill">-->
                                         <!--           <span class="btn-inner--icon"><i class="ti ti-times-circle"></i></span>-->
                                         <!--       </a>-->
                                         <!--   @endif-->
                                        

                                         <!--</td>-->

                                       <td>{{$image->profile}}</td>
                                       <td>{{$image->type}}</td>
                                       @if($image->type == "sliding")
                                             <td class="Action">
                                                        
                                                   <a href="#" data-size="md" data-url="{{ route('assign.access.create',$image->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Edit')}}" class="btn btn-sm btn-primary">
                                                        Add Accessories
                                                    </a>        
                                               <a href="#" data-size="md" data-url="{{ route('assign.window.edit',$image->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Edit')}}" class="btn btn-sm btn-primary">
                                                        <i class="ti ti-plus"></i>
                                                    </a>
                                                       
                                             </td>
                                        @else
                                       <td class="Action">
                                                <a href="#" data-size="md" data-url="{{ route('assign.access.create',$image->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Edit')}}" class="btn btn-sm btn-primary">
                                                    Add Accessories
                                                </a>   
                                                <a href="#" data-size="md" data-url="{{ route('assign.window.edit',$image->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Edit')}}" class="btn btn-sm btn-primary">
                                                    <i class="ti ti-plus"></i>
                                                </a>
                                            </td>
                                        @endif
                                     </tr>
                                   
                                 @endforeach
                                @else
                                    <tr class="font-style">
                                        <td colspan="6" class="text-center">{{ __('No data available in table') }}</td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   

@endsection
