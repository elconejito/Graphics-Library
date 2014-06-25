<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<span class="navbar-brand">Graphics Library</span>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
                <li class="active"><a href="{{ URL::to('gl') }}">Dashboard</a></li>
                <li><a href="{{ URL::to('projects') }}">Projects</a></li>
                <li><a href="{{ URL::to('agencies') }}">Agencies</a></li>
                <li><a href="{{ URL::to('tags') }}">Tags</a></li>
			</ul>
            {{ Form::open( [ 'url' => 'search', 'method' => 'GET', 'class' => 'navbar-form navbar-left' ] ) }}
                <div class="form-group">
                    {{ Form::text('q', Input::old('q'), array('class' => 'form-control', 'placeholder'=>'Enter Keyword')) }}
                </div>
                {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
			<ul class="nav navbar-nav navbar-right">
                @if( Auth::check() )
                <li>{{ link_to('admin', 'Admin') }}</li>
                <li>{{ link_to_action('UsersController@getLogout', 'Logout') }}</li>
                @else
                <li>{{ link_to_action('UsersController@getLogin', 'Login') }}</li>
                <li>{{ link_to_action('UsersController@getRegister', 'Register') }}</li>
                @endif
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</div>