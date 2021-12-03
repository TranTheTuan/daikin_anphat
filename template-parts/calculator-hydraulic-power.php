<div id="hydraulic_power" style="position:relative">
    <!-- <input type="text" style="position:absolute;left:100px;top:300px;width:50px;" /> -->
    <canvas id="hydraulic_power_canvas"></canvas>
    <div style="position:absolute;left:40px;top:410px;">
        <label for="motor-speed">Motor Speed</label><br>
        <input type="number" id="motor-speed" style="width: 100px;" value="1450"
            onchange="calculate_hydraulic_power()" /><br>
        <label for="motor-speed">rev/min</label>
    </div>
    <div style="position:absolute;left:170px;top:410px;">
        <label for="motor-efficiency">Motor Efficiency</label><br>
        <input type="number" id="motor-efficiency" style="width: 100px;" value="85"
            onchange="calculate_hydraulic_power()" /><br>
        <label for="motor-efficiency">%</label>
    </div>
    <div style="position:absolute;left:300px;top:410px;">
        <label for="pump-displ">Pump Displ.</label><br>
        <input type="number" id="pump-displ" style="width: 100px;" value="100"
            onchange="calculate_hydraulic_power()" /><br>
        <label for="pump-displ">cc/rev</label>
    </div>
    <div style="position:absolute;left:430px;top:410px;">
        <label for="flow-rate">Flow Rate</label><br>
        <input type="number" id="flow-rate" style="width: 100px;" value="145"
            onchange="calculate_hydraulic_power()" /><br>
        <label for="flow-rate">L/min</label><br>
    </div>
    <div style="position:absolute;left:560px;top:410px;">
        <label for="load-pressure">Load Pressure</label><br>
        <input type="number" id="load-pressure" style="width: 100px;" value="210"
            onchange="calculate_hydraulic_power()" /><br>
        <label for="load-pressure">bar</label><br>
    </div>

    <div style="position:absolute;left:530px;top:532px;font-size: 14px;">
        <label id="power-in-1">Hello</label>
    </div>

    <div style="position:absolute;left:530px;top:586px;font-size: 14px;">
        <label id="flow">Flow</label>
    </div>

    <div style="position:absolute;left:530px;top:632px;font-size: 14px;">
        <label id="shaft-torque">Shaft</label>
    </div>

    <div style="position:absolute;left:530px;top:686px;font-size: 14px;">
        <label id="power-in-2">Hello2</label>
    </div>

</div>
<script>
function calculate_hydraulic_power() {
    MotorSpeed = document.getElementById("motor-speed").value
    MotorEfficiency = document.getElementById("motor-efficiency").value
    PumpDispl = document.getElementById("pump-displ").value
    FlowRate = document.getElementById("flow-rate").value
    LoadPressure = document.getElementById("load-pressure").value

    PowerIn1 = ((MotorSpeed * PumpDispl * LoadPressure) / (600 * (MotorEfficiency / 100.0))) / 1000 // W -> kW
    Flow = MotorSpeed * PumpDispl / 1000
    ShaftTorque = PumpDispl * LoadPressure / (20 * Math.PI)
    PowerIn2 = ((MotorSpeed * PumpDispl * LoadPressure) / (600)) / 1000 // W -> kW

    document.getElementById("power-in-1").innerHTML = Number((PowerIn1).toFixed(2))
    document.getElementById("flow").innerHTML = Number((Flow).toFixed(2))
    document.getElementById("shaft-torque").innerHTML = Number((ShaftTorque).toFixed(2))
    document.getElementById("power-in-2").innerHTML = Number((PowerIn2).toFixed(2))
}

var hydraulicPowerCanvas = document.getElementById("hydraulic_power_canvas");
var hydraulicPowerCanvasCtx = hydraulicPowerCanvas.getContext("2d");

const hydraulicPowerImg = new Image();
hydraulicPowerImg.onload = drawHydraulicPowerImg;
hydraulicPowerImg.src = "<?php echo get_template_directory_uri() . '/assets/images/calculators/hydraulic_power.png'; ?>"

function drawHydraulicPowerImg() {
    hydraulicPowerCanvas.width = this.naturalWidth;
    hydraulicPowerCanvas.height = this.naturalHeight;
    hydraulicPowerCanvasCtx.drawImage(this, 0, 0, this.width, this.height);
}

calculate_hydraulic_power()
</script>