<div id="temp_control" style="position:relative">
    <canvas id="temp_control_canvas"></canvas>

    <!-- Input -->
    <div style="position:absolute;left:70px;top:480px;">
        <label for="air-temp">Air Temp.</label><br>
        <input type="number" id="air-temp" style="width: 100px;" value="18" onchange="calculate_temp_control()" /><br>
        <label for="air-temp">Celcius</label>
    </div>


    <div style="position:absolute;left:200px;top:480px;">
        <label for="flow-rate">Flow Rate</label><br>
        <input type="number" id="flow-rate" style="width: 100px;" value="145" onchange="calculate_temp_control()" /><br>
        <label for="flow-rate">L/min</label><br>
    </div>

    <div style="position:absolute;left:330px;top:480px;">
        <label for="tank-volume">Tank Volume</label><br>
        <input type="number" id="tank-volume" style="width: 100px;" value="1000"
            onchange="calculate_temp_control()" /><br>
        <label for="tank-volume">L</label>
    </div>

    <div style="position:absolute;left:460px;top:480px;">
        <label for="tank-temp">Tank Temp.</label><br>
        <input type="number" id="tank-temp" style="width: 100px;" value="45" onchange="calculate_temp_control()" /><br>
        <label for="tank-temp">Celcius</label>
    </div>

    <div style="position:absolute;left:70px;top:570px;">
        <label for="water-tin-tout">Water Tout - Tin</label><br>
        <input type="number" id="water-tin-tout" style="width: 100px;" value="5"
            onchange="calculate_temp_control()" /><br>
        <label for="water-tin-tout">Celcius</label>
    </div>

    <div style="position:absolute;left:200px;top:570px;">
        <label for="water-flow">Water Flow</label><br>
        <input type="number" id="water-flow" style="width: 100px;" value="25" onchange="calculate_temp_control()" /><br>
        <label for="water-flow">L/min</label>
    </div>

    <div style="position:absolute;left:330px;top:570px;">
        <label for="heater-power">Heater Power</label><br>
        <input type="number" id="heater-power" style="width: 100px;" value="1"
            onchange="calculate_temp_control()" /><br>
        <label for="heater-power">kW</label>
    </div>

    <div style="position:absolute;left:460px;top:570px;">
        <label for="percent-power-in-to-heat">% Power In to Heat</label><br>
        <input type="number" id="percent-power-in-to-heat" style="width: 100px;" value="30"
            onchange="calculate_temp_control()" /><br>
        <label for="percent-power-in-to-heat">%</label>
    </div>

    <div style="position:absolute;left:610px;top:570px;">
        <label for="pump-power">Hydraulic Pump Power</label><br>
        <input type="number" id="pump-power" style="width: 100px;" value="51" onchange="calculate_temp_control()" /><br>
        <label for="pump-power">kW</label>
    </div>


    <!-- Formulas -->
    <div style="position:absolute;left:560px;top:720px;font-size: 14px;">
        <label id="tank-heat-loss"></label>
    </div>
    <div style="position:absolute;left:560px;top:770px;font-size: 14px;">
        <label id="cool-water-heat-out"></label>
    </div>
    <div style="position:absolute;left:560px;top:820px;font-size: 14px;">
        <label id="heat-balance"></label>
    </div>
    <div style="position:absolute;left:560px;top:870px;font-size: 14px;">
        <label id="tank-temp-rise-rate"></label>
    </div>

</div>
<script>
function calculate_temp_control() {
    AirTemp = document.getElementById("air-temp").value
    FlowRate = document.getElementById("flow-rate").value
    TankVolume = document.getElementById("tank-volume").value
    TankTemp = document.getElementById("tank-temp").value

    WaterTinTout = document.getElementById("water-tin-tout").value
    WaterFlow = document.getElementById("water-flow").value
    HeaterPower = document.getElementById("heater-power").value
    PercentPowerInToHeat = document.getElementById("percent-power-in-to-heat").value
    PumpPower = document.getElementById("pump-power").value

    TankAreaApprox = 8 // m2
    K = 12 // W / m2 oC

    TankHeatLoss = 0.011 * TankAreaApprox * (TankTemp - AirTemp)
    CoolWaterHeatOut = 2778 * 4200 * 0.997 * WaterFlow * 60 * (WaterTinTout) / 10000000000
    HeatBalance = HeaterPower - TankHeatLoss + (PercentPowerInToHeat * PumpPower / 100) - CoolWaterHeatOut
    TankTempRiseRate = HeatBalance * 35 / TankVolume


    document.getElementById("tank-heat-loss").innerHTML = Number((TankHeatLoss).toFixed(2))
    document.getElementById("cool-water-heat-out").innerHTML = Number((CoolWaterHeatOut).toFixed(2))
    document.getElementById("heat-balance").innerHTML = Number((HeatBalance).toFixed(2))
    document.getElementById("tank-temp-rise-rate").innerHTML = Number((TankTempRiseRate).toFixed(2))
}



var tempControlCanvas = document.getElementById("temp_control_canvas");
var tempControlCanvasCtx = tempControlCanvas.getContext("2d");

const tempControlImg = new Image();
tempControlImg.onload = drawTempControlImg;
tempControlImg.src = "<?php echo get_template_directory_uri() . '/assets/images/calculators/temp_control.png'; ?>";

function drawTempControlImg() {
    tempControlCanvas.width = this.naturalWidth;
    tempControlCanvas.height = this.naturalHeight;
    tempControlCanvasCtx.drawImage(this, 0, 0, this.width, this.height);
}

calculate_temp_control()
</script>