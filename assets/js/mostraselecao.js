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
function admSelectCheck2(nameSelect, adicionarvalores)
{
    console.log(nameSelect);
    if(nameSelect){
        admOptionValue = document.getElementById("opcao4").value;
        if(admOptionValue == nameSelect.value){
            document.getElementById("elemento4").style.display = "block";
        }
        else{
            document.getElementById("elemento4").style.display = "none";
        }
    } 
    else {
        document.getElementById("elemento4").style.display = "none";
    }    
    if (adicionarvalores == true){
        admOptionValue2 = document.getElementById("opcao5").value;
        admOptionValue3 = document.getElementById("opcao6").value;
        if(admOptionValue2 == nameSelect.value){
            document.getElementById("elemento5").style.display = "block";
        }
        else{
            document.getElementById("elemento5").style.display = "none";
        }
        if(admOptionValue3 == nameSelect.value){
            document.getElementById("elemento6").style.display = "block";
        }
        else{
            document.getElementById("elemento6").style.display = "none";
        }
    }
    else{
    document.getElementById("elemento5").style.display = "none";
    document.getElementById("elemento6").style.display = "none";
    }
}
function admSelectCheck3(nameSelect, adicionarvalores)
{
    console.log(nameSelect);
    if(nameSelect){
        admOptionValue = document.getElementById("opcao7").value;
        if(admOptionValue == nameSelect.value){
            document.getElementById("elemento7").style.display = "block";
        }
        else{
            document.getElementById("elemento7").style.display = "none";
        }
    } 
    else {
        document.getElementById("elemento7").style.display = "none";
    }    
    if (adicionarvalores == true){
        admOptionValue2 = document.getElementById("opcao8").value;
        admOptionValue3 = document.getElementById("opcao9").value;
        if(admOptionValue2 == nameSelect.value){
            document.getElementById("elemento8").style.display = "block";
        }
        else{
            document.getElementById("elemento8").style.display = "none";
        }
        if(admOptionValue3 == nameSelect.value){
            document.getElementById("elemento9").style.display = "block";
        }
        else{
            document.getElementById("elemento9").style.display = "none";
        }
    }
    else{
    document.getElementById("elemento8").style.display = "none";
    document.getElementById("elemento9").style.display = "none";
    }
}