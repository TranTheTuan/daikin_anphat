<div id="accumulators" style="position:relative">
    <!-- <input type="text" style="position:absolute;left:100px;top:300px;width:50px;" /> -->
    <canvas id="accumulators_canvas"></canvas>
    <div style="position:absolute;left:20px;top:160px;">
        <label for="gas-pre-charge">Gas Pre-charge</label><br>
        <input type="number" id="gas-pre-charge" style="width: 100px;" value="90"
            onchange="calculate_accumulators()" /><br>
        <label for="gas-pre-charge">%</label>
    </div>
    <div style="position:absolute;left:150px;top:160px;">
        <label for="min-work-press">Min Work Press</label><br>
        <input type="number" id="min-work-press" style="width: 100px;" value="100"
            onchange="calculate_accumulators()" /><br>
        <label for="min-work-press">bar</label>
    </div>
    <div style="position:absolute;left:280px;top:160px;">
        <label for="max-work-press">Max Work Press</label><br>
        <input type="number" id="max-work-press" style="width: 100px;" value="150"
            onchange="calculate_accumulators()" /><br>
        <label for="max-work-press">bar</label>
    </div>
    <div style="position:absolute;left:410px;top:160px;">
        <label for="adiabatic-index">Adiabatic Index</label><br>
        <input type="number" id="adiabatic-index" style="width: 100px;" value="1.3"
            onchange="calculate_accumulators()" /><br>
        <label for="adiabatic-index"></label><br>
    </div>
    <div style="position:absolute;left:540px;top:160px;">
        <label for="nominal-volume">Nominal Volume</label><br>
        <input type="number" id="nominal-volume" style="width: 100px;" value="20"
            onchange="calculate_accumulators()" /><br>
        <label for="nominal-volume">Litre</label><br>
    </div>

    <div style="position:absolute;left:510px;top:280px;font-size: 14px;">
        <label id="precharge-gas-pressure"></label>
    </div>

    <div style="position:absolute;left:580px;top:324px;font-size: 14px;">
        <label id="usable-volume"></label>
    </div>

</div>
<script>
function calculate_accumulators() {
    GasPreCharge = document.getElementById("gas-pre-charge").value
    MinWorkPress = document.getElementById("min-work-press").value
    MaxWorkPress = document.getElementById("max-work-press").value
    AdiabaticIndex = document.getElementById("adiabatic-index").value
    NominalVolume = document.getElementById("nominal-volume").value

    PrechargeGasPressure = GasPreCharge / 100 * MinWorkPress

    UsableVolume = NominalVolume * ((PrechargeGasPressure / MinWorkPress) * 1 / AdiabaticIndex - (PrechargeGasPressure /
        MaxWorkPress) * 1 / AdiabaticIndex)

    document.getElementById("precharge-gas-pressure").innerHTML = Number((PrechargeGasPressure).toFixed(2))
    document.getElementById("usable-volume").innerHTML = Number((UsableVolume).toFixed(2))
}


var accumulatorsCanvas = document.getElementById("accumulators_canvas");
var accumulatorsCanvasCtx = accumulatorsCanvas.getContext("2d");

const accumulatorsImg = new Image();
accumulatorsImg.onload = drawAccumulatorImg;
accumulatorsImg.src = "<?php echo get_template_directory_uri() . '/assets/images/calculators/accumulators.png'; ?>"

function drawAccumulatorImg() {
    accumulatorsCanvas.width = this.naturalWidth;
    accumulatorsCanvas.height = this.naturalHeight;
    accumulatorsCanvasCtx.drawImage(this, 0, 0, this.width, this.height);
}

calculate_accumulators()
</script>