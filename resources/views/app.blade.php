<html>
<head>
    <meta charset="UTF-8">
    <!-- Add this to <head> -->
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap@next/dist/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
</head>
<body>
<div id="app">
    <div class="container">
        <b-jumbotron header="Bootstrap Vue" lead="Bootstrap 4 Components for Vue.js 2" >
            <p>@{{ message }}</p>
        </b-jumbotron>
    </div>
</div>
<script type="application/javascript" src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>
<script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
<script type="application/javascript">
    var app = new Vue({
        el: '#app'
    })
</script>
</body>
</html>