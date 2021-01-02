function admSelectCheck(nameSelect, adicionarvalores)
{
    console.log(nameSelect);
    if(nameSelect){
        admOptionValue = document.getElementById("opcao").value;
        if(admOptionValue == nameSelect.value){
            document.getElementById("elemento").style.display = "block";
        }
        else{
            document.getElementById("elemento").style.display = "none";
        }
    } 
    else {
        document.getElementById("elemento").style.display = "none";
    }    
    if (adicionarvalores == true){
        admOptionValue2 = document.getElementById("opcao2").value;
        admOptionValue3 = document.getElementById("opcao3").value;
        if(admOptionValue2 == nameSelect.value){
            document.getElementById("elemento2").style.display = "block";
        }
        else{
            document.getElementById("elemento2").style.display = "none";
        }
        if(admOptionValue3 == nameSelect.value){
            document.getElementById("elemento3").style.display = "block";
        }
        else{
            document.getElementById("elemento3").style.display = "none";
        }
    }
    else{
    document.getElementById("elemento2").style.display = "none";
    document.getElementById("elemento3").style.display = "none";
    }
}