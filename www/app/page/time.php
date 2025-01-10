<?php

site()->layoutInit();
site()->addPageTitle("Time Stamp");
site()->addJS("/app/js/timestamp.js", "file");

?>

<div class="page bar-top bar-btm bar-ssc-b">
    <div class="container">
        <h1>Time Stamp</h1>
        <p>A handy set of utilities for creating Discord time tags.</p>
        <p>Also handy: <a href="http://hammertime.cyou" target="_blank">Hammer Time</a></p>
        <hr class="hr-ssc hr-ssc-b">
        <ul class="nav nav-underline mb-4">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-bs-toggle="tab" data-bs-target="#station-timer">
                    Station Timer
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#bulk-converter">
                    Bulk Time Converter
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#simple-converter">
                    Simple Converter
                </a>
            </li>
        </ul>
        <div class="tab-content mb-5">
            <div class="tab-pane fade show active" id="station-timer">
                <h2>Station Timer</h2>
                <p>Copy the timer text from the Eve client as shown.</p>
                <div class="row">
                    <div class="form col-md-6">
                        <textarea class="form-control" id="stationTimer" rows="3"
                            placeholder="...and paste it here."></textarea><br>
                        <button class="btn btn-primary btn-ssc-b" data-timestamp="convertStationTimer">
                            Convert Station Timer
                        </button>
                        <button class="btn btn-outline btn-ssc-b" data-timestamp="stationTimerSampleData">
                            Sample Data
                        </button>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid" src="/app/rsrc/img/copy-timer.png">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="bulk-converter">
                <h2>Bulk Time Converter</h2>
                <p>Convert bulk times (Name YYYY.MM.DD HH:mm), one per line:</p>
                <div class="row">
                    <div class="form col-md-6">
                        <textarea class="form-control" id="bulk" rows="3"></textarea><br>
                        <button class="btn btn-primary btn-ssc-b" data-timestamp="convertBulk">
                            Convert in Bulk
                        </button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="simple-converter">
                <h2>Simple Converter</h2>
                <p>Enter a date time below.</p>
                <p>Input time without an offset uses your current time zone.</p>
                <div class="d-flex flex-row align-items-center flex-wrap">
                    <input class="form-control w-auto" id="simple">
                    &nbsp;
                    <button class="btn btn-primary btn-ssc-b" data-timestamp="convertSimple">
                        Convert
                    </button>
                </div>
                <div class="mt-3 d-flex flex-row align-items-center flex-wrap">
                    <input class="form-control w-auto" id="output">
                    &nbsp;
                    <div class="btn-group">
                        <button class="btn btn-primary btn-ssc-b dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="d-none d-sm-inline">Copy for</span>
                            Discord
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" data-timestamp="discord"><code>:t</code> | Short time: 9:18
                                AM</a>
                            <a class="dropdown-item" data-timestamp="discord"><code>:T</code> | Long time: 9:18:34
                                AM</a>
                            <a class="dropdown-item" data-timestamp="discord"><code>:d</code> | Short date:
                                12/11/2022</a>
                            <a class="dropdown-item" data-timestamp="discord"><code>:D</code> | Long date: December
                                11,
                                2022</a>
                            <a class="dropdown-item" data-timestamp="discord"><code>:f</code> | Short date & time:
                                December
                                11, 2022 9:18 AM</a>
                            <a class="dropdown-item" data-timestamp="discord"><code>:F</code> | Long date & time:
                                Sunday,
                                December 11, 2022 9:18 AM</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" data-timestamp="discord"><code>:R</code> | Relative time: 5
                                minutes
                                ago</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="hr-ssc hr-ssc-b">
        <p>Improvements:
        <ul class="marker-ssc marker-ssc-b">
            <li>Provide additional hints or instructions</li>
            <li>Add more example data</li>
            <li>Add copied to clipboard indicator</li>
        </ul>
        </p>
    </div>
</div>

<?=site()->layout()?>
