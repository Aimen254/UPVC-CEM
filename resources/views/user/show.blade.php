@extends('layouts.admin')
@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp
@section('page-title')
{{$user->name}}
@endsection
@push('script-page')
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        $(".list-group-item").click(function(){
            $('.list-group-item').filter(function(){
                return this.href == id;
            }).parent().removeClass('text-primary');
        });
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
    function printme(){
        window.print();
    }
        function show(){
        $("#filters").show();
    }
</script>
    <script>
 $(document).ready(function(){
    $('#select_id').on('change', function() {
        var val = $(this).val();
    $("#usercard").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1)
    });
  });
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
<!--@if(session()->has('data'))-->
<!--    <script type="text/javascript">-->
<!--    $("#moncount").show();-->
<!--    $("#count").hide();-->
<!--    </script>-->
<!--@else-->
<!-- <script type="text/javascript">-->

<!--    $("#count").show();-->
<!--    </script>-->
<!--@endif-->
// <script>
//     $('input[type=month]').change(function () {
//          $("#moncount").show();
//           $("#count").hide();
//     this.form.submit();
// });
// </script>

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('users.index')}}">{{__('User')}}</a></li>
    <li class="breadcrumb-item"> {{$user->name}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
      
                <a href="#" onclick="printme();"  title="{{__('Print Data')}}" class="btn btn-sm btn-primary btnprn">
  <i class="fa fa-print"></i>
        </a>
       
    </div>
@endsection

@section('content')
<div class="row">
          <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-12">
                  <div class="card">
                       <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-success">
                                            <i class="ti ti-test-pipe"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0">{{__('Pipeline')}}</p>
                                            <h5 class="mb-0 text-success">{{$user->default_pipeline}}</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-warning">
                                            <i class="ti ti-test-pipe"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0">{{__('Total Leads')}}</p>
                                            <h5 class="mb-0 text-success">{{$leadCount}}</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-info">
                                            <i class="fa fa-quote-left"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0">{{__('Quoations')}}</p>
                                            <h5 class="mb-0 text-info">{{($quote)}}</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-login"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0">{{__('Last Login')}}</p>
                                            <h5 class="mb-0 text-info">{{($user->last_login_at)}}</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-user"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0">{{__('Type')}}</p>
                                            <h5 class="mb-0 text-primary">{{($user->type)}}</h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
                </div>
            </div>
            <div id="users_products">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-end">
                                            <a href="#" data-size="md" data-url="{{ route('users.edit',$user->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Add User')}}" class="btn btn-sm btn-primary">
                                                <i class="ti ti-plus"></i>
                                            </a>
                                        </div>
                                        <h5>{{__('User')}}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                <tr>
                                                    <th>{{__('Name')}}</th>
                                                    <th>{{__('Email')}}</th>
                                                    <th>{{__('Image')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                              
                                                                <p class="mb-0">{{$user->name}}</p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="d-flex align-items-center">
                                                              
                                                              <p class="mb-0">{{$user->email}}</p>
                                                          </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <img @if($user->avatar) src="{{asset('/storage/uploads/avatar/'.$user->avatar)}}" @else src="{{asset('/storage/uploads/avatar/avatar.png')}}" @endif class="wid-30 rounded-circle me-3" alt="avatar image">
                                                            </div>
                                                        </td>
                                                        @can('edit user')
                                                            <td>
                                                                <div class="action-btn bg-danger ms-2">
                                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id],'id'=>'delete-form-'.$user->id]) !!}
                                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}"><i class="ti ti-trash text-white"></i></a>

                                                                    {!! Form::close() !!}
                                                                </div>
                                                            </td>
                                                        @endcan
                                                    </tr>
                                              
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-end">
                                            <a href="#" data-size="md" data-url="{{ route('users.edit',$user->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Upgrade Plan')}}" class="btn btn-sm btn-primary">
                                                <i class="ti ti-plus"></i>
                                            </a>
                                        </div>
                                        <h5>{{__('Plans')}}</h5>

                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                <tr>
                                                    <th>{{__('Plan')}}</th>
                                                    <th>{{__('Plan Expire date')}}</th>
                                                    <th>{{__('Requested Plan')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
        
                                                    <tr>
                                                        <td>
                                                            {{$user->plan}}
                                                        </td>
                                                        <td>
                                                           {{$user->plan_expirey_date}}
                                                        </td>
                                                        <td>
                                                            {{$user->requested_plan}}
                                                        </td>
                                                    
                                                    </tr>
                                            
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <!--       <div class="row">-->
            <!--            <div class="col-sm-12">-->
            <!--                  <h5>{{__('Leads')}}</h5>-->
            <!--                <div class="card-body row kanban-wrapper horizontal-scroll-cards" >-->
            <!--                    @foreach($user->leads as $lead)-->
            <!--                    <div class="col">-->
            <!--                        <div class="card" data-id="{{$lead->id}}">-->
            <!--                            <div class="pt-3 ps-3">-->
            <!--                                @php($labels = $lead->labels())-->
            <!--                                @if($labels)-->
            <!--                                    @foreach($labels as $label)-->
            <!--                                        <div class="badge-xs badge bg-{{$label->color}} p-2 px-3 rounded">{{$label->name}}</div>-->
            <!--                                    @endforeach-->
            <!--                                @endif-->
            <!--                            </div>-->
            <!--                            <div class="card-header border-0 pb-0 position-relative">-->
            <!--                                <h5><a href="@can('view lead')@if($lead->is_active){{route('leads.show',$lead->id)}}@else#@endif @else#@endcan">{{$lead->name}}</a></h5>-->
            <!--                                <div class="card-header-right">-->
            <!--                                <p>{{  !empty($lead->stage)?$lead->stage->name:'-' }}</p>-->
            <!--                                </div>-->
            <!--                            </div>-->
                                      
            <!--                            <div class="card-body">-->
            <!--                                <div class="d-flex align-items-center justify-content-between">-->
                                              
            <!--                                    <div class="user-group">-->
            <!--                                        @foreach($lead->users as $user)-->
            <!--                                            <img src="@if($user->avatar) {{asset('/storage/uploads/avatar/'.$user->avatar)}} @else {{asset('storage/uploads/avatar/avatar.png')}} @endif" alt="image" data-bs-toggle="tooltip" title="{{$user->name}}">-->
            <!--                                        @endforeach-->
            <!--                                    </div>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    @endforeach-->
            <!--                </div>-->
                        

            <!--        </div>-->
            
            <!--</div>-->
        </div>
</div

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
            <?php
                    $leas = $user->leads();
            ?>
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
                            <table class="table datatable" >
                                <thead>
                                <tr>
                                   
                                    <th>  {{__('Date')}}
                                    </th>
                                   
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Subject')}}</th>
                                    <th>{{__('Stage')}}</th>
                                    <th>{{__('Users')}}</th>
                                    <th>{{__('Address')}}</th>
                                    <th>{{__('Reporter')}}</th>
                                  
                                    <th>{{__('Action')}}</th>
                                </tr>
                                <tr>
                                    <td> 
                                           <label for="">Date</label>
                                            <select id="select_id" name="actors">                       
                                                <option value=""</option>
                                                <!-- <option selected="selected">Java</option>  -->
                                                @foreach ($user->leads as $lead)
                                                    <option >{!! $lead->created_at !!}</option>
                                                @endforeach
                                            </select>
                                    </td>
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                 
                                @if(count($user->leads) > 0)
                            
                                    @foreach ($user->leads as $lead)
                                  
                                       @foreach($users as $use)
                                        <tr>
                                            <td>{{ $lead->created_at }}</td>
                                            <td>{{ $lead->name }}</td>
                                            <td>{{ $lead->subject }}</td>
                                            <td>{{  !empty($lead->stage)?$lead->stage->name:'-' }}</td>
                                            <td>
                                                @foreach($lead->users as $user)
                                                    <a href="#" class="btn btn-sm mr-1 p-0 rounded-circle">
                                                        <img alt="image" data-toggle="tooltip" data-original-title="{{$user->name}}" @if($user->avatar) src="{{asset('/storage/uploads/avatar/'.$user->avatar)}}" @else src="{{asset('/storage/uploads/avatar/avatar.png')}}" @endif class="rounded-circle " width="25" height="25">
                                                    </a>
                                                    <p class="mb-0">{{$user->name}}</p>
                                                @endforeach
                                            </td>
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
   
        
@endsection
