window.onload = function(){
    var json = JSON.parse(localStorage.getItem("producto"));
    alert(json);
    alert(json[0]['cod_producto']);
    alert(json[1]['cod_producto']);
}