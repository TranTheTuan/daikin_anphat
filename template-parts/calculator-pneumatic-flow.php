<div id="pneumatic_flow" style="position:relative">
    <!-- <input type="text" style="position:absolute;left:100px;top:300px;width:50px;" /> -->
    <canvas id="pneumatic_flow_canvas"></canvas>

    <div style="position:absolute;left:40px;top:100px;">
        <label for="upstream-pressure">Upstream Pressure (P1)</label><br>
        <input type="number" id="upstream-pressure" style="width: 100px;" value="6"
            onchange="calculate_pneumatic_flow()" /><br>
        <label for="upstream-pressure">bar</label>
    </div>
    <div style="position:absolute;left:300px;top:100px;">
        <label for="downstream-pressure">Downstream Pressure (P2)</label><br>
        <input type="number" id="downstream-pressure" style="width: 100px;" value="5"
            onchange="calculate_pneumatic_flow()" /><br>
        <label for="downstream-pressure">bar</label>
    </div>
    <div style="position:absolute;left:40px;top:180px;">
        <label for="valve-conductance">Valve Conductance (C)</label><br>
        <input type="number" id="valve-conductance" style="width: 100px;" value="4"
            onchange="calculate_pneumatic_flow()" /><br>
        <label for="valve-conductance">dm/s/sbar</label>
    </div>
    <div style="position:absolute;left:300px;top:180px;">
        <label for="critical-pressure-ratio">Critical Pressure Ratio (b)</label><br>
        <input type="number" id="critical-pressure-ratio" style="width: 100px;" value="0.3"
            onchange="calculate_pneumatic_flow()" /><br>
        <label for="critical-pressure-ratio"></label><br>
    </div>


    <div style="position:absolute;left:355px;top:312px;font-size: 14px;">
        <label id="flow-free-air-q"></label>
    </div>


</div>
<script>
function calculate_pneumatic_flow() {
    P1 = document.getElementById("upstream-pressure").value
    P2 = document.getElementById("downstream-pressure").value
    C = document.getElementById("valve-conductance").value
    b = document.getElementById("critical-pressure-ratio").value

    FlowFreeAirQ = C * P1 * Math.sqrt(1 - Math.pow(((P2 / P1 - b) / (1 - b)), 2))

    document.getElementById("flow-free-air-q").innerHTML = Number((FlowFreeAirQ).toFixed(2))

}

var pneumaticFlowCanvas = document.getElementById("pneumatic_flow_canvas");
var pneumaticFlowCanvasCtx = pneumaticFlowCanvas.getContext("2d");

const pneumaticFlowImg = new Image();
pneumaticFlowImg.onload = drawPneumaticFlowImg;
pneumaticFlowImg.src = "<?php echo get_template_directory_uri() . '/assets/images/calculators/pneumatic_flow.png'; ?>"

function drawPneumaticFlowImg() {
    pneumaticFlowCanvas.width = this.naturalWidth;
    pneumaticFlowCanvas.height = this.naturalHeight;
    pneumaticFlowCanvasCtx.drawImage(this, 0, 0, this.width, this.height);
}

calculate_pneumatic_flow()
</script>