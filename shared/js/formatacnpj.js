const cnpj = document.getElementById("CNPJ");
cnpj.addEventListener("keyup", formatarCNPJ);
function formatarCNPJ(e) {

    var v = e.target.value.replace(/\D/g, "");

    v = v.replace(/^(\d{2})(\d)/, "$1.$2");

    v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");

    v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");

    v = v.replace(/(\d{4})(\d)/, "$1-$2");

    e.target.value = v;



}

