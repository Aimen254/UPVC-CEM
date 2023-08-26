<?php

namespace App\Http\Controllers;

use App\Models\UserWindow;
use App\Models\Image;
use App\Models\Formula;
use App\Models\ImageFormula;
use App\Models\Project;
use App\Models\UserSlidingAccess;
use App\Models\ProductService;
use App\Models\Accessories;
use App\Models\FormulAssign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserWindowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('manage product & service'))
       {
            $images = Image::all();
            $formulas = Formula::all();
            return view('image.allimages' , compact('images' , 'formulas'));
       }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Image $image)
    {
        
        if(\Auth::user()->can('create product & service'))
        {
            $users = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
            $users->prepend(__('Select User'), '');
                        $products       = Project::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('project_name', 'id');


            return view('image.usercreate', compact('users', 'image','products'));
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }
    function cal($ac, $id, $width, $height){
      
        $slide = new UserSlidingAccess();
        $slide->value_id = $id;
        foreach($ac as $a){
            if($a->name == "Aluminium Rail (Sliding Windows)"){
               
                $slide->aluminium_rail = "25";
            }elseif($a->name == "Brush Rolls (Sliding Windows)"){
                
                 $slide->brush_rolls = "25";
            }elseif($a->name == "Bumper Block (Sliding Windows)"){
               
                $slide->bumpler_block = $a->quantity * $a->price;
           }elseif($a->name == "Double Tap On Screens (Sliding Windows)"){
                 
            $slide->DTape_screws = $a->quantity *  $a->price;
           }elseif($a->name == "Dummy Wheels (Sliding Windows)"){
               
            $slide->dummy_wheels = $a->quantity *  $a->price;
           }elseif($a->name == "Fiber Net Roll (Sliding Windows)"){
              
            $slide->fiber_net = $a->quantity *  $a->price;
           }elseif($a->name == "Flat Handle (Sliding Windows)"){
                
            $slide->flat_handle = $a->quantity *  $a->price;
           }elseif($a->name == "Fly Screen Gaskit (Sliding Windows)"){
               
            $ht = $height * 2;
            $wt = $width * 2;
            $sum = $ht + $wt;
            $half = $sum/2;
            $slide->fly_screen_gaskit = $half *  $a->price;
           }elseif($a->name == "Fly Screen Sliding Wheel (Sliding Windows)"){
              
            $slide->fly_screen_slidingwheel = $a->quantity *  $a->price;
           }elseif($a->name == "Gear Handles (Sliding Windows)"){
               
            $slide->gear_handles = $a->quantity *  $a->price;
           }elseif($a->name == "sliding Gear Keeps (Sliding Windows)"){
            $slide->sliding_gearkeep = $a->quantity *  $a->price;
           }elseif($a->name == "Sliding Gears (Sliding Windows)"){
            $slide->sliding_gear = $a->quantity *  $a->price;
           }elseif($a->name == "Sliding Gear Wheels (Sliding Windows)"){
            $slide->sliding_gearwheels = $a->quantity *  $a->price;
           }elseif($a->name == "Stoppers (Sliding Windows)"){
            $slide->stoppers = $a->quantity *  $a->price;
           }elseif($a->name == "Wind Break Bridge (Sliding Windows)"){
            $slide->wind_break = $a->quantity *  $a->price;
           }
            else{
                return "edfhdf";
            }
           
           }
         
           return  $slide->save();
    }
    
      function product($image_name,$image_id ,$id, $innerWidth , $innerHeight,$outerWidth,$outerHeight,$product,$sum){
        $productService                 = new ProductService();
        $productService->name           = $image_name;
        $productService->innerwidth           = $innerWidth;
        $productService->innerheight          = $innerHeight;
        $productService->outerheight          = $outerHeight;
          $productService->sale_price     = $sum;
        $productService->outerwidth          = $outerWidth;
        $productService->image_id         = $image_id;
        $productService->value_id          = $id;
        $productService->projects          = $product;
        $productService->type           = "product";
        $productService->created_by     = \Auth::user()->creatorId();
        $productService->save();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('create product & service'))
        {
            $usr = \Auth::user();
            $image_id = $request->id;
            $imget = ImageFormula :: where('image_id', $image_id)->get();
            
            $image_name = $request->name;
            $fwidth = $request->width;
            $width = $fwidth * 304.8;
            $fheight = $request->height;
            $height = $fheight * 304.8;
            // Config::set('common.form', $width);
            // return(Config::get('common.form'));
            foreach( $imget as $imgg)
                {
                    $data[] = $imgg->formula_type;
                }
                
            if($image_name == "Outer frame 80MM 88MM 98MM"){
                try {
                    $Formula            = new UserWindow();
               
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +6 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                
                        // $Formula->formula_type = $img->formula_type;
                        // $Formula->image_id = $image_id;
                       
                        $Formula->formula_type       = json_encode($data);
                        $Formula->image_id =  $image_id;
                        $Formula->projects    = implode(",", array_filter($request->products));
                        $Formula->created_by  = $usr->creatorId();
                        $Formula->user_id=\Auth::user()->id;
                        $insert = $Formula->save();
                        if ($insert){
                            return redirect()->back()->with('success', __('Values Added successfully created!'));
                        }
            
                    } catch (\Exception $e) {
                        return $e->getMessage();
                    }
              
              
            }
            elseif($image_name == "Sliding Sash 55"){
                  $access = FormulAssign::where('imagename' , $image_name)->first();
                  
                    $accessid     = explode(',', $access->acess_id);
                    
                    $ac  = Accessories::whereIn('id',$accessid)->get();
                  
                try {
                    $Formula            = new UserWindow();
                    foreach( $imget as $img)
                    {
                      
                        if($img->formula_type ==  "Outer frame 80MM 88MM 98MM"){
                           
                           
                                $f1Width = $width + 6 ;
                                $f1Height = $height +6 ;
                                $Formula->outerwidth        = $f1Width;
                                $Formula->outerheight        = $f1Height;
                         
                        }
                        elseif($img->formula_type == "sliding sash 73"){
                        
                         
                                
                                $f2Width = $width/2 + 5;
                                $f2Height = $height - 80 ;
                                $netwidth = $width - 15;
                                 $netHeight = $height - 80 ;
                              
                                $Formula->innerwidth        = $f2Width;
                                $Formula->innerheight        = $f2Height;
                                $Formula->netwidth        = $netwidth;
                                $Formula->netheight        = $netHeight;
                     
                             
                            
                        
                        }
                        elseif($img->formula_type == "sliding sash 55"){
                        
                          
                                $f2Width = $width/2 + 2;
                                $f2Height = $height - 78 ;
                                 $netwidth = $width - 15;
                                 $netHeight = $height - 78 ;
                           
                                $Formula->innerwidth        = $f2Width;
                                $Formula->innerheight        = $f2Height;
                                 $Formula->netwidth        = $netwidth;
                                $Formula->netheight        = $netHeight;
                            
                               
                        
                        }
                        else{
                            
                                $f2Width = $width/2 + 5;
                                $f2Height = $height - 80 ;
                                 $netwidth = $width - 15;
                                 $netHeight = $height - 80 ;
                            
                                $Formula->innerwidth        = $f2Width;
                                $Formula->innerheight        = $f2Height;
                                 $Formula->netwidth        = $netwidth;
                                $Formula->netheight        = $netHeight;
                              
                        }
        
                    }
                
                        // $Formula->formula_type = $img->formula_type;
                        // $Formula->image_id = $image_id;
                       $project =  implode(",", array_filter($request->products));
                        $Formula->formula_type       = json_encode($data);
                          $Formula->image_id =  $image_id;
                          $Formula->projects     = implode(",", array_filter($request->products));
                        $Formula->created_by  = $usr->creatorId();
                        $Formula->user_id=\Auth::user()->id;
                      
                        $insert = $Formula->save();
                         $id =$Formula->id;
                        $this->cal($ac ,$id, $fwidth, $fheight );
                        $sum = $Formula->valuesum();
                        $usupdate =  UserWindow::find($id);
                        $usupdate->totalexpense = $sum;
                        $usupdate->update();
                        $this->product($image_name,$image_id ,$id, $f2Width , $f2Height,$f1Width,$f1Height,$project, $sum);
                        if ($insert){
                            return redirect()->back()->with('success', ('Values Added successfully created!'));
                        }
            
                    } catch (\Exception $e) {
                        return $e->getMessage();
                    }
              
              
            }
          
            elseif($image_name == "Sliding Sash 66"){
                     $access = FormulAssign::where('imagename' , $image_name)->first();

                    $accessid     = explode(',', $access->acess_id);
                    $ac  = Accessories::whereIn('id',$accessid)->get();
                  try {
                    $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "Outer frame 80MM 88MM 98MM"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +6 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                     
                    }
                    elseif($img->formula_type == "sliding sash 73"){
                    
                     
                            
                            $f2Width = $width/2 + 5;
                            $f2Height = $height - 80 ;
                            $netwidth = $width - 15;
                            $netHeight = $height - 80; 
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                            $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                 
                         
                        
                    
                    }
                    elseif($img->formula_type == "sliding sash 55"){
                    
                      
                            $f2Width = $width/2 + 2;
                            $f2Height = $height - 78 ;
                            $netwidth = $width - 15;
                            $netHeight = $height - 78; 
                       
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                            $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                        
                           
                    
                    }
                    else{
                        
                            $f2Width = $width/2 + 5;
                            $f2Height = $height - 80 ;
                             $netwidth = $width - 15;
                            $netHeight = $height - 80;
                        
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                            $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                        
                          
                    }
    
                }
                
                        // $Formula->formula_type = $img->formula_type;
                        // $Formula->image_id = $image_id;
                       
                        $Formula->formula_type       = json_encode($data);
                        $Formula->created_by  = $usr->creatorId();
                          $Formula->image_id =  $image_id;
                          $Formula->projects     = implode(",", array_filter($request->products));
                        $Formula->user_id=\Auth::user()->id;
                        $insert = $Formula->save();
                          $id =$Formula->id;
                        $this->cal($ac ,$id, $width, $height );
                          $sum = $Formula->valuesum();
                        $usupdate =  UserWindow::find($id);
                        $usupdate->totalexpense = $sum;
                        $usupdate->update();
                            $this->product($image_name,$image_id ,$id, $f2Width , $f2Height,$f1Width,$f1Height,$project, $sum);
                        if ($insert){
                            return redirect()->back()->with('success', __('Values Added successfully created!'));
                        }
            
                    } catch (\Exception $e) {
                        return $e->getMessage();
                    }
         
            }
            
            elseif($image_name == "Sliding Sash 73"){
                    $access = FormulAssign::where('imagename' , $image_name)->first();

                    $accessid     = explode(',', $access->acess_id);
                    $ac  = Accessories::whereIn('id',$accessid)->get();
              try {
                $Formula            = new UserWindow();
                    foreach( $imget as $img)
                    {
                      
                        if($img->formula_type ==  "Outer frame 80MM 88MM 98MM"){
                           
                           
                                $f1Width = $width + 6 ;
                                $f1Height = $height +6 ;
                                $Formula->outerwidth        = $f1Width;
                                $Formula->outerheight        = $f1Height;
                         
                        }
                        elseif($img->formula_type == "sliding sash 73"){
                        
                         
                                
                                $f2Width = $width/2 + 5;
                                $f2Height = $height - 80 ;
                                $netwidth = $width - 15;
                                $netHeight = $height - 80;
                              
                                $Formula->innerwidth        = $f2Width;
                                $Formula->innerheight        = $f2Height;
                                $Formula->netwidth        = $netwidth;
                                $Formula->netheight        = $netHeight;
                     
                             
                            
                        
                        }
                        elseif($img->formula_type == "sliding sash 55"){
                        
                          
                                $f2Width = $width/2 + 2;
                                $f2Height = $height - 78 ;
                                $netwidth = $width - 15;
                                $netHeight = $height - 78;
                           
                                $Formula->innerwidth        = $f2Width;
                                $Formula->innerheight        = $f2Height;
                                $Formula->netwidth        = $netwidth;
                                $Formula->netheight        = $netHeight;
                            
                               
                        
                        }
                        else{
                            
                                $f2Width = $width/2 + 5;
                                $f2Height = $height - 80 ;
                                $netwidth = $width - 15;
                                $netHeight = $height - 80;
                            
                                $Formula->innerwidth        = $f2Width;
                                $Formula->innerheight        = $f2Height;
                                $Formula->netwidth        = $netwidth;
                                $Formula->netheight        = $netHeight;
                              
                        }
            
                    }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects    = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                        $id =$Formula->id;
                        $this->cal($ac ,$id, $width, $height );
                          $sum = $Formula->valuesum();
                        $usupdate =  UserWindow::find($id);
                        $usupdate->totalexpense = $sum;
                        $usupdate->update();
                            $this->product($image_name,$image_id ,$id, $f2Width , $f2Height,$f1Width,$f1Height,$project, $sum);
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
        
            elseif($image_name == "Sliding Sash 55 with Fixed Width/Height"){
                   $access = FormulAssign::where('imagename' , $image_name)->first();

                    $accessid     = explode(',', $access->acess_id);
                    $ac  = Accessories::whereIn('id',$accessid)->get();
              try {
                $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "Outer frame 80MM 88MM 98MM"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +6 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                     
                    }
                    elseif($img->formula_type == "Sliding Sash Fix 55"){
                    
                     
                            
                            $f2Width = $width/4 + 20;
                            $f2Height = $height - 78 ;
                            $f3Width = $width/2 + 40;
                            $f3Height = $height - 78 ;
                            $netwidth = $width - 15;
                            $netHeight = $height - 78;
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                            $Formula->fixwidth        = $f3Width;
                            $Formula->fixheight        = $f3Height;
                            $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                         
                        
                    
                    }
                    elseif($img->formula_type == "Sliding Sash Fix 66"){
                    
                      
                            $f2Width = $width/2 + 2;
                            $f2Height = $height - 78 ;
                            $f3Width = $width/2 + 40;
                            $f3Height = $height - 70 ;
                             $netwidth = $width - 15;
                            $netHeight = $height - 78;
                       
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                            $Formula->fixwidth        = $f3Width;
                            $Formula->fixheight        = $f3Height;
                            $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                           
                    
                    }
                    else{
                        
                            $f2Width = $width/2 + 5;
                            $f2Height = $height - 80 ;
                             $f3Width = $width/2 + 40;
                            $f3Height = $height - 70 ;
                             $netwidth = $width - 15;
                            $netHeight = $height - 80;
                        
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                            $Formula->fixwidth        = $f3Width;
                            $Formula->fixheight        = $f3Height;
                            $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                          
                    }
        
                }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                        $id =$Formula->id;
                        $this->cal($ac ,$id, $width, $height );
                          $sum = $Formula->valuesum();
                        $usupdate =  UserWindow::find($id);
                        $usupdate->totalexpense = $sum;
                        $usupdate->update();
                            $this->product($image_name,$image_id ,$id, $f2Width , $f2Height,$f1Width,$f1Height,$project, $sum);
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
             }
            elseif($image_name == "Sliding Sash 66 with Fixed Width/Height"){
                   $access = FormulAssign::where('imagename' , $image_name)->first();

                    $accessid     = explode(',', $access->acess_id);
                    $ac  = Accessories::whereIn('id',$accessid)->get();
              try {
                $Formula            = new UserWindow();
                    foreach( $imget as $img)
                    {
                      
                        if($img->formula_type ==  "Outer frame 80MM 88MM 98MM"){
                           
                           
                                $f1Width = $width + 6 ;
                                $f1Height = $height +6 ;
                                $Formula->outerwidth        = $f1Width;
                                $Formula->outerheight        = $f1Height;
                         
                        }
                        elseif($img->formula_type == "Sliding Sash Fix 55"){
                        
                         
                                
                                $f2Width = $width/4 + 20;
                                $f2Height = $height - 78 ;
                                $f3Width = $width/2 + 40;
                                $f3Height = $height - 78 ;
                                $netwidth = $width - 15;
                                $netHeight = $height - 78;
                              
                                $Formula->innerwidth        = $f2Width;
                                $Formula->innerheight        = $f2Height;
                                $Formula->fixwidth        = $f3Width;
                                $Formula->fixheight        = $f3Height;
                                $Formula->netwidth        = $netwidth;
                                $Formula->netheight        = $netHeight;
                            
                        
                        }
                        elseif($img->formula_type == "Sliding Sash Fix 66"){
                        
                          
                                $f2Width = $width/2 + 2;
                                $f2Height = $height - 78 ;
                                $f3Width = $width/2 + 40;
                                $f3Height = $height - 70 ;
                                 $netwidth = $width - 15;
                                $netHeight = $height - 78;
                           
                                $Formula->innerwidth        = $f2Width;
                                $Formula->innerheight        = $f2Height;
                                $Formula->fixwidth        = $f3Width;
                                $Formula->fixheight        = $f3Height;
                                $Formula->netwidth        = $netwidth;
                                $Formula->netheight        = $netHeight;
                               
                        
                        }
                        else{
                            
                                $f2Width = $width/2 + 5;
                                $f2Height = $height - 80 ;
                                 $f3Width = $width/2 + 40;
                                $f3Height = $height - 70 ;
                                  $netwidth = $width - 15;
                                $netHeight = $height - 80;
                            
                                $Formula->innerwidth        = $f2Width;
                                $Formula->innerheight        = $f2Height;
                                $Formula->fixwidth        = $f3Width;
                                $Formula->fixheight        = $f3Height;
                                $Formula->netwidth        = $netwidth;
                                $Formula->netheight        = $netHeight;
                              
                        }
            
                    }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                        $id =$Formula->id;
                        $this->cal($ac ,$id, $width, $height );
                          $sum = $Formula->valuesum();
                        $usupdate =  UserWindow::find($id);
                        $usupdate->totalexpense = $sum;
                        $usupdate->update();
                            $this->product($image_name,$image_id ,$id, $f2Width , $f2Height,$f1Width,$f1Height,$project, $sum);
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
            elseif($image_name == "Sliding Sash 73 with Fixed Width/Height"){
                   $access = FormulAssign::where('imagename' , $image_name)->first();

                    $accessid     = explode(',', $access->acess_id);
                    $ac  = Accessories::whereIn('id',$accessid)->get();
              try {
                $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "Outer frame 80MM 88MM 98MM"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +6 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                     
                    }
                    elseif($img->formula_type == "Sliding Sash Fix 55"){
                    
                     
                            
                            $f2Width = $width/4 + 20;
                            $f2Height = $height - 78 ;
                            $f3Width = $width/2 + 40;
                            $f3Height = $height - 78 ;
                            $netwidth = $width - 15;
                            $netHeight = $height - 78;
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                            $Formula->fixwidth        = $f3Width;
                            $Formula->fixheight        = $f3Height;
                            $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                        
                    
                    }
                    elseif($img->formula_type == "Sliding Sash Fix 66"){
                    
                      
                            $f2Width = $width/2 + 2;
                            $f2Height = $height - 78 ;
                            $f3Width = $width/2 + 40;
                            $f3Height = $height - 70 ;
                            $netwidth = $width - 15;
                            $netHeight = $height - 78;
                       
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                            $Formula->fixwidth        = $f3Width;
                            $Formula->fixheight        = $f3Height;
                            $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                           
                    
                    }
                    else{
                        
                            $f2Width = $width/2 + 5;
                            $f2Height = $height - 80 ;
                            $f3Width = $width/2 + 40;
                            $f3Height = $height - 70 ;
                            $netwidth = $width - 15;
                            $netHeight = $height - 78;
                        
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                            $Formula->fixwidth        = $f3Width;
                            $Formula->fixheight        = $f3Height;
                              $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                          
                    }
        
                }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                       $id =$Formula->id;
                        $this->cal($ac ,$id, $width, $height );
                          $sum = $Formula->valuesum();
                        $usupdate =  UserWindow::find($id);
                        $usupdate->totalexpense = $sum;
                        $usupdate->update();
                        $this->product($image_name,$image_id ,$id, $f2Width , $f2Height,$f1Width,$f1Height,$project, $sum);
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
            
            elseif($image_name == "Sliding Sash 55, 63, 73"){
                     $access = FormulAssign::where('imagename' , $image_name)->first();

                    $accessid     = explode(',', $access->acess_id);
                    $ac  = Accessories::whereIn('id',$accessid)->get();
              try {
                $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "Outer frame 80MM 88MM 98MM"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +6 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                     
                    }
                    elseif($img->formula_type == "Sliding Sash 55, 66, 73"){
                    
                     
                            
                            $f2Width = $width + 85/4;
                               $netwidth = $width - 15;
                            $netHeight = $f1Width;
                           
                            
                            $Formula->innerwidth        = $f2Width;
                              $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                           
                          
                    
                    }
                   
        
                }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                       $id =$Formula->id;
                        $this->cal($ac ,$id, $width, $height );
                          $sum = $Formula->valuesum();
                        $usupdate =  UserWindow::find($id);
                        $usupdate->totalexpense = $sum;
                        $usupdate->update();
                        $this->product($image_name,$image_id ,$id, $f2Width , $f2Height,$f1Width,$f1Height,$project, $sum);
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
        
            elseif($image_name == "Latch Lock Sliding Sash 55"){
                     $access = FormulAssign::where('imagename' , $image_name)->first();

                    $accessid     = explode(',', $access->acess_id);
                    $ac  = Accessories::whereIn('id',$accessid)->get();
              try {
                $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "Outer frame 80MM 88MM 98MM"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +6 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                            
                     
                    }
                    elseif($img->formula_type == "Latch Lock Sliding Sash 55"){
                    
                     
                            
                            $f2Width = $width+85/4 ;
                            $netwidth = $width - 15;
                            $netHeight = $height +6;
                          
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                            $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                         
                        
                    
                    }
                    elseif($img->formula_type == "Latch Lock Sliding Sash 66"){
                    
                      
                            $f2Width = $width+85/4;
                              $netwidth = $width - 15;
                            $netHeight = $height  +6;
                          
                       
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                             $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                    
                    }
                    else{
                        
                            $f2Width = $width+85/4;
                             $netwidth = $width - 15;
                            $netHeight = $height  +6;
                          
                        
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                                 $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                          
                    }
        
                }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                     $id =$Formula->id;
                        $this->cal($ac ,$id, $width, $height );
                          $sum = $Formula->valuesum();
                        $usupdate =  UserWindow::find($id);
                        $usupdate->totalexpense = $sum;
                        $usupdate->update();
                            $this->product($image_name,$image_id ,$id, $f2Width , $f2Height,$f1Width,$f1Height,$project, $sum);
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
            elseif($image_name == "Latch Lock Sliding Sash 66"){
                    $access = FormulAssign::where('imagename' , $image_name)->first();

                    $accessid     = explode(',', $access->acess_id);
                    $ac  = Accessories::whereIn('id',$accessid)->get();
              try {
                $Formula            = new UserWindow();
                    foreach( $imget as $img)
                    {
                      
                        if($img->formula_type ==  "Outer frame 80MM 88MM 98MM"){
                           
                           
                                $f1Width = $width + 6 ;
                                $f1Height = $height +6 ;
                                $Formula->outerwidth        = $f1Width;
                                $Formula->outerheight        = $f1Height;
                                
                         
                        }
                        elseif($img->formula_type == "Latch Lock Sliding Sash 55"){
                        
                         
                                
                                $f2Width = $width + 85/4 ;
                                $netwidth = $width - 15;
                                $netHeight = $height  +6;
                                
                                $Formula->innerwidth        = $f2Width;
                            
                                     $Formula->netwidth        = $netwidth;
                            $Formula->netheight        = $netHeight;
                             
                            
                        
                        }
                        elseif($img->formula_type == "Latch Lock Sliding Sash 66"){
                        
                          
                                $f2Width = $width + 85/4; ;
                                   $netwidth = $width - 15;
                                $netHeight = $height  +6;
                           
                                $Formula->innerwidth        = $f2Width;
                               
                                $Formula->netwidth        = $netwidth;
                                $Formula->netheight        = $netHeight;
                             
                        
                        }
                        else{
                            
                                $f2Width = $width + 85/4;
                                    $netwidth = $width - 15;
                                $netHeight = $height  +6;
                                $Formula->innerwidth        = $f2Width;
                                $Formula->netwidth        = $netwidth;
                                $Formula->netheight        = $netHeight;
                              
                        }
            
                    }
                    
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects    = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                         $id =$Formula->id;
                        $this->cal($ac ,$id, $width, $height );
                          $sum = $Formula->valuesum();
                        $usupdate =  UserWindow::find($id);
                        $usupdate->totalexpense = $sum;
                        $usupdate->update();
                            $this->product($image_name,$image_id ,$id, $f2Width , $f2Height,$f1Width,$f1Height,$project, $sum);
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
            elseif($image_name == "Latch Lock Sliding Sash 73"){
                  $access = FormulAssign::where('imagename' , $image_name)->first();

                    $accessid     = explode(',', $access->acess_id);
                    $ac  = Accessories::whereIn('id',$accessid)->get();
              try {
                $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "Outer frame 80MM 88MM 98MM"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +6 ;
                            
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                     
                    }
                    elseif($img->formula_type == "Latch Lock Sliding Sash 55"){
                    
                     
                            
                            $f2Width = $width + 85/4 ;
                            $netwidth = $width - 15;
                            $netHeight = $height  +6;
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                            $Formula->netwidth        = $netwidth;
                                $Formula->netheight        = $netHeight;
                         
                        
                    
                    }
                    elseif($img->formula_type == "Latch Lock Sliding Sash 66"){
                    
                      
                            $f2Width = $width + 85/4;
                            $netwidth = $width - 15;
                            $netHeight = $height  +6;
                       
                            $Formula->innerwidth        = $f2Width;
                           $Formula->netwidth        = $netwidth;
                           $Formula->netheight        = $netHeight;
                    
                    }
                    else{
                        
                            $f2Width = $width + 85/4;
                            $netwidth = $width - 15;
                            $netHeight = $height  +6;
                            $Formula->innerwidth        = $f2Width;
                             $Formula->netwidth        = $netwidth;
                           $Formula->netheight        = $netHeight;
                            
                          
                    }
        
                }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                         $id =$Formula->id;
                        $this->cal($ac ,$id, $width, $height );
                          $sum = $Formula->valuesum();
                        $usupdate =  UserWindow::find($id);
                        $usupdate->totalexpense = $sum;
                        $usupdate->update();
                            $this->product($image_name,$image_id ,$id, $f2Width , $f2Height,$f1Width,$f1Height,$project, $sum);
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
        
            elseif($image_name == "60MM"){
              try {
                $Formula            = new UserWindow();
                    foreach( $imget as $img)
                    {
                      
                        if($img->formula_type ==  "Outer frame 80MM 88MM 98MM"){
                           
                           
                                $f1Width = $width + 6 ;
                                $f1Height = $height +6 ;
                                $Formula->outerwidth        = $f1Width;
                                $Formula->outerheight        = $f1Height;
                         
                        }
                        elseif($img->formula_type == "60MM"){
                        
                         
                                
                                $f2Width = $width - 56 ;
                                $f2Height = $height - 56 ;
                              
                                $Formula->innerwidth        = $f2Width;
                                $Formula->innerheight        = $f2Height;
                             
                            
                        
                        }
                        elseif($img->formula_type == "70MM"){
                        
                          
                                $f2Width = $width - 70;
                                $f2Height = $height - 70 ;
                           
                                $Formula->innerwidth        = $f2Width;
                                $Formula->innerheight        = $f2Height;
                        
                        }
            
                    }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
            elseif($image_name == "70MM"){
              try {
                $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "Outer frame 80MM 88MM 98MM"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +6 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                     
                    }
                    elseif($img->formula_type == "60MM"){
                    
                     
                            
                            $f2Width = $width - 56 ;
                            $f2Height = $height - 56 ;
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                         
                        
                    
                    }
                    elseif($img->formula_type == "70MM"){
                    
                      
                            $f2Width = $width - 70;
                            $f2Height = $height - 70 ;
                       
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                    
                    }
        
                }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
        
             elseif($image_name == "Mullion 60MM"){
              try {
                $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "Outer frame 80MM 88MM 98MM	"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +6 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                     
                    }
                    elseif($img->formula_type == "Mullion 60MM	"){
                    
                     
                            
                            $f2Width = $width - 80;
                          
                          
                            $Formula->innerwidth        = $f2Width;
                         
                         
                        
                    
                    }
                    elseif($img->formula_type == "Mullion 70MM	"){
                    
                      
                            $f2Width = $width - 100;
                       
                            $Formula->innerwidth        = $f2Width;
                    
                    }
        
                }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
             elseif($image_name == "Mullion 70MM"){
              try {
                $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "Outer frame 80MM 88MM 98MM	"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +6 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                     
                    }
                    elseif($img->formula_type == "Mullion 60MM	"){
                    
                     
                            
                            $f2Width = $width - 80 ;
                          
                          
                            $Formula->innerwidth        = $f2Width;
                          
                         
                        
                    
                    }
                    elseif($img->formula_type == "Mullion 70MM	"){
                    
                      
                            $f2Width = $width - 100;
                         
                       
                            $Formula->innerwidth        = $f2Width;
                          
                    }
        
                }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
        
             elseif($image_name == "Openable door sash 60MM"){
              try {
                $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "60MM Frame"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +3 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                     
                    }
                    elseif($img->formula_type == "Openable door sash 60MM"){
                    
                     
                            
                            $f2Width = $width - 56;
                            $f2Height = $height - 35;
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                         
                        
                    
                    }
                    elseif($img->formula_type == "Openable door sash 70MM"){
                    
                            $f2Width = $width - 70;
                            $f2Height = $height - 40;
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                          
                    }
        
                }
                
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
             elseif($image_name == "Openable door sash 70MM"){
              try {
                $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "70MM Frame"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +3 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                     
                    }
                    elseif($img->formula_type == "Openable door sash 60MM"){
                    
                     
                            
                            $f2Width = $width - 56;
                            $f2Height = $height - 35;
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                         
                        
                    
                    }
                    elseif($img->formula_type == "Openable door sash 70MM"){
                    
                            $f2Width = $width - 70;
                            $f2Height = $height - 40;
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                          
                    }
        
                }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
        
             elseif($image_name == "Openable sash 60MM"){
              try {
                $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "60MM Frame"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +6 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f1Height;
                     
                    }
                    elseif($img->formula_type == "Openable sash 60MM"){
                    
                     
                            
                            $f2Width = $width - 80/2;
                            $f2Height = $height - 56;
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                         
                        
                    
                    }
                    elseif($img->formula_type == "Openable sash 70MM"){
                    
                            $f2Width = $width - 100/2;
                            $f2Height = $height - 70;
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                          
                    }
        
                }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
             elseif($image_name == "Openable sash 70MM"){
              try {
                $Formula            = new UserWindow();
                foreach( $imget as $img)
                {
                  
                    if($img->formula_type ==  "60MM Frame"){
                       
                       
                            $f1Width = $width + 6 ;
                            $f1Height = $height +6 ;
                            $Formula->outerwidth        = $f1Width;
                            $Formula->outerheight        = $f2Height;
                     
                    }
                    elseif($img->formula_type == "Openable sash 60MM"){
                    
                     
                            
                            $f2Width = $width - 80/2;
                            $f2Height = $height - 56;
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                         
                        
                    
                    }
                    elseif($img->formula_type == "Openable sash 70MM"){
                    
                            $f2Width = $width - 100/2;
                            $f2Height = $height - 70;
                          
                            $Formula->innerwidth        = $f2Width;
                            $Formula->innerheight        = $f2Height;
                          
                    }
        
                }
            
                    // $Formula->formula_type = $img->formula_type;
                    // $Formula->image_id = $image_id;
                   
                    $Formula->formula_type       = json_encode($data);
                      $Formula->image_id =  $image_id;
                      $Formula->projects     = implode(",", array_filter($request->products));
                    $Formula->created_by  = $usr->creatorId();
                    $Formula->user_id=\Auth::user()->id;
                    $insert = $Formula->save();
                    if ($insert){
                        return redirect()->back()->with('success', __('Values Added successfully created!'));
                    }
        
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
     
        }
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserWindow  $userWindow
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Auth::user()->can('manage product & service'))
        {
               $window = UserWindow::find($id);
            $image_id = $window->image_id;
            $image = Image::where('id', $image_id)->first();
               $access = UserSlidingAccess::where('value_id' , $id)->get();
            return view('image.showvalues', compact('window', 'image','access'));
        } else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }


   public function image_list(Image $image)
    {
   
        if(\Auth::user()->can('manage product & service'))
        {
            $image_id = $image->id;
           $datas = UserWindow::where('image_id', $image_id)->get();
         
        //     $projs = UserWindow::where('image_id', $image_id)->pluck('projects')->toArray();
        //       $allproj = Project::whereIn('id', $projs)->get();
        //   return $allproj ;
        $recent = DB::table('user_windows')->where('image_id', $image_id)->latest('id')->first();
         $raccess = UserSlidingAccess::where('value_id' , $recent->id)->get();
           $assign_to = UserWindow::where('image_id', $image_id)->pluck('assignto')->toArray();
          
        $assign = User::whereIn('id', $assign_to)->get();
           $createdby = UserWindow::where('image_id', $image_id)->pluck('created_by')->toArray();
        $createid = User::whereIn('id', $createdby)->get();
           
            return view('image.imagelist', compact( 'datas','image','recent', 'assign' , 'createid','raccess'));
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
   
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserWindow  $userWindow
     * @return \Illuminate\Http\Response
     */
    public function edit(UserWindow $userWindow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserWindow  $userWindow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserWindow $userWindow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserWindow  $userWindow
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $window = UserWindow::find($id);
        if(\Auth::user()->can('delete product & service'))
        {
            if($window->created_by == \Auth::user()->creatorId())
            {
                $window->delete();

                return redirect()->back()->with('success', __('Entry successfully deleted!'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
    
    public function createassign(UserWindow $data){
        $users = User::where('type', 'Cutter')->get()->pluck('name', 'id');
        return view('image.assign', compact( 'data', 'users'));
    }
    public function assign(Request $request)
    {
       
        if(\Auth::user()->can('manage product & service'))
        {
            $id = $request->id;
            $row = UserWindow::find($id);
            // $ldate = date('Y-m-d H:i:s');
          
                $row->assignto = implode(",", array_filter($request->assign));
                $row->update();
                if($row){
                   
                    return redirect()->back()->with('success', __('Entery successfully Assign!'));
                }
                else{
                     return redirect()->back()->with('error', __('Permission Denied.'));
                }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
       public function createstatus(UserWindow $data){
        
        return view('image.status', compact( 'data'));
    }
    public function status(Request $request)
    {
       
        if(\Auth::user()->can('manage product & service'))
        {
            $id = $request->id;
            $row = UserWindow::find($id);
            // $ldate = date('Y-m-d H:i:s');
          
                $row->status = $request->status;
                $row->update();
                if($row){
                   
                    return redirect()->back()->with('success', __('status successfully Updated!'));
                }
                else{
                     return redirect()->back()->with('error', __('Permission Denied.'));
                }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}
