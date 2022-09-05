<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>
    <body class="antialiased">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
   
    <script src="{{ URL::asset('js/jquery-3.6.1.min.js') }}"></script>
    
    <!-- jquery-sortable :: Sortable :: Latest (https://johnny.github.io/jquery-sortable/) -->
    <script src="{{ URL::asset('js/jquery-sortable.js') }}"></script>

   
    <div class="container-fluid">
		<h2><span>Menus</span></h2>
		@if(Session::has('success'))
			<div class="alert alert-primary" role="alert">
				{{Session::get('success')}}
			</div>
		@endif
		@if(Session::has('error'))
			<div class="alert alert-danger" role="alert">
				{{Session::get('error')}}
			</div>
		@endif

		<div class="content info-box">
				@if(count($menus) > 0)		
				Select a menu to edit: 		
				<form action="{{route('manage-menus')}}" class="form-inline">
					<select name="id">
						@foreach($menus as $menu)
							@if($selectedMenu != '')
							<option value="{{$menu->id}}" @if($menu->id == $selectedMenu->id) selected @endif>{{$menu->title}}</option>
						    @else
							<option value="{{$menu->id}}">{{$menu->title}}</option>
						    @endif
						@endforeach
					</select>
					<button class="btn btn-sm btn-default btn-menu-select">Select</button>
				</form> 
				or
				@endif 
				<a href="{{route('manage-menus','?id=new')}}">Create a new menu</a>.	
		</div>


		<div class="row" id="main-row">				
			<div class="col-sm-3 cat-form @if(count($menus) == 0) disabled @endif">
				<h3><span>Add Menu Items</span></h3>			

				<div class="panel-group" id="menu-items">

					<div class="panel panel-default">
						<div class="panel-heading">
							<a href="#categories-list" data-toggle="collapse" data-parent="#menu-items">Categories <span class="caret pull-right"></span></a>
						</div>
						<div class="panel-collapse collapse in" id="categories-list">
							<div class="panel-body">						
							<div class="item-list-body">
									@foreach($categories as $cat)
									{{-- {{$cat->id}} --}}
									<p><input type="checkbox" name="select-category[]" value="{{$cat->id}}"> {{$cat->title}}</p>
									@endforeach
							</div>	
							<div class="item-list-footer">
									<label class="btn btn-sm btn-default"><input type="checkbox" id="select-all-categories"> Select All</label>
									<button type="button" class="pull-right btn btn-default btn-sm" id="add-categories">Add to Menu</button>
							</div>
							</div>						
						</div>
						<script>
						$('#select-all-categories').click(function(event) {   
							if(this.checked) {
							$('#categories-list :checkbox').each(function() {
								this.checked = true;                        
							});
							}else{
							$('#categories-list :checkbox').each(function() {
								this.checked = false;                        
							});
							}
						});
						</script>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
						<a href="#posts-list" data-toggle="collapse" data-parent="#menu-items">posts <span class="caret pull-right"></span></a>
						</div>
						<div class="panel-collapse collapse" id="posts-list">
						<div class="panel-body">						
							<div class="item-list-body">
							@foreach($posts as $post)
								<p><input type="checkbox" name="select-post[]" value="{{$post->id}}"> {{$post->title}}</p>
							@endforeach
							</div>	
							<div class="item-list-footer">
							<label class="btn btn-sm btn-default"><input type="checkbox" id="select-all-posts"> Select All</label>
							<button type="button" id="add-posts" class="pull-right btn btn-default btn-sm">Add to Menu</button>
							</div>
						</div>						
						</div>
						<script>
						$('#select-all-posts').click(function(event) {   
							if(this.checked) {
							$('#posts-list :checkbox').each(function() {
								this.checked = true;                        
							});
							}else{
							$('#posts-list :checkbox').each(function() {
								this.checked = false;                        
							});
							}
						});
						</script>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
						<a href="#custom-links" data-toggle="collapse" data-parent="#menu-items">Custom Links <span class="caret pull-right"></span></a>
						</div>
						<div class="panel-collapse collapse" id="custom-links">
						<div class="panel-body">						
							<div class="item-list-body">
							<div class="form-group">
								<label>URL</label>
								<input type="url" id="url" class="form-control" placeholder="https://">
							</div>
							<div class="form-group">
								<label>Link Text</label>
								<input type="text" id="linktext" class="form-control" placeholder="">
								</div>
							</div>	
							<div class="item-list-footer">
								<button type="button" class="pull-right btn btn-default btn-sm" id="add-custom-link">Add to Menu</button>
							</div>
							</div>
						</div>
						</div>
					</div>

				</div>		

				<div class="col-sm-9 cat-view">
				<h3><span>Menu Structure</span></h3>
					@if($selectedMenu == '')
						<h4>Create New Menu</h4>
						<form method="post" action="{{route('create-menu')}}">
							{{csrf_field()}}
							<div class="row">
								<div class="col-sm-12">
								<label>Name</label>
								</div>
								<div class="col-sm-6">
								<div class="form-group">							
									<input type="text" name="title" class="form-control">
								</div>
								</div>
								<div class="col-sm-6 text-right">
								<button class="btn btn-sm btn-primary">Create Menu</button>
								</div>
							</div>
						</form>
					@else

						<div id="menu-content">
							<div id="result"></div>
							<div style="min-height: 240px;">
								<p>Select categories, pages or add custom links to menus.</p>
								@if($selectedMenu != '')
								<ul class="menu ui-sortable" id="menuitems">
									@if(!empty($menuitems))
	                                {{-- {{dd($selectedMenu->id);}} --}}
											@foreach($menuitems as $key=>$item)
												<li data-id="{{$item->id}}">
													<span class="menu-item-bar">
														<a href="#collapse{{$item->id}}" class="pull-right" data-toggle="collapse">
															<i class="fa fa-arrows"></i> 
															@if(empty($item->name)) {{$item->title}} @else {{$item->name}} @endif 
															<i class="fa-sharp fa-solid fa-caret-down"></i>
														</a>
													</span>
													<div class="collapse" id="collapse{{$item->id}}">
													<div class="input-box">
														<form method="post" action="{{route('update-menuitem',$item->id)}}">
														{{csrf_field()}}
														<div class="form-group">
															<label>Link Name</label>
															<input type="text" name="name" value="@if(empty($item->name)) {{$item->title}} @else {{$item->name}} @endif" class="form-control">
														</div>
														@if($item->type == 'custom')
															<div class="form-group">
															<label>URL</label>
															<input type="text" name="slug" value="{{$item->slug}}" class="form-control">
															</div>					
															<div class="form-group">
															<input type="checkbox" name="target" value="_blank" @if($item->target == '_blank') checked @endif> Open in a new tab
															</div>
														@endif
														<div class="form-group">
															<button class="btn btn-sm btn-primary">Save</button>
															{{-- {{$item->id}} --}}
															<a href="{{route('delete-menuitem',$item->id.'/'.$key)}}" class="btn btn-sm btn-danger">Delete</a>
														</div>
														</form>
													</div>
													</div>

													<ul>
														{{-- // children 1 --}}
														@if(isset($item->children))
															@foreach($item->children as $m)
															{{-- {{dd($m);}} --}}
																@foreach($m as $in1=>$data)
																	<li data-id="{{$data->id}}" class="menu-item"> 
																		<span class="menu-item-bar">
																		<a href="#collapse{{$data->id}}" class="pull-right" data-toggle="collapse">
																				<i class="fa fa-arrows"></i> 
																				@if(empty($data->name)) {{$data->title}} @else {{$data->name}} @endif 
																				<i class="fa-sharp fa-solid fa-caret-down"></i>
																			</a>
																		</span>
																		<div class="collapse" id="collapse{{$data->id}}">
																			<div class="input-box">
																				<form method="post" action="{{route('update-menuitem',$data->id)}}">
																					{{csrf_field()}}
																					<div class="form-group">
																					<label>Link Name</label>
																					<input type="text" name="name" value="@if(empty($data->name)) {{$data->title}} @else {{$data->name}} @endif" class="form-control">
																					</div>
																					@if($data->type == 'custom')
																					<div class="form-group">
																						<label>URL</label>
																						<input type="text" name="slug" value="{{$data->slug}}" class="form-control">
																					</div>					
																					<div class="form-group">
																						<input type="checkbox" name="target" value="_blank" @if($data->target == '_blank') checked @endif> Open in a new tab
																					</div>
																					@endif
																					<div class="form-group">
																					<button class="btn btn-sm btn-primary">Save</button>
																					<a href="{{route('delete-menuitem',$data->id.'/'.$key.'/'.$in1)}}" class="btn btn-sm btn-danger">Delete</a>
																					</div>
																				</form>
																			</div>
																		</div>
																		<ul>
																			
																			{{-- // children 2 --}}
																			@if(isset($data->children))
																				@foreach($data->children as $m)
																				@foreach($m as $in2=>$data)
																					<li data-id="{{$data->id}}" class="menu-item"> 
																						<span class="menu-item-bar">
																						<a href="#collapse{{$data->id}}" class="pull-right" data-toggle="collapse">
																								<i class="fa fa-arrows"></i> 
																								@if(empty($data->name)) {{$data->title}} @else {{$data->name}} @endif 
																								<i class="fa-sharp fa-solid fa-caret-down"></i>
																							</a>
																						</span>
																					<div class="collapse" id="collapse{{$data->id}}">
																						<div class="input-box">
																						<form method="post" action="{{route('update-menuitem',$data->id)}}">
																							{{csrf_field()}}
																							<div class="form-group">
																							<label>Link Name</label>
																							<input type="text" name="name" value="@if(empty($data->name)) {{$data->title}} @else {{$data->name}} @endif" class="form-control">
																							</div>
																							@if($data->type == 'custom')
																							<div class="form-group">
																								<label>URL</label>
																								<input type="text" name="slug" value="{{$data->slug}}" class="form-control">
																							</div>					
																							<div class="form-group">
																								<input type="checkbox" name="target" value="_blank" @if($data->target == '_blank') checked @endif> Open in a new tab
																							</div>
																							@endif
																							<div class="form-group">
																							<button class="btn btn-sm btn-primary">Save</button>
																							<a href="{{route('delete-menuitem',$data->id.'/'.$key.'/'.$in1.'/'.$in2)}}" class="btn btn-sm btn-danger">Delete</a>
																							</div>
																						</form>
																						</div>
																					</div>
																					<ul>
																						{{-- // children 3 --}}
																						@if(isset($data->children))
																							@foreach($data->children as $m)
																							@foreach($m as $in3=>$data)
																								<li data-id="{{$data->id}}" class="menu-item"> 
																									<span class="menu-item-bar">
																									<a href="#collapse{{$data->id}}" class="pull-right" data-toggle="collapse">
																											<i class="fa fa-arrows"></i> 
																											@if(empty($data->name)) {{$data->title}} @else {{$data->name}} @endif 
																											<i class="fa-sharp fa-solid fa-caret-down"></i>
																										</a>
																									</span>
																								<div class="collapse" id="collapse{{$data->id}}">
																									<div class="input-box">
																									<form method="post" action="{{route('update-menuitem',$data->id)}}">
																										{{csrf_field()}}
																										<div class="form-group">
																										<label>Link Name</label>
																										<input type="text" name="name" value="@if(empty($data->name)) {{$data->title}} @else {{$data->name}} @endif" class="form-control">
																										</div>
																										@if($data->type == 'custom')
																										<div class="form-group">
																											<label>URL</label>
																											<input type="text" name="slug" value="{{$data->slug}}" class="form-control">
																										</div>					
																										<div class="form-group">
																											<input type="checkbox" name="target" value="_blank" @if($data->target == '_blank') checked @endif> Open in a new tab
																										</div>
																										@endif
																										<div class="form-group">
																										<button class="btn btn-sm btn-primary">Save</button>
																										<a href="{{route('delete-menuitem',$data->id.'/'.$key.'/'.$in1.'/'.$in2.'/'.$in3)}}" class="btn btn-sm btn-danger">Delete</a>
																										</div>
																									</form>
																									</div>
																								</div>
																								<ul>
																									{{-- // children 4 --}}
																									@if(isset($data->children))
																										@foreach($data->children as $m)
																										@foreach($m as $in4=>$data)
																											<li data-id="{{$data->id}}" class="menu-item"> 
																												<span class="menu-item-bar">
																												<a href="#collapse{{$data->id}}" class="pull-right" data-toggle="collapse">
																														<i class="fa fa-arrows"></i> 
																														@if(empty($data->name)) {{$data->title}} @else {{$data->name}} @endif 
																														<i class="fa-sharp fa-solid fa-caret-down"></i>
																													</a>
																												</span>
																											<div class="collapse" id="collapse{{$data->id}}">
																												<div class="input-box">
																												<form method="post" action="{{route('update-menuitem',$data->id)}}">
																													{{csrf_field()}}
																													<div class="form-group">
																													<label>Link Name</label>
																													<input type="text" name="name" value="@if(empty($data->name)) {{$data->title}} @else {{$data->name}} @endif" class="form-control">
																													</div>
																													@if($data->type == 'custom')
																													<div class="form-group">
																														<label>URL</label>
																														<input type="text" name="slug" value="{{$data->slug}}" class="form-control">
																													</div>					
																													<div class="form-group">
																														<input type="checkbox" name="target" value="_blank" @if($data->target == '_blank') checked @endif> Open in a new tab
																													</div>
																													@endif
																													<div class="form-group">
																													<button class="btn btn-sm btn-primary">Save</button>
																													<a href="{{route('delete-menuitem',$data->id.'/'.$key.'/'.$in1.'/'.$in2.'/'.$in3.'/'.$in4)}}" class="btn btn-sm btn-danger">Delete</a>
																													</div>
																												</form>
																												</div>
																											</div>
																											<ul>
																												
																											</ul>
																											</li>
																										@endforeach
																										@endforeach	
																									@endif		
																								</ul>
																								</li>
																							@endforeach
																							@endforeach	
																						@endif		
																					</ul>
																					</li>
																				@endforeach
																				@endforeach	
																			@endif	
																				
																		</ul>
																	</li>
																@endforeach
															@endforeach	
														@endif	
													</ul>
												</li>
											@endforeach
									@endif
								</ul>	
								@endif	
							</div>	
							@if($selectedMenu != '')
								<div class="form-group menulocation">
								<label><b>Menu Location</b></label>
								<p><label><input type="radio" name="location" value="1" @if($selectedMenu->location == 1) checked @endif> Header</label></p>
								<p><label><input type="radio" name="location" value="2" @if($selectedMenu->location == 2) checked @endif> Main Navigation</label></p>
								</div>									
								<div class="text-right">
								<button class="btn btn-sm btn-primary" id="saveMenu">Save Menu</button>
								</div>
								<p><a href="{{route('delete-menu',$selectedMenu->id)}}">Delete Menu</a></p>
							@endif										
						</div>

					@endif	
				</div>	

		</div>
	</div>

	<div id="serialize_output">@if($selectedMenu){{$selectedMenu->content}}@endif</div>	


	@if($selectedMenu)
			<script>
			$('#add-categories').click(function(){
			var menuid = <?=$selectedMenu->id?>;
			var n = $('input[name="select-category[]"]:checked').length;
			var array = $('input[name="select-category[]"]:checked');
			var ids = [];
			for(i=0;i<n;i++){
				ids[i] =  array.eq(i).val();
			}
			if(ids.length == 0){
				return false;
			}
			$.ajax({
				type:"get",
				data: {menuid:menuid,ids:ids},
				url: "{{route('add-categories-to-menu')}}",				
				success:function(res){	
					// console.log(res);			
				location.reload();
				}
			});
			});
			$('#add-posts').click(function(){
			var menuid = <?=$selectedMenu->id?>;
			var n = $('input[name="select-post[]"]:checked').length;
			var array = $('input[name="select-post[]"]:checked');
			var ids = [];
			for(i=0;i<n;i++){
				ids[i] =  array.eq(i).val();
			}
			if(ids.length == 0){
				return false;
			}
			$.ajax({
				type:"get",
				data: {menuid:menuid,ids:ids},
				url: "{{route('add-post-to-menu')}}",				
				success:function(res){
				location.reload();
				}
			})
			})
			$("#add-custom-link").click(function(){
			var menuid = <?=$selectedMenu->id?>;
			var url = $('#url').val();
			var link = $('#linktext').val();
			if(url.length > 0 && link.length > 0){
				$.ajax({
				type:"get",
				data: {menuid:menuid,url:url,link:link},
				url: "{{route('add-custom-link')}}",				
				success:function(res){
					location.reload();
				}
				})
			}
			})
			</script>
			<script>
			$('#saveMenu').click(function(){
			var menuid = <?=$selectedMenu->id?>;
			var location = $('input[name="location"]:checked').val();
			var newText = $("#serialize_output").text();
			var data = JSON.parse($("#serialize_output").text());	
			$.ajax({
				type:"get",
				data: {menuid:menuid,data:data,location:location},
				url: "{{route('update-menu')}}",				
				success:function(res){
				window.location.reload();
				}
			})	
			})
			</script>
			<script>
			var group = $("#menuitems").sortable({
			group: 'serialization',
			onDrop: function ($item, container, _super) {
				var data = group.sortable("serialize").get();	    
				var jsonString = JSON.stringify(data, null, ' ');
				$('#serialize_output').text(jsonString);
				_super($item, container);
			}
			});
			</script>	

	@endif		

<style>
  .item-list,.info-box{background: #fff;padding: 10px;}
  .item-list-body{max-height: 300px;overflow-y: scroll;}
  .panel-body p{margin-bottom: 5px;}
  .info-box{margin-bottom: 15px;}
  .item-list-footer{padding-top: 10px;}
  .panel-heading a{display: block;}
  .form-inline{display: inline;}
  .form-inline select{padding: 4px 10px;}
  .btn-menu-select{padding: 4px 10px}
  .disabled{pointer-events: none; opacity: 0.7;}
  .menu-item-bar{background: #eee;padding: 5px 10px;border:1px solid #d7d7d7;margin-bottom: 5px; width: 75%; cursor: move;display: block;}
  #serialize_output{display: block;}
  .menulocation label{font-weight: normal;display: block;}
  body.dragging, body.dragging * {cursor: move !important;}
  .dragged {position: absolute;z-index: 1;}
  ol.example li.placeholder {position: relative;}
  ol.example li.placeholder:before {position: absolute;}
  #menuitem{list-style: none;}
  #menuitem ul{list-style: none;}
  .input-box{width:75%;background:#fff;padding: 10px;box-sizing: border-box;margin-bottom: 5px;}
  .input-box .form-control{width: 50%}
</style>


</body>
</html>
