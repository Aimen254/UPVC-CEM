<?php

namespace App\Http\Controllers;

use App\Models\ProjectWindow;
use App\Models\ProjWindowAcces;
use App\Models\Frame;
use App\Models\AssignWindow;
use App\Models\UserSlidingAccess;
use App\Models\OpenAssignAccess;
use App\Models\Project;
use App\Models\Pipeline;
use Illuminate\Http\Request;

class ProjectWindowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usr = \Auth::user();
        if($usr->default_pipeline)
        {
            $pipeline = Pipeline::where('created_by', '=', $usr->creatorId())->where('id', '=', $usr->default_pipeline)->first();
            if(!$pipeline)
            {
                $pipeline = Pipeline::where('created_by', '=', $usr->creatorId())->first();
            }
        }
        else
        {
            $pipeline = Pipeline::where('created_by', '=', $usr->creatorId())->first();
        }

        $pipelines = Pipeline::where('created_by', '=', $usr->creatorId())->get()->pluck('name', 'id');
        $images = Frame::where('created_by', '=', \Auth::user()->creatorId())->get();
        return view('projectwindows.index', compact('pipeline,images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(\Auth::user()->can('create product & service'))
        {
           $project= Project::find($id);
            // $users->prepend(__('Select User'), '');
              $slideaccess          = AssignWindow::where('created_by', '=', \Auth::user()->creatorId())->where('type', 'sliding')->get()->pluck('profile', 'id');
             $openaccess          = AssignWindow::where('created_by', '=', \Auth::user()->creatorId())->where('type', 'openable')->get()->pluck('profile', 'id');
             $fixaccess          = AssignWindow::where('created_by', '=', \Auth::user()->creatorId())->where('type', 'fix')->get()->pluck('profile', 'id');

            return view('projectwindows.create', compact('slideaccess', 'openaccess', 'fixaccess', 'project'));
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }
      public function doorcreate($id)
    {
        if(\Auth::user()->can('create product & service'))
        {
           $project= Project::find($id);
            // $users->prepend(__('Select User'), '');
            $dooraccess          = AssignWindow::where('type', '=', 'door')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('profile', 'id');          

            return view('projectwindows.doorcreate', compact('project','dooraccess'));
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }
    
        function checkprofile($project_id,$request){
            $usr = \Auth::user();
            $width = $request->width;
            $height = $request->height;
            $type = $request->type;
            $image = $request->image;
            $frame = AssignWindow::find($request->frame_id);
            $profile = new ProjectWindow();
            $profile->frame_id= $request->frame_id;
            $profile->project  = $project_id;
             $profile->frame= $frame->profile;
            $profile->company= $frame->company;
            $profile->height= $request->height;
            $profile->width= $request->width;
            $profile->designtype= $request->designtype;
            $profile->designtyperatio= $request->designtyperatio;
            $profile->typequantity= $request->typequantity;
            // $proj->quantity = $request->quantity;
            $profile->created_by= $usr->creatorId();
            $insert = $profile->save();
            if($type == "gear_handles"){
                $typequantity = $request->typequantity;
                $typeprice = $profile->prices->gearprice;
                $typeamount = $typequantity * $typeprice;
            }else if($type == "interlock"){
                $typequantity = $request->typequantity;
                $typeprice = $profile->prices->latchlockprice;
                 $typeamount = $typequantity * $typeprice;
            }else{
                $typequantity = $request->typequantity;
                $typeprice = $profile->prices->cockspurprice;
                 $typeamount = $typequantity * $typeprice;
            }


             $outertotal = $width * 2 + $height * 2;
             $slidetotal =  $width * 2 + $height * 4;
             $nettotal = $width + $height *2;
             $netsteeltotal =  $height *2;
             $slidebeed = $width * 2 + $height * 4;
             $net = $width + $height * 2;
             $gaskit = $width * 2 + $height * 4;
             $netgaskit = $width * 2 + $height * 2;
             $slidebrush = $width  + $height * 4;
             $aluminiumrail = $width;
             $interlock = $height * 2;

             $outerprofile = $outertotal / 18;
             $outersteelprofile = $outertotal / 8;
             $netprofile = $nettotal / 18; 
            //  return round($netprofile,0,PHP_ROUND_HALF_DOWN);
             $netsteelprofile = $netsteeltotal / 8;
             $slideprofile =  $slidetotal / 18;  
             $slidesteelprofile =  $slidetotal / 8;
             $slidebeedprfile = $slidebeed / 18;
             $nettprofile = $net / 4;
             $interlockprofile = $interlock / 18;            

            //  $outerprice = $profile->price($profile->frame);
            $outerprice = $profile->prices->outerprice;
            $outersteelprice = $profile->prices->outersteelprice;
            $slideprice = $profile->prices->slideprice;
            $slidesteelprice = $profile->prices->slidesteelprice;
            $netprice = $profile->prices->netprice;
            $netsteelprice = $profile->prices->netsteelprice;
            $slidebeedprice= $profile->prices->slidebeedprice;
            $nettprice = $profile->prices->nettprice;
            $gaskitprice =  $profile->prices->gaskitprice;
            $netgaskitprice =  $profile->prices->netgaskitprice;
            $slidingbrushprice =  $profile->prices->slidingbrushprice;
            $aluminiumrailprice =  $profile->prices->aluminiumrailprice;
            $interlockprice =  $profile->prices->interlockprice;
          

            $outeramount =  ceil( $outerprofile ) * $outerprice;
            $slideamount =  ceil($slideprofile) * $slideprice;
            $netamount = ceil($netprofile) * $netprice;
            $slidebeedamount = ceil($slidebeedprfile) * $slidebeedprice;
            $interlockamount =  $interlockprice *  ceil($interlockprofile);
            $totalprofile =   $outeramount+$slideamount+ $netamount +$slidebeedamount+ $interlockamount;

            $outersteelamount =  $outersteelprofile * $outersteelprice;
            $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
            $netsteelamount = $netsteelprofile * $netsteelprice;

            $nettamount = $nettprofile * $nettprice;
            $netgaskitamount = $netgaskit  * $netgaskitprice;
            $gaskitamount = $gaskit  * $gaskitprice;
            $slidingbrushamount = $slidebrush  * $slidingbrushprice;
            $aluminiumrailamount = $aluminiumrail * $aluminiumrailprice;
           
            $total = $outeramount +  $outersteelamount + $slideamount  +$slidesteelamount +  
            $netamount +  $netsteelamount +   $slidebeedamount + $typeamount + $nettamount +  $netgaskitamount
            + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount;
            $totalexpense = $total;
            
            $fileName = time() . "_" . $image->getClientOriginalName();
            $path =    $image->storeAs('uploads/windows/', $fileName);
               $profile->image = $fileName;
               $profile->url = $path;

            $profile->outeramount = $outeramount;
            
            $profile->outerprofile = ceil( $outerprofile );
            $profile->outersteelprofile = ceil( $outerprofile );
            $profile->netprofile = ceil($netprofile);
            $profile->netsteelprofile =ceil( $netsteelprofile);
            $profile->slideprofile = ceil($slideprofile);
            $profile->slidesteelprofile = ceil($slidesteelprofile);
            $profile->slidebeedprfile = ceil($slidebeedprfile);
            $profile->nettprofile = ceil($nettprofile);
            $profile->interlockprofile = ceil($interlockprofile);
        
            $profile->outerrn = $outertotal;
            $profile->slidern =$slidetotal;
            $profile->netframrn =$nettotal;
            $profile->slidebeedrn =$slidebeed;
            $profile->interlockrn =$interlock;
            $profile->outersteelrn =$outertotal;
            $profile->slidesteelrn =$slidetotal;
            $profile->netframesteelrn =$netsteeltotal;
            $profile->netrn =$net;
            $profile->gaskitrn =$gaskit;
            $profile->netgaskitrn =$netgaskit;
            $profile->brushrolrn =$slidebrush;
            $profile->aluminiumrn =$aluminiumrail;
            
            $profile->outersteelamount = $outersteelamount;
            $profile->slideamount = $slideamount;
            $profile->slidesteelamount = $slidesteelamount;
            $profile->netamount = $netamount;
            $profile->netsteelamount = $netsteelamount;
            $profile->slidebeedamount = $slidebeedamount;
            $profile->typeamount = $typeamount;
            $profile->nettamount  = $nettamount ;
            $profile->netgaskitamount = $netgaskitamount;
            $profile->gaskitamount=$gaskitamount;
            $profile->slidingbrushamount=$slidingbrushamount;
            $profile->aluminiumrailamount=$aluminiumrailamount;
            $profile->interlockamount=$interlockamount;
            // $profile->totalexpense = $totalexpense;
               $acesstotal =  $this->access($profile, $width,$height,$project_id);
        $profile->totalexpense = $totalexpense;
        $profile->hardwarecost = $acesstotal;
        $profile->totalcost = $totalexpense + $acesstotal;
            $insert=$profile->update();
            // if ($insert){

            //     return redirect()->back()->with('success', __('Value added successfully.'));
            //     }
            
        }
      function Asaspenprofile($project_id,$request){
            $usr = \Auth::user();
            $width = $request->width;
            $height = $request->height;
            $type = $request->type;
            $image = $request->image;
           $frame = AssignWindow::where('profile' ,'ASASPEN(98-73(white))')->first();
            $profile = new ProjectWindow();
            $profile->frame_id= $request->frame_id;
            $profile->project  = $project_id;
             $profile->frame= $frame->profile;
            $profile->company= $frame->company;
            $profile->height= $request->height;
            $profile->width= $request->width;
            $profile->designtype= $request->designtype;
            $profile->designtyperatio= $request->designtyperatio;
            $profile->typequantity= $request->typequantity;
            // $proj->quantity = $request->quantity;
            $profile->created_by= $usr->creatorId();
            $insert = $profile->save();
            if($type == "gear_handles"){
                $typequantity = $request->typequantity;
                $typeprice = $profile->prices->gearprice;
                $typeamount = $typequantity * $typeprice;
            }else if($type == "interlock"){
                $typequantity = $request->typequantity;
                $typeprice = $profile->prices->latchlockprice;
                 $typeamount = $typequantity * $typeprice;
            }else{
                $typequantity = $request->typequantity;
                $typeprice = $profile->prices->cockspurprice;
                 $typeamount = $typequantity * $typeprice;
            }


             $outertotal = $width * 2 + $height * 2;
             $slidetotal =  $width * 2 + $height * 4;
             $nettotal = $width + $height *2;
             $netsteeltotal =  $height *2;
             $slidebeed = $width * 2 + $height * 4;
             $net = $width + $height * 2;
             $gaskit = $width * 2 + $height * 4;
             $netgaskit = $width * 2 + $height * 2;
             $slidebrush = $width  + $height * 4;
             $aluminiumrail = $width;
             $interlock = $height * 2;

             $outerprofile = $outertotal / 18;
             $outersteelprofile = $outertotal / 8;
             $netprofile = $nettotal / 18; 
            //  return round($netprofile,0,PHP_ROUND_HALF_DOWN);
             $netsteelprofile = $netsteeltotal / 8;
             $slideprofile =  $slidetotal / 18;  
             $slidesteelprofile =  $slidetotal / 8;
             $slidebeedprfile = $slidebeed / 18;
             $nettprofile = $net / 4;
             $interlockprofile = $interlock / 18;            

            //  $outerprice = $profile->price($profile->frame);
            $outerprice = $profile->prices->outerprice;
            $outersteelprice = $profile->prices->outersteelprice;
            $slideprice = $profile->prices->slideprice;
            $slidesteelprice = $profile->prices->slidesteelprice;
            $netprice = $profile->prices->netprice;
            $netsteelprice = $profile->prices->netsteelprice;
            $slidebeedprice= $profile->prices->slidebeedprice;
            $nettprice = $profile->prices->nettprice;
            $gaskitprice =  $profile->prices->gaskitprice;
            $netgaskitprice =  $profile->prices->netgaskitprice;
            $slidingbrushprice =  $profile->prices->slidingbrushprice;
            $aluminiumrailprice =  $profile->prices->aluminiumrailprice;
            $interlockprice =  $profile->prices->interlockprice;
          

            $outeramount =  ceil( $outerprofile ) * $outerprice;
            $slideamount =  ceil($slideprofile) * $slideprice;
            $netamount = ceil($netprofile) * $netprice;
            $slidebeedamount = ceil($slidebeedprfile) * $slidebeedprice;
            $interlockamount =  $interlockprice *  ceil($interlockprofile);
            $totalprofile =   $outeramount+$slideamount+ $netamount +$slidebeedamount+ $interlockamount;

            $outersteelamount =  $outersteelprofile * $outersteelprice;
            $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
            $netsteelamount = $netsteelprofile * $netsteelprice;

            $nettamount = $nettprofile * $nettprice;
            $netgaskitamount = $netgaskit  * $netgaskitprice;
            $gaskitamount = $gaskit  * $gaskitprice;
            $slidingbrushamount = $slidebrush  * $slidingbrushprice;
            $aluminiumrailamount = $aluminiumrail * $aluminiumrailprice;
           
            $total = $outeramount +  $outersteelamount + $slideamount  +$slidesteelamount +  
            $netamount +  $netsteelamount +   $slidebeedamount + $typeamount + $nettamount +  $netgaskitamount
            + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount;
            $totalexpense = $total;
            
            $fileName = time() . "_" . $image->getClientOriginalName();
            $path =    $image->storeAs('uploads/windows/', $fileName);
               $profile->image = $fileName;
               $profile->url = $path;

            $profile->outeramount = $outeramount;
            
              $profile->outerprofile = ceil( $outerprofile );
            $profile->outersteelprofile = ceil( $outerprofile );
            $profile->netprofile = ceil($netprofile);
            $profile->netsteelprofile =ceil( $netsteelprofile);
            $profile->slideprofile = ceil($slideprofile);
            $profile->slidesteelprofile = ceil($slidesteelprofile);
            $profile->slidebeedprfile = ceil($slidebeedprfile);
            $profile->nettprofile = ceil($nettprofile);
            $profile->interlockprofile = ceil($interlockprofile);
        
            $profile->outerrn = $outertotal;
            $profile->slidern =$slidetotal;
            $profile->netframrn =$nettotal;
            $profile->slidebeedrn =$slidebeed;
            $profile->interlockrn =$interlock;
            $profile->outersteelrn =$outertotal;
            $profile->slidesteelrn =$slidetotal;
            $profile->netframesteelrn =$netsteeltotal;
            $profile->netrn =$net;
            $profile->gaskitrn =$gaskit;
            $profile->netgaskitrn =$netgaskit;
            $profile->brushrolrn =$slidebrush;
            $profile->aluminiumrn =$aluminiumrail;
            
            $profile->outersteelamount = $outersteelamount;
            $profile->slideamount = $slideamount;
            $profile->slidesteelamount = $slidesteelamount;
            $profile->netamount = $netamount;
            $profile->netsteelamount = $netsteelamount;
            $profile->slidebeedamount = $slidebeedamount;
            $profile->typeamount = $typeamount;
            $profile->nettamount  = $nettamount ;
            $profile->netgaskitamount = $netgaskitamount;
            $profile->gaskitamount=$gaskitamount;
            $profile->slidingbrushamount=$slidingbrushamount;
            $profile->aluminiumrailamount=$aluminiumrailamount;
            $profile->interlockamount=$interlockamount;
            // $profile->totalexpense = $totalexpense;
               $acesstotal =  $this->access($profile, $width,$height,$project_id);
         $profile->totalexpense = $totalexpense;
        $profile->hardwarecost = $acesstotal;
        $profile->totalcost = $totalexpense + $acesstotal;
            $insert=$profile->update();
            // if ($insert){

            //     return redirect()->back()->with('success', __('Value added successfully.'));
            //     }
            
        }
        function doublesliderprofile($profile, $width,$height,$typeamount,$image,$project_id){
        // if($profile->frame == "80-66(white)"){
           
             $outertotal = $width * 2 + $height * 2;
             $slidetotal =  $width * 2 + $height * 4;
             $nettotal = $width + $height *2;
             $slidebeed = $width * 2 + $height * 8;
             $interlock = $height * 4;
            
             $netsteeltotal =  $height *2;
             $net = $width + $height * 2;
             $gaskit = $width * 2 + $height * 4;
             $netgaskit = $width * 2 + $height * 2;
             $slidebrush = $width  + $height * 4;
             $aluminiumrail = $width;
            
    
             $outerprofile = $outertotal / 18;
             $outersteelprofile = $outertotal / 8;
             $netprofile = $nettotal / 18; 
            //  return round($netprofile,0,PHP_ROUND_HALF_DOWN);
             $netsteelprofile = $netsteeltotal / 8;
             $slideprofile =  $slidetotal / 18;  
             $slidesteelprofile =  $slidetotal / 8;
             $slidebeedprfile = $slidebeed / 18;
             $nettprofile = $net / 4;
             $interlockprofile = $interlock / 18;            
    
            //  $outerprice = $profile->price($profile->frame);
            $outerprice = $profile->prices->outerprice;
            $outersteelprice = $profile->prices->outersteelprice;
            $slideprice = $profile->prices->slideprice;
            $slidesteelprice = $profile->prices->slidesteelprice;
            $netprice = $profile->prices->netprice;
            $netsteelprice = $profile->prices->netsteelprice;
            $slidebeedprice= $profile->prices->slidebeedprice;
            $nettprice = $profile->prices->nettprice;
            $gaskitprice =  $profile->prices->gaskitprice;
            $netgaskitprice =  $profile->prices->netgaskitprice;
            $slidingbrushprice =  $profile->prices->slidingbrushprice;
            $aluminiumrailprice =  $profile->prices->aluminiumrailprice;
            $interlockprice =  $profile->prices->interlockprice;
    
          
    
            $outeramount =  ceil( $outerprofile ) * $outerprice;
            $slideamount =  ceil($slideprofile) * $slideprice;
            $netamount = ceil($netprofile) * $netprice;
            $slidebeedamount = ceil($slidebeedprfile) * $slidebeedprice;
            $interlockamount =  $interlockprice *  ceil($interlockprofile);
            $totalprofile =   $outeramount+$slideamount+ $netamount +$slidebeedamount+ $interlockamount;
    
            $outersteelamount =  $outersteelprofile * $outersteelprice;
            $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
            $netsteelamount = $netsteelprofile * $netsteelprice;
    
            $nettamount = $nettprofile * $nettprice;
            $netgaskitamount = $netgaskit  * $netgaskitprice;
            $gaskitamount = $gaskit  * $gaskitprice;
            $slidingbrushamount = $slidebrush  * $slidingbrushprice;
            $aluminiumrailamount = $aluminiumrail * $aluminiumrailprice;
           
            $total = $outeramount +  $outersteelamount + $slideamount  +$slidesteelamount +  
            $netamount +  $netsteelamount +   $slidebeedamount + $typeamount + $nettamount +  $netgaskitamount
            + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount;
            $totalexpense = $total;
            
            $fileName = time() . "_" . $image->getClientOriginalName();
            $path =    $image->storeAs('uploads/windows', $fileName);
               $profile->image = $fileName;
               $profile->url = $path;
    
            $profile->outeramount = $outeramount;
            
            $profile->outerrn = $outertotal;
            $profile->slidern =$slidetotal;
            $profile->netframrn =$nettotal;
            $profile->slidebeedrn =$slidebeed;
            $profile->interlockrn =$interlock;
            $profile->outersteelrn =$outertotal;
            $profile->slidesteelrn =$slidetotal;
            $profile->netframesteelrn =$netsteeltotal;
            $profile->netrn =$net;
            $profile->gaskitrn =$gaskit;
            $profile->netgaskitrn =$netgaskit;
            $profile->brushrolrn =$slidebrush;
            $profile->aluminiumrn =$aluminiumrail;
            
            $profile->outersteelamount = $outersteelamount;
            $profile->slideamount = $slideamount;
            $profile->slidesteelamount = $slidesteelamount;
            $profile->netamount = $netamount;
            $profile->netsteelamount = $netsteelamount;
            $profile->slidebeedamount = $slidebeedamount;
            $profile->typeamount = $typeamount;
            $profile->nettamount  = $nettamount ;
            $profile->netgaskitamount = $netgaskitamount;
            $profile->gaskitamount=$gaskitamount;
            $profile->slidingbrushamount=$slidingbrushamount;
            $profile->aluminiumrailamount=$aluminiumrailamount;
            $profile->interlockamount=$interlockamount;
            // $profile->totalexpense = $totalexpense;
               $acesstotal =  $this->doubleaccess($profile, $width,$height,$project_id);
        $profile->totalexpense = $totalexpense + $acesstotal;
            $insert=$profile->update();
            if ($insert){
    
                return redirect()->back()->with('success', __('Value added successfully.'));
                }
        
    //   }
        
      }
      
      function winplastprofile($project_id, $request){
       $usr = \Auth::user();
        $width = $request->width;
        $height = $request->height;
        $type = $request->type;
        $image = $request->image;
        $frame = AssignWindow::where('profile' ,'Winplast(80-66(white))')->first();
        $profile = new ProjectWindow();
        $profile->frame_id= $frame->id;
        $profile->project  = $project_id;
         $profile->frame= $frame->profile;
         $profile->company= $frame->company;
        $profile->height= $request->height;
        $profile->width= $request->width;
        $profile->designtype= $request->designtype;
        $profile->designtyperatio= $request->designtyperatio;
        $profile->typequantity= $request->typequantity;
        // $proj->quantity = $request->quantity;
        $profile->created_by= $usr->creatorId();
        $insert = $profile->save();
        if($type == "gear_handles"){
            $typequantity = $request->typequantity;
            $typeprice = $profile->prices->gearprice;
            $typeamount = $typequantity * $typeprice;
        }else if($type == "interlock"){
            $typequantity = $request->typequantity;
            $typeprice = $profile->prices->latchlockprice;
             $typeamount = $typequantity * $typeprice;
        }else{
            $typequantity = $request->typequantity;
            $typeprice = $proj->prices->cockspurprice;
             $typeamount = $typequantity * $typeprice;
        }

         $outertotal = $width * 2 + $height * 2;
         $slidetotal =  $width * 2 + $height * 4;
         $nettotal = $width + $height *2;
         $slidebeed = $width * 2 + $height * 4;
         $interlock = $height * 2;
         $netsteeltotal =  $height *2;
         $net = $width + $height * 2;
         $gaskit = $width * 2 + $height * 4;
         $netgaskit = $width * 2 + $height * 2;
         $slidebrush = $width  + $height * 4;
         $aluminiumrail = $width;
        

         $outerprofile = $outertotal / 18;
         $outersteelprofile = $outertotal / 8;
         $netprofile = $nettotal / 18; 
        //  return round($netprofile,0,PHP_ROUND_HALF_DOWN);
         $netsteelprofile = $netsteeltotal / 8;
         $slideprofile =  $slidetotal / 18;  
         $slidesteelprofile =  $slidetotal / 8;
         $slidebeedprfile = $slidebeed / 18;
         $nettprofile = $net / 4;
         $interlockprofile = $interlock / 18;            

        //  $outerprice = $profile->price($profile->frame);
        $outerprice = $profile->prices->outerprice;
        $outersteelprice = $profile->prices->outersteelprice;
        $slideprice = $profile->prices->slideprice;
        $slidesteelprice = $profile->prices->slidesteelprice;
        $netprice = $profile->prices->netprice;
        $netsteelprice = $profile->prices->netsteelprice;
        $slidebeedprice= $profile->prices->slidebeedprice;
        $nettprice = $profile->prices->nettprice;
        $gaskitprice =  $profile->prices->gaskitprice;
        $netgaskitprice =  $profile->prices->netgaskitprice;
        $slidingbrushprice =  $profile->prices->slidingbrushprice;
        $aluminiumrailprice =  $profile->prices->aluminiumrailprice;
        $interlockprice =  $profile->prices->interlockprice;

        $outerw = $profile->prices->outerw;
        $slidew = $profile->prices->slidew;
        $netframw = $profile->prices->netframw;
        $beedingw = $profile->prices->beedingw;
        $interlockw = $profile->prices->interlockw;


        $outeramount =  ceil( $outerprofile ) * $outerprice * $outerw;
        $slideamount =  ceil($slideprofile) * $slideprice * $slidew;
        $netamount = ceil($netprofile) * $netprice * $netframw;
        $slidebeedamount = ceil($slidebeedprfile) * $slidebeedprice * $beedingw;
        $interlockamount =  $interlockprice *  ceil($interlockprofile) *$interlockw;
        $totalprofile =   $outeramount+$slideamount+ $netamount +$slidebeedamount+ $interlockamount;

        $outersteelamount =  $outersteelprofile * $outersteelprice;
        $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
        $netsteelamount = $netsteelprofile * $netsteelprice;

        $nettamount = $nettprofile * $nettprice;
        $netgaskitamount = $netgaskit  * $netgaskitprice;
        $gaskitamount = $gaskit  * $gaskitprice;
        $slidingbrushamount = $slidebrush  * $slidingbrushprice;
        $aluminiumrailamount = $aluminiumrail * $aluminiumrailprice;
       
        $total = $outeramount +  $outersteelamount + $slideamount  +$slidesteelamount +  
        $netamount +  $netsteelamount +   $slidebeedamount + $typeamount + $nettamount +  $netgaskitamount
        + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount;
        $totalexpense = $total;
        
        $fileName = time() . "_" . $image->getClientOriginalName();
        $path =    $image->storeAs('uploads/windows', $fileName);
           $profile->image = $fileName;
           $profile->url = $path;

        $profile->outeramount = $outeramount;
        
          $profile->outerprofile = ceil( $outerprofile );
        $profile->outersteelprofile = ceil( $outerprofile );
        $profile->netprofile = ceil($netprofile);
        $profile->netsteelprofile =ceil( $netsteelprofile);
        $profile->slideprofile = ceil($slideprofile);
        $profile->slidesteelprofile = ceil($slidesteelprofile);
        $profile->slidebeedprfile = ceil($slidebeedprfile);
        $profile->nettprofile = ceil($nettprofile);
        $profile->interlockprofile = ceil($interlockprofile);
        
        $profile->outerrn = $outertotal;
        $profile->slidern =$slidetotal;
        $profile->netframrn =$nettotal;
        $profile->slidebeedrn =$slidebeed;
        $profile->interlockrn =$interlock;
        $profile->outersteelrn =$outertotal;
        $profile->slidesteelrn =$slidetotal;
        $profile->netframesteelrn =$netsteeltotal;
        $profile->netrn =$net;
        $profile->gaskitrn =$gaskit;
        $profile->netgaskitrn =$netgaskit;
        $profile->brushrolrn =$slidebrush;
        $profile->aluminiumrn =$aluminiumrail;
        
        $profile->outersteelamount = $outersteelamount;
        $profile->slideamount = $slideamount;
        $profile->slidesteelamount = $slidesteelamount;
        $profile->netamount = $netamount;
        $profile->netsteelamount = $netsteelamount;
        $profile->slidebeedamount = $slidebeedamount;
        $profile->typeamount = $typeamount;
        $profile->nettamount  = $nettamount ;
        $profile->netgaskitamount = $netgaskitamount;
        $profile->gaskitamount=$gaskitamount;
        $profile->slidingbrushamount=$slidingbrushamount;
        $profile->aluminiumrailamount=$aluminiumrailamount;
        $profile->interlockamount=$interlockamount;
        // $profile->totalexpense = $totalexpense;
        $acesstotal =  $this->access($profile, $width,$height,$project_id);
        $profile->totalexpense = $totalexpense;
        $profile->hardwarecost = $acesstotal;
        $profile->totalcost = $totalexpense + $acesstotal;
        $insert=$profile->update();
        // if ($insert){

        //     return redirect()->back()->with('success', __('Value added successfully.'));
        //     }
        
    //   }
        
      }
      
       function doublewinplastprofile($profile, $width,$height,$typeamount,$image,$project_id){
        // if($profile->frame == "80-66(white)"){

         $outertotal = $width * 2 + $height * 2;
         $slidetotal =  $width * 2 + $height * 4;
         $nettotal = $width + $height *2;
         $slidebeed = $width * 2 + $height * 8;
         $interlock = $height * 4;
         $netsteeltotal =  $height *2;
         $net = $width + $height * 2;
         $gaskit = $width * 2 + $height * 4;
         $netgaskit = $width * 2 + $height * 2;
         $slidebrush = $width  + $height * 4;
         $aluminiumrail = $width;
        

         $outerprofile = $outertotal / 18;
         $outersteelprofile = $outertotal / 8;
         $netprofile = $nettotal / 18; 
        //  return round($netprofile,0,PHP_ROUND_HALF_DOWN);
         $netsteelprofile = $netsteeltotal / 8;
         $slideprofile =  $slidetotal / 18;  
         $slidesteelprofile =  $slidetotal / 8;
         $slidebeedprfile = $slidebeed / 18;
         $nettprofile = $net / 4;
         $interlockprofile = $interlock / 18;            

        //  $outerprice = $profile->price($profile->frame);
        $outerprice = $profile->prices->outerprice;
        $outersteelprice = $profile->prices->outersteelprice;
        $slideprice = $profile->prices->slideprice;
        $slidesteelprice = $profile->prices->slidesteelprice;
        $netprice = $profile->prices->netprice;
        $netsteelprice = $profile->prices->netsteelprice;
        $slidebeedprice= $profile->prices->slidebeedprice;
        $nettprice = $profile->prices->nettprice;
        $gaskitprice =  $profile->prices->gaskitprice;
        $netgaskitprice =  $profile->prices->netgaskitprice;
        $slidingbrushprice =  $profile->prices->slidingbrushprice;
        $aluminiumrailprice =  $profile->prices->aluminiumrailprice;
        $interlockprice =  $profile->prices->interlockprice;

        $outerw = $profile->prices->outerw;
        $slidew = $profile->prices->slidew;
        $netframw = $profile->prices->netframw;
        $beedingw = $profile->prices->beedingw;
        $interlockw = $profile->prices->interlockw;


        $outeramount =  ceil( $outerprofile ) * $outerprice * $outerw;
        $slideamount =  ceil($slideprofile) * $slideprice * $slidew;
        $netamount = ceil($netprofile) * $netprice * $netframw;
        $slidebeedamount = ceil($slidebeedprfile) * $slidebeedprice * $beedingw;
        $interlockamount =  $interlockprice *  ceil($interlockprofile) *$interlockw;
        $totalprofile =   $outeramount+$slideamount+ $netamount +$slidebeedamount+ $interlockamount;

        $outersteelamount =  $outersteelprofile * $outersteelprice;
        $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
        $netsteelamount = $netsteelprofile * $netsteelprice;

        $nettamount = $nettprofile * $nettprice;
        $netgaskitamount = $netgaskit  * $netgaskitprice;
        $gaskitamount = $gaskit  * $gaskitprice;
        $slidingbrushamount = $slidebrush  * $slidingbrushprice;
        $aluminiumrailamount = $aluminiumrail * $aluminiumrailprice;
       
        $total = $outeramount +  $outersteelamount + $slideamount  +$slidesteelamount +  
        $netamount +  $netsteelamount +   $slidebeedamount + $typeamount + $nettamount +  $netgaskitamount
        + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount;
        $totalexpense = $total;
        
        $fileName = time() . "_" . $image->getClientOriginalName();
        $path =    $image->storeAs('uploads/windows', $fileName);
           $profile->image = $fileName;
           $profile->url = $path;

        $profile->outeramount = $outeramount;
        
        $profile->outern = $outertotal;
        $profile->slidern =$slidetotal;
        $profile->netframrn =$nettotal;
        $profile->slidebeedrn =$slidebeed;
        $profile->interlockrn =$interlock;
        $profile->outersteelrn =$outertotal;
        $profile->slidesteelrn =$slidetotal;
        $profile->netframesteelrn =$netsteeltotal;
        $profile->netrn =$net;
        $profile->gaskitrn =$gaskit;
        $profile->netgaskitrn =$netgaskit;
        $profile->brushrolrn =$slidebrush;
        $profile->aluminiumrn =$aluminiumrail;
        
        $profile->outersteelamount = $outersteelamount;
        $profile->slideamount = $slideamount;
        $profile->slidesteelamount = $slidesteelamount;
        $profile->netamount = $netamount;
        $profile->netsteelamount = $netsteelamount;
        $profile->slidebeedamount = $slidebeedamount;
        $profile->typeamount = $typeamount;
        $profile->nettamount  = $nettamount ;
        $profile->netgaskitamount = $netgaskitamount;
        $profile->gaskitamount=$gaskitamount;
        $profile->slidingbrushamount=$slidingbrushamount;
        $profile->aluminiumrailamount=$aluminiumrailamount;
        $profile->interlockamount=$interlockamount;
        // $profile->totalexpense = $totalexpense;
         $acesstotal =  $this->doubleaccess($profile, $width,$height,$project_id);
        $profile->totalexpense = $totalexpense + $acesstotal;
        $insert=$profile->update();
        if ($insert){

            return redirect()->back()->with('success', __('Value added successfully.'));
            }
        
    //   }
        
      }
       function fixprofile($profile, $width,$height,$image,$project_id){
        // if($profile->frame == "80-66(white)"){

         $outertotal = $width * 2 + $height * 2;
         $slidebeed = $width * 2 + $height * 2;
         $gaskit = $width * 4 + $height * 4;

         $outerprofile = $outertotal / 18;
         $outersteelprofile = $outertotal / 8;
         $slidebeedprfile = $slidebeed / 18;          

        //  $outerprice = $profile->price($profile->frame);
        $outerprice = $profile->prices->outerprice;
        $outersteelprice = $profile->prices->outersteelprice;
        $slidebeedprice= $profile->prices->slidebeedprice;
        $gaskitprice =  $profile->prices->gaskitprice;

        $outeramount =   $outerprofile * $outerprice;
        $slidebeedamount = $slidebeedprfile * $slidebeedprice ;

        $outersteelamount =  $outersteelprofile * $outersteelprice;
        $gaskitamount = $gaskit  * $gaskitprice;
        $total = $outeramount + $slidebeedamount +$outersteelamount+  $gaskitamount;
        $totalexpense = $total;
        
        $fileName = time() . "_" . $image->getClientOriginalName();
        $path =    $image->storeAs('uploads/windows', $fileName);
           $profile->image = $fileName;
           $profile->url = $path;

        $profile->outeramount = $outeramount;
        
        $profile->outerrn = $outertotal;
        $profile->slidebeedrn =$slidebeed;
        $profile->outersteelrn =$outertotal;
        $profile->gaskitrn =$gaskit;
        
        $profile->outersteelamount = $outersteelamount;
        $profile->slidebeedamount = $slidebeedamount;
        // $profile->typeamount = $typeamount;
        $profile->gaskitamount=$gaskitamount;
        // $profile->totalexpense=$totalexpense;
        $acesstotal = $this->fixaccess($profile, $width,$height,$project_id);
        $profile->totalexpense = $totalexpense + $acesstotal;
        $insert=$profile->update();
        if ($insert){

            return redirect()->back()->with('success', __('Value added successfully.'));
            }
        
    //   }
        
      }
     function openprofile($profile, $width,$height,$image, $typeamount,$hindge,$type,$openabletype,$ratio,$project_id){
        // if($profile->frame == "80-66(white)"){
     
         $outertotal = $width * 2 + $height * 2;
         $slidetotal =  $width * 4 + $height * 4;
         $slidebeed = $width * 4 + $height * 4;
         $gaskit = $width * 2 + $height * 2;
         $xgaskit = $width * 4 + $height * 4;
         $gaskitbeed = $width * 4 ;

         $outerprofile = $outertotal / 18;
         $slideprofile =  $slidetotal / 18;  
         $outersteelprofile = $outertotal / 8;
         $slidesteelprofile =  $slidetotal / 8;
         $slidebeedprfile = $slidebeed / 18;          

        //  $outerprice = $profile->price($profile->frame);
        $outerprice = $profile->prices->outerprice;
        $outersteelprice = $profile->prices->outersteelprice;
        $slideprice = $profile->prices->slideprice;
        $slidesteelprice = $profile->prices->slidesteelprice;
        $slidebeedprice= $profile->prices->slidebeedprice;
        $gaskitprice =  $profile->prices->gaskitprice;
        $xgaskitprice =  $profile->prices->xgaskitprice;
        $gaskitbeedprice =  $profile->prices->gaskitbeedprice;

        $outerw = $profile->prices->outerw;
        $slidew = $profile->prices->slidew;
        $beedingw = $profile->prices->beedingw;

        $outeramount =  $outerprofile * $outerprice ;
        $slideamount =  $slideprofile * $slideprice;
        $slidebeedamount = $slidebeedprfile * $slidebeedprice ;
        $outersteelamount =  $outersteelprofile * $outersteelprice;
        $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
        $gaskitamount = $gaskit  * $gaskitprice;
        $xgaskitamount = $xgaskit  * $xgaskitprice;
        $gaskitbeedamount = $gaskitbeed  * $gaskitbeedprice;
        $total = ceil($outeramount) +ceil($slideamount) + ceil($slidebeedamount) + $gaskitbeedamount+ $slidesteelamount + $outersteelamount+ $xgaskitamount + $gaskitamount;
        $totalexpense = $total;
        
        $fileName = time() . "_" . $image->getClientOriginalName();
        $path =    $image->storeAs('uploads/windows', $fileName);
           $profile->image = $fileName;
           $profile->url = $path;

        $profile->outeramount = ceil($outeramount);
        
         $profile->outerrn = $outertotal;
        $profile->slidern =$slidetotal;
        $profile->slidebeedrn =$slidebeed;
        $profile->outersteelrn =$outertotal;
        $profile->slidesteelrn =$slidetotal;
        $profile->gaskitrn =$gaskit;
        $profile->gaskitbeedrn =$gaskitbeed;
        $profile->xgaskitrn =$xgaskit;
        
        $profile->outersteelamount = ceil($outersteelamount);
        $profile->slideamount = ceil($slideamount);
        $profile->slidesteelamount = $slidesteelamount;
        $profile->slidebeedamount = ceil($slidebeedamount);
        // $profile->typeamount = $typeamount;
        $profile->gaskitamount=$gaskitamount;
        $profile->xgaskitamount=$xgaskitamount;
        $profile->gaskitbeedamount=$gaskitbeedamount;
        // $profile->totalexpense=$totalexpense;
     if($type == "gear_handles" && $openabletype == "casement"){
           $accesstotal =  $this->gearopenaccess($profile, $width,$height,$hindge,$typeamount,$project_id);
        
        }else if($type == "cockspurhandle" && $openabletype == "casement"){
            $accesstotal =    $this->openaccess($profile, $width,$height,$hindge,$typeamount,$project_id);   
        }else if($type == "gear_handles" && $openabletype == "tophing"){
            $accesstotal =    $this->hinggearopenaccess($profile, $width,$height,$hindge,$typeamount,$project_id);   
        }else if($type == "cockspurhandle" && $openabletype == "tophing"){
            $accesstotal =    $this->hingopenaccess($profile, $width,$height,$hindge,$typeamount,$project_id);   
        }else{
            $accesstotal = 0;
        }
        $profile->totalexpense = $totalexpense + $accesstotal;
        // $acesstotal = $this->fixaccess($profile, $width,$height);
        // $profile->totalexpense = $totalexpense + $acesstotal;
        $insert=$profile->update();
        if ($insert){

            return redirect()->back()->with('success', __('Value added successfully.'));
            }
        
    //   }
        
      }
      
       function openwinprofile($profile, $width,$height,$image, $typeamount,$hindge,$type,$openabletype,$project_id){
        // if($profile->frame == "80-66(white)"){
     
         $outertotal = $width * 2 + $height * 2;
         $slidetotal =  $width * 4 + $height * 4;
         $slidebeed = $width * 4 + $height * 4;
         $gaskit = $width * 2 + $height * 2;
         $xgaskit = $width * 4 + $height * 4;
         $gaskitbeed = $width * 4 ;

         $outerprofile = $outertotal / 18;
         $slideprofile =  $slidetotal / 18;  
         $outersteelprofile = $outertotal / 8;
         $slidesteelprofile =  $slidetotal / 8;
         $slidebeedprfile = $slidebeed / 18;          

        //  $outerprice = $profile->price($profile->frame);
        $outerprice = $profile->prices->outerprice;
        $outersteelprice = $profile->prices->outersteelprice;
        $slideprice = $profile->prices->slideprice;
        $slidesteelprice = $profile->prices->slidesteelprice;
        $slidebeedprice= $profile->prices->slidebeedprice;
        $gaskitprice =  $profile->prices->gaskitprice;
        $xgaskitprice =  $profile->prices->xgaskitprice;
        $gaskitbeedprice =  $profile->prices->gaskitbeedprice;

        $outerw = $profile->prices->outerw;
        $slidew = $profile->prices->slidew;
        $beedingw = $profile->prices->beedingw;

       $outeramount =  $outerprofile * $outerprice * $outerw;
        $slideamount =  $slideprofile * $slideprice *$slidew;
        $slidebeedamount = $slidebeedprfile * $slidebeedprice *$beedingw;
        $outersteelamount =  $outersteelprofile * $outersteelprice;
        $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
        $gaskitamount = $gaskit  * $gaskitprice;
        $xgaskitamount = $xgaskit  * $xgaskitprice;
        $gaskitbeedamount = $gaskitbeed  * $gaskitbeedprice;
        $total = ceil($outeramount) +ceil($slideamount) + ceil($slidebeedamount) + $gaskitbeedamount+ $slidesteelamount + $outersteelamount+ $xgaskitamount + $gaskitamount;
        $totalexpense = $total;
        
        $fileName = time() . "_" . $image->getClientOriginalName();
        $path =    $image->storeAs('uploads/windows', $fileName);
           $profile->image = $fileName;
           $profile->url = $path;

        $profile->outeramount = ceil($outeramount);
        
         $profile->outerrn = $outertotal;
        $profile->slidern =$slidetotal;
        $profile->slidebeedrn =$slidebeed;
        $profile->outersteelrn =$outertotal;
        $profile->slidesteelrn =$slidetotal;
        $profile->gaskitrn =$gaskit;
        $profile->gaskitbeedrn =$gaskitbeed;
        $profile->xgaskitrn =$xgaskit;
        
        $profile->outersteelamount = ceil($outersteelamount);
        $profile->slideamount = ceil($slideamount);
        $profile->slidesteelamount = $slidesteelamount;
        $profile->slidebeedamount = ceil($slidebeedamount);
        // $profile->typeamount = $typeamount;
        $profile->gaskitamount=$gaskitamount;
        $profile->xgaskitamount=$xgaskitamount;
        $profile->gaskitbeedamount=$gaskitbeedamount;
        // $profile->totalexpense=$totalexpense;
     if($type == "gear_handles" && $openabletype == "casement"){
           $accesstotal =  $this->gearopenaccess($profile, $width,$height,$hindge,$typeamount,$project_id);
        
        }else if($type == "cockspurhandle" && $openabletype == "casement"){
            $accesstotal =    $this->openaccess($profile, $width,$height,$hindge,$typeamount,$project_id);   
        }else if($type == "gear_handles" && $openabletype == "tophing"){
            $accesstotal =    $this->hinggearopenaccess($profile, $width,$height,$hindge,$typeamount,$project_id);   
        }else if($type == "cockspurhandle" && $openabletype == "tophing"){
            $accesstotal =    $this->hingopenaccess($profile, $width,$height,$hindge,$typeamount,$project_id);   
        }else{
            $accesstotal = 0;
        }
        $profile->totalexpense = $totalexpense + $accesstotal;
        // $acesstotal = $this->fixaccess($profile, $width,$height);
        // $profile->totalexpense = $totalexpense + $acesstotal;
        $insert=$profile->update();
        if ($insert){

            return redirect()->back()->with('success', __('Value added successfully.'));
            }
        
    //   }
        
      }
      
        function doorprofile($profile, $width,$height,$image,$hindge,$type,$size,$handle,$project_id){
        // if($profile->frame == "80-66(white)"){
         $sizee = $width * $height;
         $outertotal = $width * 2 + $height * 2;
         $slidetotal =  $width * 2 + $height * 4;
         $slidebeed = $width * 2 + $height * 4;
         $gaskit = $width * 4 + $height * 4;
         $xgaskit = $width * 4 + $height * 8;
         $gaskitbeed = $width * 2 + $height * 4;
         $value = 12 / 144 ;
         $fixpanel = $sizee * $value;

         $outerprofile = $outertotal / 19.5;
         $slideprofile =  $slidetotal / 19.5;  
         $outersteelprofile = $outertotal / 8;
         $slidesteelprofile =  $slidetotal / 8;
         $slidebeedprfile = $slidebeed / 19.5;  
         $gaskitprofile = $gaskit / 100;
         $xgaskitprofile = $xgaskit / 100;   
         $gaskitbeedprofile = $gaskitbeed / 100;       

        //  $outerprice = $profile->price($profile->frame);
        $outerprice = $profile->prices->outerprice;
        $outersteelprice = $profile->prices->outersteelprice;
        $slideprice = $profile->prices->slideprice;
        $slidesteelprice = $profile->prices->slidesteelprice;
        $slidebeedprice= $profile->prices->slidebeedprice;
        $gaskitprice =  $profile->prices->gaskitprice;
        $xgaskitprice =  $profile->prices->xgaskitprice;
        $gaskitbeedprice =  $profile->prices->gaskitbeedprice;
        $fixpanelprice =  $profile->prices->fixpanelprice;


        $outeramount =  $outerprofile * $outerprice;
        $slideamount =  $slideprofile * $slideprice ;
        $slidebeedamount = $slidebeedprfile * $slidebeedprice;
        $outersteelamount =  $outersteelprofile * $outersteelprice;
        $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
        $gaskitamount = $gaskitprofile  * $gaskitprice;
        $xgaskitamount = $xgaskitprofile  * $xgaskitprice;
        $gaskitbeedamount = $gaskitbeedprofile  * $gaskitbeedprice;
        $fixpanelamount = $fixpanel  * $fixpanelprice;
        $total = ceil($outeramount) +ceil($slideamount) + ceil($slidebeedamount) + ceil($fixpanelamount) + $gaskitbeedamount+ $slidesteelamount + $outersteelamount+ $xgaskitamount + $gaskitamount;
        $totalexpense = $total;
        
        $fileName = time() . "_" . $image->getClientOriginalName();
        $path =    $image->storeAs('uploads/windows', $fileName);
           $profile->image = $fileName;
           $profile->url = $path;

        $profile->outeramount = $outeramount;
        
          $profile->outerrn = $outertotal;
        $profile->slidern =$slidetotal;
        $profile->slidebeedrn =$slidebeed;
        $profile->outersteelrn =$outertotal;
        $profile->slidesteelrn =$slidetotal;
        $profile->gaskitrn =$gaskit;
        $profile->xgaskitrn = $xgaskit;
        $profile->gaskitbeedrn = $gaskitbeed;
        
        $profile->outersteelamount = $outersteelamount;
        $profile->slideamount = $slideamount;
        $profile->slidesteelamount = $slidesteelamount;
        $profile->slidebeedamount = $slidebeedamount;
        // $profile->typeamount = $typeamount;
        $profile->gaskitamount=$gaskitamount;
        $profile->xgaskitamount=$xgaskitamount;
        $profile->gaskitbeedamount=$gaskitbeedamount;
        $profile->fixpanelamount=$fixpanelamount;
        //  $profile->totalexpense=$totalexpense;
         $accesstotal =  $this->dooraccess($profile, $width,$height,$hindge,$handle,$size,$type,$project_id);
           $profile->totalexpense = $totalexpense + $accesstotal;
        // $acesstotal = $this->fixaccess($profile, $width,$height);
        // $profile->totalexpense = $totalexpense + $acesstotal;
        $insert=$profile->update();
        if ($insert){

            return redirect()->back()->with('success', __('Value added successfully.'));
            }
        
    //   }
        
      }
        function winplastdoorprofile($profile, $width,$height,$image,$hindge,$type,$size,$handle,$project_id){
        // if($profile->frame == "80-66(white)"){
         $sizee = $width * $height;
         $outertotal = $width * 2 + $height * 2;
         $slidetotal =  $width * 2 + $height * 4;
         $slidebeed = $width * 2 + $height * 4;
         $gaskit = $width * 4 + $height * 4;
         $xgaskit = $width * 4 + $height * 8;
         $gaskitbeed = $width * 2 + $height * 4;
         $value = 12 / 144 ;
         $fixpanel = $sizee * $value;

         $outerprofile = $outertotal / 19.5;
         $slideprofile =  $slidetotal / 19.5;  
         $outersteelprofile = $outertotal / 8;
         $slidesteelprofile =  $slidetotal / 8;
         $slidebeedprfile = $slidebeed / 19.5;  
         $gaskitprofile = $gaskit / 100;
         $xgaskitprofile = $xgaskit / 100;   
         $gaskitbeedprofile = $gaskitbeed / 100;       

        //  $outerprice = $profile->price($profile->frame);
        $outerprice = $profile->prices->outerprice;
        $outersteelprice = $profile->prices->outersteelprice;
        $slideprice = $profile->prices->slideprice;
        $slidesteelprice = $profile->prices->slidesteelprice;
        $slidebeedprice= $profile->prices->slidebeedprice;
        $gaskitprice =  $profile->prices->gaskitprice;
        $xgaskitprice =  $profile->prices->xgaskitprice;
        $gaskitbeedprice =  $profile->prices->gaskitbeedprice;
        $fixpanelprice =  $profile->prices->fixpanelprice;
       
         $outerw = $profile->prices->outerw;
        $slidew = $profile->prices->slidew;
        $beedingw = $profile->prices->beedingw;
         $fixpanelw = $profile->prices->fixpanelw;

        $outeramount =  $outerprofile * $outerprice * $outerw;
       
        $slideamount =  $slideprofile * $slideprice * $slidew;
        $slidebeedamount = $slidebeedprfile * $slidebeedprice * $beedingw;
        $outersteelamount =  $outersteelprofile * $outersteelprice;
        $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
        $gaskitamount = $gaskitprofile  * $gaskitprice;
        $xgaskitamount = $xgaskitprofile  * $xgaskitprice;
        $gaskitbeedamount = $gaskitbeedprofile  * $gaskitbeedprice;
        $fixpanelamount = $fixpanel  * $fixpanelprice * $fixpanelw;
        $total = ceil($outeramount) +ceil($slideamount) + ceil($slidebeedamount) + ceil($fixpanelamount) + $gaskitbeedamount+ $slidesteelamount + $outersteelamount+ $xgaskitamount + $gaskitamount;
        $totalexpense = $total;
        
        $fileName = time() . "_" . $image->getClientOriginalName();
        $path =    $image->storeAs('uploads/windows', $fileName);
           $profile->image = $fileName;
           $profile->url = $path;

        $profile->outeramount = $outeramount;
        
          $profile->outerrn = $outertotal;
        $profile->slidern =$slidetotal;
        $profile->slidebeedrn =$slidebeed;
        $profile->outersteelrn =$outertotal;
        $profile->slidesteelrn =$slidetotal;
        $profile->gaskitrn =$gaskit;
        $profile->xgaskitrn = $xgaskit;
        $profile->gaskitbeedrn = $gaskitbeed;
        
        $profile->outersteelamount = $outersteelamount;
        $profile->slideamount = $slideamount;
        $profile->slidesteelamount = $slidesteelamount;
        $profile->slidebeedamount = $slidebeedamount;
        // $profile->typeamount = $typeamount;
        $profile->gaskitamount=$gaskitamount;
        $profile->xgaskitamount=$xgaskitamount;
        $profile->gaskitbeedamount=$gaskitbeedamount;
        $profile->fixpanelamount=$fixpanelamount;
        //  $profile->totalexpense=$totalexpense;
         $accesstotal =  $this->dooraccess($profile, $width,$height,$hindge,$handle,$size,$type,$project_id);
           $profile->totalexpense = $totalexpense + $accesstotal;
        // $acesstotal = $this->fixaccess($profile, $width,$height);
        // $profile->totalexpense = $totalexpense + $acesstotal;
        $insert=$profile->update();
        if ($insert){

            return redirect()->back()->with('success', __('Value added successfully.'));
            }
        
    //   }
        
      }
      
       function access($proj, $width,$height,$project_id){
            $runningft = $width * 2 + $height * 2;
         $sashroll = $proj->pricesqty->sashrollqty *  $proj->pricesqty->sashrollrate;
         $bumperblock = $proj->pricesqty->bumperblockqty *  $proj->pricesqty->bumperblockrate;
         $dummywheel = $proj->pricesqty->dummywheelqty *  $proj->pricesqty->dummywheelrate;
         $flathandle = $proj->pricesqty->flathandleqty *  $proj->pricesqty->flathandlerate;
         $netwheel = $proj->pricesqty->netwheelqty *  $proj->pricesqty->netwheelrate;
         $stopper = $proj->pricesqty->stopperqty *  $proj->pricesqty->stopperrate;
         $windbreak = $proj->pricesqty->windbreakqty *  $proj->pricesqty->windbreakrate;
         $silicon = $proj->pricesqty->siliconqty *  $proj->pricesqty->siliconrate;
         $fixer = $proj->pricesqty->fixerqty *  $proj->pricesqty->fixerrate;
         $slidekeep = $proj->pricesqty->slidekeepqty *  $proj->pricesqty->slidekeeprate;
         
             $steeltapqty = $proj->pricesqty->steeltapqty * $runningft;
        $steeltap = $proj->pricesqty->steeltaprate * $steeltapqty ;

        $conscrewqty = $proj->pricesqty->conscrewqty * $runningft;
        $conscrew = $proj->pricesqty->conscrewrate * $conscrewqty;
        
         $total = $sashroll + $bumperblock +  $dummywheel+$flathandle+ $netwheel+ $stopper +$windbreak+$silicon+$fixer +  $slidekeep+  $conscrew +         $steeltap;
         
         $projacs = new ProjWindowAcces();
        $projacs->project= $project_id;
         $projacs->projwin_id = $proj->id;
         $projacs->sashrollrate = $sashroll;
         $projacs->bumperblockrate =  $bumperblock;
         $projacs->dummywheelrate = $dummywheel;
         $projacs->flathandlerate = $flathandle;
         $projacs->netwheelrate = $netwheel;
         $projacs->stopperrate = $stopper;
         $projacs->siliconrate = $silicon;
         $projacs->windbreakrate = $windbreak;
         $projacs->fixerrate = $fixer;
         $projacs->slidekeeprate = $slidekeep;
            $projacs->steeltaprate = $steeltap;
          $projacs->conscrewrate = $conscrew;
         $projacs->total = $total;
        $insert = $projacs->save();
        if($insert){
            return $total;
        }


      }
       function doubleaccess($proj, $width,$height,$project_id){
           $runningft = $width * 2 + $height * 2;
        $sashroll = $proj->pricesqty->sashrollqty *  $proj->pricesqty->sashrollrate;
        $bumperblock = $proj->pricesqty->bumperblockqty *  $proj->pricesqty->bumperblockrate;
        $dummywheel = $proj->pricesqty->dummywheelqty *  $proj->pricesqty->dummywheelrate;
        $flathandleqty = $proj->pricesqty->flathandleqty + 1;
        $flathandle = $flathandleqty *  $proj->pricesqty->flathandlerate;
        $netwheel = $proj->pricesqty->netwheelqty *  $proj->pricesqty->netwheelrate;
        $stopper = $proj->pricesqty->stopperqty *  $proj->pricesqty->stopperrate;
        $windbreak = $proj->pricesqty->windbreakqty *  $proj->pricesqty->windbreakrate;
        $silicon = $proj->pricesqty->siliconqty *  $proj->pricesqty->siliconrate;
        $fixer = $proj->pricesqty->fixerqty *  $proj->pricesqty->fixerrate;
        $slidekeepqty = $proj->pricesqty->slidekeepqty * 2;
        $slidekeep = $proj->pricesqty->slidekeeprate * $slidekeepqty ;
        
        $steeltapqty = $proj->pricesqty->steeltapqty * $runningft;
        $steeltap = $proj->pricesqty->steeltaprate * $steeltapqty ;

        $conscrewqty = $proj->pricesqty->conscrewqty * $runningft;
        $conscrew = $proj->pricesqty->conscrewrate * $conscrewqty;
        
        $total = $sashroll + $bumperblock +  $dummywheel+$flathandle+ $netwheel+ $stopper +$windbreak+$silicon+$fixer+$slidekeep+  $conscrew +         $steeltap;

        $projacs = new ProjWindowAcces();
          $projacs->project = $project_id;
        $projacs->projwin_id = $proj->id;
        $projacs->sashrollrate = $sashroll;
        $projacs->bumperblockrate =  $bumperblock;
        $projacs->dummywheelrate = $dummywheel;
        $projacs->flathandlerate = $flathandle;
        $projacs->netwheelrate = $netwheel;
        $projacs->stopperrate = $stopper;
        $projacs->siliconrate = $silicon;
        $projacs->windbreakrate = $windbreak;
        $projacs->fixerrate = $fixer;
        $projacs->slidekeeprate = $slidekeep;
         $projacs->steeltaprate = $steeltap;
          $projacs->conscrewrate = $conscrew;
        $projacs->total = $total;
       $insert = $projacs->save();
       if($insert){
           return $total;
       }


     }
      function fixaccess($proj, $width,$height,$project_id){
        $runningft = $width * 2 + $height * 2;
        $silicon = $proj->pricesqty->siliconqty *  $proj->pricesqty->siliconrate;
        $steeltapqty = $proj->pricesqty->steeltapqty * $runningft;
        $steeltap = $proj->pricesqty->steeltaprate * $steeltapqty ;

        $conscrewqty = $proj->pricesqty->conscrewqty * $runningft;
        $conscrew = $proj->pricesqty->conscrewrate * $conscrewqty;

        $total =$silicon+  $conscrew +  $steeltap;

        $projacs = new ProjWindowAcces();
         $projacs->project = $project_id;
        $projacs->projwin_id = $proj->id;
        $projacs->siliconrate = $silicon;
        $projacs->steeltaprate = $steeltap;
        $projacs->conscrewrate = $conscrew;
        $projacs->total = $total;
       $insert = $projacs->save();
       if($insert){
           return $total;
       }


     }
      function openaccess($proj, $width,$height,$hindge,$typeamount,$project_id){
        $runningft = $width * 2 + $height * 2;
        $silicon = $proj->openpricesqty->siliconqty *  $proj->openpricesqty->siliconrate;
        $outwardcase = $proj->openpricesqty->outwardcaseqty * $proj->openpricesqty->outwardcaserate;
        $windowstay= $proj->openpricesqty->windowstayqty * $proj->openpricesqty->windowstayrate;
        // $frictionstay= $proj->openpricesqty->frictionstayqty * $proj->openpricesqty->frictionstayrate;
        $pencilhindge= $proj->openpricesqty->pencilhindgeqty * $proj->openpricesqty->pencilhindgerate;
        $flathandle= $proj->openpricesqty->flathandleqty * $proj->openpricesqty->flathandlerate;
        $twoDhindges= $proj->openpricesqty->twoDhindgesqty * $proj->openpricesqty->twoDhindgesrate;
        $thDhindges= $proj->openpricesqty->thDhindgesqty * $proj->openpricesqty->thDhindgesrate;
        $openablekeep = $proj->openpricesqty->openablekeepqty * $proj->openpricesqty->openablekeeprate	;
        $Tlock = $proj->openpricesqty->Tlockqty * $proj->openpricesqty->Tlockrate	;


        

        $projacs = new ProjWindowAcces();
       $projacs->project = $project_id;
        $projacs->projwin_id = $proj->id;
        $projacs->siliconrate = $silicon;
        $projacs->outwardcaserate = $outwardcase;
        $projacs->windowstayrate = $windowstay;
        // $projacs->frictionstayrate = $frictionstay;
        $projacs->pencilhindgerate = $pencilhindge;
        $projacs->flathandlerate = $flathandle;
        if($hindge == "2Dhindge"){
            $projacs->twoDhindgesrate = $twoDhindges;
            $total =$silicon+  $outwardcase +  $windowstay  + $pencilhindge +$flathandle + 
        $twoDhindges +$openablekeep + $Tlock +$typeamount;
        }else{
            $projacs->thDhindgesrate = $thDhindges;
            $total =$silicon+  $outwardcase +  $windowstay + $pencilhindge +$flathandle + 
        $thDhindges+$openablekeep + $Tlock +$typeamount;
        }
        $projacs->cockspurrate = $typeamount;
        $projacs->Tlockrate = $Tlock;

        $projacs->total = $total;
       $insert = $projacs->save();
       if($insert){
           return $total;
       }


     }
     function gearopenaccess($proj, $width,$height,$hindge,$typeamount,$project_id){
        $runningft = $width * 2 + $height * 2;
        $silicon = $proj->openpricesqty->siliconqty *  $proj->openpricesqty->siliconrate;
        $outwardcase = $proj->openpricesqty->outwardcaseqty * $proj->openpricesqty->outwardcaserate;
        $windowstay= $proj->openpricesqty->windowstayqty * $proj->openpricesqty->windowstayrate;
        // $frictionstay= $proj->openpricesqty->frictionstayqty * $proj->openpricesqty->frictionstayrate;
        $pencilhindge= $proj->openpricesqty->pencilhindgeqty * $proj->openpricesqty->pencilhindgerate;
        $flathandle= $proj->openpricesqty->flathandleqty * $proj->openpricesqty->flathandlerate;
        $twoDhindges= $proj->openpricesqty->twoDhindgesqty * $proj->openpricesqty->twoDhindgesrate;
        $thDhindges= $proj->openpricesqty->thDhindgesqty * $proj->openpricesqty->thDhindgesrate;
        $openablekeep = $proj->openpricesqty->openablekeepqty * $proj->openpricesqty->openablekeeprate	;
        $Tlock = $proj->openpricesqty->Tlockqty * $proj->openpricesqty->Tlockrate	;



        $projacs = new ProjWindowAcces();
         $projacs->project = $project_id;
        $projacs->projwin_id = $proj->id;
        $projacs->siliconrate = $silicon;
        $projacs->outwardcaserate = $outwardcase;
        $projacs->windowstayrate = $windowstay;
        // $projacs->frictionstayrate = $frictionstay;
        $projacs->pencilhindgerate = $pencilhindge;
        $projacs->flathandlerate = $flathandle;
         if($hindge == "2Dhindge"){
            $projacs->twoDhindgesrate = $twoDhindges;
            $total =$silicon+  $outwardcase +  $windowstay + $pencilhindge +$flathandle + 
        $twoDhindges +$openablekeep + $Tlock +$typeamount;
        }else{
            $projacs->thDhindgesrate = $thDhindges;
            $total =$silicon+  $outwardcase +  $windowstay + $pencilhindge +$flathandle + 
        $thDhindges+$openablekeep + $Tlock +$typeamount;
        }
        $projacs->openablekeeprate = $openablekeep;
        $projacs->gearlockrate = $typeamount;
        $projacs->Tlockrate = $Tlock;

        $projacs->total = $total;
       $insert = $projacs->save();
       if($insert){
           return $total;
       }


     }
     
       function hingopenaccess($proj, $width,$height,$hindge,$typeamount,$project_id){
        $runningft = $width * 2 + $height * 2;
        $silicon = $proj->openpricesqty->siliconqty *  $proj->openpricesqty->siliconrate;
        $outwardcase = $proj->openpricesqty->outwardcaseqty * $proj->openpricesqty->outwardcaserate;
        // $windowstay= $proj->openpricesqty->windowstayqty * $proj->openpricesqty->windowstayrate;
        $frictionstay= $proj->openpricesqty->frictionstayqty * $proj->openpricesqty->frictionstayrate;
        $pencilhindge= $proj->openpricesqty->pencilhindgeqty * $proj->openpricesqty->pencilhindgerate;
        $flathandle= $proj->openpricesqty->flathandleqty * $proj->openpricesqty->flathandlerate;
        $twoDhindges= $proj->openpricesqty->twoDhindgesqty * $proj->openpricesqty->twoDhindgesrate;
        $thDhindges= $proj->openpricesqty->thDhindgesqty * $proj->openpricesqty->thDhindgesrate;
        $openablekeep = $proj->openpricesqty->openablekeepqty * $proj->openpricesqty->openablekeeprate	;
        $Tlock = $proj->openpricesqty->Tlockqty * $proj->openpricesqty->Tlockrate	;
 $total =$silicon+  $outwardcase + $frictionstay + $pencilhindge +$flathandle +$openablekeep + $Tlock +$typeamount;

        

        $projacs = new ProjWindowAcces();
         $projacs->project = $project_id;
        $projacs->projwin_id = $proj->id;
        $projacs->siliconrate = $silicon;
        $projacs->outwardcaserate = $outwardcase;
        // $projacs->windowstayrate = $windowstay;
        $projacs->frictionstayrate = $frictionstay;
        $projacs->pencilhindgerate = $pencilhindge;
        $projacs->flathandlerate = $flathandle;
      
           

        $projacs->cockspurrate = $typeamount;
        $projacs->Tlockrate = $Tlock;

        $projacs->total = $total;
       $insert = $projacs->save();
       if($insert){
           return $total;
       }


     }
     function hinggearopenaccess($proj, $width,$height,$hindge,$typeamount,$project_id){
        $runningft = $width * 2 + $height * 2;
        $silicon = $proj->openpricesqty->siliconqty *  $proj->openpricesqty->siliconrate;
        $outwardcase = $proj->openpricesqty->outwardcaseqty * $proj->openpricesqty->outwardcaserate;
        // $windowstay= $proj->openpricesqty->windowstayqty * $proj->openpricesqty->windowstayrate;
        $frictionstay= $proj->openpricesqty->frictionstayqty * $proj->openpricesqty->frictionstayrate;
        $pencilhindge= $proj->openpricesqty->pencilhindgeqty * $proj->openpricesqty->pencilhindgerate;
        $flathandle= $proj->openpricesqty->flathandleqty * $proj->openpricesqty->flathandlerate;
        $twoDhindges= $proj->openpricesqty->twoDhindgesqty * $proj->openpricesqty->twoDhindgesrate;
        $thDhindges= $proj->openpricesqty->thDhindgesqty * $proj->openpricesqty->thDhindgesrate;
        $openablekeep = $proj->openpricesqty->openablekeepqty * $proj->openpricesqty->openablekeeprate	;
        $Tlock = $proj->openpricesqty->Tlockqty * $proj->openpricesqty->Tlockrate	;
   $projacs->thDhindgesrate = $thDhindges;
            $total =$silicon+  $outwardcase  + $frictionstay + $pencilhindge +$flathandle +$openablekeep + $Tlock +$typeamount;


        $projacs = new ProjWindowAcces();
         $projacs->project= $project_id;
        $projacs->projwin_id = $proj->id;
        $projacs->siliconrate = $silicon;
        $projacs->outwardcaserate = $outwardcase;
        // $projacs->windowstayrate = $windowstay;
        $projacs->frictionstayrate = $frictionstay;
        $projacs->pencilhindgerate = $pencilhindge;
        $projacs->flathandlerate = $flathandle;
        $projacs->openablekeeprate = $openablekeep;
        $projacs->gearlockrate = $typeamount;
        $projacs->Tlockrate = $Tlock;

        $projacs->total = $total;
       $insert = $projacs->save();
       if($insert){
           return $total;
       }


     }
      function dooraccess($proj, $width,$height,$hindge,$handle,$size,$type,$project_id){
        $runningft = $width * 2 + $height * 2;
        $silicon = $proj->openpricesqty->siliconqty *  $proj->openpricesqty->siliconrate;
        $twoDhindges= $proj->openpricesqty->twoDhindgesqty * $proj->openpricesqty->twoDhindgesrate;
        $thDhindges= $proj->openpricesqty->thDhindgesqty * $proj->openpricesqty->thDhindgesrate;
        $imphandlesp= $proj->openpricesqty->imphandlespqty * $proj->openpricesqty->imphandlesprate;
        $imphandlecyl= $proj->openpricesqty->imphandlecylqty * $proj->openpricesqty->imphandlecylrate;
       
        $imphandle= $proj->openpricesqty->imphandleqty * $proj->openpricesqty->imphandlerate;
        $cockspur= $proj->openpricesqty->cockspurqty * $proj->openpricesqty->cockspurrate;
        $Tlock = $proj->openpricesqty->Tlockqty * $proj->openpricesqty->Tlockrate	;
        if($size == "singleopener"){
            $twoDhindges= $proj->openpricesqty->twoDhindgesqty * $proj->openpricesqty->twoDhindgesrate;
            $thDhindges= $proj->openpricesqty->thDhindgesqty * $proj->openpricesqty->thDhindgesrate;
        }else{
            $twoqty = $proj->openpricesqty->twoDhindgesqty * 2;
            $twoDhindges= $twoqty * $proj->openpricesqty->twoDhindgesrate;
            $thqty = $proj->openpricesqty->thDhindgesqty * 2;
            $thDhindges= $thqty * $proj->openpricesqty->twoDhindgesrate;
        }

        

        $projacs = new ProjWindowAcces();
        if(!empty($type)){
            $projacs->Tlockrate = $Tlock;
        }
        $projacs->projwin_id = $proj->id;
        // $projacs->Tlockrate = $Tlock;
        if($hindge == "2Dhindge"){
            $projacs->twoDhindgesrate = $twoDhindges;
            $hindge = $twoDhindges;
            $total = $hindge + $silicon + $Tlock;
        }else{
            $projacs->thDhindgesrate = $thDhindges;
            $hindge = $thDhindges;
            $total =$hindge + $silicon + $Tlock;
        }
        $projacs->siliconrate = $silicon;
        if($handle == "imphandlesp"){
            $projacs->imphandlesprate = $imphandlesp;
            $total =$hindge + $silicon + $Tlock + $imphandlesp;
        }else if($handle == "imphandle"){
            $projacs->imphandlerate = $imphandle;
            $total =$hindge + $silicon + $Tlock + $imphandle;
        }else if($handle == "imphandlecyl"){
            $projacs->imphandlecylrate = $imphandlecyl;
            $total =$hindge + $silicon + $Tlock + $imphandlecyl;
        }else{
            $projacs->cockspurrate = $cockspur;
            $total =$hindge + $silicon + $Tlock + $cockspur;
        }
 
        $projacs->project = $project_id;
        $projacs->total = $total;
       $insert = $projacs->save();
       if($insert){
           return $total;
       }


     }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project_id)
    {
       
       $usr = \Auth::user();
        $project   = Project::find($project_id);
        $frame = AssignWindow::find($request->frame_id);
   
       if($request->designtype == 'sliding'){
        $this->checkprofile($project_id,$request);
         $this->winplastprofile($project_id,$request);
          $this->Asaspenprofile($project_id,$request);
          return redirect()->back()->with('success', __('Mullion added successfully.'));
           
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectWindow  $projectWindow
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $window = ProjectWindow::where('projwin_id',$id)->first();
         $count = ProjectWindow::where('projwin_id',$id)->count();
        $width = ProjectWindow::where('projwin_id', $id)->sum('width');
        $height = ProjectWindow::where('projwin_id', $id)->sum('height');
         $outerrn = ProjectWindow::where('projwin_id', $id)->sum('outerrn');
        $slidern = ProjectWindow::where('projwin_id', $id)->sum('slidern');
        $netframrn = ProjectWindow::where('projwin_id', $id)->sum('netframrn');
       $slidebeedrn = ProjectWindow::where('projwin_id', $id)->sum('slidebeedrn');
        $interlockrn = ProjectWindow::where('projwin_id', $id)->sum('interlockrn');
    $outersteelrn = ProjectWindow::where('projwin_id', $id)->sum('outersteelrn');
        $slidesteelrn = ProjectWindow::where('projwin_id', $id)->sum('slidesteelrn');
       $netframesteelrn = ProjectWindow::where('projwin_id', $id)->sum('netframesteelrn');
        $netrn = ProjectWindow::where('projwin_id', $id)->sum('netrn');
        $gaskitrn = ProjectWindow::where('projwin_id', $id)->sum('gaskitrn');
        $netgaskitrn = ProjectWindow::where('projwin_id', $id)->sum('netgaskitrn');
        $brushrolrn = ProjectWindow::where('projwin_id', $id)->sum('brushrolrn');
     $aluminiumrn = ProjectWindow::where('projwin_id', $id)->sum('aluminiumrn');
     $totalexpense = ProjectWindow::where('projwin_id', $id)->sum('totalexpense');
      $hardwarecost = ProjectWindow::where('projwin_id', $id)->sum('hardwarecost');
           $totalcost = ProjectWindow::where('projwin_id', $id)->sum('totalcost');
              $sqf = ProjectWindow::where('projwin_id', $id)->sum('sqf');
  $xgaskitrn = ProjectWindow::where('projwin_id', $id)->sum('xgaskitrn');
  $gaskitbeedrn = ProjectWindow::where('projwin_id', $id)->sum('gaskitbeedrn');

        return view('projectwindows.view', compact('window','width','height','outerrn','slidern','netframrn','slidebeedrn','interlockrn','outersteelrn','slidesteelrn','netframesteelrn','netrn','gaskitrn','brushrolrn','aluminiumrn','totalexpense','hardwarecost','netgaskitrn','totalcost','sqf','count','xgaskitrn','gaskitbeedrn'));
    }
      public function allshow($id)
    {

        $window = ProjectWindow::find($id);
        return view('projectwindows.allview', compact('window'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectWindow  $projectWindow
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::user()->can('edit milestone'))
        {
            $milestone = ProjectWindow::find($id);

            return view('projectwindows.addvalues', compact('milestone'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
 
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectWindow  $projectWindow
     * @return \Illuminate\Http\Response
     */
      public function listedit($id)
    {
        if(\Auth::user()->can('edit milestone'))
        {
            $projectwindow = ProjectWindow::find($id);

            return view('projectwindows.edit', compact('projectwindow'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
    
    public function update(Request $request, $id)
    {
       
           $proj = ProjectWindow::find($id);
       $proj->widthmm = $request->widthmm;
       $proj->heightmm = $request->heightmm;
       $update = $proj->update();
       if($update){
        return view('projectwindows.windowdetails', compact('proj'));
       }else{
        return redirect()->back()->with('error', __('Permission Denied.'));
       }
    }
    
     public function mulionupdate(Request $request, $id){
         $project = Project::find($id);
         $price = $request->price;
         $sum= $request->sum;
         $profile = $sum / 18;
         $amount =  $price *$profile ;
         $project->mullionamount = $amount;
         $insert = $project->update();
         if ($insert){

            return redirect()->back()->with('success', __('Mullion added successfully.'));
            }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectWindow  $projectWindow
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        if(\Auth::user()->can('delete milestone'))
        {
            $milestone = ProjectWindow::find($id);
            $milestone->delete();

            return redirect()->back()->with('success', __('Window record successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
    
     function slideprofile($height,$width,$projrec,$slide,$designtype,$projectid,$exist,$company,$count){
       
        $outertotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('outerrn');
        $slidetotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('slidern');
        $nettotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('netframrn');
        $slidebeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('slidebeedrn');
        $interlock = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('interlockrn');
        $outersteel = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('outersteelrn');
        $slidesteel = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('slidesteelrn');
        $netsteeltotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('netframesteelrn');
        $net = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('netrn');
        $gaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('gaskitrn');
        $netgaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('netgaskitrn');
        $slidebrush = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('brushrolrn');
        $aluminiumrail = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('aluminiumrn');
      

        $outerprofile = $outertotal / 18;
        $outersteelprofile = $outersteel  / 8;
        $netprofile = $nettotal / 18; 
       //  return round($netprofile,0,PHP_ROUND_HALF_DOWN);
        $netsteelprofile = $netsteeltotal / 8;
        $slideprofile =  $slidetotal / 18;  
        $slidesteelprofile =  $slidesteel / 8;
        $slidebeedprfile = $slidebeed / 18;
        $nettprofile = $net / 4;
        $interlockprofile = $interlock / 18;  

        $outerprice = $slide->outerprice;
        $outersteelprice = $slide->outersteelprice;
        $slideprice = $slide->slideprice;
        $slidesteelprice = $slide->slidesteelprice;
        $netprice = $slide->netframeprice;
        $netsteelprice =$slide->netsteelprice;
        $slidebeedprice=$slide->slidebeedprice;
        $nettprice = $slide->netprice;
        $gaskitprice =  $slide->gaskitprice;
        $netgaskitprice = $slide->netgaskitprice;
        $slidingbrushprice =  $slide->slidingbrushprice;
        $aluminiumrailprice =  $slide->aluminiumrailprice;
        $interlockprice =  $slide->interlockprice;

        
        $outeramount =  ceil( $outerprofile ) * $outerprice;
        $slideamount =  ceil($slideprofile) * $slideprice;
        $netamount = ceil($netprofile) * $netprice;
        $slidebeedamount = ceil($slidebeedprfile) * $slidebeedprice;
     
        $interlockamount =  $interlockprice *  ceil($interlockprofile);
        
       $outersteelamount =  $outersteelprofile * $outersteelprice;
        $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
        $netsteelamount = $netsteelprofile * $netsteelprice;

        $nettamount = $nettprofile * $nettprice;
        $netgaskitamount = $netgaskit  * $netgaskitprice;
        $gaskitamount = $gaskit  * $gaskitprice;
        $slidingbrushamount = $slidebrush  * $slidingbrushprice;
        $aluminiumrailamount = $aluminiumrail * $aluminiumrailprice;
        $typeamount = $projrec->typeamount * $count;
       
        $total = $outeramount +  $outersteelamount + $slideamount  +$slidesteelamount +  
        $netamount +  $netsteelamount +   $slidebeedamount + $nettamount +  $netgaskitamount
        + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount ;
        $totalexpense = $total;
        
        $sashrollqty = $slide->sashrollqty *  $count;
        $bumperblockqty = $slide->bumperblockqty * $count;
        $dummywheelqty = $slide->dummywheelqty *  $count;
        $flathandleqty = $slide->flathandleqty * $count;
        $netwheelqty = $slide->netwheelqty *  $count;
        $stopperqty = $slide->stopperqty *  $count;
        $windbreakqty = $slide->windbreakqty *  $count;
        $siliconqty = $slide->siliconqty *  $count;
        $fixerqty = $slide->fixerqty * $count;
        $slidekeepqty = $slide->slidekeepqty *  $count;
        $steeltapqty = $slide->steeltapqty *  $count;
        $conscrewqty = $slide->conscrewqty *  $count;
        
        $sashroll = $sashrollqty *  $slide->sashrollrate;
        $bumperblock = $bumperblockqty *  $slide->bumperblockrate;
        $dummywheel = $dummywheelqty *  $slide->dummywheelrate;
        $flathandle = $flathandleqty *  $slide->flathandlerate;
        $netwheel = $netwheelqty *  $slide->netwheelrate;
        $stopper = $stopperqty *  $slide->stopperrate;
        $windbreak = $windbreakqty *  $slide->windbreakrate;
        $silicon = $siliconqty *  $slide->siliconrate;
        $fixer = $fixerqty *  $slide->fixerrate;
        $slidekeep = $slidekeepqty *  $slide->slidekeeprate;
        $steeltap = $steeltapqty *  $slide->steeltaprate;
        $conscrew = $conscrewqty *  $slide->conscrewrate;
        $accesstotal = $sashroll + $bumperblock +  $dummywheel+$flathandle+ $netwheel+ $stopper +$windbreak+$silicon+$fixer+$slidekeep
        +$steeltap+$conscrew;

        if(!empty($exist)){
            
            $exist->outerrn = $outertotal;
            $exist->slidern =$slidetotal;
            $exist->netframrn =$nettotal;
            $exist->slidebeedrn =$slidebeed;
            $exist->interlockrn =$interlock;
            $exist->outersteelrn =$outertotal;
            $exist->slidesteelrn =$slidetotal;
            $exist->netframesteelrn =$netsteeltotal;
            $exist->netrn =$net;
            $exist->gaskitrn =$gaskit;
            $exist->netgaskitrn =$netgaskit;
            $exist->brushrolrn =$slidebrush;
            $exist->aluminiumrn =$aluminiumrail;

            $exist->Project = $projectid;
            $exist->jobcost ="jobcost";
            $exist->designtype = $designtype.' '."total cost";
            $exist->width = $width;
            $exist->height = $height;
            $exist->designtyperatio = $projrec->designtyperatio;
            $exist->typeamount = $typeamount;
            $exist->outeramount = $outeramount;
            $exist->outersteelamount = $outersteelamount;
            $exist->slideamount = $slideamount;
            $exist->slidesteelamount = $slidesteelamount;
            $exist->netamount = $netamount;
            $exist->netsteelamount = $netsteelamount;
            $exist->slidebeedamount = $slidebeedamount;
            $exist->company = $company;
            // $profile->typeamount = $typeamount;
            $exist->nettamount  = $nettamount ;
            $exist->netgaskitamount = $netgaskitamount;
            $exist->gaskitamount=$gaskitamount;
            $exist->slidingbrushamount=$slidingbrushamount;
            $exist->aluminiumrailamount=$aluminiumrailamount;
            $exist->interlockamount=$interlockamount;
            $exist->totalexpense = $totalexpense;
            $exist->hardwarecost = $accesstotal;
            $exist->totalcost = $totalexpense + $accesstotal;
            $updatee=$exist->update();
            if ($updatee){
                return  $exist->totalcost;
                }
        }else{
           
            $profile = new ProjectWindow();
            $profile->outerrn = $outertotal;
            $profile->slidern =$slidetotal;
            $profile->netframrn =$nettotal;
            $profile->slidebeedrn =$slidebeed;
            $profile->interlockrn =$interlock;
            $profile->outersteelrn =$outertotal;
            $profile->slidesteelrn =$slidetotal;
            $profile->netframesteelrn =$netsteeltotal;
            $profile->netrn =$net;
            $profile->gaskitrn =$gaskit;
            $profile->netgaskitrn =$netgaskit;
            $profile->brushrolrn =$slidebrush;
            $profile->aluminiumrn =$aluminiumrail;

            $profile->Project = $projectid;
            $profile->final = 1;
            $profile->jobcost ="jobcost";
            $profile->designtype = $designtype.' '."Total cost";
            $profile->company = $company;
            $profile->width = $width;
            $profile->height = $height;
            $profile->designtyperatio = $projrec->designtyperatio;
            $profile->typeamount = $typeamount;
            $profile->outeramount = $outeramount;
            $profile->outersteelamount = $outersteelamount;
            $profile->slideamount = $slideamount;
            $profile->slidesteelamount = $slidesteelamount;
            $profile->netamount = $netamount;
            $profile->netsteelamount = $netsteelamount;
            $profile->slidebeedamount = $slidebeedamount;
            // $profile->typeamount = $typeamount;
            $profile->nettamount  = $nettamount ;
            $profile->netgaskitamount = $netgaskitamount;
            $profile->gaskitamount=$gaskitamount;
            $profile->slidingbrushamount=$slidingbrushamount;
            $profile->aluminiumrailamount=$aluminiumrailamount;
            $profile->interlockamount=$interlockamount;
            $profile->totalexpense = $totalexpense;
            $profile->hardwarecost = $accesstotal;
            $profile->totalcost = $totalexpense + $accesstotal;
            $save=$profile->save();
    
           if ($save){
            return  $profile->totalcost;
            }
        }
    }
    function slidewinplastprofile($height,$width,$projrec,$slide,$designtype,$projectid,$exist,$company,$count){
        $outertotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('outerrn');
        $slidetotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('slidern');
        $nettotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('netframrn');
        $slidebeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('final',1)->sum('slidebeedrn');
        $interlock = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('interlockrn');
        $outersteel = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('outersteelrn');
        $slidesteel = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('slidesteelrn');
        $netsteeltotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('netframesteelrn');
        $net = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('netrn');
        $gaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('gaskitrn');
        $netgaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('netgaskitrn');
        $slidebrush = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('brushrolrn');
        $aluminiumrail = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('aluminiumrn');

        $outerprofile = $outertotal / 18;
        $outersteelprofile = $outertotal / 8;
        $netprofile = $nettotal / 18; 
       //  return round($netprofile,0,PHP_ROUND_HALF_DOWN);
        $netsteelprofile = $netsteeltotal / 8;
        $slideprofile =  $slidetotal / 18;  
        $slidesteelprofile =  $slidetotal / 8;
        $slidebeedprfile = $slidebeed / 18;
        $nettprofile = $net / 4;
        $interlockprofile = $interlock / 18;  

        $outerprice = $slide->outerprice;
        $outersteelprice = $slide->outersteelprice;
        $slideprice = $slide->slideprice;
        $slidesteelprice = $slide->slidesteelprice;
        $netprice = $slide->netframeprice;
        $netsteelprice =$slide->netsteelprice;
        $slidebeedprice=$slide->slidebeedprice;
        $nettprice = $slide->netprice;
        $gaskitprice =  $slide->gaskitprice;
        $netgaskitprice = $slide->netgaskitprice;
        $slidingbrushprice =  $slide->slidingbrushprice;
        $aluminiumrailprice =  $slide->aluminiumrailprice;
        $interlockprice =  $slide->interlockprice;

        $outerw = $slide->outerw;
        $slidew = $slide->slidew;
        $netframw = $slide->netframw;
        $beedingw = $slide->beedingw;
        $interlockw = $slide->interlockw;

        $outeramount =  ceil( $outerprofile ) * $outerprice * $outerw;
        $slideamount =  ceil($slideprofile) * $slideprice * $slidew;
        $netamount = ceil($netprofile) * $netprice * $netframw;
        $slidebeedamount = ceil($slidebeedprfile) * $slidebeedprice * $beedingw;
     
        $interlockamount =  $interlockprice *  ceil($interlockprofile) *$interlockw;
        
        $outersteelamount =  $outersteelprofile * $outersteelprice;
        $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
        $netsteelamount = $netsteelprofile * $netsteelprice;

        $nettamount = $nettprofile * $nettprice;
        $netgaskitamount = $netgaskit  * $netgaskitprice;
        $gaskitamount = $gaskit  * $gaskitprice;
        $slidingbrushamount = $slidebrush  * $slidingbrushprice;
        $aluminiumrailamount = $aluminiumrail * $aluminiumrailprice;
        $typeamount = $projrec->typeamount * $count;
       
        $total = $outeramount +  $outersteelamount + $slideamount  +$slidesteelamount +  
        $netamount +  $netsteelamount +   $slidebeedamount + $nettamount +  $netgaskitamount
        + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount ;
        $totalexpense = $total;
        
        $sashrollqty = $slide->sashrollqty *  $count;
        $bumperblockqty = $slide->bumperblockqty * $count;
        $dummywheelqty = $slide->dummywheelqty *  $count;
        $flathandleqty = $slide->flathandleqty * $count;
        $netwheelqty = $slide->netwheelqty *  $count;
        $stopperqty = $slide->stopperqty *  $count;
        $windbreakqty = $slide->windbreakqty *  $count;
        $siliconqty = $slide->siliconqty *  $count;
        $fixerqty = $slide->fixerqty * $count;
        $slidekeepqty = $slide->slidekeepqty *  $count;
        $steeltapqty = $slide->steeltapqty *  $count;
        $conscrewqty = $slide->conscrewqty *  $count;
        
        $sashroll = $sashrollqty *  $slide->sashrollrate;
        $bumperblock = $bumperblockqty *  $slide->bumperblockrate;
        $dummywheel = $dummywheelqty *  $slide->dummywheelrate;
        $flathandle = $flathandleqty *  $slide->flathandlerate;
        $netwheel = $netwheelqty *  $slide->netwheelrate;
        $stopper = $stopperqty *  $slide->stopperrate;
        $windbreak = $windbreakqty *  $slide->windbreakrate;
        $silicon = $siliconqty *  $slide->siliconrate;
        $fixer = $fixerqty *  $slide->fixerrate;
        $slidekeep = $slidekeepqty *  $slide->slidekeeprate;
        $steeltap = $steeltapqty *  $slide->steeltaprate;
        $conscrew = $conscrewqty *  $slide->conscrewrate;
        $accesstotal = $sashroll + $bumperblock +  $dummywheel+$flathandle+ $netwheel+ $stopper +$windbreak+$silicon+$fixer+$slidekeep
        +$steeltap+$conscrew;
        if(!empty($exist)){
            $exist->outerrn = $outertotal;
            $exist->slidern =$slidetotal;
            $exist->netframrn =$nettotal;
            $exist->slidebeedrn =$slidebeed;
            $exist->interlockrn =$interlock;
            $exist->outersteelrn =$outertotal;
            $exist->slidesteelrn =$slidetotal;
            $exist->netframesteelrn =$netsteeltotal;
            $exist->netrn =$net;
            $exist->gaskitrn =$gaskit;
            $exist->netgaskitrn =$netgaskit;
            $exist->brushrolrn =$slidebrush;
            $exist->aluminiumrn =$aluminiumrail;

            $exist->Project = $projectid;
            $exist->jobcost ="jobcost";
            $exist->designtype = $designtype.' '."total cost";
            $exist->width = $width;
            $exist->height = $height;
            $exist->designtyperatio = $projrec->designtyperatio;
            $exist->typeamount = $typeamount;
            $exist->outeramount = $outeramount;
            $exist->outersteelamount = $outersteelamount;
            $exist->slideamount = $slideamount;
            $exist->slidesteelamount = $slidesteelamount;
            $exist->netamount = $netamount;
            $exist->netsteelamount = $netsteelamount;
            $exist->slidebeedamount = $slidebeedamount;
            $exist->company = $company;
            // $profile->typeamount = $typeamount;
            $exist->nettamount  = $nettamount ;
            $exist->netgaskitamount = $netgaskitamount;
            $exist->gaskitamount=$gaskitamount;
            $exist->slidingbrushamount=$slidingbrushamount;
            $exist->aluminiumrailamount=$aluminiumrailamount;
            $exist->interlockamount=$interlockamount;
            $exist->totalexpense = $totalexpense;
            $exist->hardwarecost = $accesstotal;
            $exist->totalcost = $totalexpense + $accesstotal;
            $updatee=$exist->update();
            if ($updatee){
                return  $exist->totalcost;
                }
        }else{
            $profile = new ProjectWindow();
            $profile = new ProjectWindow();
            $profile->outerrn = $outertotal;
            $profile->slidern =$slidetotal;
            $profile->netframrn =$nettotal;
            $profile->slidebeedrn =$slidebeed;
            $profile->interlockrn =$interlock;
            $profile->outersteelrn =$outertotal;
            $profile->slidesteelrn =$slidetotal;
            $profile->netframesteelrn =$netsteeltotal;
            $profile->netrn =$net;
            $profile->gaskitrn =$gaskit;
            $profile->netgaskitrn =$netgaskit;
            $profile->brushrolrn =$slidebrush;
            $profile->aluminiumrn =$aluminiumrail;

            $profile->Project = $projectid;
            $profile->final = 1;
            $profile->jobcost ="jobcost";
            $profile->designtype = $designtype.' '."Total cost";
            $profile->company = $company;
            $profile->width = $width;
            $profile->height = $height;
            $profile->designtyperatio = $projrec->designtyperatio;
            $profile->typeamount = $typeamount;
            $profile->outeramount = $outeramount;
            $profile->outersteelamount = $outersteelamount;
            $profile->slideamount = $slideamount;
            $profile->slidesteelamount = $slidesteelamount;
            $profile->netamount = $netamount;
            $profile->netsteelamount = $netsteelamount;
            $profile->slidebeedamount = $slidebeedamount;
            // $profile->typeamount = $typeamount;
            $profile->nettamount  = $nettamount ;
            $profile->netgaskitamount = $netgaskitamount;
            $profile->gaskitamount=$gaskitamount;
            $profile->slidingbrushamount=$slidingbrushamount;
            $profile->aluminiumrailamount=$aluminiumrailamount;
            $profile->interlockamount=$interlockamount;
            $profile->totalexpense = $totalexpense;
            $profile->hardwarecost = $accesstotal;
            $profile->totalcost = $totalexpense + $accesstotal;
            $save=$profile->save();
           if ($save){
            return  $profile->totalcost;
            }
        }
        

    }
    function allfixprofile($height,$width,$projrec,$slide,$designtype,$projectid,$exist,$company,$count){

        $outertotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('outerrn');
        $slidebeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('slidebeedrn');
        $outersteel = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('outersteelrn');
        $gaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('gaskitrn');
     
           $outerprofile = $outertotal / 18;
        $outersteelprofile = $outersteel / 8;
         $slidebeedprfile = $slidebeed / 18;          

        //  $outerprice = $profile->price($profile->frame);
        $outerprice = $slide->outerprice;
        $outersteelprice = $slide->outersteelprice;
         $slidebeedprice= $slide->slidebeedprice;
        $gaskitprice =  $slide->gaskitprice;

        $outeramount =   $outerprofile * $outerprice;
         $slidebeedamount = $slidebeedprfile * $slidebeedprice ;

        $outersteelamount = $outersteelprofile * $outersteelprice;
        $gaskitamount = $gaskit  * $gaskitprice;
       
        $total = $outeramount + $slidebeedamount +$outersteelamount+  $gaskitamount ;
        $totalexpense = $total;

        $runningft = $width * 2 + $height * 2;
         $siliconqty =  $slide->siliconqty * $count;
        $silicon = $siliconqty *  $slide->siliconrate;
        $steeltapqty = $slide->steeltapqty  * $runningft * $count;
        $conscrewqty = $slide->conscrewqty * $runningft * $count;
     
        $steeltap = $slide->steeltaprate * $steeltapqty ;
        $conscrew = $slide->conscrewrate * $conscrewqty;
        $accesstotal =  $conscrew +  $steeltap + $silicon;
        
        if(!empty($exist)){
          
            $exist->Project = $projectid;
            $exist->jobcost ="jobcost";
            $exist->designtype = $designtype.' '."total cost";
            $exist->width = $width;
            $exist->height = $height;
            $exist->designtyperatio = $projrec->designtyperatio;
            $exist->outeramount = $outeramount;
            $exist->outersteelamount = $outersteelamount;
            $exist->company = $company;
            $exist->slidebeedamount = $slidebeedamount;
            // $profile->typeamount = $typeamount;
            $exist->gaskitamount=$gaskitamount;
            $exist->totalexpense=$totalexpense;
            $exist->hardwarecost = $accesstotal;
            $exist->totalcost = $totalexpense + $accesstotal;
           $updatee =  $exist->update();
           if ($updatee){
           return  $exist->totalcost;
           }
        }else{
            $profile = new ProjectWindow();
            $profile->Project = $projectid;
            $profile->final = 1;
            $profile->jobcost ="jobcost";
            $profile->designtype = $designtype.' '."total cost";
            $profile->width = $width;
            $profile->height = $height;
            $profile->designtyperatio = $projrec->designtyperatio;
            $profile->company = $company;
            $profile->outeramount = $outeramount;
            $profile->outersteelamount = $outersteelamount;
            $profile->company = $company;
            $profile->slidebeedamount = $slidebeedamount;
            $profile->gaskitamount=$gaskitamount;
            $profile->totalexpense=$totalexpense;
            $profile->hardwarecost = $accesstotal;
            $profile->totalcost = $totalexpense + $accesstotal;
           $insert =  $profile->save();
           if ($insert){
            return  $profile->totalcost;
            }
        }
      

    }
    function allfixwinplastprofile($height,$width,$projrec,$slide,$designtype,$projectid,$exist,$company,$count){
      $outertotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('outerrn');
        $slidebeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('slidebeedrn');
        $outersteel = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('outersteelrn');
        $gaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('gaskitrn');

         $outerprofile = $outertotal / 18;
         $outersteelprofile = $outersteel * 9 / 8;
         $slidebeedprfile = $slidebeed / 18;          

        //  $outerprice = $profile->price($profile->frame);
        $outerprice = $slide->outerprice;
        $outersteelprice = $slide->outersteelprice;
        $slidebeedprice= $slide->slidebeedprice;
        $gaskitprice =  $slide->gaskitprice;
        
        $outerw = $slide->outerw;
        $beedingw = $slide->beedingw;

        $outeramount =   $outerprofile * $outerprice * $outerw;
        $slidebeedamount = $slidebeedprfile * $slidebeedprice  * $beedingw;
        $outersteelamount =  $outersteelprofile * $outersteelprice;
        $gaskitamount = $gaskit  * $gaskitprice;
        $total = $outeramount + $slidebeedamount +$outersteelamount+  $gaskitamount;
        $totalexpense = $total;

        $runningft = $width * 2 + $height * 2;
        $siliconqty =  $slide->siliconqty * $count;
        $steeltapqty = $slide->steeltapqty  * $runningft * $count;
        $conscrewqty = $slide->conscrewqty * $runningft * $count;
        $silicon = $siliconqty *  $slide->siliconrate;
        $steeltap = $slide->steeltaprate * $steeltapqty ;
        $conscrew = $slide->conscrewrate * $conscrewqty;
        $accesstotal =$silicon+  $conscrew +  $steeltap;
        
        if(!empty($exist)){
           
            $exist->Project = $projectid;
            $exist->jobcost ="jobcost";
            $exist->designtype = $designtype.' '."total cost";
            $exist->width = $width;
            $exist->height = $height;
            $exist->designtyperatio = $projrec->designtyperatio;
            $exist->width = $width;
            $exist->height = $height;
            $exist->designtyperatio = $projrec->designtyperatio;
            $exist->outeramount = $outeramount;
            $exist->outersteelamount = $outersteelamount;
            $exist->company = $company;
            $exist->slidebeedamount = $slidebeedamount;
            // $profile->typeamount = $typeamount;
            $exist->gaskitamount=$gaskitamount;
            $exist->totalexpense=$totalexpense;
            $exist->hardwarecost = $accesstotal;
            $exist->totalcost = $totalexpense + $accesstotal;
           $updatee =  $exist->update();
           if($updatee){
            return $exist->totalexpense;
           }
        }else{
            $profile = new ProjectWindow();
            $profile->Project = $projectid;
            $profile->final = 1;
            $profile->jobcost ="jobcost";
            $profile->designtype =$designtype.' '."total cost";
            $profile->width = $width;
            $profile->height = $height;
            $profile->designtyperatio = $projrec->designtyperatio;
            $profile->width = $width;
            $profile->height = $height;
            $profile->designtyperatio = $projrec->designtyperatio;
            $profile->company = $company;
            $profile->outeramount = $outeramount;
            $profile->outersteelamount = $outersteelamount;
            $profile->company = $company;
            $profile->slidebeedamount = $slidebeedamount;
            $profile->gaskitamount=$gaskitamount;
            $profile->totalexpense=$totalexpense;
            $profile->hardwarecost = $accesstotal;
            $profile->totalcost = $totalexpense + $accesstotal;
           $insert =  $profile->save();
           if ($insert){
            return  $profile->totalexpense;
            }
        }
      

    }
    function openablewinprofile($height,$width,$projrec,$slide,$designtype,$projectid,$exist,$company,$count){

        $outertotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('outerrn');
        $slidebeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('slidebeedrn');
        $gaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('gaskitrn');
        $slidetotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('slidern');
        $xgaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('xgaskitrn');
        $gaskitbeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('gaskitbeedrn');

      

        $outerprofile = $outertotal / 18;
        $slideprofile =  $slidetotal / 18;  
        $outersteelprofile = $outertotal / 8;
        $slidesteelprofile =  $slidetotal / 8;
        $slidebeedprfile = $slidebeed / 18;          

       //  $outerprice = $profile->price($profile->frame);
       $outerprice = $slide->outerprice;
       $outersteelprice = $slide->outersteelprice;
       $slideprice = $slide->slideprice;
       $slidesteelprice = $slide->slidesteelprice;
       $slidebeedprice= $slide->slidebeedprice;
       $gaskitprice =  $slide->gaskitprice;
       $xgaskitprice =  $slide->xgaskitprice;
       $gaskitbeedprice =  $slide->gaskitbeedprice;

       if($projrec->winlock == "gear_handles"){
        $lockprice = $projrec->prices->gearprice;
        }else{
            $lockprice = $projrec->prices->cockspurprice;
        }

       $outerw = $slide->outerw;
       $slidew = $slide->slidew;
       $beedingw = $slide->beedingw;

       $outeramount =  $outerprofile * $outerprice * $outerw;
       $slideamount =  $slideprofile * $slideprice *$slidew;
       $slidebeedamount = $slidebeedprfile * $slidebeedprice *$beedingw;
       $outersteelamount =  $outersteelprofile * $outersteelprice;
       $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
       $gaskitamount = $gaskit  * $gaskitprice;
       $xgaskitamount = $xgaskit  * $xgaskitprice;
       $gaskitbeedamount = $gaskitbeed  * $gaskitbeedprice;
       $typeamount = $lockprice* $count;
       $total = ceil($outeramount) +ceil($slideamount) + ceil($slidebeedamount) + $gaskitbeedamount+ $slidesteelamount + $outersteelamount+ $xgaskitamount + $gaskitamount + $typeamount;
       $totalexpense = $total;

       if($projrec->lock == "gear_handles" && $projrec->designtyperatio == "casement"){
        $accesstotal =  $this->gearopenallaccess($projrec, $width,$height,$projrec->hing,$lockprice);
     
        }else if($projrec->lock == "cockspurhandle" &&  $projrec->designtyperatio == "casement"){
            $accesstotal =    $this->openallaccess($projrec, $width,$height,$projrec->hing,$lockprice);   
        }else if($projrec->lock == "gear_handles" && $projrec->designtyperatio == "tophing"){
            $accesstotal =    $this->hinggearopenallaccess($projrec, $width,$height,$projrec->hing,$lockprice);   
        }else if($projrec->lock == "cockspurhandle" &&  $projrec->designtyperatio == "tophing"){
            $accesstotal =    $this->hingopenallaccess($projrec, $width,$height,$$projrec->hing,$lockprice);   
        }else{
            $accesstotal = 0;
        }
      
       if(!empty($exist)){
         
        $exist->Project = $projectid;
        $exist->jobcost ="jobcost";
        $exist->designtype = $designtype.' '."total cost";
        $exist->width = $width;
        $exist->height = $height;
        $exist->designtyperatio = $projrec->designtyperatio;
        $exist->company = $company;
        $exist->typeamount = $typeamount;
        $exist->outeramount = ceil($outeramount);
        $exist->outersteelamount = ceil($outersteelamount);
        $exist->slideamount = $slideamount;
        $exist->slidesteelamount = $slidesteelamount;
        $exist->slidebeedamount = ceil($slidebeedamount);
        // $profile->typeamount = $typeamount;
        $exist->gaskitamount=$gaskitamount;
        $exist->xgaskitamount=$xgaskitamount;
        $exist->gaskitbeedamount=$gaskitbeedamount;
        $exist->totalexpense = $totalexpense ;
        $exist->hardwarecost = $accesstotal;
        $exist->totalcost = $totalexpense + $accesstotal;
        $updatee=$exist->update();
        if($updatee){
            return  $exist->totalcost;
        }
       }else{

        $exist = new ProjectWindow(); 
        $exist->Project = $projectid;
        $exist->final = 1;
        $exist->jobcost ="jobcost";
        $exist->designtype = $designtype.' '."total cost";
        $exist->company = $company;
        $exist->width = $width;
        $exist->height = $height;
        $exist->typeamount = $typeamount;
        $exist->designtyperatio = $projrec->designtyperatio;
        $exist->outeramount = ceil($outeramount);
        $exist->outersteelamount = ceil($outersteelamount);
        $exist->slideamount = $slideamount;
        $exist->slidesteelamount = $slidesteelamount;
        $exist->slidebeedamount = ceil($slidebeedamount);
        // $profile->typeamount = $typeamount;
        $exist->gaskitamount=$gaskitamount;
        $exist->xgaskitamount=$xgaskitamount;
        $exist->gaskitbeedamount=$gaskitbeedamount;
        $exist->totalexpense = $totalexpense ; 
        $exist->hardwarecost = $accesstotal;
        $exist->totalcost = $totalexpense + $accesstotal;
        $insert=$exist->save();
        if ($insert){
            return  $exist->totalcost;
            }
       }
   
    
        

    }
    function openableprofile($height,$width,$projrec,$slide,$designtype,$projectid,$exist,$company,$count){

      $outertotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('outerrn');
        $slidebeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('slidebeedrn');
        $gaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('gaskitrn');
        $slidetotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('slidern');
        $xgaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('xgaskitrn');
        $gaskitbeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->where('company',$company)->where('final',1)->sum('gaskitbeedrn');

      

       $outerprofile = $outertotal / 18;
        $slideprofile =  $slidetotal / 18;
        $outersteelprofile = $outertotal / 8;
        $slidesteelprofile =  $slidetotal / 8;
        $slidebeedprfile = $slidebeed / 18;      

       //  $outerprice = $profile->price($profile->frame);
       $outerprice = $slide->outerprice;
       $outersteelprice = $slide->outersteelprice;
       $slideprice = $slide->slideprice;
       $slidesteelprice = $slide->slidesteelprice;
       $slidebeedprice= $slide->slidebeedprice;
       $gaskitprice =  $slide->gaskitprice;
       $xgaskitprice =  $slide->xgaskitprice;
       $gaskitbeedprice =  $slide->gaskitbeedprice;
     if($projrec->winlock == "gear_handles"){
        $lockprice = $projrec->prices->gearprice;
        }else{
            $lockprice = $projrec->prices->cockspurprice;
        }

       $outerw = $slide->outerw;
       $slidew = $slide->slidew;
       $beedingw = $slide->beedingw;

     $outeramount =  $outerprofile * $outerprice ;
       $slideamount =  $slideprofile * $slideprice ;
       $slidebeedamount = $slidebeedprfile * $slidebeedprice ;
       $outersteelamount =  $outersteelprofile * $outersteelprice;
       $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
       $gaskitamount = $gaskit  * $gaskitprice;
       $xgaskitamount = $xgaskit  * $xgaskitprice;
       $gaskitbeedamount = $gaskitbeed  * $gaskitbeedprice;
       $typeamount = $lockprice* $count;
       $total = ceil($outeramount) +ceil($slideamount) + ceil($slidebeedamount) + $gaskitbeedamount+ $slidesteelamount + $outersteelamount+ $xgaskitamount + $gaskitamount ;
       $totalexpense = $total;

       
       if($projrec->winlock == "gear_handles" && $projrec->designtyperatio == "casement"){
        $accesstotal =  $this->gearopenallaccess($projrec, $width,$height,$projrec->hing,$lockprice,$count);
     
        }else if($projrec->winlock  == "cockspurhandle" &&  $projrec->designtyperatio == "casement"){
            $accesstotal =    $this->openallaccess($projrec, $width,$height,$projrec->hing,$lockprice,$count);   
        }else if($projrec->winlock  == "gear_handles" && $projrec->designtyperatio == "tophing"){
            $accesstotal =    $this->hinggearopenallaccess($projrec, $width,$height,$projrec->hing,$lockprice,$count);   
        }else if($projrec->winlock  == "cockspurhandle" &&  $projrec->designtyperatio == "tophing"){
            $accesstotal =    $this->hingopenallaccess($projrec, $width,$height,$$projrec->hing,$lockprice,$count);   
        }else{
            $accesstotal = 0;
        }
      
       if(!empty($exist)){
        $exist->Project = $projectid;
        $exist->jobcost ="jobcost";
        $exist->designtype = $designtype.' '."total cost";
        $exist->width = $width;
        $exist->height = $height;
        $exist->designtyperatio = $projrec->designtyperatio;
        $exist->company = $company;
        $exist->typeamount = $typeamount;
          $exist->frame = $slide->frame;
        $exist->outeramount = ceil($outeramount);
        $exist->outersteelamount = ceil($outersteelamount);
        $exist->slideamount = $slideamount;
        $exist->slidesteelamount = $slidesteelamount;
        $exist->slidebeedamount = ceil($slidebeedamount);
        // $profile->typeamount = $typeamount;
        $exist->gaskitamount=$gaskitamount;
        $exist->xgaskitamount=$xgaskitamount;
        $exist->gaskitbeedamount=$gaskitbeedamount;
        $exist->totalexpense = $totalexpense ;
        $exist->hardwarecost = $accesstotal;
        $exist->totalcost = $totalexpense + $accesstotal;
        $updatee=$exist->update();
        if($updatee){
            return  $exist->totalcost;
        }
       }else{
        $profile = new ProjectWindow();
         
        $profile->Project = $projectid;
        $profile->jobcost ="jobcost";
        $profile->final = 1;
        $profile->designtype = $designtype.' '."total cost";
        $profile->width = $width;
        $profile->height = $height;
        $profile->designtyperatio = $projrec->designtyperatio;
        $profile->company = $company;
        $profile->typeamount = $typeamount;
        $profile->frame = $slide->frame;
        $profile->outeramount = ceil($outeramount);
        $profile->outersteelamount = ceil($outersteelamount);
        $profile->slideamount = $slideamount;
        $profile->slidesteelamount = $slidesteelamount;
        $profile->slidebeedamount = ceil($slidebeedamount);
        // $profile->typeamount = $typeamount;
        $profile->gaskitamount=$gaskitamount;
        $profile->xgaskitamount=$xgaskitamount;
        $profile->gaskitbeedamount=$gaskitbeedamount;
        $profile->totalexpense = $totalexpense ;
        $profile->hardwarecost = $accesstotal;
        $profile->totalcost = $totalexpense + $accesstotal;
        $insert=$profile->save();
        if ($insert){
            return $profile->totalcost;
            }
       }
   
    
        

    }
    function openallaccess($proj, $width,$height,$hindge,$typeamount,$count){
        $runningft = $width * 2 + $height * 2;
        $siliconqty = $proj->siliconqty * $count;
        $silicon = $siliconqty *  $proj->siliconrate;
        $outwardcaseqty = $proj->outwardcaseqty * $count;
        $outwardcase = $outwardcaseqty * $proj->outwardcaserate;
        $windowstayqty =  $proj->windowstayqty * $count;
        $windowstay= $proj->windowstayqty * $proj->windowstayrate;
        // $frictionstay= $proj->openpricesqty->frictionstayqty * $proj->openpricesqty->frictionstayrate;
        $pencilhindgeqty =  $proj->pencilhindgeqty * $count;
        $pencilhindge= $pencilhindgeqty * $proj->pencilhindgerate;
         $flathandleqty = $proj->flathandleqty * $count;
        $flathandle= $flathandleqty * $proj->flathandlerate;
        $twoDhindgesqty = $proj->twoDhindgesqty * $count;
        $twoDhindges= $twoDhindgesqty * $proj->twoDhindgesrate;
        $thDhindgesqty = $proj->thDhindgesqty * $count;
        $thDhindges= $thDhindgesqty * $proj->thDhindgesrate;
        $openablekeepqty =  $proj->openablekeepqty * $count;
        $openablekeep = $openablekeepqty * $proj->openablekeeprate	;
        $Tlockqty = $proj->Tlockqty * $count;
        $Tlock = $Tlockqty * $proj->Tlockrate	;

        if($hindge == "twohing"){
            $total =$silicon+  $outwardcase +  $windowstay  + $pencilhindge +$flathandle + 
        $twoDhindges +$openablekeep + $Tlock +$typeamount;
        }else{
            $total =$silicon+  $outwardcase +  $windowstay + $pencilhindge +$flathandle + 
        $thDhindges+$openablekeep + $Tlock +$typeamount;
        }
           return $total;
    }
    function gearopenallaccess($proj, $width,$height,$hindge,$typeamount,$count){
        $runningft = $width * 2 + $height * 2;
        $siliconqty = $proj->siliconqty * $count;
        $silicon = $siliconqty *  $proj->siliconrate;
         $outwardcaseqty = $proj->outwardcaseqty * $count;
        $outwardcase = $outwardcaseqty * $proj->outwardcaserate;
        $windowstayqty =  $proj->windowstayqty * $count;
        $windowstay= $proj->windowstayqty * $proj->windowstayrate;
        // $frictionstay= $proj->openpricesqty->frictionstayqty * $proj->openpricesqty->frictionstayrate;
         $pencilhindgeqty =  $proj->pencilhindgeqty * $count;
        $pencilhindge= $pencilhindgeqty * $proj->pencilhindgerate;
        $flathandleqty = $proj->flathandleqty * $count;
        $flathandle= $flathandleqty * $proj->flathandlerate;
        $twoDhindgesqty = $proj->twoDhindgesqty * $count;
        $twoDhindges= $twoDhindgesqty * $proj->twoDhindgesrate;
        $thDhindgesqty = $proj->thDhindgesqty * $count;
        $thDhindges= $thDhindgesqty * $proj->thDhindgesrate;
        $openablekeepqty =  $proj->openablekeepqty * $count;
        $openablekeep = $openablekeepqty * $proj->openablekeeprate	;
        $Tlockqty = $proj->Tlockqty * $count;
        $Tlock = $Tlockqty * $proj->Tlockrate	;

         if($hindge == "twohing"){
            $total =$silicon+  $outwardcase +  $windowstay + $pencilhindge +$flathandle + 
        $twoDhindges +$openablekeep + $Tlock +$typeamount;
        }else{
            $total =$silicon+  $outwardcase +  $windowstay + $pencilhindge +$flathandle + 
        $thDhindges+$openablekeep + $Tlock +$typeamount;
        }
           return $total;
    }
     
    function hingopenallaccess($proj, $width,$height,$hindge,$typeamount,$count){
        $runningft = $width * 2 + $height * 2;
        $siliconqty = $proj->siliconqty * $count;
        $silicon = $siliconqty *  $proj->siliconrate;
        $outwardcaseqty = $proj->outwardcaseqty * $count;
        $outwardcase = $outwardcaseqty * $proj->outwardcaserate;
        // $windowstay= $proj->windowstayqty * $proj->windowstayrate;
        $frictionstayqty = $proj->frictionstayqty * $count;
        $frictionstay= $frictionstayqty * $proj->frictionstayrate;
         $pencilhindgeqty =  $proj->pencilhindgeqty * $count;
        $pencilhindge= $pencilhindgeqty * $proj->pencilhindgerate;
        $flathandleqty = $proj->flathandleqty * $count;
        $flathandle= $flathandleqty * $proj->flathandlerate;
        $twoDhindgesqty = $proj->twoDhindgesqty * $count;
        $twoDhindges= $twoDhindgesqty * $proj->twoDhindgesrate;
        $thDhindgesqty = $proj->thDhindgesqty * $count;
        $thDhindges= $thDhindgesqty * $proj->thDhindgesrate;
        $openablekeepqty =  $proj->openablekeepqty * $count;
        $openablekeep = $openablekeepqty * $proj->openablekeeprate	;
        $Tlockqty = $proj->Tlockqty * $count;
        $Tlock = $Tlockqty * $proj->Tlockrate	;
        $total =$silicon+  $outwardcase + $frictionstay + $pencilhindge +$flathandle +$openablekeep + $Tlock +$typeamount;
           return $total;
    }
    function hinggearopenallaccess($proj, $width,$height,$hindge,$typeamount,$count){
        $runningft = $width * 2 + $height * 2;
       $siliconqty = $proj->siliconqty * $count;
        $silicon = $siliconqty *  $proj->siliconrate;
        $outwardcaseqty = $proj->outwardcaseqty * $count;
        $outwardcase = $outwardcaseqty * $proj->outwardcaserate;
        // $windowstay= $proj->windowstayqty * $proj->windowstayrate;
        $frictionstayqty = $proj->frictionstayqty * $count;
        $frictionstay= $frictionstayqty * $proj->frictionstayrate;
         $pencilhindgeqty =  $proj->pencilhindgeqty * $count;
        $pencilhindge= $pencilhindgeqty * $proj->pencilhindgerate;
        $flathandleqty = $proj->flathandleqty * $count;
        $flathandle= $flathandleqty * $proj->flathandlerate;
        $twoDhindgesqty = $proj->twoDhindgesqty * $count;
        $twoDhindges= $twoDhindgesqty * $proj->twoDhindgesrate;
        $thDhindgesqty = $proj->thDhindgesqty * $count;
        $thDhindges= $thDhindgesqty * $proj->thDhindgesrate;
        $openablekeepqty =  $proj->openablekeepqty * $count;
        $openablekeep = $openablekeepqty * $proj->openablekeeprate	;
        $Tlockqty = $proj->Tlockqty * $count;
        $Tlock = $Tlockqty * $proj->Tlockrate	;
            $total =$silicon+  $outwardcase  + $frictionstay + $pencilhindge +$flathandle +$openablekeep + $Tlock +$typeamount;

           return $total;
    }
   
    public function quotesheet(Request $request,$id){
        $company = $request->company;
        $project_id = $id;
        $typ = Project::$type;
        $slidedesigntype =  $typ['sliding'];
        $fixdesigntype =  $typ['fix'];
        $opendesigntype =  $typ['open'];
        $br = ProjectWindow::$brand;
        $buraq =  $br['Buraq'];
        $win =  $br['Winplast'];
        $asas =  $br['Asaspen'];
        $slideall = 0;
        $slide = ProjectWindow::where('project', $id)->where('designtype',$slidedesigntype)->where('company',$company)->where('final',1)->first();
        if($slide){
            $width = ProjectWindow::where('project', $id)->where('designtype',$slide->designtype)->where('company',$slide->company)->where('final',1)->sum('width');
            $height = ProjectWindow::where('project', $id)->where('designtype',$slide->designtype)->where('company',$slide->company)->where('final',1)->sum('height');
            $slidesqf = ProjectWindow::where('project', $id)->where('designtype',$slide->designtype)->where('company',$slide->company)->where('final',1)->sum('sqf');
            $slidecount = ProjectWindow::where('project', $id)->where('designtype',$slide->designtype)->where('final',1)->where('company',$slide->company)->count();
            $price =  UserSlidingAccess::where('frame',$slide->frame)->first();
            $exist = ProjectWindow::where('project', '=', $id)->where('designtype','sliding total cost')->where('company',$slide->company)->where('final',1)->first();
            if($slide->company == $win){
                $slideall =  $this->slidewinplastprofile($height,$width,$slide,$price,$slide->designtype,$id,$exist,$slide->company,$slidecount);
            }else{
                  $slideall = $this->slideprofile($height,$width,$slide,$price,$slide->designtype,$id,$exist,$slide->company,$slidecount);
            }
        }
        $fix = ProjectWindow::where('project', $id)->where('designtype',$fixdesigntype)->where('final',1)->where('company',$company)->first();
        if($fix){
            $width = ProjectWindow::where('project', $id)->where('designtype',$fix->designtype)->where('company',$fix->company)->where('final',1)->sum('width');
            $height = ProjectWindow::where('project', $id)->where('designtype',$fix->designtype)->where('company',$fix->company)->where('final',1)->sum('height');
            $fixsqf = ProjectWindow::where('project', $id)->where('designtype',$fix->designtype)->where('company',$fix->company)->where('final',1)->sum('sqf');
            $fixcount = ProjectWindow::where('project', $id)->where('designtype',$fix->designtype)->where('final',1)->where('company',$fix->company)->count();
            $price =  UserSlidingAccess::where('frame',$fix->frame)->first();
            $exist = ProjectWindow::where('project', '=', $id)->where('designtype','fix total cost')->where('company',$fix->company)->where('final',1)->first();
            if($fix->company == $win){
                $fixall =  $this->allfixwinplastprofile($height,$width,$fix,$price,$fix->designtype,$id,$exist,$fix->company,$fixcount);
            }else{
                $fixall =  $this->allfixprofile($height,$width,$fix,$price,$fix->designtype,$id,$exist,$fix->company,$fixcount);
            }
        }
        $open = ProjectWindow::where('project', $id)->where('designtype',$opendesigntype)->where('company',$company)->where('final',1)->first();
        if($open){
           
            $width = ProjectWindow::where('project', $id)->where('designtype',$open->designtype)->where('company',$open->company)->where('final',1)->sum('width');
            $height = ProjectWindow::where('project', $id)->where('designtype',$open->designtype)->where('company',$open->company)->where('final',1)->sum('height');
            $opensqf = ProjectWindow::where('project', $id)->where('designtype',$open->designtype)->where('company',$open->company)->where('final',1)->sum('sqf');
            $opencount = ProjectWindow::where('project', $id)->where('designtype',$open->designtype)->where('final',1)->where('company',$open->company)->count();
        $price =  UserSlidingAccess::where('frame',$open->frame)->first();
            $exist = ProjectWindow::where('project', '=', $id)->where('designtype','open total cost')->where('company',$open->company)->where('final',1)->first();

            if($open->company == $win){
                $openall = $this->openablewinprofile($height,$width,$open,$price,$open->designtype,$id,$exist,$open->company,$opencount);
            }else{
                $openall =$this->openableprofile($height,$width,$open,$price,$open->designtype,$id,$exist,$open->company,$opencount);
            }
        }
        if(empty($open) && empty($fix)){
            $sqfall = $slidesqf  ;
            $amountalll = $slideall ;
            $amountall = round($amountalll);
            $sqfper = $amountall /  $sqfall;
            $rateper = round($sqfper);
            $fb = $sqfall * 10;
            $openall  = 0;
            $opencount = 0;
            $fixcount = 0;
            $fixall = 0;
           return view('projectwindows.internaljobquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb','project_id')); 
           }else if(empty($open) && empty($slide)){
            $sqfall = $fixsqf;
            $amountalll = $fixall ;
            $amountall = round($amountalll);
            $sqfper = $amountall /  $sqfall;
            $rateper = round($sqfper);
            $fb = $sqfall * 10;
            $openall  = 0;
            $opencount = 0;
            $slidecount = 0;
            $slideall = 0;
           return view('projectwindows.internaljobquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb','project_id')); 
           }else if(empty($fix) && empty($slide)){
            $sqfall = $opensqf;
            $amountalll = $openall ;
            $amountall = round($amountalll);
            $sqfper = $amountall /  $sqfall;
            $rateper = round($sqfper);
            $fb = $sqfall * 10;
            $fixall  = 0;
            $fixcount = 0;
            $slidecount = 0;
            $slideall = 0;
           return view('projectwindows.internaljobquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb','project_id')); 
           }else if(empty($slide)){
              
            $sqfall = $fixsqf + $opensqf;
            $amountalll = $fixall + $openall;
            $amountall = round($amountalll);
            $sqfper = $amountall /  $sqfall;
            $rateper = round($sqfper);
            $fb = $sqfall * 10;
            $slideall  = 0;
            $slidecount = 0;
           return view('projectwindows.internaljobquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb','project_id')); 
           }else if(empty($open)){
            $sqfall = $fixsqf + $slidesqf;
            $amountalll = $fixall + $slideall;
            $amountall = round($amountalll);
            $sqfper = $amountall /  $sqfall;
            $rateper = round($sqfper);
            $fb = $sqfall * 10;
            $openall  = 0;
            $opencount = 0;
           return view('projectwindows.internaljobquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb','project_id')); 
           }else if(empty($fix)){
            $sqfall = $opensqf + $slidesqf;
            $amountalll = $openall + $slideall;
            $amountall = round($amountalll);
            $sqfper = $amountall /  $sqfall;
            $rateper = round($sqfper);
            $fb = $sqfall * 10;
            $fixall  = 0;
            $fixcount = 0;
           return view('projectwindows.internaljobquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb','project_id')); 
           }else{
            $sqfall = $slidesqf + $fixsqf + $opensqf;
            $amountalll =  $slideall + $fixall + $openall ;
            $amountall = round($amountalll);
            $sqfper = $amountall /  $sqfall;
            $rateper = round($sqfper);
            $fb = $sqfall * 10;
       
           return view('projectwindows.internaljobquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb','project_id'));
           }
    }


   
}
