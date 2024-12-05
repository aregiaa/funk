function atualizarDados(id){
    let classValor = document.getElementsByClassName(id);
    let nome = classValor[0].value;
    let quantidade = classValor[1].value;
    let valor = classValor[2].value;

    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "update.php");
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id + "&nome=" + nome + "&quantidade=" + quantidade + "&valor=" + valor);
}