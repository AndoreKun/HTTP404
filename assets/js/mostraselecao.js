function admSelectCheck(nameSelect)
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
    else{
        document.getElementById("elemento").style.display = "none";
    }
}