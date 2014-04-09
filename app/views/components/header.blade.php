@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description','default description')">
    <meta name="author" content="">
    
    <title>@yield('meta_title','default title')</title>
@show

@section('css')
    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.css') }}
    
    <!-- Custom styles for this template -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
    {{ HTML::style('css/main.css') }}
@show

@section('js')
	<!-- jQuery 2.0.3 -->
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	{{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/main.js') }}
@show

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-23022925-2', 'littlerabbitstudios.com');
  ga('send', 'pageview');

</script>
