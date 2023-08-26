@extends('layouts.admin')
@section('page-title')
    {{__('Balance Entry Create')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Double Entry')}}</li>
    <li class="breadcrumb-item">{{__('Balance Entry')}}</li>
@endsection

@push('script-page')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{asset('js/jquery.repeater.min.js')}}"></script>
    <script>

$(document).ready(function(){
  var type;
  var profile;
  var width;
  var height;
  var profileval;
  var typeratioval;
  var total ;
  var opendirval;
  var openhingval;
  var lockvalue;
  var handleval;
  $('#type').on('change',function(){
 type = $(this).find('option:selected').val();
 if(type == 'sliding'){
    let open= document.getElementById("open");
    let fix= document.getElementById("fix");
    let slide= document.getElementById("slide");
    let slidetype= document.getElementById("slidetype");
    let fixtype= document.getElementById("fixtype");
    let opentype= document.getElementById("opentype");
    let openlock= document.getElementById("openlock");
    let slidelock= document.getElementById("slidelock");
    let opendir= document.getElementById("opendir");
    let hing= document.getElementById("hing");  let handle= document.getElementById("handle");
 
    open.disabled = true;
    fix.disabled = true;
    fixtype.disabled = true;
     door.disabled = true;
    doortype.disabled = true;
    doorlock.disabled = true;
    slidetype.disabled = false ;
    fixtype.disabled = true;
    opentype.disabled = true;
    slidelock.disabled = false;
    openlock.disabled = true;
    opendir.disabled = true;
    hing.disabled = true;
     handle.disabled = true;
  
    $("#fixselect").hide();
    $("#slideselect").show();
    $("#openselect").hide();
   $("#doorselect").hide();
    $("#doortype").hide();
    $("#doortypee").hide();
    $("#doorlockk").hide();
    $("#slidetype").show();
    $("#slidetypee").show();
    $("#fixtypee").hide();
    $("#opentypee").hide();
    $("#openlockk").hide();
    $("#slidelockk").show();
    $("#outhead").hide();
    $("#opendirr").hide();
        $("#handlee").hide();
            $("#handlehead").hide();
            $("#hinghead").hide();
            $("#hingg").hide();
 
    $('#slidetype').on('change',function(){
    typeratioval = $(this).find('option:selected').val();
});
$('#slidelock').on('change',function(){
    lockvalue = $(this).find('option:selected').val();
});
    $('#slide').on('change',function(){
    profileval = $(this).find('option:selected').val();
    profile = $(this).find('option:selected').text();
    
  });
 }else if(type == 'fix'){
    let open= document.getElementById("open");
    let slide= document.getElementById("slide");
    let fix= document.getElementById("fix");
    let slidetype= document.getElementById("slidetype");
    let fixtype= document.getElementById("fixtype");
    let opentype= document.getElementById("opentype");
    let openlock= document.getElementById("openlock");
    let slidelock= document.getElementById("slidelock");
    let opendir= document.getElementById("opendir");
    let hing= document.getElementById("hing");
    let handle= document.getElementById("handle");

    fix.disabled = false;
    slide.disabled = true;
    open.disabled = true;
    door.disabled = true;
    doortype.disabled = true;
    doorlock.disabled = true;
    slidetype.disabled = true ;
    fixtype.disabled = false;
    opentype.disabled = true;
    openlock.disabled = true;
    opendir.disabled = true;
    hing.disabled = true;
     handle.disabled = true;

    $("#fixselect").show();
    $("#slideselect").hide();
    $("#openselect").hide();
     $("#doorselect").hide();
    $("#doortype").hide();
    $("#doortypee").hide();
    $("#doorlockk").hide();
    $("#fixtypee").show();
    $("#slidetypee").hide();
    $("#fixtypee").show();
    $("#opentypee").hide();     
  $("#openlockk").hide();
    $("#slidelockk").hide();
    $("#outhead").hide();
    $("#opendirr").hide();
    $("#handlee").hide();
    $("#handlehead").hide();
    $("#hinghead").hide();
    $("#hingg").hide();

    $('#fixtypee').on('change',function(){
    typeratioval = $(this).find('option:selected').val();
});

    $('#fix').on('change',function(){
    profileval = $(this).find('option:selected').val();
    profile = $(this).find('option:selected').text();
  });
  
 }else if(type == 'open'){
    let open= document.getElementById("open");
    let slide= document.getElementById("slide");
    let fix= document.getElementById("fix");
    let slidetype= document.getElementById("slidetype");
    let fixtype= document.getElementById("fixtype");
    let opentype= document.getElementById("opentype");  
    let openlock= document.getElementById("openlock");
    let slidelock= document.getElementById("slidelock");
    let handle= document.getElementById("handle"); 


   
    fix.disabled = true;
    slide.disabled = true;
    open.disabled = false;
     door.disabled = true;
    doortype.disabled = true;
    doorlock.disabled = true;
    opentype.disabled = false;
    slidetype.disabled = true ;
    fixtype.disabled = true;
    slidelock.disabled = true;
    openlock.disabled = false;
     handle.disabled = true;
  
  
    $("#fixselect").hide();
    $("#slideselect").hide();
    $("#openselect").show();
        $("#doorselect").hide();
    $("#doortype").hide();
    $("#doortypee").hide();
    $("#doorlockk").hide();
    $("#slidetypee").hide();
    $("#fixtypee").hide();
    $("#opentypee").show(); 
    $("#openlockk").show();
    $("#slidelockk").hide();
      $("#handlehead").hide();
            $("#handlee").hide();

 
    $('#opentype').on('change',function(){
        typeratioval = $(this).find('option:selected').val();
    opentypeval = $(this).find('option:selected').val();
    let opendir= document.getElementById("opendir");
    let hing= document.getElementById("hing");

    if(opentypeval == "tophing"){
        opendir.disabled = false;
        $("#outhead").show();
        $("#opendirr").show();
           $("#hinghead").hide();
                $("#hingg").hide();
    }else if(opentypeval == "casement"){
        opendir.disabled = false;
        $("#outhead").show();
        $("#opendirr").show();
        hing.disabled = false;
        $("#hinghead").show();
        $("#hingg").show();
    }
   });

    $('#open').on('change',function(){
        profileval = $(this).find('option:selected').val();
        profile = $(this).find('option:selected').text();
       
    });
    $('#opendir').on('change',function(){
        opendirval = $(this).find('option:selected').val();
   
    });
    $('#openlock').on('change',function(){
        lockvalue = $(this).find('option:selected').val();
    });
    $('#hing').on('change',function(){
            openhingval = $(this).find('option:selected').val();
       
    });
 }else if(type == 'door'){
            let door= document.getElementById("door");
            let open= document.getElementById("open");
            let fix= document.getElementById("fix");
            let slide= document.getElementById("slide");
            let slidetype= document.getElementById("slidetype");
            let fixtype= document.getElementById("fixtype");
            let opentype= document.getElementById("opentype");
            let doortype= document.getElementById("doortype");
            let openlock= document.getElementById("openlock");
            let slidelock= document.getElementById("slidelock");
            let doorlock= document.getElementById("doorlock");
            let opendir= document.getElementById("opendir");
            let hing= document.getElementById("hing");
            let handle= document.getElementById("handle");
        
            open.disabled = true;
            slide.disabled = true;
            fix.disabled = true;
            door.disabled = false;
            fixtype.disabled = true;
            slidetype.disabled = true ;
            fixtype.disabled = true;
            opentype.disabled = true;
            doortype.disabled = false;
            slidelock.disabled = true;
            openlock.disabled = true;
            doorlock.disabled = false;
            opendir.disabled = true;
            hing.disabled = false;
            handle.disabled = false;
        
            $("#hinghead").show();
            $("#hingg").show();
            $("#handlehead").show();
            $("#handlee").show();
            $("#fixselect").hide();
            $("#slideselect").hide();
            $("#doorselect").show();
            $("#openselect").hide();
            $("#slidetype").hide();
            $("#slidetypee").hide();
            $("#doortype").show();
            $("#doortypee").show();
            $("#fixtypee").hide();
            $("#opentypee").hide();
            $("#openlockk").hide();
            $("#slidelockk").hide();
            $("#doorlockk").show();
            $("#outhead").hide();
            $("#opendirr").hide();
        
            $('#doortype').on('change',function(){
            typeratioval = $(this).find('option:selected').val();
            });
            $('#doorlock').on('change',function(){
            lockvalue = $(this).find('option:selected').val();
            });
            $('#door').on('change',function(){
            profileval = $(this).find('option:selected').val();
            profile = $(this).find('option:selected').text();
        
            });
             $('#hing').on('change',function(){
            openhingval = $(this).find('option:selected').val();
       
            });
            $('#handle').on('change',function(){
            handleval = $(this).find('option:selected').val();
       
            });
        }
  });

  var btn = $('.addRow');

  $(btn).click(function(e){
    e.preventDefault();
  var tr =  "<tr>" +
  "<td><input type='number' class='form-control width' name='width[]'></td>" +
 " <td><input type='number' class='form-control height' name='height[]'></td> " +
 " <td><input type='text' id='' class='form-control type' name='type[]'></td>" +
 " <td><input type='text' id='' class='form-control myprof' name='myprof[]'></td>" +
"</td>"+
" <td><input type='text' id='' class='form-control designtyperatio' name='designtyperatio[]'></td>" +
"</td>"+
" <td id='locktd'><input type='text' id='lockinp' class='form-control lock' name='lock[]'></td>" +
"</td>"+
" <td id='dirtd'><input type='text' id='opendirin' class='form-control opendir' name='opendir[]'></td>" +
"</td>"+
" <td id='hingtd'><input type='text' id='openhing' class='form-control hing' name='hing[]'></td>" +
"</td>"+
 " <td id='handletd'><input type='text' id='doorhandle' class='form-control handle' name='handle[]'></td>" +
        "</td>"+

 " <th><a href='javascript:void(0)'' class='btn btn-danger deleteRow'>-</a></th>"+
 " <td><input type='hidden' class='form-control profile' name='profile[]'></td>" +
"</tr>"
   
$('tbody').append(tr);
var el = $(this).parent().parent().parent().parent();
   typetext = el.find('.type').val();
  
if(typetext == 'sliding'){
    el.find('.type').val(type);
  el.find('.profile').val(profileval);
        el.find('.myprof').val(profile);
        el.find('.designtyperatio').val(typeratioval);
    
        el.find('#lockinp').show();
        el.find('.lock').val(lockvalue);
        var dirchild = el.find('#opendirin');
        var dirtd = el.find('#dirtd');
        var hingchild = el.find('#openhing');
        var hingtd = el.find('#hingtd');
          var handlechild = el.find('#doorhandle');
            var handletd = el.find('#handletd');
        if (typeof(hingchild) != 'undefined' && hingchild != null){
            dirchild.remove();
            dirtd.remove();
            hingchild.remove();
            hingtd.remove();
             handlechild.remove();
            handletd.remove();
        }
        

}else if(typetext == 'fix'){
  
    el.find('.type').val(type);
  el.find('.profile').val(profileval);
        el.find('.myprof').val(profile);
        el.find('.designtyperatio').val(typeratioval);
        var dirchild = el.find('#opendirin');
        var dirtd = el.find('#dirtd');
        var hingchild = el.find('#openhing');
        var hingtd = el.find('#hingtd');
        var lockchild = el.find('#lockinp');
        var locktd = el.find('#locktd');
         var handlechild = el.find('#doorhandle');
            var handletd = el.find('#handletd');
        if (typeof(hingchild) != 'undefined' && hingchild != null){
            dirchild.remove();
            dirtd.remove();
            hingchild.remove();
            hingtd.remove();
            lockchild.remove();
            locktd.remove();
             handlechild.remove();
            handletd.remove();
        }
}else if(typetext == 'open' && typeratioval == 'casement'){
        el.find('.type').val(type);
        el.find('.profile').val(profileval);
        el.find('.myprof').val(profile);
        el.find('.designtyperatio').val(typeratioval);
        el.find('#opendirin').show();
        el.find('#lockinp').show();
        el.find('.lock').val(lockvalue);
        el.find('.opendir').val(opendirval);
        el.find('.hing').val(openhingval);
          var handlechild = el.find('#doorhandle');
            var handletd = el.find('#handletd');
            if (typeof(handlechild) != 'undefined' && handletd != null){
            handlechild.remove();
            handletd.remove();
            }
}else if(typetext == 'open' && typeratioval == 'tophing'){
        el.find('.type').val(type);
        el.find('.profile').val(profileval);
        el.find('.myprof').val(profile);
        el.find('.designtyperatio').val(typeratioval);
        el.find('#opendirin').show();
        el.find('.opendir').val(opendirval);
        el.find('#lockinp').show();
        el.find('.lock').val(lockvalue);
        var hingchild = el.find('#openhing');
        var hingtd = el.find('#hingtd');
        var handlechild = el.find('#doorhandle');
        var handletd = el.find('#handletd');
        if (typeof(hingchild) != 'undefined' && hingchild != null){
            hingchild.remove();
            hingtd.remove();
            handlechild.remove();
            handletd.remove();
        }
}else if(typetext == 'door'){
            el.find('.type').val(type);
            el.find('.profile').val(profileval);
            el.find('.myprof').val(profile);
            el.find('.designtyperatio').val(typeratioval);
        
            el.find('#lockinp').show();
            el.find('.lock').val(lockvalue);
            el.find('.hing').val(openhingval);
            
            el.find('.handle').val(handleval);
            var dirchild = el.find('#opendirin');
            var dirtd = el.find('#dirtd');
                dirchild.remove();
                dirtd.remove();
        

        }
 
 });
 

  
 $('tbody').on('click' ,'.deleteRow' , function(){
       $(this).parent().parent().remove();
 });
});

 


</script>
@endpush
@section('content')

    {{ Form::open(array('route' => ['project.quote.store',$project_id],'class'=>'w-100')) }}
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

    <div class="row">
        <div class="col-xl-12">
            <div class="card repeater">
                <div class="item-section py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <a href="#" data-repeater-create="" class="btn btn-primary mr-2" data-toggle="modal" data-target="#add-bank">
                                <i class="ti ti-plus"></i> {{__('Add Accounts')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0" data-repeater-list="accounts" id="sortable-table">
                            <thead>
                            <tr>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Type</th>
                            <th>Profile</th>
                            <th>Profile Type</th>
                            <th>Lock</th>
                            <th style="display: none;" id="outhead">Outward</th>
                            <th style="display: none;" id="hinghead">HindgeType</th>
                             <th style="display: none;" id="handlehead">Handle Type</th>
                            
                            <th><a href="javascript:void(0)" class="btn btn-success addRow">+</a></th>
                            </tr>
                            </thead>

                            <tbody class="ui-sortable" data-repeater-item>
                            <tr>
                                <td><input type="number" class="form-control width" name="width[]"></td>
                                <td><input type="number" class="form-control height" name="height[]"></td>
                                <td width="20%" class="form-group pt-0">
                                    {{ Form::select('type', $accounts,'', array('class' => 'form-control type select', 'id' => 'type' ,'required'=>'required')) }}

                                </td>

                                <td >
                                <div style="display: block;" id="slideselect">
                                {{ Form::select('profile', $slide,'', array('class' => 'form-control profile select', 'id' => 'slide' ,'required'=>'required')) }}
                                </div>
                                <div style="display: none;" id="fixselect">
                                {{ Form::select('profile', $fix,'', array('class' => 'form-control profile select', 'id' => 'fix' ,'required'=>'required')) }}

                                </div>
                                <div style="display: none;" id="openselect">
                                {{ Form::select('profile', $open,'', array('class' => 'form-control profile select', 'id' => 'open' ,'required'=>'required')) }}

                                </div>
                                   <div style="display: none;" id="doorselect">
                                {{ Form::select('profile', $door,'', array('class' => 'form-control profile select', 'id' => 'door' ,'required'=>'required')) }}
                                </div>
                                </td>

                                <td >
                                    <div style="display: block;" id="slidetypee">
                                       {{ Form::select('designtyperatio', $slidetype,'', array('class' => 'form-control designtyperatio select', 'id' => 'slidetype' ,'required'=>'required')) }}
                                    </div>
                                    <div style="display: none;" id="fixtypee">
                                       {{ Form::select('designtyperatio', $fixtype,'', array('class' => 'form-control designtyperatio  select', 'id' => 'fixtype' ,'required'=>'required')) }}
                                    </div>
                                    <div style="display: none;" id="opentypee">
                                       {{ Form::select('designtyperatio', $opentype,'', array('class' => 'form-control designtyperatio select', 'id' => 'opentype' ,'required'=>'required')) }}
                                    </div>
                                     <div style="display: none;" id="doortypee">
                                       {{ Form::select('designtyperatio', $doortype,'', array('class' => 'form-control designtyperatio select', 'id' => 'doortype' ,'required'=>'required')) }}
                                    </div>
                                </td>
                                <td>
                                     <div style="display: block;" id="slidelockk">
                                       {{ Form::select('lock', $slidelock,'', array('class' => 'form-control lock select', 'id' => 'slidelock' ,'required'=>'required')) }}
                                    </div> 
                                    <div style="display: none;" id="openlockk">
                                       {{ Form::select('lock', $openlock,'', array('class' => 'form-control lock select', 'id' => 'openlock' ,'required'=>'required')) }}
                                    </div> 
                                     <div style="display: none;" id="doorlockk">
                                       {{ Form::select('lock', $doorlock,'', array('class' => 'form-control lock select', 'id' => 'doorlock')) }}
                                    </div>
                                </td>
                                <td style="display: none;" id="opendirr">
                                {{ Form::select('opendir', $opendir,'', array('class' => 'form-control opendir select', 'id' => 'opendir' ,'required'=>'required')) }}
                                </td>
                                <td style="display: none;" id="hingg">
                                {{ Form::select('hing', $hing,'', array('class' => 'form-control hing select', 'id' => 'hing' ,'required'=>'required')) }}
                                </td>
                              
                                  <td style="display: none;" id="handlee">
                                {{ Form::select('handle', $doorhandle,'', array('class' => 'form-control handle select', 'id' => 'handle' ,'required'=>'required')) }}
                                </td>
                               
                                <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" onclick="location.href = '{{route('project.quote.index',$project_id)}}';" class="btn btn-light">
        <input type="submit" value="{{__('Create')}}" class="btn btn-primary">

    </div>
    {{ Form::close() }}

@endsection


