<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menu;
use App\Models\menuitem;
use App\Models\category;
use App\Models\post;
use Illuminate\Support\Facades\Session as FacadesSession;
use Session;

class menuController extends Controller
{	
  public function index(){
    $menuitems = '';

    $selectedMenu = ''; 
    if($_GET['id'] == 'new') {
      $selectedMenu = '';
    }

    if(isset($_GET['id']) && $_GET['id'] != 'new'){
      $id = $_GET['id'];
      $selectedMenu = menu::where('id',$id)->first();
      if($selectedMenu->content != ''){
        // dd($selectedMenu->content);
        $menuitems = json_decode($selectedMenu->content);
        // dd($menuitems);
        $menuitems = $menuitems[0]; 
        // dd($menuitems);
        foreach($menuitems as $menu){
          $menu->title = menuitem::where('id',$menu->id)->value('title');
          $menu->name = menuitem::where('id',$menu->id)->value('name');
          $menu->slug = menuitem::where('id',$menu->id)->value('slug');
          $menu->target = menuitem::where('id',$menu->id)->value('target');
          $menu->type = menuitem::where('id',$menu->id)->value('type');
          
          // children 1
          if(!empty($menu->children[0])){
            foreach ($menu->children[0] as $child) {
              $child->title = menuitem::where('id',$child->id)->value('title');
              $child->name = menuitem::where('id',$child->id)->value('name');
              $child->slug = menuitem::where('id',$child->id)->value('slug');
              $child->target = menuitem::where('id',$child->id)->value('target');
              $child->type = menuitem::where('id',$child->id)->value('type');

              // children 2
                if(!empty($child->children)){
                  foreach ($child->children as $children) {
                    foreach ($children as $child) {
                      $child->title = menuitem::where('id',$child->id)->value('title');
                      $child->name = menuitem::where('id',$child->id)->value('name');
                      $child->slug = menuitem::where('id',$child->id)->value('slug');
                      $child->target = menuitem::where('id',$child->id)->value('target');
                      $child->type = menuitem::where('id',$child->id)->value('type');

                      // children 3
                      if(!empty($child->children)){
                        foreach ($child->children as $children) {
                          foreach ($children as $child) {
                            $child->title = menuitem::where('id',$child->id)->value('title');
                            $child->name = menuitem::where('id',$child->id)->value('name');
                            $child->slug = menuitem::where('id',$child->id)->value('slug');
                            $child->target = menuitem::where('id',$child->id)->value('target');
                            $child->type = menuitem::where('id',$child->id)->value('type');

                            // children 4
                            if(!empty($child->children)){
                              foreach ($child->children as $children) {
                                foreach ($children as $child) {
                                  $child->title = menuitem::where('id',$child->id)->value('title');
                                  $child->name = menuitem::where('id',$child->id)->value('name');
                                  $child->slug = menuitem::where('id',$child->id)->value('slug');
                                  $child->target = menuitem::where('id',$child->id)->value('target');
                                  $child->type = menuitem::where('id',$child->id)->value('type');
                                }    
                              }  
                            } 

                          }    
                        }  
                      } 
                       
                    }    
                  }  
                }  
            }  
          }
          if(!empty($menu->children[0])){
            // dd($menu->children[0]) ;
            foreach ($menu->children[0] as $child) {
            }  
          }
        }
        // dd($menuitems);
      }else{
        $menuitems = menuitem::where('menu_id',$selectedMenu->id)->get();                    
      }             
    }
    return view ('welcome',['categories'=>category::all(),'posts'=>post::all(),'menus'=>menu::all(),'selectedMenu'=>$selectedMenu,'menuitems'=>$menuitems]);
  }	

  public function store(Request $request){
	$data = $request->all(); 
	if(menu::create($data)){ 
	  $menu_data = menu::orderby('id','DESC')->first();          
	  // FacadesSession::flash('success','Menu saved successfully !');          
	  return redirect("manage-menus?id=$menu_data->id")->with('success','Menu saved successfully !');
	}else{
	  return redirect()->back()->with('error','Failed to save menu !');
	}
  }	

  public function addCatToMenu(Request $request){
    $data = $request->all();
    $menuid = $request->menuid;
    $ids = $request->ids;
    // return $menuid;
    $menu = menu::findOrFail($menuid);
    if($menu->content == ''){
      foreach($ids as $id){
        $data['title'] = category::where('id',$id)->value('title');
        $data['slug'] = category::where('id',$id)->value('slug');
        $data['type'] = 'category';
        $data['menu_id'] = $menuid;
        $data['updated_at'] = NULL;
        menuitem::create($data);
      }
    }else{
      $olddata = json_decode($menu->content,true); 
      foreach($ids as $id){
        $data['title'] = category::where('id',$id)->value('title');
        $data['slug'] = category::where('id',$id)->value('slug');
        $data['type'] = 'category';
        $data['menu_id'] = $menuid;
        $data['updated_at'] = NULL;
        menuitem::create($data);
      }
      foreach($ids as $id){
        $array['title'] = category::where('id',$id)->value('title');
        $array['slug'] = category::where('id',$id)->value('slug');
        $array['name'] = NULL;
        $array['type'] = 'category';
        $array['target'] = NULL;
        $id_menuitems = menuitem::where('slug',$array['slug'])->where('name',$array['name'])->where('type',$array['type'])->get();
        $id_menuitem = '';
        foreach($id_menuitems as $id_menuitem ){
           $id_menuitem = $id_menuitem->id ;
        }
        // return($id_menuitem);
        // return($id_menuitems);
        // return($array['id']);
        $array['id'] = $id_menuitem;
        $array['children'] = [[]];
        array_push($olddata[0],$array);
        $oldata = json_encode($olddata);
        $menu->update(['content'=>$olddata]);
      }
    }
  }

  public function addPostToMenu(Request $request){
    $data = $request->all();
    $menuid = $request->menuid;
    $ids = $request->ids;
    $menu = menu::findOrFail($menuid);
    if($menu->content == ''){
      foreach($ids as $id){
        $data['title'] = post::where('id',$id)->value('title');
        $data['slug'] = post::where('id',$id)->value('slug');
        $data['type'] = 'post';
        $data['menu_id'] = $menuid;
        $data['updated_at'] = NULL;
        menuitem::create($data);
      }
    }else{
      $olddata = json_decode($menu->content,true); 
      foreach($ids as $id){
        $data['title'] = post::where('id',$id)->value('title');
        $data['slug'] = post::where('id',$id)->value('slug');
        $data['type'] = 'post';
        $data['menu_id'] = $menuid;
        $data['updated_at'] = NULL;
        menuitem::create($data);
      }
      foreach($ids as $id){
        $array['title'] = post::where('id',$id)->value('title');
        $array['slug'] = post::where('id',$id)->value('slug');
        $array['name'] = NULL;
        $array['type'] = 'post';
        $array['target'] = NULL;
        $array['id'] = menuitem::where('slug',$array['slug'])->where('name',$array['name'])->where('type',$array['type'])->orderby('id','DESC')->value('id');                
        $array['children'] = [[]];
        array_push($olddata[0],$array);
        $oldata = json_encode($olddata);
        $menu->update(['content'=>$olddata]);
      }
    }
  }

  public function addCustomLink(Request $request){
    $data = $request->all();
    $menuid = $request->menuid;
    $menu = menu::findOrFail($menuid);
    if($menu->content == ''){
      $data['title'] = $request->link;
      $data['slug'] = $request->url;
      $data['type'] = 'custom';
      $data['menu_id'] = $menuid;
      $data['updated_at'] = NULL;
      menuitem::create($data);
    }else{
      $olddata = json_decode($menu->content,true); 
      $data['title'] = $request->link;
      $data['slug'] = $request->url;
      $data['type'] = 'custom';
      $data['menu_id'] = $menuid;
      $data['updated_at'] = NULL;
      menuitem::create($data);
      $array = [];
      $array['title'] = $request->link;
      $array['slug'] = $request->url;
      $array['name'] = NULL;
      $array['type'] = 'custom';
      $array['target'] = NULL;
      $array['id'] = menuitem::where('slug',$array['slug'])->where('name',$array['name'])->where('type',$array['type'])->orderby('id','DESC')->value('id');                
      $array['children'] = [[]];
      array_push($olddata[0],$array);
      $oldata = json_encode($olddata);
      $menu->update(['content'=>$olddata]);
    }
  }

  public function updateMenu(Request $request){
    $menu_data = $request->all(); 
    $menu=menu::findOrFail($request->menuid);            
    $content = $request->data; 
    $menu_data = [];  
    $menu_data['location'] = $request->location;       
    $menu_data['content'] = json_encode($content);
    $menu->update($menu_data); 
  }

  public function updateMenuItem(Request $request){
    $data = $request->all();        
    $item = menuitem::findOrFail($request->id);
    $item->update($data);
    return redirect()->back();
  }

  public function deleteMenuItem($id,$key,$in1='',$in2='',$in3='',$in4=''){        
    $menuitem = menuitem::findOrFail($id);
    // dd($menuitem->menu_id);
    $menu = menu::where('id',$menuitem->menu_id)->first();
    // dd($menu->content);
    if($menu->content != ''){
      
      $data = json_decode($menu->content,true);            
      $maindata = $data[0];
        
      if($in1 == ''){
      // dd('ok');
        unset($data[0][$key]);
        $menu_data = json_encode($data); 
        $menu->update(['content'=>$menu_data]);                         
      }
      if(($in1 >= 0) && empty($in2 && $in3 && $in4) && $in2 != 0 && $in3 != 0 && $in4 != 0){
        // dd('1');
        unset($data[0][$key]['children'][0][$in1]);
	    $menu_data = json_encode($data);
        $menu->update(['content'=>$menu_data]); 
      }
      if(($in1 >= 0 && $in2 >= 0) && empty($in3 && $in4) && $in3 != 0 && $in4 != 0){
        // dd(2);
        unset($data[0][$key]['children'][0][$in1]['children'][0][$in2]);
	    $menu_data = json_encode($data);
        $menu->update(['content'=>$menu_data]); 
      }
      if(($in1 >= 0 && $in2 >= 0 && $in3 >= 0) && empty($in4) && $in4 != 0){
        // dd(3);
        unset($data[0][$key]['children'][0][$in1]['children'][0][$in2]['children'][0][$in3]);
	    $menu_data = json_encode($data);
        $menu->update(['content'=>$menu_data]); 
      }
      if(($in1 >= 0 && $in2 >= 0 && $in3 >= 0 && $in4 >= 0)){
        // dd('ok');
        unset($data[0][$key]['children'][0][$in1]['children'][0][$in2]['children'][0][$in3]['children'][0][$in4]);
	    $menu_data = json_encode($data);
        $menu->update(['content'=>$menu_data]); 
      }
    }
    $menuitem->delete();
    return redirect()->back();
  }	

  public function destroy(Request $request){
    menuitem::where('menu_id',$request->id)->delete();  
    menu::findOrFail($request->id)->delete();
    return redirect('manage-menus?id=new')->with('success','Menu deleted successfully');
  }		

  
}	