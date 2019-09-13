const yMax = 3;
const yMin = -3;
function checkValue(Y) {
    return (isNaN(Number(Y.value.replace(',','.'))) || Y.value.replace(',','.')< yMin || Y.value.replace(',','.')>yMax || Y.value==="");
}
function onY() {
    var Y=document.getElementById("Yea");
    if (checkValue(Y)) Y.style.backgroundColor="red";
    else Y.style.backgroundColor="white";
}
var flag=0;
function onSubmit(){
    var error=document.createElement("error");
    var errorParent=document.getElementById("error")
    var Y=document.getElementById("Yea");
    if (checkValue(Y)){
        event.preventDefault();
        if (flag<1){
        flag++;
        error.innerHTML="You have entered extraneous characters or nothing, look at the picture on the left, aren't you ashamed ?!";
        error.style.cssText="color: Red;";
        errorParent.appendChild(error);
        }
    }
    return !checkValue(Y);
}
