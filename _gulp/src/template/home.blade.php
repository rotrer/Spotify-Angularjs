<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Base</title>
    <!-- App Angular -->
    {{ HTML::script('assets/scripts/angular.js') }}
    {{ HTML::script('assets/scripts/jquery.js') }}
    {{ HTML::script('assets/scripts/app.js') }}
    {{ HTML::script('assets/scripts/controllers.js') }}
    {{ HTML::script('assets/scripts/factory.js') }}
    {{ HTML::script('assets/scripts/directives.js') }}

    <script type="text/javascript">
        var APP_URI = '{{ URL::to('/'); }}';
    </script>
</head>
<body ng-app="fbApp">
</body>
</html>