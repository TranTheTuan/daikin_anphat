<div id="hydraulic_pipes" style="position:relative">
    <canvas id="hydraulic_pipes_canvas"></canvas>

    <!-- Input -->
    <div style="position:absolute;left:70px;top:370px;">
        <label for="suction-line-id">Suction Line ID</label><br>
        <input type="number" id="suction-line-id" style="width: 100px;" value="70"
            onchange="calculate_hydraulic_pipes()" /><br>
        <label for="suction-line-id">mm</label>
    </div>
    <div style="position:absolute;left:200px;top:370px;">
        <label for="press-line-id">Pressure Line ID</label><br>
        <input type="number" id="press-line-id" style="width: 100px;" value="30"
            onchange="calculate_hydraulic_pipes()" /><br>
        <label for="press-line-id">mm</label>
    </div>
    <div style="position:absolute;left:330px;top:370px;">
        <label for="return-line-id">Return Line ID</label><br>
        <input type="number" id="return-line-id" style="width: 100px;" value="40"
            onchange="calculate_hydraulic_pipes()" /><br>
        <label for="return-line-id">mm</label>
    </div>
    <div style="position:absolute;left:460px;top:370px;">
        <label for="flow-rate">Flow Rate</label><br>
        <input type="number" id="flow-rate" style="width: 100px;" value="145"
            onchange="calculate_hydraulic_pipes()" /><br>
        <label for="flow-rate">L/min</label><br>
    </div>

    <!-- Formulas -->
    <div style="position:absolute;left:510px;top:505px;font-size: 14px;">
        <label id="suction-vel"></label>
    </div>
    <div style="position:absolute;left:510px;top:595px;font-size: 14px;">
        <label id="supply-vel"></label>
    </div>
    <div style="position:absolute;left:510px;top:675px;font-size: 14px;">
        <label id="return-vel"></label>
    </div>

</div>
<script>
function calculate_hydraulic_pipes() {
    SuctionLineId = document.getElementById("suction-line-id").value
    PressLineId = document.getElementById("press-line-id").value
    ReturnLineId = document.getElementById("return-line-id").value
    FlowRate = document.getElementById("flow-rate").value

    SuctionVel = (FlowRate / 60000) * 4 / (Math.PI * Math.pow(SuctionLineId / 1000, 2))
    SupplyVel = (FlowRate / 60000) * 4 / (Math.PI * Math.pow(PressLineId / 1000, 2))
    ReturnVel = (FlowRate / 60000) * 4 / (Math.PI * Math.pow(ReturnLineId / 1000, 2))

    document.getElementById("suction-vel").innerHTML = Number((SuctionVel).toFixed(2))
    document.getElementById("supply-vel").innerHTML = Number((SupplyVel).toFixed(2))
    document.getElementById("return-vel").innerHTML = Number((ReturnVel).toFixed(2))
}


var hydraulicPipesCanvas = document.getElementById("hydraulic_pipes_canvas");
var hydraulicPipesCanvasCtx = hydraulicPipesCanvas.getContext("2d");

const hydraulicPipesImg = new Image();
hydraulicPipesImg.onload = drawHydraulicPipesImg;
hydraulicPipesImg.src = "<?php echo get_template_directory_uri() . '/assets/images/calculators/hydraulic_pipes.png'; ?>";

function drawHydraulicPipesImg() {
    hydraulicPipesCanvas.width = this.naturalWidth;
    hydraulicPipesCanvas.height = this.naturalHeight;
    hydraulicPipesCanvasCtx.drawImage(this, 0, 0, this.width, this.height);
}

calculate_hydraulic_pipes()
</script>