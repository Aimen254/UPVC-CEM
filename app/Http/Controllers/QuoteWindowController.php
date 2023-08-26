<?php

namespace App\Http\Controllers;
use App\Models\ProjectWindow;
use App\Models\Project;
use App\Models\ProjWindowAcces;
use App\Models\AssignWindow;
use App\Models\UserSlidingAccess;
use App\Models\OpenAssignAccess;
use App\Models\ProjWinEntry;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Carbon\Carbon;

class QuoteWindowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
          $projent = ProjWinEntry::where('project_id', $id)->get();
        $proj = ProjectWindow::where('project', $id)->get();
        return view('projectwindows.quoteindex', compact('projent','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
        //  $accounts = Project::$type;
        //      $accounts::prepend('Select Profile','');
        $accs = Project::$type;
         $accounts = Arr::prepend($accs,'Select Type' );
      $slidet = Project::$slidetype;
        $slidetype = Arr::prepend($slidet,'Select Slide Type' );
        $opent = Project::$opentype;
        $opentype = Arr::prepend($opent,'Select Open Type' );
        $fixt = Project::$fixtype;
        $fixtype = Arr::prepend($fixt,'Select Fix Type' );
             $doort = ProjectWindow::$ratio;
        $doortype =  Arr::prepend($doort,'Select Door Type' );
        $slidelk = Project::$slidelock;
        $slidelock = Arr::prepend($slidelk,'Select Lock' );
        $openlk = Project::$openlock;
        $openlock = Arr::prepend($openlk,'Select Lock' );
             $doorlk = Project::$doorlock;
        $doorlock = Arr::prepend($doorlk,'Select Lock' );
        $openldi = Project::$opendir;
        $opendir = Arr::prepend($openldi,'Select Lock' );
        $openhin = Project::$hing;
        $hing = Arr::prepend($openhin,'Select hindge' );
          $handle = ProjectWindow::$handle;
        $doorhandle = Arr::prepend($handle,'Select handle' );
        $slide = AssignWindow::where('type', 'sliding')->get()->pluck('profile', 'id');
        $fix = AssignWindow::where('type', 'fix')->get()->pluck('profile', 'id');
        $fix->prepend('Select FixType', '');
        $open = AssignWindow::where('type', 'openable')->get()->pluck('profile', 'id');
        $open->prepend('Select OpenType', '');
         $door = AssignWindow::where('type', 'door')->get()->pluck('profile', 'id');
        $door->prepend('Select Doortype', '');
          return view('projectwindows.quote', compact('accounts','slide','project_id','fix','open','slidetype'
        ,'opentype','fixtype','slidelock','openlock','opendir','hing','doortype','doorhandle','doorlock','door'));
    }
    //     single sliding //
   public function checkprofile($id,$width, $height,$type,$profiledata,$designtyperatio,$lock,$projwinid){
        $usr = \Auth::user();
        $width = $width;
        $height = $height;
        $designtype = $type;
        $proj = new ProjectWindow();
     
        $proj->frame_id= $profiledata->id;
        $proj->project  = $id;
         $proj->frame= $profiledata->profile;
         $proj->company= $profiledata->company;
           $proj->projwin_id = $projwinid;
         $proj->designtype= $designtype;
         $proj->designtyperatio= $designtyperatio;
          $proj->winlock= $lock;
        $proj->height= $height;
        $proj->width= $width;
         $proj->sqf = $width * $height;
        $proj->created_by= $usr->creatorId();
        $insert = $proj->save();

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
        $outerprice = $proj->prices->outerprice;
        $outersteelprice = $proj->prices->outersteelprice;
        $slideprice = $proj->prices->slideprice;
        $slidesteelprice = $proj->prices->slidesteelprice;
        $netprice = $proj->prices->netprice;
        $netsteelprice = $proj->prices->netsteelprice;
        $slidebeedprice= $proj->prices->slidebeedprice;
        $nettprice = $proj->prices->nettprice;
        $gaskitprice =  $proj->prices->gaskitprice;
        $netgaskitprice =  $proj->prices->netgaskitprice;
        $slidingbrushprice =  $proj->prices->slidingbrushprice;
        $aluminiumrailprice =  $proj->prices->aluminiumrailprice;
        $interlockprice =  $proj->prices->interlockprice;
        if($lock == "gear_handles"){
            $lockprice = $proj->prices->gearprice;
        }else{
            $lockprice = $proj->prices->latchlockprice;
        }
      

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
        $netamount +  $netsteelamount +   $slidebeedamount  + $nettamount +  $netgaskitamount
        + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount +$lockprice;
        $totalexpense = $total;
      
        $proj->outeramount = $outeramount;

        $proj->outerprofile =   ceil( $outerprofile);
        $proj->outersteelprofile =   $outersteelprofile;
        $proj->netprofile =   ceil( $netprofile);
        $proj->netsteelprofile = $netsteelprofile;
        $proj->slideprofile = ceil( $slideprofile);
        $proj->slidesteelprofile = $slidesteelprofile;
        $proj->slidebeedprfile = ceil( $slidebeedprfile);
        $proj->nettprofile = ceil( $nettprofile);
        $proj->interlockprofile = ceil( $interlockprofile);

        $proj->outerrn = $outertotal;
        $proj->slidern =$slidetotal;
        $proj->netframrn =$nettotal;
        $proj->slidebeedrn =$slidebeed;
        $proj->interlockrn =$interlock;
        $proj->outersteelrn =$outertotal;
        $proj->slidesteelrn =$slidetotal;
        $proj->netframesteelrn =$netsteeltotal;
        $proj->netrn =$net;
        $proj->gaskitrn =$gaskit;
        $proj->netgaskitrn =$netgaskit;
        $proj->brushrolrn =$slidebrush;
        $proj->aluminiumrn =$aluminiumrail;
   
        $proj->outersteelamount = $outersteelamount;  
        $proj->slideamount = $slideamount;
        $proj->slidesteelamount = $slidesteelamount;
        $proj->netamount = $netamount;
        $proj->netsteelamount = $netsteelamount;
        $proj->slidebeedamount = $slidebeedamount;
        $proj->typeamount = $lockprice;
        $proj->nettamount  = $nettamount ;
        $proj->netgaskitamount = $netgaskitamount;
        $proj->gaskitamount=$gaskitamount;
        $proj->slidingbrushamount=$slidingbrushamount;
        $proj->aluminiumrailamount=$aluminiumrailamount;
        $proj->interlockamount=$interlockamount;
        // $profile->totalexpense = $totalexpense;
      $proj->totalexpense = $totalexpense;
       $acesstotal =  $this->access($proj, $width,$height,$id);
     
       $proj->hardwarecost = $acesstotal;
       $proj->totalcost = $totalexpense + $acesstotal;
        $insert=$proj->update();
      
    }
    public function doublesliderprofile($id,$width, $height,$type,$profiledata,$designtyperatio,$lock,$projwinid){
        $usr = \Auth::user();
        $width = $width;
        $height = $height;
        $designtype = $type;
        $proj = new ProjectWindow();
        $proj->frame_id= $profiledata->id;
        $proj->project  = $id;
         $proj->frame= $profiledata->profile;
         $proj->company= $profiledata->company;
           $proj->projwin_id = $projwinid;
         $proj->designtype= $designtype;
         $proj->designtyperatio= $designtyperatio;
          $proj->winlock= $lock;
        $proj->height= $height;
        $proj->width= $width;
         $proj->sqf = $width * $height;
        // $proj->quantity = $request->quantity;
        $proj->created_by= $usr->creatorId();
        $insert = $proj->save();
       
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
        $outerprice = $proj->prices->outerprice;
        $outersteelprice = $proj->prices->outersteelprice;
        $slideprice = $proj->prices->slideprice;
        $slidesteelprice = $proj->prices->slidesteelprice;
        $netprice = $proj->prices->netprice;
        $netsteelprice = $proj->prices->netsteelprice;
        $slidebeedprice= $proj->prices->slidebeedprice;
        $nettprice = $proj->prices->nettprice;
        $gaskitprice =  $proj->prices->gaskitprice;
        $netgaskitprice =  $proj->prices->netgaskitprice;
        $slidingbrushprice =  $proj->prices->slidingbrushprice;
        $aluminiumrailprice =  $proj->prices->aluminiumrailprice;
        $interlockprice =  $proj->prices->interlockprice;
        if($lock == "gear_handles"){
            $lockprice = $proj->prices->gearprice;
        }else{
            $lockprice = $proj->prices->latchlockprice;
        }
     
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
        $netamount +  $netsteelamount +   $slidebeedamount  + $nettamount +  $netgaskitamount
        + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount;
        $totalexpense = $total;
       
      
        $proj->outeramount = $outeramount;

              $proj->outerprofile =   ceil( $outerprofile);
        $proj->outersteelprofile =   $outersteelprofile;
        $proj->netprofile =   ceil( $netprofile);
        $proj->netsteelprofile = $netsteelprofile;
        $proj->slideprofile = ceil( $slideprofile);
        $proj->slidesteelprofile = $slidesteelprofile;
        $proj->slidebeedprfile = ceil( $slidebeedprfile);
        $proj->nettprofile = ceil( $nettprofile);
        $proj->interlockprofile = ceil( $interlockprofile);
        
        $proj->outerrn = $outertotal;
        $proj->slidern =$slidetotal;
        $proj->netframrn =$nettotal;
        $proj->slidebeedrn =$slidebeed;
        $proj->interlockrn =$interlock;
        $proj->outersteelrn =$outertotal;
        $proj->slidesteelrn =$slidetotal;
        $proj->netframesteelrn =$netsteeltotal;
        $proj->netrn =$net;
        $proj->gaskitrn =$gaskit;
        $proj->netgaskitrn =$netgaskit;
        $proj->brushrolrn =$slidebrush;
        $proj->aluminiumrn =$aluminiumrail;
   
        $proj->outersteelamount = $outersteelamount;  
        $proj->slideamount = $slideamount;
        $proj->slidesteelamount = $slidesteelamount;
        $proj->netamount = $netamount;
        $proj->netsteelamount = $netsteelamount;
        $proj->slidebeedamount = $slidebeedamount;
        $proj->nettamount  = $nettamount ;
        $proj->netgaskitamount = $netgaskitamount;
        $proj->gaskitamount=$gaskitamount;
        $proj->typeamount = $lockprice;
        $proj->slidingbrushamount=$slidingbrushamount;
        $proj->aluminiumrailamount=$aluminiumrailamount;
        $proj->interlockamount=$interlockamount;
        // $profile->totalexpense = $totalexpense;
        $acesstotal =  $this->doubleaccess($proj, $width,$height,$id);
        $proj->totalexpense = $totalexpense;
        $proj->hardwarecost = $acesstotal;
        $proj->totalcost = $totalexpense + $acesstotal;
        $insert=$proj->update();
       
    }
    function winplastprofile($id,$width, $height,$type,$profiledata,$designtyperatio,$lock,$projwinid){
        $usr = \Auth::user();
        $width = $width;
        $height = $height;
        $designtype = $type;
        $proj = new ProjectWindow();
        $proj->frame_id= $profiledata->id;
        $proj->project  = $id;
         $proj->frame= $profiledata->profile;
         $proj->company= $profiledata->company;
           $proj->projwin_id = $projwinid;
         $proj->designtype= $designtype;
         $proj->designtyperatio= $designtyperatio;
          $proj->winlock= $lock;
        $proj->height= $height;
        $proj->width= $width;
         $proj->sqf = $width * $height;
        $proj->created_by= $usr->creatorId();
        $insert = $proj->save();
        if($lock == "gear_handles"){
            $lockprice = $proj->prices->gearprice;
        }else{
            $lockprice = $proj->prices->latchlockprice;
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
         $outerprice = $proj->prices->outerprice;
         $outersteelprice = $proj->prices->outersteelprice;
         $slideprice = $proj->prices->slideprice;
         $slidesteelprice = $proj->prices->slidesteelprice;
         $netprice = $proj->prices->netprice;
         $netsteelprice = $proj->prices->netsteelprice;
         $slidebeedprice= $proj->prices->slidebeedprice;
         $nettprice = $proj->prices->nettprice;
         $gaskitprice =  $proj->prices->gaskitprice;
         $netgaskitprice =  $proj->prices->netgaskitprice;
         $slidingbrushprice =  $proj->prices->slidingbrushprice;
         $aluminiumrailprice =  $proj->prices->aluminiumrailprice;
         $interlockprice =  $proj->prices->interlockprice;
 
         $outerw = $proj->prices->outerw;
         $slidew = $proj->prices->slidew;
         $netframw = $proj->prices->netframw;
         $beedingw = $proj->prices->beedingw;
         $interlockw = $proj->prices->interlockw;
 
 
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
         $netamount +  $netsteelamount +   $slidebeedamount + $lockprice + $nettamount +  $netgaskitamount
         + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount;
         $totalexpense = $total;

         $proj->outeramount = $outeramount;
         
        $proj->outerprofile =   ceil( $outerprofile);
        $proj->outersteelprofile =   $outersteelprofile;
        $proj->netprofile =   ceil( $netprofile);
        $proj->netsteelprofile = $netsteelprofile;
        $proj->slideprofile = ceil( $slideprofile);
        $proj->slidesteelprofile = $slidesteelprofile;
        $proj->slidebeedprfile = ceil( $slidebeedprfile);
        $proj->nettprofile = ceil( $nettprofile);
        $proj->interlockprofile = ceil( $interlockprofile);
         
         $proj->outerrn = $outertotal;
         $proj->slidern =$slidetotal;
         $proj->netframrn =$nettotal;
         $proj->slidebeedrn =$slidebeed;
         $proj->interlockrn =$interlock;
         $proj->outersteelrn =$outertotal;
         $proj->slidesteelrn =$slidetotal;
         $proj->netframesteelrn =$netsteeltotal;
         $proj->netrn =$net;
         $proj->gaskitrn =$gaskit;
         $proj->netgaskitrn =$netgaskit;
         $proj->brushrolrn =$slidebrush;
         $proj->aluminiumrn =$aluminiumrail;
         
         $proj->outersteelamount = $outersteelamount;
         $proj->slideamount = $slideamount;
         $proj->slidesteelamount = $slidesteelamount;
         $proj->netamount = $netamount;
         $proj->netsteelamount = $netsteelamount;
         $proj->slidebeedamount = $slidebeedamount;
         $proj->typeamount = $lockprice;
         $proj->nettamount  = $nettamount ;
         $proj->netgaskitamount = $netgaskitamount;
         $proj->gaskitamount=$gaskitamount;
         $proj->slidingbrushamount=$slidingbrushamount;
         $proj->aluminiumrailamount=$aluminiumrailamount;
         $proj->interlockamount=$interlockamount;
         // $profile->totalexpense = $totalexpense;
         $acesstotal =  $this->access($proj, $width,$height,$id);
         $proj->totalexpense = $totalexpense;
         $proj->hardwarecost = $acesstotal;
         $proj->totalcost = $totalexpense + $acesstotal;
         $insert=$proj->update();
    }
    function doublewinplastprofile($id,$width, $height,$type,$profiledata,$designtyperatio,$lock,$projwinid){
        // if($profile->frame == "80-66(white)"){
            $usr = \Auth::user();
            $width = $width;
            $height = $height;
            $designtype = $type;
            $proj = new ProjectWindow();
            $proj->frame_id= $profiledata->id;
            $proj->project  = $id;
             $proj->frame= $profiledata->profile;
             $proj->company= $profiledata->company;
               $proj->projwin_id = $projwinid;
             $proj->designtype= $designtype;
             $proj->designtyperatio= $designtyperatio;
              $proj->winlock= $lock;
            $proj->height= $height;
            $proj->width= $width;
             $proj->sqf = $width * $height;
            $proj->created_by= $usr->creatorId();
            $insert = $proj->save();
            if($lock == "gear_handles"){
                $lockprice = $proj->prices->gearprice;
            }else{
                $lockprice = $proj->prices->latchlockprice;
            }
     
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
        $outerprice = $proj->prices->outerprice;
        $outersteelprice = $proj->prices->outersteelprice;
        $slideprice = $proj->prices->slideprice;
        $slidesteelprice = $proj->prices->slidesteelprice;
        $netprice = $proj->prices->netprice;
        $netsteelprice = $proj->prices->netsteelprice;
        $slidebeedprice= $proj->prices->slidebeedprice;
        $nettprice = $proj->prices->nettprice;
        $gaskitprice =  $proj->prices->gaskitprice;
        $netgaskitprice =  $proj->prices->netgaskitprice;
        $slidingbrushprice =  $proj->prices->slidingbrushprice;
        $aluminiumrailprice =  $proj->prices->aluminiumrailprice;
        $interlockprice =  $proj->prices->interlockprice;

        $outerw = $proj->prices->outerw;
        $slidew = $proj->prices->slidew;
        $netframw = $proj->prices->netframw;
        $beedingw = $proj->prices->beedingw;
        $interlockw = $proj->prices->interlockw;


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
        $netamount +  $netsteelamount +   $slidebeedamount + $lockprice + $nettamount +  $netgaskitamount
        + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount;
        $totalexpense = $total;
      

        $proj->outeramount = $outeramount;
        
        $proj->outern = $outertotal;
        $proj->slidern =$slidetotal;
        $proj->netframrn =$nettotal;
        $proj->slidebeedrn =$slidebeed;
        $proj->interlockrn =$interlock;
        $proj->outersteelrn =$outertotal;
        $proj->slidesteelrn =$slidetotal;
        $proj->netframesteelrn =$netsteeltotal;
        $proj->netrn =$net;
        $proj->gaskitrn =$gaskit;
        $proj->netgaskitrn =$netgaskit;
        $proj->netgaskitrn =$netgaskit;
        $proj->brushrolrn =$slidebrush;
        $proj->aluminiumrn =$aluminiumrail;
        
        $proj->outersteelamount = $outersteelamount;
        $proj->slideamount = $slideamount;
        $proj->slidesteelamount = $slidesteelamount;
        $proj->netamount = $netamount;
        $proj->netsteelamount = $netsteelamount;
        $proj->slidebeedamount = $slidebeedamount;
        $proj->typeamount = $lockprice;
        $proj->nettamount  = $nettamount ;
        $proj->netgaskitamount = $netgaskitamount;
        $proj->gaskitamount=$gaskitamount;
        $proj->slidingbrushamount=$slidingbrushamount;
        $proj->aluminiumrailamount=$aluminiumrailamount;
        $proj->interlockamount=$interlockamount;
        // $profile->totalexpense = $totalexpense;
         $acesstotal =  $this->doubleaccess($proj, $width,$height,$id);
         $proj->totalexpense = $totalexpense;
         $proj->hardwarecost = $acesstotal;
         $proj->totalcost = $totalexpense + $acesstotal;
         $insert=$proj->update();
    }
    function Asaspenprofile($id,$width, $height,$type,$profiledata,$designtyperatio,$lock,$projwinid){
        $usr = \Auth::user();
        $width = $width;
        $height = $height;
        $designtype = $type;
        $profile = new ProjectWindow();
        $profile->frame_id= $profiledata->id;
        $profile->project  = $id;
         $profile->frame= $profiledata->profile;
         $profile->company= $profiledata->company;
           $proj->projwin_id = $projwinid;
         $profile->designtype= $designtype;
         $profile->designtyperatio= $designtyperatio;
          $profile->winlock= $lock;
        $profile->height= $height;
        $profile->width= $width;
         $profile->sqf = $width * $height;
        $profile->created_by= $usr->creatorId();
        $insert = $profile->save();
        if($lock == "gear_handles"){
            $lockprice = $profile->prices->gearprice;
        }else{
            $lockprice = $profile->prices->latchlockprice;
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
        $netamount +  $netsteelamount +   $slidebeedamount + $lockprice + $nettamount +  $netgaskitamount
        + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount;
        $totalexpense = $total;
       
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
        $profile->typeamount = $lockprice;
        $profile->nettamount  = $nettamount ;
        $profile->netgaskitamount = $netgaskitamount;
        $profile->gaskitamount=$gaskitamount;
        $profile->slidingbrushamount=$slidingbrushamount;
        $profile->aluminiumrailamount=$aluminiumrailamount;
        $profile->interlockamount=$interlockamount;
        // $profile->totalexpense = $totalexpense;
           $acesstotal =  $this->access($profile, $width,$height,$id);
        $profile->totalexpense = $totalexpense;
        $profile->hardwarecost = $acesstotal;
        $profile->totalcost = $totalexpense + $acesstotal;
        $insert=$profile->update(); 
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
    // Fix Profile start
    function fixprofile($id,$width, $height,$type,$profiledata,$designtyperatio,$lock,$projwinid){
        // if($profile->frame == "80-66(white)"){
        $usr = \Auth::user();
        $width = $width;
        $height = $height;
        $designtype = $type;
        $profile = new ProjectWindow();
        $profile->frame_id= $profiledata->id;
        $profile->project  = $id;
            $profile->frame= $profiledata->profile;
            $profile->company= $profiledata->company;
              $profile->projwin_id = $projwinid;
            $profile->designtype= $designtype;
            $profile->designtyperatio= $designtyperatio;
        $profile->height= $height;
        $profile->width= $width;
          $profile->sqf = $width * $height;
        $profile->created_by= $usr->creatorId();
        $insert = $profile->save();

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
        $acesstotal = $this->fixaccess($profile, $width,$height,$id);
        $profile->totalexpense = $totalexpense;
        $profile->hardwarecost = $acesstotal;
        $profile->totalcost = $totalexpense + $acesstotal;
        $insert=$profile->update();
    }
    function Winfixprofile($id,$width, $height,$type,$profiledata,$designtyperatio,$lock,$projwinid){
        // if($profile->frame == "80-66(white)"){
        $usr = \Auth::user();
        $width = $width;
        $height = $height;
        $designtype = $type;
        $profile = new ProjectWindow();
        $profile->frame_id= $profiledata->id;
        $profile->project  = $id;
            $profile->frame= $profiledata->profile;
            $profile->company= $profiledata->company;
              $proj->projwin_id = $projwinid;
            $profile->designtype= $designtype;
            $profile->designtyperatio= $designtyperatio;
        $profile->height= $height;
        $profile->width= $width;
          $profile->sqf = $width * $height;
        $profile->created_by= $usr->creatorId();
        $insert = $profile->save();

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

        $outerw = $profile->prices->outerw;
        $slidew = $profile->prices->slidew;

        $outeramount =   $outerprofile * $outerprice * $outerw;
        $slidebeedamount = $slidebeedprfile * $slidebeedprice * $slidew;
    

        $outersteelamount =  $outersteelprofile * $outersteelprice;
        $gaskitamount = $gaskit  * $gaskitprice;
        $total = $outeramount + $slidebeedamount +$outersteelamount+  $gaskitamount;
        $totalexpense = $total;
        
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
        $acesstotal = $this->fixaccess($profile, $width,$height,$id);
        $profile->totalexpense = $totalexpense;
        $profile->hardwarecost = $acesstotal;
        $profile->totalcost = $totalexpense + $acesstotal;
        $insert=$profile->update();
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
    // Fix Profile Start

    // Open Profile start
    function openprofile($id,$width, $height,$type,$profiledata,$designtyperatio,$lock,$opendir,$hing,$projwinid){
      
        $usr = \Auth::user();
        $data = array(
            $opendir,
            $designtyperatio
          );
        $width = $width;
        $height = $height;
        $designtype = $type;
        $profile = new ProjectWindow();
        $profile->frame_id= $profiledata->id;
        $profile->project  = $id;
        $profile->frame= $profiledata->profile;
        $profile->company= $profiledata->company;
          $profile->projwin_id = $projwinid;
        $profile->designtype= $designtype;
        $profile->designtyperatio= $designtyperatio;
         $profile->winlock= $lock;
           $profile->hing= $hing;
        $profile->openabledir= $opendir;    
        $profile->profile_info = implode(' ',$data);
        $profile->height= $height;
        $profile->width= $width;
          $profile->sqf = $width * $height;
        $profile->created_by= $usr->creatorId();
        $insert = $profile->save();
        if($lock == "gear_handles"){
            $lockprice = $profile->prices->gearprice;
        }else{
            $lockprice = $profile->prices->cockspurprice;
        }
     
         $outertotal = $width * 2 + $height * 2;
         $slidetotal =  $width * 4 + $height * 4;
         $slidebeed = $width * 4 + $height * 4;
         $gaskit = $width * 2 + $height * 2;
         $xgaskit = $width * 4 + $height * 4;
         $gaskitbeed = $height * 4 ;
         $netgaskit = $gaskitbeed;
         $flyscreen = $gaskitbeed;

         $outerprofile = $outertotal / 18;
         $slideprofile =  $slidetotal / 18;  
         $outersteelprofile = $outertotal / 8;
         $slidesteelprofile =  $slidetotal / 8;
         $slidebeedprfile = $slidebeed / 18;
          $gaskitprofile = $gaskit / 100;
          $xgaskitprofile = $xgaskit / 100;
          $gaskitbeedprofile = $gaskitbeed / 100;
        $netprofile = $outerprofile;
        $netsteelprofile = $outersteelprofile;
        $netgaskitprofile = $gaskitbeed / 4;
        $flyscreenprofile = $gaskitbeed / 4;

        //  $outerprice = $profile->price($profile->frame);
        $outerprice = $profile->prices->outerprice;
        $outersteelprice = $profile->prices->outersteelprice;
        $slideprice = $profile->prices->slideprice;
        $slidesteelprice = $profile->prices->slidesteelprice;
        $netprice = $profile->prices->netprice;
        $netsteelprice = $profile->prices->netsteelprice;
        $netsteelprice = $profile->prices->netsteelprice;
        $slidebeedprice= $profile->prices->slidebeedprice;
        $gaskitprice =  $profile->prices->gaskitprice;
        $xgaskitprice =  $profile->prices->xgaskitprice;
        $gaskitbeedprice =  $profile->prices->gaskitbeedprice;
        $netgaskitprice = $profile->prices->netgaskitprice;
        $flyscreenprice = $profile->prices->flyscreen;

        $outerw = $profile->prices->outerw;
        $slidew = $profile->prices->slidew;
        $beedingw = $profile->prices->beedingw;

        $outeramount =  $outerprofile * $outerprice ;
        $slideamount =  $slideprofile * $slideprice;
        $slidebeedamount = $slidebeedprfile * $slidebeedprice ;
        $netamount = $netprofile * $netprice ;
        $netsteelamount = $netsteelprice * $netsteelprofile;
        $outersteelamount =  $outersteelprofile * $outersteelprice;
        $slidesteelamount =  $slidesteelprofile * $slidesteelprice;
        $gaskitamount = $gaskit  * $gaskitprice;
        $xgaskitamount = $xgaskit  * $xgaskitprice;
        $netgaskitamount = $netgaskit  * $netgaskitprice;
        $flyscreenamount = $flyscreen  * $flyscreenprice;
        $gaskitbeedamount = $gaskitbeed  * $gaskitbeedprice;
        $total = ceil($outeramount) +ceil($slideamount) + ceil($slidebeedamount) + $gaskitbeedamount+ $slidesteelamount + $outersteelamount+ $xgaskitamount + $gaskitamount + $netamount + $netsteelamount + $netgaskitamount + $flyscreenamount;
        $totalexpense = $total;

        $profile->outeramount = ceil($outeramount);
        
         $profile->outerrn = $outertotal;
        $profile->slidern =$slidetotal;
        $profile->slidebeedrn =$slidebeed;
        $profile->outersteelrn =$outertotal;
        $profile->slidesteelrn =$slidetotal;
        $profile->gaskitrn =$gaskit;
        $profile->gaskitbeedrn =$gaskitbeed;
        $profile->xgaskitrn =$xgaskit;
          $profile->netgaskitrn =$netgaskit;
           $profile->flyscreen =$flyscreen;
        $profile->netamount= $netamount;
        $profile->netsteelamount= $netsteelamount;
        $profile->netgaskitamount= $netgaskitamount;
         $profile->flyscreenamount= $flyscreenamount;
        $profile->gaskitbeedamount=$gaskitbeedamount;
        
        $profile->outersteelamount = ceil($outersteelamount);
        $profile->slideamount = ceil($slideamount);
        $profile->slidesteelamount = $slidesteelamount;
        $profile->slidebeedamount = ceil($slidebeedamount);
        // $profile->typeamount = $typeamount;
        $profile->gaskitamount=$gaskitamount;
        $profile->xgaskitamount=$xgaskitamount;
        $profile->gaskitbeedamount=$gaskitbeedamount;
        // $profile->totalexpense=$totalexpense;
        if($lock == "gear_handles" && $designtyperatio == "casement"){
            $accesstotal =  $this->gearopenaccess($profile, $width,$height,$hing,$lockprice,$id);
         
         }else if($lock == "cockspurhandle" && $designtyperatio == "casement"){
             $accesstotal =    $this->openaccess($profile, $width,$height,$hing,$lockprice,$id);   
         }else if($lock == "gear_handles" && $designtyperatio == "tophing"){
             $accesstotal =    $this->hinggearopenaccess($profile, $width,$height,$hing,$lockprice,$id);   
         }else if($lock == "cockspurhandle" && $designtyperatio == "tophing"){
             $accesstotal =    $this->hingopenaccess($profile, $width,$height,$hing,$lockprice,$id);   
         }else{
             $accesstotal = 0;
         }
        $profile->totalexpense = $totalexpense;
        $profile->hardwarecost = $accesstotal;
        $profile->totalcost = $totalexpense + $accesstotal;
        $insert=$profile->update();
    
    }
    function openwinprofile($id,$width, $height,$type,$profiledata,$designtyperatio,$lock,$opendir,$hing,$projwinid){
        // if($profile->frame == "80-66(white)"){
      
            $usr = \Auth::user();
            $data = array(
                $opendir,
                $designtyperatio
              );
            $width = $width;
            $height = $height;
            $designtype = $type;
            $profile = new ProjectWindow();
            $profile->frame_id= $profiledata->id;
            $profile->project  = $id;
            $profile->frame= $profiledata->profile;
            $profile->company= $profiledata->company;
                $proj->projwin_id = $projwinid;
            $profile->designtype= $designtype;
            $profile->designtyperatio= $designtyperatio;
             $profile->winlock= $lock;
               $profile->hing= $hing;
            $profile->openabledir= $opendir;    
            $profile->profile_info = implode(' ',$data);
            $profile->height= $height;
            $profile->width= $width;
              $profile->sqf = $width * $height;
            $profile->created_by= $usr->creatorId();
            $insert = $profile->save();
            if($lock == "gear_handles"){
                $lockprice = $profile->prices->gearprice;
            }else{
                $lockprice = $profile->prices->cockspurprice;
            }
         $outertotal = $width * 2 + $height * 2;
         $slidetotal =  $width * 4 + $height * 4;
         $slidebeed = $width * 4 + $height * 4;
         $gaskit = $width * 2 + $height * 2;
         $xgaskit = $width * 4 + $height * 4;
         $gaskitbeed = $width * 4 ;
           $netgaskit = $gaskitbeed;
         $flyscreen = $gaskitbeed;

         $outerprofile = $outertotal / 18;
         $slideprofile =  $slidetotal / 18;  
         $outersteelprofile = $outertotal / 8;
         $slidesteelprofile =  $slidetotal / 8;
         $slidebeedprfile = $slidebeed / 18;    
           $gaskitprofile = $gaskit / 100;
         $xgaskitprofile = $xgaskit / 100;
         $gaskitbeedprofile = $gaskitbeed / 100;
         $netprofile = $outerprofile;
         $netsteelprofile = $outersteelprofile;
         $netgaskitprofile = $gaskitbeed / 4;
        $flyscreenprofile = $gaskitbeed / 4;

        //  $outerprice = $profile->price($profile->frame);
        $outerprice = $profile->prices->outerprice;
        $outersteelprice = $profile->prices->outersteelprice;
        $slideprice = $profile->prices->slideprice;
        $slidesteelprice = $profile->prices->slidesteelprice;
        $slidebeedprice= $profile->prices->slidebeedprice;
        $gaskitprice =  $profile->prices->gaskitprice;
        $xgaskitprice =  $profile->prices->xgaskitprice;
        $gaskitbeedprice =  $profile->prices->gaskitbeedprice;
        $netprice = $profile->prices->netprice;
        $netsteelprice = $profile->prices->netsteelprice;
        $netgaskitprice = $profile->prices->netgaskitprice;
        $flyscreenprice = $profile->prices->flyscreen;


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
        $netamount = $netprofile * $netprice ;
        $netsteelamount = $netsteelprice * $netsteelprofile;
        $netgaskitamount = $netgaskit  * $netgaskitprice;
        $flyscreenamount = $flyscreen  * $flyscreenprice;

        $total = ceil($outeramount) +ceil($slideamount) + ceil($slidebeedamount) + $gaskitbeedamount+ $slidesteelamount + $outersteelamount+ $xgaskitamount + $gaskitamount + $netamount + $netsteelamount + $netgaskitamount + $flyscreenamount;
        $totalexpense = $total;
        

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
                $profile->netamount= $netamount;
        $profile->netsteelamount= $netsteelamount;
        $profile->netgaskitamount= $netgaskitamount;
        $profile->flyscreenamount= $flyscreenamount;
        // $profile->totalexpense=$totalexpense;
        if($lock == "gear_handles" && $designtyperatio == "casement"){
            $accesstotal =  $this->gearopenaccess($profile, $width,$height,$hing,$lockprice,$id);
         
         }else if($lock == "cockspurhandle" && $designtyperatio == "casement"){
             $accesstotal =    $this->openaccess($profile, $width,$height,$hing,$lockprice,$id);   
         }else if($lock == "gear_handles" && $designtyperatio == "tophing"){
             $accesstotal =    $this->hinggearopenaccess($profile, $width,$height,$hing,$lockprice,$id);   
         }else if($lock == "cockspurhandle" && $designtyperatio == "tophing"){
             $accesstotal =    $this->hingopenaccess($profile, $width,$height,$hing,$lockprice,$id);   
         }else{
             $accesstotal = 0;
         }
         $profile->totalexpense = $totalexpense;
         $profile->hardwarecost = $accesstotal;
         $profile->totalcost = $totalexpense + $accesstotal;
        $insert=$profile->update();
        
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
        if($hindge == "twohing"){
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
         if($hindge == "twohing"){
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
       
            $total =$silicon+  $outwardcase  + $frictionstay + $pencilhindge +$flathandle +$openablekeep + $Tlock +$typeamount;


        $projacs = new ProjWindowAcces();
         $projacs->project= $project_id;
        $projacs->projwin_id = $proj->id;
        $projacs->siliconrate = $silicon;
        $projacs->outwardcaserate = $outwardcase;
        // $projacs->windowstayrate = $windowstay;
        $projacs->frictionstayrate = $frictionstay;
        $projacs->pencilhindgerate = $pencilhindge;
        $projacs->thDhindgesrate = $thDhindges;
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
       function doorprofile($id,$width, $height,$type,$profiledata,$designtyperatio,$lock,$hing,$projwinid,$handle){
 
        $usr = \Auth::user();
        $width = $width;
        $height = $height;
        $designtype = $type;
        $profile = new ProjectWindow();
        $profile->projwin_id = $projwinid;
        $profile->frame_id= $profiledata->id;
        $profile->project  = $id;
        $profile->frame= $profiledata->profile;
        $profile->company= $profiledata->company;
        $profile->designtype= $designtype;
        $profile->designtyperatio= $designtyperatio;
        $profile->winlock= $lock;
        $profile->hing= $hing;
        $profile->doorhandle= $handle;
        $profile->height= $height;
        $profile->width= $width;
        $profile->sqf = $width * $height;
        // $proj->quantity = $request->quantity;
        $profile->created_by= $usr->creatorId();
        $insert = $profile->save(); 

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
         $accesstotal =  $this->dooraccess($profile, $width,$height,$hing,$handle,$designtyperatio,$lock);
         $profile->totalexpense = $totalexpense;
         $profile->hardwarecost = $accesstotal;
         $profile->totalcost = $totalexpense + $accesstotal;
        $insert=$profile->update();
     
    }
    function dooraccess($proj, $width,$height,$hindge,$handle,$size,$type){
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
   public function store(Request $request , $id)
    {
        return $request;
          $date =  Carbon::now();
        if(\Auth::user()->can('manage project')){
            $types = $request->type;
            $profilestype = $request->designtyperatio;
            $profiles = $request->profile;
            $profile = is_array($profiles)? $profiles['0']: $profiles;
            $type = is_array($types)? $types['0']: $types;
            $profiletype = is_array($profilestype)?   $profilestype['0']: $profilestype;
            $profiledata = AssignWindow::find($profile);
            $projwin              = new ProjWinEntry();
            $projwin->project_id  = $id;
            $projwin->date        = $date;
            $projwin->frame        = $profiledata->profile;
            $projwin->company        =  $profiledata->company;
            $projwin->designtype        = $type;
            $projwin->designtyperatio       = $profiletype;
            $projwin->created_by  = \Auth::user()->creatorId();
            $projwin->save();
            
            $br = ProjectWindow::$brand;
            $win =  $br['Winplast'];
            $opensdir = $request->opendir;
            $hings = $request->hing;
            $locks = $request->lock;
            $widths = $request->width;
              $handles = $request->handle;
            $heights = $request->height;
      
        $width = is_array($widths)?  $widths['0']: $widths;
            $height = is_array($heights)?  $heights['0']: $heights;
            $lock = is_array($locks)?  $locks['0']: $locks;
            $opendir = is_array($opensdir)?  $opensdir['0']: $opensdir;
            $hing = is_array($hings)? $hings['0']: $hings;
               $handle = is_array($handles)? $handles['0']: $handles;
            $accounts = $request->width;
            if($type == 'sliding' && $profiledata->company != $win){
               
                for($i = 0; $i < count($accounts); $i++)
                {
                    $width =  $widths[$i];
                    $height =  $heights[$i];
                    if($profiletype == "single"){
                        $this->checkprofile($id,$width, $height,$type,$profiledata,$profiletype,$lock);
                    }else{
                         $this->doublesliderprofile($id,$width, $height,$type,$profiledata,$profiletype,$lock,$projwin->id);
                    }
                }
            }else if($type == 'sliding' && $profiledata->company == $win ){
               
              
                for($i = 0; $i < count($accounts); $i++)
                {
                    $width =  $widths[$i];
                    $height =  $heights[$i];
                    if($profiletype == "single"){
                        $this->winplastprofile($id,$width, $height,$type,$profiledata,$profiletype,$lock);
                    }else{
                         $this->doublewinplastprofile($id,$width, $height,$type,$profiledata,$profiletype,$lock,$projwin->id);
                    }
                }
            }else if($type == 'fix' && $profiledata->company != $win){
          
                for($i = 0; $i < count($accounts); $i++)
                {
                    $width =  $widths[$i];
                    $height =  $heights[$i];
                        $this->fixprofile($id,$width, $height,$type,$profiledata,$profiletype,$lock,$projwin->id);
                }
            }else if($type == 'fix' && $profiledata->company == $win){
                for($i = 0; $i < count($accounts); $i++)
                {
                    $width =  $widths[$i];
                    $height =  $heights[$i];
                        $this->Winfixprofile($id,$width, $height,$type,$profiledata,$profiletype,$lock,$projwin->id);
                }
            }else if($type == 'open' && $profiledata->company != $win){
          
                for($i = 0; $i < count($accounts); $i++)
                {
                    $width =  $widths[$i];
                    $height =  $heights[$i];
                    
                        $this->openprofile($id,$width, $height,$type,$profiledata,$profiletype,$lock,$opendir,$hing,$projwin->id);
                }
            }else if($type == 'open' && $profiledata->company == $win){
          
                for($i = 0; $i < count($accounts); $i++)
                {
                    $width =  $widths[$i];
                    $height =  $heights[$i];
                        $this->openwinprofile($id,$width, $height,$type,$profiledata,$profiletype,$lock,$opendir,$hing,$projwin->id);
                }
            }else if($type == 'door' && $profiledata->company != $win){
                for($i = 0; $i < count($accounts); $i++)
                {
                    $width =  $widths[$i];
                    $height =  $heights[$i];
                        $this->doorprofile($id,$width, $height,$type,$profiledata,$profiletype,$lock,$hing,$projwin->id,$handle);
                }
            }else if($type == 'door' && $profiledata->company == $win){
                for($i = 0; $i < count($accounts); $i++)
                {
                    $width =  $widths[$i];
                    $height =  $heights[$i];
                        $this->doorprofile($id,$width, $height,$type,$profiledata,$profiletype,$lock,$opendir,$hing,$projwin->id);
                }
            }
       
            return redirect()->route('project.quote.index',$id)->with('success', __('Quotation entry successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $project_id = $id;
       $projectWindow = ProjectWindow::where('projwin_id', $id)->get();
        $accounts = Project::$type;
        // $accounts = Arr::prepend($accs,'Select Type' );
        $slidet = Project::$slidetype;
        $slidetype = Arr::prepend($slidet,'Select Slide Type' );
        $opent = Project::$opentype;
        $opentype = Arr::prepend($opent,'Select Open Type' );
        $fixt = Project::$fixtype;
        $fixtype = Arr::prepend($fixt,'Select Fix Type' );
        $doort = ProjectWindow::$ratio;
        $doortype =  Arr::prepend($doort,'Select Door Type' );
        $slidelk = Project::$slidelock;
        $slidelock = Arr::prepend($slidelk,'Select Lock' );
        $openlk = Project::$openlock;
        $openlock = Arr::prepend($openlk,'Select Lock' );
        $doorlk = Project::$doorlock;
        $doorlock = Arr::prepend($doorlk,'Select Lock' );
        $openldi = Project::$opendir;
        $opendir = Arr::prepend($openldi,'Select Lock' );
        $openhin = Project::$hing;
        $hing = Arr::prepend($openhin,'Select hindge' );
        $handle = ProjectWindow::$handle;
        $doorhandle = Arr::prepend($handle,'Select handle' );
        $slide = AssignWindow::where('type', 'sliding')->get()->pluck('profile', 'id');
        $fixs = AssignWindow::where('type', 'fix')->get()->pluck('profile', 'id');
        // $fix->prepend('Select FixType', '');
        $open = AssignWindow::where('type', 'openable')->get()->pluck('profile', 'id');
        $open->prepend('Select OpenType', '');
        $door = AssignWindow::where('type', 'door')->get()->pluck('profile', 'id');
        $door->prepend('Select Doortype', '');
    //   $slide = AssignWindow::where('type', 'sliding')->get();
    
            return view('projectwindows.quotedit', compact('accounts','slide','fixs','open','slidetype'
        ,'opentype','fixtype','slidelock','openlock','opendir','hing','doortype','doorhandle','doorlock','door','projectWindow','project_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if(\Auth::user()->can('delete milestone'))
        {
            $milestone = ProjWinEntry::find($id);
            $milestone->delete();
            $window = ProjectWindow::where('projwin_id',$milestone->id)->delete();

            return redirect()->back()->with('success', __('Window record successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
       
             
    }
    
    function slideprofile($height,$width,$projrec,$slide,$designtype,$projectid,$exist,$company,$count){
       
        $outertotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('outerrn');
        $slidetotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('slidern');
        $nettotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('netframrn');
        $slidebeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('slidebeedrn');
        $interlock = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('interlockrn');
        $outersteel = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('outersteelrn');
        $slidesteel = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('slidesteelrn');
        $netsteeltotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('netframesteelrn');
        $net = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('netrn');
        $gaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('gaskitrn');
        $netgaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('netgaskitrn');
        $slidebrush = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('brushrolrn');
        $aluminiumrail = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('aluminiumrn');
      

        $outerprofile = $outertotal / 18;
        $outersteelprofile = $outersteel * 19 / 8;
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
        + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount + $typeamount;
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
        $outertotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('outerrn');
        $slidetotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('slidern');
        $nettotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('netframrn');
        $slidebeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('slidebeedrn');
        $interlock = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('interlockrn');
        $outersteel = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('outersteelrn');
        $slidesteel = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('slidesteelrn');
        $netsteeltotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('netframesteelrn');
        $net = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('netrn');
        $gaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('gaskitrn');
        $netgaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('netgaskitrn');
        $slidebrush = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('brushrolrn');
        $aluminiumrail = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('aluminiumrn');

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
        + $gaskitamount + $slidingbrushamount + $aluminiumrailamount + $interlockamount + $typeamount;
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

        $outertotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('outerrn');
        $slidebeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('slidebeedrn');
        $outersteel = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('outersteelrn');
        $gaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('gaskitrn');
     
         $outerprofile = $outertotal / 18;
         $outersteelprofile = $outersteel  / 8;
         $slidebeedprfile = $slidebeed / 18;          

        //  $outerprice = $profile->price($profile->frame);
        $outerprice = $slide->outerprice;
        $outersteelprice = $slide->outersteelprice;
        $slidebeedprice= $slide->slidebeedprice;
        $gaskitprice =  $slide->gaskitprice;

        $outeramount =   $outerprofile * $outerprice;
        $slidebeedamount = $slidebeedprfile * $slidebeedprice ;

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
               return  $exist->totalcost;
           }
        }else{
            $profile = new ProjectWindow();
            $profile->Project = $projectid;
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
      $outertotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('outerrn');
        $slidebeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('slidebeedrn');
        $outersteel = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('outersteelrn');
        $gaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('gaskitrn');

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
        $siliconqty =  $slide->pricesqty->siliconqty * $count;
        $steeltapqty = $slide->pricesqty->steeltapqty  * $runningft * $count;
        $conscrewqty = $slide->pricesqty->conscrewqty * $runningft * $count;
        $silicon = $siliconqty *  $slide->pricesqty->siliconrate;
        $steeltap = $slide->pricesqty->steeltaprate * $steeltapqty ;
        $conscrew = $slide->pricesqty->conscrewrate * $conscrewqty;
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
            return  $exist->totalcost; 
           }
        }else{
            $profile = new ProjectWindow();
            $profile->Project = $projectid;
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
            return  $profile->totalcost; 
            }
        }
      

    }
    function openablewinprofile($height,$width,$projrec,$slide,$designtype,$projectid,$exist,$company,$count){

        $outertotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('outerrn');
        $slidebeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('slidebeedrn');
        $gaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('gaskitrn');
        $slidetotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('slidern');
        $xgaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('xgaskitrn');
        $gaskitbeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('gaskitbeedrn');
          $gaskitbeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('gaskitbeedrn');
       $flyscreen = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('flyscreenrn');
       $netgaskitrn = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('netgaskitrn');

      

        $outerprofile = $outertotal / 19.5;
        $slideprofile =  $slidetotal / 19.5;  
        $outersteelprofile = $outertotal / 8;
        $slidesteelprofile =  $slidetotal / 8;
        $slidebeedprfile = $slidebeed / 19.5; 
        $netprofile = $outerprofile;
        $netsteelprofile = $outersteelprofile;

       //  $outerprice = $profile->price($profile->frame);
       $outerprice = $slide->outerprice;
       $outersteelprice = $slide->outersteelprice;
       $slideprice = $slide->slideprice;
       $slidesteelprice = $slide->slidesteelprice;
       $slidebeedprice= $slide->slidebeedprice;
       $gaskitprice =  $slide->gaskitprice;
       $xgaskitprice =  $slide->xgaskitprice;
       $gaskitbeedprice =  $slide->gaskitbeedprice;
        $netprice = $slide->netprice;
        $netsteelprice = $slide->netsteelprice;
        $netgaskitprice = $slide->netgaskitprice;
        $flyscreenprice = $slide->flyscreen;

       if($projrec->winlock == "gear_handles"){
        $lockprice = $slide->prices->gearprice;
        }else{
            $lockprice = $slide->prices->cockspurprice;
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
        $netamount = $netprofile * $netprice ;
        $netsteelamount = $netsteelprice * $netsteelprofile;
        $netgaskitamount = $netgaskit  * $netgaskitprice;
        $flyscreenamount = $flyscreen  * $flyscreenprice;
       $typeamount = $lockprice* $count;
       $total = ceil($outeramount) +ceil($slideamount) + ceil($slidebeedamount) + $gaskitbeedamount+ $slidesteelamount + $outersteelamount+ $xgaskitamount + $gaskitamount + $typeamount + $netamount + $netsteelamount + $netgaskitamount + $flyscreenamount;
       $totalexpense = $total;

       if($projrec->winlock == "gear_handles" && $projrec->designtyperatio == "casement"){
        $accesstotal =  $this->gearopenallaccess($projrec, $width,$height,$projrec->hing,$lockprice);
     
        }else if($projrec->winlock == "cockspurhandle" &&  $projrec->designtyperatio == "casement"){
            $accesstotal =    $this->openallaccess($projrec, $width,$height,$projrec->hing,$lockprice);   
        }else if($projrec->winlock == "gear_handles" && $projrec->designtyperatio == "tophing"){
            $accesstotal =    $this->hinggearopenallaccess($projrec, $width,$height,$projrec->hing,$lockprice);   
        }else if($projrec->winlock == "cockspurhandle" &&  $projrec->designtyperatio == "tophing"){
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
        $exist->netamount= $netamount;
        $exist->netsteelamount= $netsteelamount;
        $exist->netgaskitamount= $netgaskitamount;
         $exist->flyscreenamount= $flyscreenamount;
        $exist->totalexpense = $totalexpense ;
        $exist->hardwarecost = $accesstotal;
        $exist->totalcost = $totalexpense + $accesstotal;
        $upatee=$exist->update();
        if($upatee){
              return  $exist->totalcost;
        }
       }else{
        $exist = new ProjectWindow();
         
        $exist->Project = $projectid;
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
        $exist->netamount= $netamount;
        $exist->netsteelamount= $netsteelamount;
        $exist->netgaskitamount= $netgaskitamount;
         $exist->flyscreenamount= $flyscreenamount;
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

        $outertotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('outerrn');
        $slidebeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('slidebeedrn');
        $gaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('gaskitrn');
        $slidetotal = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('slidern');
        $xgaskit = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('xgaskitrn');
        $gaskitbeed = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('gaskitbeedrn');
       $flyscreen = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('flyscreenrn');
       $netgaskitrn = ProjectWindow::where('project', $projectid)->where('designtype',$designtype)->sum('netgaskitrn');
      

        $outerprofile = $outertotal / 18;
        $slideprofile =  $slidetotal / 18;
        $outersteelprofile = $outertotal / 8;
        $slidesteelprofile =  $slidetotal / 8;
        $slidebeedprfile = $slidebeed / 18; 
                $netprofile = $outerprofile;
        $netsteelprofile = $outersteelprofile;

       //  $outerprice = $profile->price($profile->frame);
       $outerprice = $slide->outerprice;
       $outersteelprice = $slide->outersteelprice;
       $slideprice = $slide->slideprice;
       $slidesteelprice = $slide->slidesteelprice;
       $slidebeedprice= $slide->slidebeedprice;
       $gaskitprice =  $slide->gaskitprice;
       $xgaskitprice =  $slide->xgaskitprice;
       $gaskitbeedprice =  $slide->gaskitbeedprice;
               $netprice = $slide->netprice;
        $netsteelprice = $slide->netsteelprice;
        $netgaskitprice = $slide->netgaskitprice;
        $flyscreenprice = $slide->flyscreen;
     if($projrec->winlock == "gear_handles"){
        $lockprice = $slide->gearprice;
        }else{
            $lockprice = $slide->cockspurprice;
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
               $netamount = $netprofile * $netprice ;
        $netsteelamount = $netsteelprice * $netsteelprofile;
        $netgaskitamount = $netgaskit  * $netgaskitprice;
        $flyscreenamount = $flyscreen  * $flyscreenprice;
       $typeamount = $lockprice* $count;
       $total = ceil($outeramount) +ceil($slideamount) + ceil($slidebeedamount) + $gaskitbeedamount+ $slidesteelamount + $outersteelamount+ $xgaskitamount + $gaskitamount + $typeamount  + $netamount + $netsteelamount + $netgaskitamount + $flyscreenamount;
       $totalexpense = $total;

       
       if($projrec->winlock == "gear_handles" && $projrec->designtyperatio == "casement"){
        $accesstotal =  $this->gearopenallaccess($projrec, $width,$height,$projrec->hing,$lockprice);
     
        }else if($projrec->winlock == "cockspurhandle" &&  $projrec->designtyperatio == "casement"){
            $accesstotal =    $this->openallaccess($projrec, $width,$height,$projrec->hing,$lockprice);   
        }else if($projrec->winlock == "gear_handles" && $projrec->designtyperatio == "tophing"){
            $accesstotal =    $this->hinggearopenallaccess($projrec, $width,$height,$projrec->hing,$lockprice);   
        }else if($projrec->winlock == "cockspurhandle" &&  $projrec->designtyperatio == "tophing"){
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
        $exist->netamount= $netamount;
        $exist->netsteelamount= $netsteelamount;
        $exist->netgaskitamount= $netgaskitamount;
         $exist->flyscreenamount= $flyscreenamount;
        $exist->totalexpense = $totalexpense ;
        $exist->hardwarecost = $accesstotal;
        $exist->totalcost = $totalexpense + $accesstotal;
        $updatee=$exist->update();
        if($updatee){
            return $exist->totalcost;
        }
       }else{
        $exist = new ProjectWindow();
         
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
        $exist->netamount= $netamount;
        $exist->netsteelamount= $netsteelamount;
        $exist->netgaskitamount= $netgaskitamount;
         $exist->flyscreenamount= $flyscreenamount;
        $exist->totalexpense = $totalexpense ;
        $exist->hardwarecost = $accesstotal;
        $exist->totalcost = $totalexpense + $accesstotal;
        $insert=$exist->save();
        if ($insert){
   return $exist->totalcost;
            }
       }
   
    
        

    }
    function openallaccess($proj, $width,$height,$hindge,$typeamount){
        $runningft = $width * 2 + $height * 2;
        $silicon = $proj->siliconqty *  $proj->siliconrate;
        $outwardcase = $proj->outwardcaseqty * $proj->outwardcaserate;
        $windowstay= $proj->windowstayqty * $proj->windowstayrate;
        // $frictionstay= $proj->openpricesqty->frictionstayqty * $proj->openpricesqty->frictionstayrate;
        $pencilhindge= $proj->pencilhindgeqty * $proj->pencilhindgerate;
        $flathandle= $proj->flathandleqty * $proj->flathandlerate;
        $twoDhindges= $proj->twoDhindgesqty * $proj->twoDhindgesrate;
        $thDhindges= $proj->thDhindgesqty * $proj->thDhindgesrate;
        $openablekeep = $proj->openablekeepqty * $proj->openablekeeprate	;
        $Tlock = $proj->Tlockqty * $proj->Tlockrate	;

        if($hindge == "twohing"){
            $total =$silicon+  $outwardcase +  $windowstay  + $pencilhindge +$flathandle + 
        $twoDhindges +$openablekeep + $Tlock +$typeamount;
        }else{
            $total =$silicon+  $outwardcase +  $windowstay + $pencilhindge +$flathandle + 
        $thDhindges+$openablekeep + $Tlock +$typeamount;
        }
           return $total;
    }
    function gearopenallaccess($proj, $width,$height,$hindge,$typeamount){
        $runningft = $width * 2 + $height * 2;
        $silicon = $proj->siliconqty *  $proj->siliconrate;
        $outwardcase = $proj->outwardcaseqty * $proj->outwardcaserate;
        $windowstay= $proj->windowstayqty * $proj->windowstayrate;
        // $frictionstay= $proj->openpricesqty->frictionstayqty * $proj->openpricesqty->frictionstayrate;
        $pencilhindge= $proj->pencilhindgeqty * $proj->pencilhindgerate;
        $flathandle= $proj->flathandleqty * $proj->flathandlerate;
        $twoDhindges= $proj->twoDhindgesqty * $proj->twoDhindgesrate;
        $thDhindges= $proj->thDhindgesqty * $proj->thDhindgesrate;
        $openablekeep = $proj->openablekeepqty * $proj->openablekeeprate	;
        $Tlock = $proj->Tlockqty * $proj->Tlockrate	;

         if($hindge == "twohing"){
            $total =$silicon+  $outwardcase +  $windowstay + $pencilhindge +$flathandle + 
        $twoDhindges +$openablekeep + $Tlock +$typeamount;
        }else{
            $total =$silicon+  $outwardcase +  $windowstay + $pencilhindge +$flathandle + 
        $thDhindges+$openablekeep + $Tlock +$typeamount;
        }
           return $total;
    }
     
    function hingopenallaccess($proj, $width,$height,$hindge,$typeamount){
        $runningft = $width * 2 + $height * 2;
       $silicon = $proj->siliconqty *  $proj->siliconrate;
        $outwardcase = $proj->outwardcaseqty * $proj->outwardcaserate;
        $windowstay= $proj->windowstayqty * $proj->windowstayrate;
        // $frictionstay= $proj->openpricesqty->frictionstayqty * $proj->openpricesqty->frictionstayrate;
        $pencilhindge= $proj->pencilhindgeqty * $proj->pencilhindgerate;
        $flathandle= $proj->flathandleqty * $proj->flathandlerate;
        $twoDhindges= $proj->twoDhindgesqty * $proj->twoDhindgesrate;
        $thDhindges= $proj->thDhindgesqty * $proj->thDhindgesrate;
        $openablekeep = $proj->openablekeepqty * $proj->openablekeeprate	;
        $Tlock = $proj->Tlockqty * $proj->Tlockrate	;
        $total =$silicon+  $outwardcase + $frictionstay + $pencilhindge +$flathandle +$openablekeep + $Tlock +$typeamount;
           return $total;
    }
    function hinggearopenallaccess($proj, $width,$height,$hindge,$typeamount){
        $runningft = $width * 2 + $height * 2;
       $silicon = $proj->siliconqty *  $proj->siliconrate;
        $outwardcase = $proj->outwardcaseqty * $proj->outwardcaserate;
        // $windowstay= $proj->openpricesqty->windowstayqty * $proj->openpricesqty->windowstayrate;
        $frictionstay= $proj->frictionstayqty * $proj->frictionstayrate;
       $pencilhindge= $proj->pencilhindgeqty * $proj->pencilhindgerate;
        $flathandle= $proj->flathandleqty * $proj->flathandlerate;
        $twoDhindges= $proj->twoDhindgesqty * $proj->twoDhindgesrate;
        $thDhindges= $proj->thDhindgesqty * $proj->thDhindgesrate;
        $openablekeep = $proj->openablekeepqty * $proj->openablekeeprate	;
        $Tlock = $proj->Tlockqty * $proj->Tlockrate	;
            $total =$silicon+  $outwardcase  + $frictionstay + $pencilhindge +$flathandle +$openablekeep + $Tlock +$typeamount;

           return $total;
    }

    public function quotesheet($id){
        $typ = Project::$type;
        $slidedesigntype =  $typ['sliding'];
        $fixdesigntype =  $typ['fix'];
        $opendesigntype =  $typ['open'];
        $br = ProjectWindow::$brand;
        $buraq =  $br['Buraq'];
        $win =  $br['Winplast'];
        $asas =  $br['Asaspen'];
        
        $slide = ProjectWindow::where('project', $id)->where('designtype',$slidedesigntype)->first();
        $fix = ProjectWindow::where('project', $id)->where('designtype',$fixdesigntype)->first();
        $open = ProjectWindow::where('project', $id)->where('designtype',$opendesigntype)->first();

        if($slide){
          $width = ProjectWindow::where('project', $id)->where('designtype',$slide->designtype)->sum('width');
            $height = ProjectWindow::where('project', $id)->where('designtype',$slide->designtype)->sum('height');
            $slidesqf = ProjectWindow::where('project', $id)->where('designtype',$slide->designtype)->sum('sqf');
            $slidecount = ProjectWindow::where('project', $id)->where('designtype',$slide->designtype)->where('company',$slide->company)->count();
            $price =  UserSlidingAccess::where('frame',$slide->frame)->first();
            $exist = ProjectWindow::where('project', '=', $id)->where('designtype','sliding total cost')->first();
            if($slide->company == $win){
                $slideall =  $this->slidewinplastprofile($height,$width,$slide,$price,$slide->designtype,$id,$exist,$slide->company,$slidecount);
            }else{
              $slideall =  $this->slideprofile($height,$width,$slide,$price,$slide->designtype,$id,$exist,$slide->company,$slidecount);
            }
        }
        if($fix){
              $width = ProjectWindow::where('project', $id)->where('designtype',$fix->designtype)->sum('width');
            $height = ProjectWindow::where('project', $id)->where('designtype',$fix->designtype)->sum('height');
            $fixsqf = ProjectWindow::where('project', $id)->where('designtype',$fix->designtype)->sum('sqf');
            $fixcount = ProjectWindow::where('project', $id)->where('designtype',$fix->designtype)->where('company',$fix->company)->count();
            $price =  UserSlidingAccess::where('frame',$fix->frame)->first();
            $exist = ProjectWindow::where('project', '=', $id)->where('designtype','fix total cost')->first();
            if($fix->company == $win){
               $fixall =   $this->allfixwinplastprofile($height,$width,$fix,$price,$fix->designtype,$id,$exist,$fix->company,$fixcount);
            }else{
                   $fixall = $this->allfixprofile($height,$width,$fix,$price,$fix->designtype,$id,$exist,$fix->company,$fixcount);
            }
        }
       if($open){
             $width = ProjectWindow::where('project', $id)->where('designtype',$open->designtype)->sum('width');
            $height = ProjectWindow::where('project', $id)->where('designtype',$open->designtype)->sum('height');
            $opensqf = ProjectWindow::where('project', $id)->where('designtype',$open->designtype)->sum('sqf');
            $opencount = ProjectWindow::where('project', $id)->where('designtype',$opendesigntype)->where('company',$open->company)->count();
          $price =  OpenAssignAccess::where('window_id',$open->frame_id)->first();
            $exist = ProjectWindow::where('project', '=', $id)->where('designtype','open total cost')->first();
            if($open->company == $win){
              $openall =  $this->openablewinprofile($height,$width,$open,$price,$open->designtype,$id,$exist,$open->company,$opencount);
            }else{
                $openall =  $this->openableprofile($height,$width,$open,$price,$open->designtype,$id,$exist,$open->company,$opencount);
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
           return view('projectwindows.internalquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb')); 
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
           return view('projectwindows.internalquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb')); 
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
           return view('projectwindows.internalquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb')); 
           }else if(empty($slide)){
            $sqfall = $fixsqf + $opensqf;
            $amountalll = $fixall + $openall;
            $amountall = round($amountalll);
            $sqfper = $amountall /  $sqfall;
            $rateper = round($sqfper);
            $fb = $sqfall * 10;
            $slideall  = 0;
            $slidecount = 0;
           return view('projectwindows.internalquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb')); 
           }else if(empty($open)){
            $sqfall = $fixsqf + $slidesqf;
            $amountalll = $fixall + $slideall;
            $amountall = round($amountalll);
            $sqfper = $amountall /  $sqfall;
            $rateper = round($sqfper);
            $fb = $sqfall * 10;
            $openall  = 0;
            $opencount = 0;
           return view('projectwindows.internalquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb')); 
           }else if(empty($fix)){
            $sqfall = $opensqf + $slidesqf;
            $amountalll = $openall + $slideall;
            $amountall = round($amountalll);
            $sqfper = $amountall /  $sqfall;
            $rateper = round($sqfper);
            $fb = $sqfall * 10;
            $fixall  = 0;
            $fixcount = 0;
           return view('projectwindows.internalquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb')); 
           }else{
            $sqfall = $slidesqf + $fixsqf + $opensqf;
            $amountalll =  $slideall + $fixall + $openall ;
            $amountall = round($amountalll);
            $sqfper = $amountall /  $sqfall;
            $rateper = round($sqfper);
            $fb = $sqfall * 10;
       
           return view('projectwindows.internalquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb'));
           }

    }
        public function clientquote($id){
        $typ = Project::$type;
        $slidedesigntype =  $typ['sliding'];
        $fixdesigntype =  $typ['fix'];
        $opendesigntype =  $typ['open'];
        $br = ProjectWindow::$brand;
        $buraq =  $br['Buraq'];
        $win =  $br['Winplast'];
        $asas =  $br['Asaspen'];
        $slideall = 0;
        $slide = ProjectWindow::where('project', $id)->where('designtype',$slidedesigntype)->first();
        if($slide){
            $width = ProjectWindow::where('project', $id)->where('designtype',$slide->designtype)->sum('width');
            $height = ProjectWindow::where('project', $id)->where('designtype',$slide->designtype)->sum('height');
            $slidesqf = ProjectWindow::where('project', $id)->where('designtype',$slide->designtype)->sum('sqf');
            $slidecount = ProjectWindow::where('project', $id)->where('designtype',$slide->designtype)->where('company',$slide->company)->count();
            $price =  UserSlidingAccess::where('frame',$slide->frame)->first();
            $exist = ProjectWindow::where('project', '=', $id)->where('designtype','sliding total cost')->first();
            if($slide->company == $win){
                $slideall =  $this->slidewinplastprofile($height,$width,$slide,$price,$slide->designtype,$id,$exist,$slide->company,$slidecount);
            }else{
               $slideall =   $this->slideprofile($height,$width,$slide,$price,$slide->designtype,$id,$exist,$slide->company,$slidecount);
            }
        }
        $fix = ProjectWindow::where('project', $id)->where('designtype',$fixdesigntype)->first();
        if($fix){
            $width = ProjectWindow::where('project', $id)->where('designtype',$fix->designtype)->sum('width');
            $height = ProjectWindow::where('project', $id)->where('designtype',$fix->designtype)->sum('height');
            $fixsqf = ProjectWindow::where('project', $id)->where('designtype',$fix->designtype)->sum('sqf');
            $fixcount = ProjectWindow::where('project', $id)->where('designtype',$fix->designtype)->where('company',$fix->company)->count();
            $price =  UserSlidingAccess::where('frame',$fix->frame)->first();
            $exist = ProjectWindow::where('project', '=', $id)->where('designtype','fix total cost')->first();
            if($fix->company == $win){
                $fixall =  $this->allfixwinplastprofile($height,$width,$fix,$price,$fix->designtype,$id,$exist,$fix->company,$fixcount);
            }else{
                $fixall =  $this->allfixprofile($height,$width,$fix,$price,$fix->designtype,$id,$exist,$fix->company,$fixcount);
            }
        }
        $open = ProjectWindow::where('project', $id)->where('designtype',$opendesigntype)->first();
        if($open){
           
            $width = ProjectWindow::where('project', $id)->where('designtype',$open->designtype)->sum('width');
            $height = ProjectWindow::where('project', $id)->where('designtype',$open->designtype)->sum('height');
            $opensqf = ProjectWindow::where('project', $id)->where('designtype',$open->designtype)->sum('sqf');
            $opencount = ProjectWindow::where('project', $id)->where('designtype',$open->designtype)->where('company',$open->company)->count();
          $price =  OpenAssignAccess::where('window_id',$open->frame_id)->first();
            $exist = ProjectWindow::where('project', '=', $id)->where('designtype','open total cost')->first();

            if($open->company == $win){
                $openall = $this->openablewinprofile($height,$width,$open,$price,$open->designtype,$id,$exist,$open->company,$opencount);
            }else{
                $openall =  $this->openableprofile($height,$width,$open,$price,$open->designtype,$id,$exist,$open->company,$opencount);
            }
        }
         $sqfall = $slidesqf + $fixsqf + $opensqf;
         $amountalll = $slideall + $fixall + $openall;
         $amountall = round($amountalll);
         $sqfper = $amountall /  $sqfall;
         $rateper = round($sqfper);
         $fb = $sqfall * 10;
        return view('projectwindows.clientquote' , compact('slideall','fixall','openall','slidecount','fixcount','opencount','sqfall','rateper','amountall','fb'));

    }
       public function change_status($id)
    {
          $wins = ProjectWindow::where('projwin_id', $id)->get();
        foreach($wins as $win){
             $win->final = 1;
             $win->update();
        }
        $row = ProjWinEntry::find($id);
            $row->final = $row->final == '1' ? '0' : '1';
            if($row->update()){
               
                return redirect()->back()->with('success', __('Window successfully Finalized!'));
            }
            else{
                 return redirect()->back()->with('error', __('Permission Denied.'));
            }
    }
   
}
