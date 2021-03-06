<!doctype html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Hotel Room Reservation</title>

    <script src='./lib/dhtmlxScheduler/dhtmlxscheduler.js'></script>
    <script src='./lib/dhtmlxScheduler/ext/dhtmlxscheduler_limit.js'></script>
    <script src='./lib/dhtmlxScheduler/ext/dhtmlxscheduler_collision.js'></script>
    <script src='./lib/dhtmlxScheduler/ext/dhtmlxscheduler_timeline.js'></script>
    <script src='./lib/dhtmlxScheduler/ext/dhtmlxscheduler_editors.js'></script>
    <script src='./lib/dhtmlxScheduler/ext/dhtmlxscheduler_minical.js'></script>
    <script src='./lib/dhtmlxScheduler/ext/dhtmlxscheduler_tooltip.js'></script>
    <script src='./js/mock_backend.js'></script>
    <script src='./js/scripts.js'></script>

    <link rel='stylesheet' href='./lib/dhtmlxScheduler/dhtmlxscheduler_flat.css'>
    <link rel='stylesheet' href='./css/styles.css'>

</head>

<body onload="init()">

<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
    <div class="dhx_cal_navline">

        <div style="font-size:16px;padding:4px 20px;">
            Show rooms:
            <select id="room_filter" onchange='updateSections(this.value)'></select>
        </div>
        <div class="dhx_cal_prev_button">&nbsp;</div>
        <div class="dhx_cal_next_button">&nbsp;</div>
        <div class="dhx_cal_today_button"></div>
        <div class="dhx_cal_date"></div>
    </div>
    <div class="dhx_cal_header">
    </div>
    <div class="dhx_cal_data">
    </div>
</div>
</body>