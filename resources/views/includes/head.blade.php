
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>OELABUMA</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="<?= asset('../css/app.css') ?>" rel="stylesheet">

<!-- Custom Fonts -->
<link href="<?= asset('../font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<style type="text/css">
    .ui-select-dropdown { opacity: 1 !important; }

    .modal-xl {
        width: 1200px;
    }

    .col-centered{
        float: none;
        margin: 0 auto;
    }

    .popover{
        max-width: 400px;
    }

    .center-block {
        float: none !important
    }

    #loading-bar {
        pointer-events: all;
        z-index: 99999;
        border: none;
        width: 100%;
        height: 100%;
        cursor: wait;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        position: fixed;
        background-color: rgba(0, 0, 0, 0.28);
        /*background-color: rgba(38, 38, 38, 1);*/
    }

    #loading-bar img{
        position: absolute;
        margin: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak],
    .ng-cloak, .x-ng-cloak,
    .ng-hide {
        display: none !important;
    }

    .help-inline .ng-binding{
        color: red;
    }

    .help-inline {
        color: red;
    }
</style>

<script src="<?= asset('blockly/blockly_compressed.js') ?>"></script>
<script src="<?= asset('blockly/javascript_compressed.js') ?>"></script>
<script src="<?= asset('blockly/blocks_compressed.js') ?>"></script>
<script src="<?= asset('blockly/msg/js/en.js') ?>"></script>
<script src="<?= asset('blockly/disme.js') ?>"></script>

@yield('header')


