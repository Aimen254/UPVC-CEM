
@extends('layouts.admin')
@section('page-title')
    {{__('Manage Windows')}} 
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

<script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
$(document).ready(function(){
     $(#myTable).DataTable({
        "info": false,
        "searching": false,
     });
    }); 
</script>

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Windows')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
       
    </div>
@endsection

@section('content')
<div class="row" >
        <div class="col-xxl-12">
            <div class="row">
            
                <div class="col-md-3 ">
               
                    <div class="card text-center">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <div class=" badge bg-primary p-2 px-3 rounded">
                                    
                                       
                                    </div>
                                </h6>

                            </div>

                          
                        </div>
                        <div class="card-body full-card">
                           <div class="img-fluid rounded-circle card-avatar">
                                   <img src="{{(!empty($window->image))? asset(Storage::url("uploads/windows/".$window->image)): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="kal" class="img-user wid-80">
                           </div>
                          
                        </div>
                      
                    </div>

                </div>
                <div  class="col-md-6 ">
                    <div class= "row">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-body table-border-style">
                                    <table class="table " id="myTable" >
                                        <thead>
                                        <tr>
                                                <th></th>
                                                <th></th>
                                                <th>{{__('Total SQF')}}</th>
                                         
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td>Width</td>
                                                <td>{{ $width }}</td>
                                                <td>{{ $width  }}</td>
                                            </tr
                                            <tr>
                                                <td>Height</td>
                                                <td>{{ $height }}</td>
                                                <td>{{ $height  }}</td>
                                            </tr
                                           
                                            <tr>
                                                <td>{{$count}}</td>
                                                <td></td>
                                                   <td>{{ $sqf}}</td>
                                            </tr
                                        
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                </div>
            </div>
            @if($window->designtype == "sliding")
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th>{{__('UPVC Profile')}}</th>
                                                <th>{{__('Wx2')}}</th>
                                                <th>{{__('Hx2')}}</th>
                                                <th>{{__('Total')}}</th>
                                                <th>{{__('Prof.L=18')}}</th>
                                                <th>{{__('Kg')}}</th>
                                                <th>{{__('Rate')}}</th>
                                                <th>{{__('Amount')}}</th>
                                         
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td>Outer frame </td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 2 }}</td>
                                            <td>{{  $outerrn }}</td>
                                            <?php
                                           $outprf =  $outerrn / 18 ;
                                           $outerprofile = ceil($outprf);
                                          $outerprice = $window->prices->outerprice;
                                          $outeramount = $outerprice * $outerprofile;
                                            ?>
                                            <td>{{ $outerprofile}}</td> 
                                            <td></td>
                                            <td>{{ $window->prices->outerprice }}PKR</td> 
                                        <td>{{ $outeramount}}PKR</td> 
                                        </tr
                                        <tr>
                                            <td>Sliding Sacht </td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 4 }}</td>
                                            <td>{{  $slidern }}</td>
                                            <?php
                                              $slidprf =  $slidern / 18 ;
                                               $slideprofile = ceil($slidprf);
                                              $slideprice =      $window->prices   ->slideprice;
                                             $slideamount = $slideprice *            $slideprofile;
                                            ?>
                                            <td>{{ $slideprofile}}</td> 
                                            <td></td>
                                            <td>{{ $window->prices->slideprice        }}PKR</td> 
                                            <td>{{ $slideamount}}PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Net Frame </td>
                                            <td>{{ $width }}</td>
                                            <td>{{ $height * 2 }}</td>
                                            <td>{{  $netframrn }}</td>
                                            <?Php
                                            $netprf =  $netframrn / 18 ;
                                           $netprofile = ceil($netprf);
                                          $netprice = $window->prices->netprice;
                                          $netamount = $netprice * $netprofile;
                                            ?>
                                            <td>{{ $netprofile}}</td> 
                                            <td></td>
                                            <td>{{$window->prices->netprice }}PKR</td> 
                                        <td>{{ $netamount}}PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Sliding Frame Beeding </td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 4 }}</td>
                                            <td>{{  $slidebeedrn }}</td>
                                              <?Php
                                            $slidbeedprf =  $slidebeedrn / 18 ;
                                           $slidebeedprfile = ceil($slidbeedprf);
                                          $beedprice = $window->prices->slidebeedprice;
                                          $slidebeedamount = $beedprice * $slidebeedprfile;
                                            ?>
                                            <td>{{ $slidebeedprfile}}</td> 
                                            <td></td>
                                            <td>{{$window->prices->slidebeedprice }}PKR</td> 
                                           <td>{{ $slidebeedamount}}PKR</td> 
                                        </tr>
                                         <tr>
                                            <td>Inter Lock</td>
                                            <td></td>
                                            <td>{{ $height * 2 }}</td>
                                            <td>{{  $interlockrn }}</td>
                                              <?Php
                                            $interlkprf =  $interlockrn / 18 ;
                                           $interlockprofile = ceil($interlkprf);
                                          $interlkprice = $window->prices->	interlockprice;
                                          $interlockamount = $interlkprice * $interlockprofile;
                                            ?>
                                            <td>{{ $interlockprofile}}</td> 
                                            <td></td>
                                            <td>{{$window->prices->	interlockprice }}PKR</td> 
                                        <td>{{ $interlockamount}}PKR</td> 
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th>{{__('Steeel Reinforcement')}}</th>
                                                <th>{{__('Wx2')}}</th>
                                                <th>{{__('Hx2')}}</th>
                                                <th>{{__('Total')}}</th>
                                                <th>{{__('Prof.L=18')}}</th>
                                                <th>{{__('Kg')}}</th>
                                                <th>{{__('Rate')}}</th>
                                                <th>{{__('Amount')}}</th>
                                         
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td>Outer steel frame </td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 2 }}</td>
                                            <td>{{  $outersteelrn }}</td>
                                            <?php
                                             $outersteelprofile = $outersteelrn/8;
                                            $outersteelprice = $window->prices->outersteelprice;
                                             $outersteelamount = $outersteelprofile* $outersteelprice;
                                            ?>
                                            <td></td> 
                                            <td>{{$outersteelprofile}}</td>
                                            <td>{{ $window->prices->outersteelprice }}PKR</td> 
                                          <td>{{ $outersteelamount}}PKR</td> 
                                        </tr>
                                          <tr>
                                            <td>Sliding Steel Sacht </td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 4 }}</td>
                                            <td>{{  $slidesteelrn }}</td>
                                                                                        <?php
                                                                                    $slidesteelprofile = $slidesteelrn/ 8;
                                           $slidesteelprice = $window->prices->slidesteelprice;
                                             $slidesteelamount = $slidesteelprofile * $slidesteelprice;
                                            ?>
                                            <td></td> 
                                            <td>{{$slidesteelprofile}}</td>
                                            <td>{{ $window->prices->slidesteelprice }}PKR</td> 
                                           <td>{{ $slidesteelamount}}PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Net steel Frame </td>
                                            <td></td>
                                            <td>{{ $height * 2 }}</td>
                                            <td>{{  $netframesteelrn }}</td>
                                            <?php
                                            $netsteelprofile = $netframesteelrn/8;
                                            $netsteelprice = $window->prices->netsteelprice;
                                             $netsteelamount = $netsteelprofile* $netsteelprice;
                                            ?>
                                            <td></td> 
                                            <td>{{$netsteelprofile}}</td>
                                            <td>{{$window->prices->netsteelprice }}PKR</td> 
                                        <td>{{ $netsteelamount}}PKR</td> 
                                        </tr>
                                       
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                
                  <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th>{{__('Allied Material')}}</th>
                                                <th>{{__('Wx2')}}</th>
                                                <th>{{__('Hx2')}}</th>
                                                <th>{{__('Total')}}</th>
                                                <th>{{__('Prof.L=18')}}</th>
                                                <th>{{__('Kg')}}</th>
                                                <th>{{__('Rate')}}</th>
                                                <th>{{__('Amount')}}</th>
                                         
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td>Net </td>
                                            <td>{{ $width  }}</td>
                                            <td>{{ $height * 2 }}</td>
                                            <td>{{  $netrn }}</td>
                                            <?php
                                            $netprofile = $netrn / 4;
                                            $nettprofile = ceil($netprofile);
                                            $nettprice = $window->prices->nettprice;
                                            $nettamount = $nettprofile * $nettprice;
                                            ?>
                                            <td>{{  $nettprofile }}</td> 
                                            <td></td>
                                            <td>{{ $window->prices->nettprice }}PKR</td> 
                                        <td>{{ $nettamount}}PKR</td> 
                                        </tr
                                        <tr>
                                            <td>Gaskit EPDM </td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 4 }}</td>
                                            <td>{{  $gaskitrn }}</td>
                                            <?php
                                            $gaskitprice = $window->prices->gaskitprice;
                                            $gaskitamount = $gaskitrn*              $gaskitprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td>{{ $window->prices->gaskitprice }}PKR</td> 
                                            <td>{{ $gaskitamount}}PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Netting Gaskit</td>
                                           <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 2 }}</td>
                                            <td>{{  $netgaskitrn }}</td>
                                             <?php
                                            $netgaskitprice= $window->prices->netgaskitprice;
                                            $netgaskitamount = $netgaskitrn * $netgaskitprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td>{{$window->prices->netgaskitprice }}PKR</td> 
                                        <td>{{ $netgaskitamount}}PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Sliding Brush role</td>
                                           <td>{{ $width }}</td>
                                            <td>{{ $height * 4}}</td>
                                            <td>{{  $brushrolrn }}</td>
                                              <?php
                                            $slidingbrushprice= $window->prices->slidingbrushprice;
                                            $slidingbrushamount = $brushrolrn * $slidingbrushprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td>{{$window->prices->slidingbrushprice }}PKR</td> 
                                        <td>{{ $slidingbrushamount}}PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Aluminium Rail</td>
                                           <td>{{ $width }}</td>
                                            <td></td>
                                            <td>{{  $aluminiumrn }}</td>
                                            <?php
                                            $aluminiumrailprice= $window->prices->aluminiumrailprice;
                                            $aluminiumrailamount = $aluminiumrn * $aluminiumrailprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td>{{$window->prices->aluminiumrailprice }}PKR</td> 
                                        <td>{{ $aluminiumrailamount}}PKR</td> 
                                        </tr>
                                          <tr>
                                                                                    <?php  
                                             $totalexpense =  $outeramount+     $slideamount+$netamount+$slidebeedamount+$interlockamount+$outersteelamount+$slidesteelamount+$netsteelamount+$nettamount+$gaskitamount+$netgaskitamount+$slidingbrushamount+$aluminiumrailamount;              ?>
                                            <td></td>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td> 
                                            <td>Profile+steel+Allied Cost</td>
                                            <td>{{$totalexpense }}PKR</td>
                                        </tr>
                                         <tr>
                                            <td></td>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td> 
                                            <td>Hardware Cost</td>
                                            <td>{{$hardwarecost }}PKR</td>
                                        </tr>
                                         <tr>
                                            <td></td>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td> 
                                            <td>Total Cost</td>
                                            <td>{{$totalcost }}PKR</td>
                                        </tr>
                                       
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th>{{__('GearLock/Latchlock')}}</th>
                                                <th>{{__('Slidding keep Window X 3')}}</th>
                                                <th>{{__('Flat handle')}}</th>
                                                <th>{{__('Sash Roler per window 2')}}</th>
                                                <th>{{__('Dummy wheel Per window 2')}}</th>
                                                <th>{{__('Netting wheel per window 2')}}</th>
                                                <th>{{__('Silicon Per window 2')}}</th>
                                                <th>{{__('Fixer per window 2')}}</th>
                                                <th>{{__('Wind Break Bridge  per window 2')}}</th>
                                                <th>{{__('Stoper per window 2')}}</th>
                                                <th>{{__('Bumper Block 6')}}</th>
                                                 <th>{{__('Steel Taping Screw')}}</th>
                                            <th>{{__('Concrete Screw')}}</th>
                                                    <th>{{__('Total Expense')}}</th>
                                                        <th>{{__('Action')}}</th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <?php 
                                         $sashrollqty = $window->pricesqty->sashrollqty *  $count;
                                        $bumperblockqty = $window->pricesqty->bumperblockqty * $count;
                                        $dummywheelqty = $window->pricesqty->dummywheelqty *  $count;
                                        $flathandleqty = $window->pricesqty->flathandleqty * $count;
                                        $netwheelqty = $window->pricesqty->netwheelqty *  $count;
                                        $stopperqty = $window->pricesqty->stopperqty *  $count;
                                        $windbreakqty = $window->pricesqty->windbreakqty *  $count;
                                        $siliconqty = $window->pricesqty->siliconqty *  $count;
                                        $fixerqty = $window->pricesqty->fixerqty * $count;
                                        $slidekeepqty = $window->pricesqty->slidekeepqty *  $count;
                                        $steeltapqty = $window->pricesqty->steeltapqty *  $count;
                                        $conscrewqty = $window->pricesqty->conscrewqty *  $count;
                                        $gearqty = $count;
                                        $latchlockqty = $count;
                                        $siliconqty = $count *2;
                                        
                                         $sashroll = $sashrollqty *  $window->pricesqty->sashrollrate;
                                        $bumperblock = $bumperblockqty *  $window->pricesqty->bumperblockrate;
                                        $dummywheel = $dummywheelqty *  $window->pricesqty->dummywheelrate;
                                        $flathandle = $flathandleqty *  $window->pricesqty->flathandlerate;
                                        $netwheel = $netwheelqty *  $window->pricesqty->netwheelrate;
                                        $stopper = $stopperqty *  $window->pricesqty->stopperrate;
                                        $windbreak = $windbreakqty *  $window->pricesqty->windbreakrate;
                                        $silicon = $siliconqty *  $window->pricesqty->siliconrate;
                                        $fixer = $fixerqty *  $window->pricesqty->fixerrate;
                                        $slidekeep = $slidekeepqty *  $window->pricesqty->slidekeeprate;
                                        $steeltap = $steeltapqty *  $window->pricesqty->steeltaprate;
                                        $conscrew = $conscrewqty *  $window->pricesqty->conscrewrate;
                                         $gearprice = $gearqty *  	$window->prices->gearprice;
                                         $latchlockprice = $latchlockqty *  	$window->prices->latchlockprice;
                                         $total =$sashroll+ $bumperblock+ $dummywheel + $flathandle + $netwheel + $stopper +  $windbreak + $silicon + $fixer + $slidekeep + $steeltap + $conscrew ;
                                        
                                        ?>
                                        
                                        @if(!empty( $window->projwinacces))
                                        <tr>
                                           @if(!empty($window->projwinacces->gearlockrate))
                                            <td>{{ $gearprice }}PKR</td>
                                            <?php
                                             $locktype = $gearprice;
                                            ?>
                                            @else
                                            <td>{{$latchlockprice }}PKR</td>
                                              <?php
                                             $locktype = $latchlockprice;
                                            ?>
                                            @endif
                                            <?php
                                             $totalacs =$sashroll+ $bumperblock+        $dummywheel + $flathandle +             $netwheel + $stopper +  $windbreak      + $silicon + $fixer + $slidekeep +      $steeltap + $conscrew + $locktype ;
                                            ?>
                                            <td>{{ $slidekeep }}PKR</td>
                                            <td>{{$flathandle }}PKR</td>
                                            <td>{{  $sashroll }}PKR</td>
                                            <td>{{ $dummywheel}}PKR</td> 
                                            <td>{{ $netwheel }}PKR</td> 
                                            <td>{{ $silicon}}PKR</td> 
                                            <td>{{ $fixer}}PKR</td> 
                                            <td>{{ $windbreak }}PKR</td> 
                                            <td>{{ $stopper }}PKR</td>
                                            <td>{{ $bumperblock}}PKR</td>
                                             <td>{{ $steeltap }}PKR</td>
                                            <td>{{ $conscrew }}PKR</td>
                                            <td>{{ $totalacs }}PKR</td> 
                    <td>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-size="md" data-url="{{ route('slideacess.edit',$window->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Edit')}}" class="btn btn-sm">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                    
                                                </div>
                                            </td>
                                                </tr>
                                        @else
                                        <tr><td>No data exist</td></tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
        
                    </div>
                </div>
            @elseif($window->designtype == "fix")
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                             <th></th>                                      <th>{{__('Wx2')}}</th>
                                            <th>{{__('Hx2')}}</th>
                                            <th>{{__('Total')}}</th>
                                            <th>{{__('Prof.L=18')}}</th>
                                            <th>{{__('Kg')}}</th>
                                            <th>{{__('Rate')}}</th>
                                            <th>{{__('Amount')}}</th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                                <td>Outer frame </td>
                                                <td>{{ $width * 2 }}</td>
                                                <td>{{ $height * 2 }}</td>
                                                <td>{{  $outerrn }}</td>
                                                <?php
                                               $outprf =  $outerrn / 18 ;
                                               $outerprofile = round($outprf,2);
                                              $outerprice = $window->prices->outerprice;
                                              $outeram = $outerprice * $outprf;
                                             $outeramount = round($outeram,2);
                                                ?>
                                                <td>{{ $outerprofile}}</td> 
                                                <td></td>
                                                <td>{{ $window->prices->outerprice }}PKR</td> 
                                            <td>{{ $outeramount}}PKR</td> 
                                        </tr>
                                        
                                        <tr>
                                            <td>Outer steel frame </td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 2 }}</td>
                                            <td>{{  $outersteelrn }}</td>
                                            <?php
                                            $outersteelprofile = $outersteelrn/8;
                                            $outersteelprice = $window->prices->outersteelprice;
                                             $outersteelamount = $outersteelprofile* $outersteelprice;
                                            ?>
                                            <td></td> 
                                            <td>{{$outersteelprofile}}</td>
                                            <td>{{ $window->prices->outersteelprice }}PKR</td> 
                                        <td>{{ $outersteelamount}}PKR</td>
                                        
                                        </tr>
                                        
                                        <tr>
                                            <td>Casement Beeding 5mm</td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 2 }}</td>
                                            <td>{{  $slidebeedrn }}</td>
                                              <?Php
                                            $slidbeedprf =  $slidebeedrn / 18 ;
                                           $slidebeedprfile =round($slidbeedprf,2);
                                          $beedprice = $window->prices->slidebeedprice;
                                          $slidebeedam = $beedprice * $slidebeedprfile;
                                         $slidebeedamount = round($slidebeedam,2);
                                          
                                            ?>
                                            <td>{{ $slidebeedprfile}}</td> 
                                            <td></td>
                                            <td>{{$window->prices->slidebeedprice }}PKR</td> 
                                            <td>{{ $slidebeedamount}}PKR</td> 
                                        </tr>
                                        
                                        <tr>
                                            <td>Gaskit EPDM </td>
                                            <td>{{ $width * 4 }}</td>
                                            <td>{{ $height * 4 }}</td>
                                            <td>{{  $gaskitrn }}</td>
                                            <?php
                                            $gaskitprice = $window->prices->gaskitprice;
                                            $gaskitamount = $gaskitrn * $gaskitprice;
                                               
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td>{{ $window->prices->gaskitprice }}PKR</td> 
                                            <td>{{ $gaskitamount}}PKR</td> 
                                        </tr>
                                                                                  <tr>                                      <?php                                   $siliconprice =$window->pricesqty->siliconrate ;
                                                                                  $siliconqty =$window->pricesqty->siliconqty * $count;
                                            $siliconrate = $siliconprice *
                                            $siliconqty;
                                             $totalexpense =  $outeramount+     $outersteelamount+$slidebeedamount+$gaskitamount + $siliconrate;              ?>
                                             <td></td>
                                            <td></td>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td> 
                                            <td><h6>FixFrame Profile Cost</h6></td>
                                            <td>{{$totalexpense }}PKR</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                            <th>{{__('Steel Taping Screw')}}</th>
                                            <th>{{__('Concrete Screw')}}</th>
                                            <th>{{__('Silicon')}}</th>
                                            <th>{{__('Total Expense')}}</th>
                                                <th>{{__('Action')}}</th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        @if(!empty( $window->projwinacces))
                                        <?php
                                         $steeltapqty = $window->pricesqty->steeltapqty *  $count;
                                        $conscrewqty = $window->pricesqty->conscrewqty *  $count;
                                        $steeltap = $steeltapqty *  $window->pricesqty->steeltaprate;
                                        $conscrew = $conscrewqty *  $window->pricesqty->conscrewrate;
                                        $total = $steeltap + $conscrew +$siliconrate;
                                        
                                        ?>
                                        <tr>
                                            <td>{{ $steeltap }}PKR</td>
                                            <td>{{ $conscrew }}PKR</td>
                                            <td>{{ $siliconrate}}PKR</td> 
                                            <td>{{  $total }}PKR</td>
                                             <td>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-size="md" data-url="{{ route('slideacess.edit',$window->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Edit')}}" class="btn btn-sm">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        @else
                                        <tr><td>No data exist</td></tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
        
                    </div>
                </div>
            @elseif($window->designtype == "open")
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                            <tr>
                                               <th></th>                                     <th>{{__('Wx2')}}</th>
                                            <th>{{__('Hx2')}}</th>
                                            <th>{{__('Total')}}</th>
                                            <th>{{__('Prof.L=18')}}</th>
                                            <th>{{__('Kg')}}</th>
                                            <th>{{__('Rate')}}</th>
                                            <th>{{__('Amount')}}</th>
                                        </tr>
                                    
                                        
                                    
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td>OuterWard/Inward Frame</td>
                                                <td>{{ $width * 2 }}</td>
                                                <td>{{ $height * 2 }}</td>
                                                <td>{{  $outerrn }}</td>
                                                <?php
                                               $outprf =  $outerrn / 18 ;
                                               $outerprofile = ceil($outprf);
                                              $outerprice = $window->prices->outerprice;
                                              $outeramount = $outerprice * $outprf;
                                                ?>
                                                <td>{{ $outerprofile}}</td> 
                                                <td></td>
                                                <td>{{ $window->prices->outerprice }}PKR</td> 
                                            <td>{{round( $outeramount,2)}}PKR</td> 
                                            </tr>
                                            
                                        <tr>
                                                <td>Window Outward/Inward SAsh </td>
                                                <td>{{ $width * 4 }}</td>
                                                <td>{{ $height * 4 }}</td>
                                                <td>{{  $slidern }}</td>
                                                <?php
                                                  $slidprf =  $slidern / 18 ;
                                               $slideprofile = round($slidprf,2);
                                              $slideprice = $window->prices->slideprice;
                                              $slideamount = $slideprice * $slidprf;
                                                ?>
                                                <td>{{ $slideprofile}}</td> 
                                                <td></td>
                                                <td>{{ $window->prices->slideprice }}PKR</td> 
                                            <td>{{ round($slideamount,2)}}PKR</td> 
                                        </tr>
                                          <tr>
                                            <td>WindowSashBeed </td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 4 }}</td>
                                            <td>{{  $slidebeedrn }}</td>
                                              <?Php
                                            $slidbeedprf =  $slidebeedrn / 18 ;
                                           $slidebeedprfile = round($slidbeedprf,2);
                                          $beedprice = $window->prices->slidebeedprice;
                                          $slidebeedamount = $beedprice * $slidbeedprf;
                                            ?>
                                            <td>{{ $slidebeedprfile}}</td> 
                                            <td></td>
                                            <td>{{$window->prices->slidebeedprice }}PKR</td> 
                                            <td>{{ round($slidebeedamount,2)}}PKR</td> 
                                        </tr>
                                         <tr>
                                            <td>Outer steel frame </td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 2 }}</td>
                                            <td>{{  $outersteelrn }}</td>
                                            <?php
                                            $outersteelprofile = $outersteelrn/8;
                                            $outersteelprice = $window->prices->outersteelprice;
                                             $outersteelamount = $outersteelprofile* $outersteelprice;
                                            ?>
                                            <td></td> 
                                            <td>{{$outersteelprofile}}</td>
                                            <td>{{ $window->prices->outersteelprice }}PKR</td> 
                                        <td>{{ $outersteelamount}}PKR</td>
                                        
                                        </tr>
                                         <tr>
                                            <td>Window Sash Steel </td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 4 }}</td>
                                            <td>{{  $slidesteelrn }}</td>
                                                                                        <?php
                                                                                    $slidesteelprofile = $slidesteelrn/ 8;
                                           $slidesteelprice = $window->prices->slidesteelprice;
                                             $slidesteelamount = $slidesteelprofile * $slidesteelprice;
                                            ?>
                                            <td></td> 
                                            <td>{{$slidesteelprofile}}</td>
                                            <td>{{ $window->prices->slidesteelprice }}PKR</td> 
                                        <td>{{ $slidesteelamount}}PKR</td> 
                                        </tr>
                                         <tr>
                                            <td>Gaskit EPDM </td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 4 }}</td>
                                            <td>{{  $gaskitrn }}</td>
                                            <?php
                                            $gaskitprice = $window->prices->gaskitprice;
                                            $gaskitamount = $gaskitrn * $gaskitprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td>{{ $window->prices->gaskitprice }}PKR</td> 
                                            <td>{{ $gaskitamount}}PKR</td> 
                                        </tr>
                                         <tr>
                                            <td>Gaskit EPDM </td>
                                            <td>{{ $width * 2 }}</td>
                                            <td>{{ $height * 2 }}</td>
                                            <td>{{  $xgaskitrn }}</td>
                                            <?php
                                            $gaskitprice = $window->prices->gaskitprice;
                                            $xgaskitamount = $xgaskitrn * $gaskitprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td>{{ $window->prices->gaskitprice }}PKR</td> 
                                            <td>{{ $xgaskitamount}}PKR</td> 
                                        </tr>
                                        <tr>
                                            <td>Gaskit EPDM Beeding</td>
                                            <td>{{$height * 4}}</td>
                                            <td></td>
                                            <td>{{  $gaskitbeedrn }}</td>
                                            <?php
                                            $gaskitprice = $window->prices->gaskitbeedprice;
                                            $gaskitbeedamount = $gaskitbeedrn * $gaskitprice;
                                            ?>
                                            <td></td> 
                                            <td></td>
                                            <td>{{ $window->prices->gaskitbeedprice }}PKR</td> 
                                            <td>{{ $gaskitbeedamount}}PKR</td> 
                                        </tr>
                                         <tr>                                      <?
                                             $totalexpense =  $outeramount+  $slideamount+ $outersteelamount+$slidebeedamount+$slidesteelamount+$gaskitamount + $gaskitbeedamount + $xgaskitamount;              ?>
                                             <td></td>
                                            <td></td>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td> 
                                            <td><h6>Profile Cost</h6></td>
                                            <td>{{round($totalexpense,2) }}PKR</td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                            <th>{{__('Outward casement gear')}}</th>
                                            <th>{{__('Window stay 1 in 1')}}</th>
                                            <th>{{__('Friction stay hindge 2 in 1')}}</th>
                                            <th>{{__('Pencil hinges')}}</th>
                                            <th>{{__('Flat handle')}}</th>
                                            <th>{{__('2D hinges')}}</th>
                                            <th>{{__('3D Hindges')}}</th>
                                            <th>{{__('Openable keep')}}</th>
                                            <th>{{__('T-Lock')}}</th>
                                            <th>{{__('Cockspur Handle')}}</th>
                                            <th>{{__('Silicon ')}}</th>
                                            <th>{{__('Total Expense')}}</th>
                                            <th>{{__('Action')}}</th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        @if(!empty( $window->projwinacces))
                                        <tr>
                                        <?php
                                         $siliconqty = $window->openpricesqty->siliconqty * $count;
                                        $silicon = $siliconqty *  $window->openpricesqty->siliconrate;
                                        $outwardcaseqty = $window->openpricesqty->outwardcaseqty * $count;
                                        $outwardcase = $outwardcaseqty * $window->openpricesqty->outwardcaserate;
                                        $windowstayqty =  $window->openpricesqty->windowstayqty * $count;
                                        $windowstay= $windowstayqty * $window->openpricesqty->windowstayrate;
                                        $frictionstayqty =  $window->openpricesqty->frictionstayqty * $count;
                                        $frictionstay= $frictionstayqty *  $window->openpricesqty->frictionstayrate;
                                        $pencilhindgeqty =  $window->openpricesqty->pencilhindgeqty * $count;
                                        $pencilhindge= $pencilhindgeqty * $window->openpricesqty->pencilhindgerate;
                                         $flathandleqty =$window->openpricesqty->flathandleqty * $count;
                                        $flathandle= $flathandleqty * $window->openpricesqty->flathandlerate;
                                        $twoDhindgesqty = $window->openpricesqty->twoDhindgesqty * $count;
                                        $twoDhindges= $twoDhindgesqty * $window->openpricesqty->twoDhindgesrate;
                                        $thDhindgesqty = $window->openpricesqty->thDhindgesqty * $count;
                                        $thDhindges = $thDhindgesqty * $window->openpricesqty->thDhindgesrate;
                                        $openablekeepqty =  $window->openpricesqty->openablekeepqty * $count;
                                        $openablekeep = $openablekeepqty * $window->openpricesqty->openablekeeprate	;
                                         $cockspurqty =  $window->openpricesqty->cockspurqty * $count;
                                        $cockspurrate = $cockspurqty * $window->openpricesqty->cockspurrate	;
                                        $Tlockqty = $window->openpricesqty->Tlockqty * $count;
                                        $Tlock = $Tlockqty * $window->openpricesqty->Tlockrate	;
                                        ?>
                                            <td>{{$outwardcase}}PKR</td>
                                            <td>{{ $windowstay }}PKR</td>
                                            <td>{{ $frictionstay}}PKR</td> 
                                            <td>{{ $pencilhindge}}PKR</td> 
                                            <td>{{ $flathandle}}PKR</td> 
                                            <td>{{ $twoDhindges}}PKR</td> 
                                            <td>{{ $thDhindges}}PKR</td> 
                                            <td>{{ $openablekeep}}PKR</td> 
                                            <td>{{ $Tlock}}PKR</td> 
                                            <td>{{ $cockspurrate}}PKR</td> 
                                            <td>{{$silicon}}PKR</td>
                                            <td>{{  $window->projwinacces->total }}PKR</td>
                                             <td>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-size="md" data-url="{{ route('slideacess.edit',$window->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Edit')}}" class="btn btn-sm">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        @else
                                        <tr><td>No data exist</td></tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
        
                    </div>
                </div>
            @elseif($window->designtype == "door")
            
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th>{{__('Profile')}}</th>
                                                <th>{{__('Outer Frame')}}</th>
                                                <th>{{__('OuterSteelFrame')}}</th>
                                                <th>{{__('Gaskit EMBD')}}</th>
                                                <th>{{__('Door SAsh')}}</th>
                                                <th>{{__('DoorSashSteel')}}</th>
                                                <th>{{__('Gaskit EMBD')}}</th>
                                                <th>{{__('WindowSashBeed')}}</th>
                                                <th>{{__('Gaskit Beeding')}}</th>
                                                <th>{{__('Fix Panel')}}</th>
                                                    <th>{{__('Total Expense')}}</th>
                                         
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td>{{ $window->frame }}PKR</td>
                                            <td>{{ $window->outeramount }}PKR</td>
                                            <td>{{ $window->outersteelamount}}PKR</td>
                                            <td>{{ $window->gaskitamount }}PKR</td>
                                            <td>{{  $window->slideamount }}PKR</td>
                                            <td>{{ $window->slidesteelamount }}PKR</td>
                                            <td>{{ $window->xgaskitamount }}PKR</td>
                                            <td>{{ $window->slidebeedamount }}PKR</td>
                                            <td>{{ $window->gaskitbeedamount }}PKR</td>
                                            <td>{{ $window->fixpanelamount }}PKR</td>
                                            <td>{{ $window->totalexpense }}PKR</td> 
                    
                                                </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                            <th>{{__('Imported handle espanglet+ cylider')}}</th>
                                            <th>{{__('Imported handle and cylinder ')}}</th>
                                            <th>{{__('Imported Handle ')}}</th>
                                            <th>{{__('T-Lock ')}}</th>
                                            <th>{{__('Cockspurhandle ')}}</th>
                                            <th>{{__('3d hinges 6 in1 ')}}</th>
                                            <th>{{__(' 2d hinges 6 in1 ')}}</th>
                                             <th>{{__('Silicon ')}}</th>
                                            <th>{{__('Total Expense')}}</th>
                                                <th>{{__('Action')}}</th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        @if(!empty( $window->projwinacces))
                                        <tr>
                                            <td>{{ $window->projwinacces->imphandlesprate }}PKR</td>
                                            <td>{{ $window->projwinacces->imphandlecylrate }}PKR</td>
                                            <td>{{ $window->projwinacces->imphandlerate}}PKR</td> 
                                            <td>{{ $window->projwinacces->Tlockrate}}PKR</td> 
                                            <td>{{ $window->projwinacces->cockspurrate}}PKR</td> 
                                            <td>{{ $window->projwinacces->twoDhindgesrate}}PKR</td> 
                                            <td>{{ $window->projwinacces->thDhindgesrate}}PKR</td> 
                                            <td>{{ $window->projwinacces->siliconrate}}PKR</td>
                                            <td>{{  $window->projwinacces->total }}PKR</td>
                                             <td>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-size="md" data-url="{{ route('slideacess.edit',$window->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Edit')}}" class="btn btn-sm">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        @else
                                        <tr><td>No data exist</td></tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
        
                    </div>
                </div>
            @else
            @endif
        </div>

</div>
@endsection

