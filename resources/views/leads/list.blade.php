@extends('layouts.admin')
@section('page-title')
    {{__('Manage Leads')}} @if($pipeline) - {{$pipeline->name}} @endif
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/plugins/dragula.min.css') }}" id="main-style-link">
@endpush
@push('script-page')
    <script src="{{asset('css/summernote/summernote-bs4.js')}}"></script>
      <script src="{{ asset('assets/js/plugins/dragula.min.js') }}"></script>

  <script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>
<script>
    function search(){
    
  var  filter, filtertwo,filterthree, table, tr, td, tdtwo, i;
  var name = document.getElementById("name");
  var who = document.getElementById("who");
  var quote = document.getElementById("quote");
  filter = name.value.toUpperCase();
  filtertwo = who.value.toUpperCase();
   filterthree = quote.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    tdtwo = tr[i].getElementsByTagName("td")[5];
       tdthree = tr[i].getElementsByTagName("td")[6];
    if (td) {
      if ((td.innerHTML.toUpperCase().indexOf(filter) > -1) && (tdtwo.innerHTML.toUpperCase().indexOf(filtertwo) > -1)  && (tdthree.innerHTML.toUpperCase().indexOf(filterthree) > -1) ) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  } 

}
</script>
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
    function printme(){
        window.print();
    }
     function show(){
        $("#filters").show();
    }
</script>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function myFunctiontwo() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputtwo");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[5];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Lead')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="{{ route('leads.index') }}" data-bs-toggle="tooltip" title="{{__('Kanban View')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-layout-grid"></i>
        </a>
                <a href="#" onclick="printme();"  title="{{__('Print Data')}}" class="btn btn-sm btn-primary btnprn">
  <i class="fa fa-print"></i>
        </a>
        <a href="{{ route('lead.export') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{ __('Export') }}">
            <i class="ti ti-file-export"></i>
        </a>
        <a href="#" data-size="lg" data-url="{{ route('leads.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create New User')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection

@section('content')
    @if($pipeline)
        <div class="row">
            <div class="d-flex align-items-center justify-content-end">
                <div class="class="col-auto float-end ms-2 mt-4">
                    <a href="#"  title="{{__('filters')}}" onclick="show()" class="btn btn-sm btn-primary">
                        Advance Filters
                    </a>
                </div>
            </div>
            <br>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <div class="row" id="filters" style="display:none;">
                                    <div class="col-md-2">
                                        <select name="" id="name" class="form-control">
                                        <option value="name">name</option> 
                                            @foreach ($name as $nam)
                                                <option >{{$nam}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="who" name="who" onchange="myFunctionwho()" class="form-control filter-select" placeholder="who is he">                       
                                             <option value="whoishe">whoishe</option> 
                                            @foreach ($results as $result)
                                                <option >{{$result}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="quote" name="quote" class="form-control">                       
                                            <option value="Quotation">Quotation</option>
                                            <!-- <option selected="selected">Java</option>  -->
                                                <option value="sent"> Sent</option>
                                                <option value="sent">Not sent</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                       <button class="btn btn-primary" id="search" onclick="search()" >search</button>
                                    </div>
                            </div>
                            <table class="table datatable">
                               
                                <thead>
                                <tr>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Phone')}}</th>
                                    <th>{{__('Stage')}}</th>
                                    <th>{{__('Users')}}</th>
                                    <th>{{__('Who is he')}}</th>
                                     <th>{{__('Quote')}}</th>
                                     <th>{{__('Area')}}</th>
                                     <th>{{__('Reporter')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                <tr>
                                    <td> 
                                        <!--<select id="select_id" name="actors">                       -->
                                        <!--    <option value=""</option>-->
                                           
                                        <!--    @foreach ($leads as $lead)-->
                                        <!--        <option >{!! $lead->created_at !!}</option>-->
                                        <!--    @endforeach-->
                                        <!--</select>-->
                                   
                                        <div id="location"></div>
                                    </td>
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                @if(count($leads) > 0)
                                    @foreach ($leads as $lead)
                                        @foreach($users as $use)
                                         
                                      
                                        <tr>
                                             <td>{{ $lead->created_at}}</td>
                                            <td>{{ $lead->name }}</td>
                                            <td>{{ $lead->phone }}</td>
                                            <td>{{  !empty($lead->stage)?$lead->stage->name:'-' }}</td>
                                            <td>
                                                  <div class="user-group">
                                                @foreach($lead->users as $user)
                                                <a href="#" class="btn btn-sm mr-1 p-0 rounded-circle">
                                                       <img src="@if($user->avatar) {{asset('/storage/uploads/avatar/'.$user->avatar)}} @else {{asset('storage/uploads/avatar/avatar.png')}} @endif" alt="image" data-bs-toggle="tooltip" title="{{$user->name}}">
                                                </a>
                                                 <p class="mb-0">{{$user->name}}</p>
                                                @endforeach
                                                </div>
                                            </td>
                                            <td>{{ $lead->whoishe }}</td>
                                              @if($lead->quote == 1)
                                            <td><p>Sent</p></td>
                                            @else
                                            <td><p>Not sent</p></td>
                                            @endif
                                            <td>{{ $lead->area }}</td>
                                             <td>
                                              {{$use->name}}
                                               
                                            </td>
                                            @if(Auth::user()->type != 'Client')
                                                <td class="Action">
                                                    <span>
                                                    @can('view lead')
                                                            @if($lead->is_active)
                                                                <div class="action-btn bg-warning ms-2">
                                                                <a href="{{route('leads.show',$lead->id)}}" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="{{__('View')}}" data-title="{{__('Lead Detail')}}">
                                                                    <i class="ti ti-eye text-white"></i>
                                                                </a>
                                                            </div>
                                                            @endif
                                                        @endcan
                                                        @can('edit lead')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{ route('leads.edit',$lead->id) }}" data-ajax-popup="true" data-size="xl" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Lead Edit')}}">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('delete lead')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['leads.destroy', $lead->id],'id'=>'delete-form-'.$lead->id]) !!}
                                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" ><i class="ti ti-trash text-white"></i></a>

                                                                {!! Form::close() !!}
                                                             </div>

                                                        @endif
                                         <div class="action-btn bg-danger ms-2">
                                             
                                                            <a href="{{ route('proposal.create2', $lead->id) }}" class="mx-4 btn btn-sm  align-items-center btn" title="{{__('Send Quote')}}"> <i class="fa fa-quote-left"></i></a>
                                                        </div>
                                         <div class="action-btn bg-success ms-2">
                                                            <a href="{{route('lead.increment', $lead->id) }}" class="mx-4 btn btn-sm  align-items-center btn" title="{{__('Increment')}}">
                                                            <i  class="fa fa-percent"></i> 
                                                            </a>
                                                        </div>
                                                    </span>
                                                </td>
                                            @endif
                                        </tr>
                                          
                                        @endforeach
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
