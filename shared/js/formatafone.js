const fone = document.getElementById("fone");

fone.addEventListener("keyup", formatarTelefone);

function formatarTelefone(e) {

    var v = e.target.value.replace(/\D/g, "");

    v = v.replace(/^(\d\d)(\d)/g, "($1)$2");

    v = v.replace(/(\d{5})(\d)/, "$1-$2");

    e.target.value = v;
}