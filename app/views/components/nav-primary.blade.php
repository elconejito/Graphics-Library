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
			<span class="navbar-brand">DevBox</span>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="{{ URL::to('gl') }}">Graphics Library</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
                @if( Auth::check() )
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