@extends('layouts.admin')
@section('page-title')
    {{__('Manage Images')}}
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
@endpush
@push('script-page')
    <script src="{{asset('css/summernote/summernote-bs4.js')}}"></script>
 
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
    $('.btnprn').printPage(); 
$('.btnprn').window.print();
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
    <li class="breadcrumb-item">{{__('Quotations')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        
        <a href="#" onclick="printme();" data-size="lg" data-url="" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Print Data')}}" class="btn btn-sm btn-primary btnprn">
            <i class="fa fa-print"></i>
        </a>
      
       <a href="{{ route('project.quote',$id) }}"  title="{{__('Create New User')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
        <a href="{{ route('project.quote.sheet',$id) }}"  data-bs-toggle="tooltip" title="{{__('Internal Quote')}}" class="btn btn-sm btn-primary">
            <i class="fa fa-quote-left"></i>
        </a>
           <a href="{{ route('project.quote.client',$id) }}"  data-bs-toggle="tooltip" title="{{__('Clients Quote')}}" class="btn btn-sm btn-primary">
           Quote
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
                                <th>{{__('Profile')}}</th>
                                <th>{{__('Design')}}</th>
                                <th>{{__('DesignType')}}</th>
                                <th>{{__('Windowtype')}}</th>
                                <th>{{__('Company')}}</th>
                                <th>{{__('Action')}}</th>
                                </tr>
                             
                                </thead>
                                <tbody id="myTable">
                                   
                                @foreach($projent as $milestone)
                                    
                                    <tr>
                                        <td>{{ $milestone->frame }}</td>
                                                                                  <td scope="row">
                                
                                            @if(!empty($milestone->image))
                              
                                               <img src="{{(!empty($milestone->image))? asset(Storage::url("uploads/windows/".$milestone->image)): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="kal" class="img-user wid-80">


                                    @else
                                        <a href="#" class="btn btn-sm btn-secondary btn-icon rounded-pill">
                                            <span class="btn-inner--icon"><i class="ti ti-times-circle"></i></span>
                                        </a>
                                    @endif
                                

                                

                                 </td>
                                 
                                  <td>{{ $milestone->designtype }}</td>
                                   
                                 <td>{{ $milestone->designtyperatio }}</td>
                                 
                                        <td>{{  $milestone->company }}</td>
                                <td>
                                       <div class="action-btn bg-danger ms-2">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['quote.window.delete', $milestone->id]]) !!}
                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}"><i class="ti ti-trash text-white"></i></a>

                                        {!! Form::close() !!}
                                    </div> 
                                       <div class="action-btn bg-warning ms-2">
                                        <a href="{{ route('windows.show',$milestone->id) }}" title="{{__('View')}}" class="btn btn-sm">
                                            <i class="ti ti-eye text-white"></i>
                                        </a>
                                        </div>
                                           <div class="action-btn bg-info ms-2">
                                        <a href="{{ route('project-quote.edit',[$milestone->id]) }}" title="{{__('Edit')}}" class="btn btn-sm">
                                            <i class="ti ti-pencil text-white"></i>
                                        </a>
                                        </div>
                                          <div class="action-btn bg-danger ms-2">
                                            <a href="{{ route('change_win_status', $milestone->id) }}" class=" btn btn-sm  align-items-center btn-{{ $milestone->final  == 1 ? 'info' : 'primary' }}" title="{{__('Final Window')}}">
                                        @if( $milestone->final == 1 ) <i class="fa fa-quote-left"></i>  @else <i  class="fa fa-ban"></i> @endif</a>
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
