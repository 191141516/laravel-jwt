<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Angular-Laravel Authentication</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
</head>
<body ng-app="authApp">

<div class="container">
    <div ui-view></div>
</div>

</body>

<!-- Application Dependencies -->
<script src="/js/angular.min.js"></script>
<script src="/js/angular-ui-router.min.js"></script>
<script src="/js/satellizer.min.js"></script>

<!-- Application Scripts -->
<script src="/js/app.js"></script>
<script src="/js/authController.js"></script>
<script src="/js/userController.js"></script>
</html>