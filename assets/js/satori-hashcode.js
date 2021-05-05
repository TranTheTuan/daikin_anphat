function getCookie(){
    var arr = new Array();
    if(document.cookie != ''){
        var tmp = document.cookie.split('; ');
        for(var i=0;i<tmp.length;i++){
            var data = tmp[i].split('=');
            arr[data[0]] = decodeURIComponent(data[1]);
        }
    }
    return arr;
}
var arr = getCookie();
if (arr['satori_hashcode'] != undefined && arr['satori_hashcode'] != '') {
    var StDmp = {};
    StDmp.additionalParams = { c: arr['satori_hashcode'] + "-00" };
    console.log('code::' + arr['satori_hashcode']);
}