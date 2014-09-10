<!doctype html>
<html lang="en" ng-app="fbApp">
<head>
		<meta charset="UTF-8">
		<title>Base</title>
		<!-- App Angular -->
		{{ HTML::script('assets/scripts/jquery.js') }}
		{{ HTML::script('assets/scripts/angular.js') }}
		{{ HTML::script('assets/scripts/angular-route.js') }}
		{{ HTML::script('assets/scripts/app.js') }}
		{{ HTML::script('assets/scripts/controllers.js') }}
		{{ HTML::script('assets/scripts/factory.js') }}
		{{ HTML::script('assets/scripts/directives.js') }}
		{{ HTML::script('assets/scripts/templates.js') }}

		<script type="text/javascript">
				var APP_URI = '{{ URL::to('/'); }}';
		</script>
</head>
<body>
		<div class="view-container">
			<div ng-view class="view-frame"></div>
		</div>
		@include('includes.facebook')
</body>
</html>