<?php 
/*

All Emoncms code is released under the GNU Affero General Public License.
See COPYRIGHT.txt and LICENSE.txt.

---------------------------------------------------------------------
Emoncms - open source energy visualisation
Part of the OpenEnergyMonitor project:
http://openenergymonitor.org

*/

global $path;
$device = $_GET['node'];

?>

<!--[if IE]><script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Lib/flot/jquery.flot.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Lib/flot/jquery.flot.selection.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Lib/flot/jquery.flot.touch.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Lib/flot/jquery.flot.time.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Lib/flot/date.format.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Modules/vis/visualisations/common/vis.helper.js"></script>

<style>

#table {
    margin: 0 auto;
    width:960px;
    font-size:16px;
}

.node-scheduler {
    padding: 5px 5px 5px 5px;
    background-color: #ea510e;
    text-align:left;
}

.node-scheduler-title {
    padding: 10px;
    background-color: #ea510e;
    color:#fff;
    font-weight:bold;
}

.scheduler-inner {
    background-color:#fff;
    padding:10px;
    color:#ea510e;
    font-weight:bold;
}

.scheduler-inner2 {
    background-color:#f0f0f0;
    padding:20px;
}

.weekly-scheduler-day {
    display:inline-block;
    margin-right:5px;
    width:50px; 
    height:50px; 
    background-image:url("<?php echo $path; ?>Modules/demandshaper/day.png");
    background-size:50px;
    color:#fff;
    font-weight:bold;
    text-align:center;
    cursor:pointer;
}

.weekly-scheduler-day[val="1"] {
    background-image:url("<?php echo $path; ?>Modules/demandshaper/day-enabled.png");
}

.scheduler-checkbox {
    display:inline-block;
    width:50px;
    height:31px;
    background-image:url("<?php echo $path; ?>Modules/demandshaper/checkbox_inactive.png");
    background-size:50px;
    cursor:pointer;
    float:left;
}

.scheduler-checkbox-label {
  padding-top:7px;
  padding-left:10px;
  float:left;
}

.scheduler-checkbox[state="1"] {
    background-image:url("<?php echo $path; ?>Modules/demandshaper/checkbox_active.png");
}

.saved { color:#888 }

.scheduler-title {
    padding-top:5px;
    padding-bottom:10px;
}

.scheduler-startsin {
    padding:3px;
    padding-left:10px;
    padding-right:10px;
    background-color:#f29200;
    float:right;
    color:#fff;
    border-radius: 10px;
    font-size:14px;
}

.schedule-output-heading {
    background-color:#f29200;
    color:#fff;
    padding:10px;
    cursor:pointer;
}

.schedule-output-box {
    background-color:#fff;
    padding:10px;
    font-weight:normal;
}

.triangle-dropdown {
    margin-top:5px;
    float:right;
    width: 0;
    height: 0;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-top: 10px solid #fff;
}

.triangle-pushup {
    margin-top:5px;
    float:right;
    width: 0;
    height: 0;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-bottom: 10px solid #fff;
}

</style>

<div style="height:20px"></div>

<div id="table">
  <div class="node-scheduler-title"><?php echo $device; ?></div>
  <div class="node-scheduler" node="<?php echo $device; ?>">

    <div class="scheduler-inner">
      <div class="scheduler-startsin"><span class='startsin'></span></div>
      <div class="scheduler-title">Schedule</div>

      <div class="scheduler-inner2">
        <div class="scheduler-controls">
        
          <!---------------------------------------------------------------------------------------------------------------------------->
          <!-- CONTROLS -->
          <!---------------------------------------------------------------------------------------------------------------------------->
          <div name="active" state=0 class="input scheduler-checkbox"></div>
            <div class="scheduler-checkbox-label">Active</div>
            <div style='clear:both'></div>
          <br>
          
          <div style="display:inline-block; width:120px;">Run period:</div>
            <input class="input timepicker-hour" type="text" name="period-hour" style="width:45px" /> hrs
            <input class="input timepicker-minute" type="text" name="period-minute" style="width:45px" /> mins
          <br>

          <div style="display:inline-block; width:120px;">Complete by:</div>
            <input class="input timepicker-hour" type="text" name="end-hour" style="width:45px" /> : 
            <input class="input timepicker-minute" type="text" name="end-minute" style="width:45px" />
          <br>
          <br>
          <div name="interruptible" state=0 class="input scheduler-checkbox"></div>
            <div class="scheduler-checkbox-label">Ok to interrupt schedule</div>
            <div style='clear:both'></div>
          <br>
          
          <p>Repeat:</p>
          <div class="weekly-scheduler-days">
            <div name="repeat" day=0 val=0 class="input weekly-scheduler weekly-scheduler-day"><div style="padding-top:15px">Mon</div></div>
            <div name="repeat" day=1 val=0 class="input weekly-scheduler weekly-scheduler-day"><div style="padding-top:15px">Tue</div></div>
            <div name="repeat" day=2 val=0 class="input weekly-scheduler weekly-scheduler-day"><div style="padding-top:15px">Wed</div></div>
            <div name="repeat" day=3 val=0 class="input weekly-scheduler weekly-scheduler-day"><div style="padding-top:15px">Thu</div></div>
            <div name="repeat" day=4 val=0 class="input weekly-scheduler weekly-scheduler-day"><div style="padding-top:15px">Fri</div></div>
            <div name="repeat" day=5 val=0 class="input weekly-scheduler weekly-scheduler-day"><div style="padding-top:15px">Sat</div></div>
            <div name="repeat" day=6 val=0 class="input weekly-scheduler weekly-scheduler-day"><div style="padding-top:15px">Sun</div></div>
          </div>
          <br>
          <!---------------------------------------------------------------------------------------------------------------------------->
        </div>

        <button class="scheduler-save btn">Save</button><button class="scheduler-clear btn" style="margin-left:10px">Clear</button>
        <br><br>
        <div class="schedule-output-heading"><div class="triangle-dropdown hide"></div><div class="triangle-pushup"></div>Schedule Output</div>

        <div class="schedule-output-box">
          <div id="schedule-output"></div>
          <div id="placeholder_bound" style="width:100%; height:300px">
            <div id="placeholder" style="height:300px"></div>
          </div>

          Higher bar height equalls more power available
        </div> <!-- schedule-output-box -->
        <br>
        <span class="">Demand shaper signal: </span>
        <select name="signal" class="input scheduler-select" style="margin-top:10px">
            <option value="carbonintensity">UK Grid Carbon Intensity</option>
            <option value="cydynni">Energy Local: Bethesda</option>
            <option value="economy7">Economy 7</option>
        </select>
      </div> <!-- schedule-inner2 -->
    </div> <!-- schedule-inner -->
  </div> <!-- node-scheduler -->
</div> <!-- table -->

<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Modules/demandshaper/scheduler.js"></script>

<script>
var emoncmspath = "<?php echo $path; ?>";
var device = "<?php echo $device; ?>";
var devices = {};

$.ajax({ url: emoncmspath+"device/list.json", dataType: 'json', async: false, success: function(result) { 
    // Associative array of devices by nodeid
    devices = {};
    for (var z in result) devices[result[z].nodeid] = result[z];
}});

draw_scheduler(device);

</script>


