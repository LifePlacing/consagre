<div class="menu-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumb">

		<ol class="breadcrumb">

				<li class="breadcrumb-item active" aria-current="page" > 
					<i class="fa fa-home"></i> 
					<a href="{{route('index')}}" class="text-primary">Home</a> 
				</li> <?php $link = route('index'); ?> 

				@for($i = 1; $i < count(Request::segments()); $i++) 
				<li class="breadcrumb-item" > 
					@if($i < count(Request::segments()) & $i > 0) {{Request::segment($i)}} 
					@else {{Request::segment($i)}} 
					@endif 
				</li> 
				@endfor 
			
		</ol>

		</nav>
	</div>
</div>