@extends('layouts.admin')
@section('page-title')
    {{__('Manage Images')}} @if($pipeline) - {{$pipeline->name}} @endif
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
@endpush
@push('script-page')
    <script src="{{asset('css/summernote/summernote-bs4.js')}}"></script>
 
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
</script>

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Image')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        
        <a href="#" onclick="printme();" data-size="lg" data-url="" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Print Data')}}" class="btn btn-sm btn-primary btnprn">
            <i class="fa fa-print"></i>
        </a>
      
        <a href="#" data-size="lg" data-url="{{ route('images.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create New User')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection

@section('content')
    @if($pipeline)
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
      
                            <table class="table datatable" >
                                <thead>
                                <tr>
                                   
                                 
                                   
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Image')}}</th>
                                   
                                    <th>{{__('Action')}}</th>
                                </tr>
                             
                                </thead>
                                <tbody id="myTable">
                                   
                                @if(count($images) > 0)
                                @foreach ($images as $image)
                                     
                                     <tr>
                                        
                                         <td>{{ $image->name }}</td>
                                         <td scope="row">
                                        
                                                    @if(!empty($image->image))
                                            <!--<img alt="image" data-toggle="tooltip" data-original-title="{{$image->name}}" @if($image->image) src="{{asset('/formulaimages/'.$image->image)}}" @endif  width="35" height="35">-->
                                                                                       <img src="{{(!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="kal" class="img-user wid-80 rounded-circle">

                                            @else
                                                <a href="#" class="btn btn-sm btn-secondary btn-icon rounded-pill">
                                                    <span class="btn-inner--icon"><i class="ti ti-times-circle"></i></span>
                                                </a>
                                            @endif
                                        

                                        

                                         </td>
                                        <!-- <img alt="image" data-toggle="tooltip" data-original-title="{{$image->name}}" @if($image->image) src="{{asset('/images/'.$image->image)}}" @endif  width="35" height="35"> -->

                                       
                                             <td class="Action">
                                                        
                                                 <a href="{{route('images.show',$image->id)}}" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="{{__('View')}}" data-title="{{__('Lead Detail')}}">
                                                     <i class="fa fa-eye "></i>
                                                 </a>
                                                 <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{ route('images.edit',$image->id) }}" data-ajax-popup="true" data-size="xl" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Lead Edit')}}">
                                                     <i class="fa fa-pencil "></i>
                                                 </a>
                                                       
                                             </td>
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
    @endif

@endsection
