@extends('layouts.admin')
@section('page-title')
    {{__('Manage formulas')}} @if($pipeline) - {{$pipeline->name}} @endif
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

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Formula')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        
        <a href="#" onclick="printme();" data-size="lg" data-url="" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Print Data')}}" class="btn btn-sm btn-primary btnprn">
            <i class="fa fa-print"></i>
        </a>
      
        <a href="#" data-size="lg" data-url="{{ route('formulas.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create New User')}}" class="btn btn-sm btn-primary">
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
                                    <th>{{__('Size')}}</th>
                                    <th>{{__('Type')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                             
                                </thead>
                                <tbody id="myTable">
                                   
                                @if(count($formulas) > 0)
                                @foreach ($formulas as $formula)
                                     
                                     <tr>
                                        
                                         <td>{{ $formula->name }}</td>
                                         <td>{{ $formula->size }}</td>

                                         <td>{{ $formula->type }}</td>

                                       
                                             <td class="Action">
                                                        
                                                 <a href="{{route('formulas.show',$formula->id)}}" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="{{__('View')}}" data-title="{{__('Lead Detail')}}">
                                                     <i class="fa fa-eye "></i>
                                                 </a>
                                                 <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{ route('formulas.edit',$formula->id) }}" data-ajax-popup="true" data-size="xl" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Lead Edit')}}">
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
