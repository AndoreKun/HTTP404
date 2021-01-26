function admSelectCheck(nameSelect, adicionarvalores)
{
    /**
    * Função para mostrar e esconder elementos ao selecionar opções de uma caixa de seleção, para ser utilizada primeiramente deve chamar a função 
    * na sua caixa de seleção(no campo 'onchange='). O id da seleção deverá ser "opcao" e o elemento que pretende mostrar "elemento".
    * Ao definir adicionarvalores como TRUE, adicione "opcao2" para uma segunda seleção e "elemento2" para o segundo elemento, e por fim
    * "opcao3" e "elemento3" para a ultima seleção e elemento.
    * @author Grupo HTTP 404
    * @version 2.0
    * @since 1 jan 2021
    * @param {string} nameSelect Seleção(<select>) a ser lido (Para esse valor pode utilizar $this na seleção em seu html)
    * @param {boolean} adicionarvalores Define se pretende ler mais formulários/seleções, se verdadeiro permite ler mais 2 seleções
    * @param {string} admOptionValue id do formulário/seleção 
    */
    // Caso nameSelect estiver definido, verifica se é igual ao id da seleção. 
    if(nameSelect){
        admOptionValue = document.getElementById("opcao").value;
        if(admOptionValue == nameSelect.value){
            // Se for igual, mostra o elemento que pretende mostrar
            document.getElementById("elemento").style.display = "block";
        }
        else{
            // Senão, esconde o elemento
            document.getElementById("elemento").style.display = "none";
        }
    }
    else {
        // Caso nameSelect não estiver definido, esconde também o elemento
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
    /**
    * Função para mostrar e esconder elementos ao selecionar opções de uma caixa de seleção, para ser utilizada primeiramente deve chamar a função 
    * na sua caixa de seleção(no campo 'onchange='). O id da seleção deverá ser "opcao4" e o elemento que pretende mostrar "elemento4".
    * Ao definir adicionarvalores como TRUE, adicione "opcao5" para uma segunda seleção e "elemento5" para o segundo elemento, e por fim
    * "opcao6" e "elemento6" para a ultima seleção e elemento.
    * @author Grupo HTTP 404
    * @version 1.0
    * @since 4 jan 2021
    * @param {string} nameSelect Seleção(<select>) a ser lido (Para esse valor pode utilizar $this na seleção em seu html)
    * @param {boolean} adicionarvalores Define se pretende ler mais formulários/seleções, se verdadeiro permite ler mais 2 seleções
    * @param {string} admOptionValue id do formulário/seleção 
    */
    // Caso nameSelect estiver definido, verifica se é igual ao id da seleção. 
    if(nameSelect){
        admOptionValue = document.getElementById("opcao4").value;
        if(admOptionValue == nameSelect.value){
            // Se for igual, mostra o elemento que pretende mostrar
            document.getElementById("elemento4").style.display = "block";
        }
        else{
            // Senão, esconde o elemento
            document.getElementById("elemento4").style.display = "none";
        }
    } 
    // Caso nameSelect não estiver definido, esconde também o elemento
    else {
        document.getElementById("elemento4").style.display = "none";
    }
    // Repete o mesmo processof feito acima para adicionar valores, mas duplicadamente    
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
    /**
    * Função para mostrar e esconder elementos ao selecionar opções de uma caixa de seleção, para ser utilizada primeiramente deve chamar a função 
    * na sua caixa de seleção(no campo 'onchange='). O id da seleção deverá ser "opcao7" e o elemento que pretende mostrar "elemento7".
    * Ao definir adicionarvalores como TRUE, adicione "opcao8" para uma segunda seleção e "elemento8" para o segundo elemento, e por fim
    * "opcao9" e "elemento9" para a ultima seleção e elemento.
    * @author Grupo HTTP 404
    * @version 1.0
    * @since 4 jan 2021
    * @param {string} nameSelect Seleção(<select>) a ser lido (Para esse valor pode utilizar $this na seleção em seu html)
    * @param {boolean} adicionarvalores Define se pretende ler mais formulários/seleções, se verdadeiro permite ler mais 2 seleções
    * @param {string} admOptionValue id do formulário/seleção 
    */
    // Caso nameSelect estiver definido, verifica se é igual ao id da seleção. 
    if(nameSelect){
        admOptionValue = document.getElementById("opcao7").value;
        if(admOptionValue == nameSelect.value){
            // Se for igual, mostra o elemento que pretende mostrar
            document.getElementById("elemento7").style.display = "block";
        }
        else{
            // Senão, esconde o elemento
            document.getElementById("elemento7").style.display = "none";
        }
    }
    // Caso nameSelect não estiver definido, esconde também o elemento 
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