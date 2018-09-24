@if(!empty($breadCrumData))
	<ol class="breadcrumb">
		@foreach($breadCrumData as $breadcrum)
			<li>
				<i class="fa {{$breadcrum['breadFaClass']}}"></i>
					
				@if(!empty($breadcrum['url']))
					<a href="{{$breadcrum['url']}}">{{$breadcrum['text']}}</a>
				@else
					{{$breadcrum['text']}}
				@endif
				
			</li>
		@endforeach		
	</ol>
@endif 