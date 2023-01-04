//MOSTRAR E ESCONDER SENHA
document.getElementById("olho").addEventListener("mousedown", function () {
  document.getElementById("password").type = "text";
  document.getElementById("olho").className = "fa-solid fa-eye olho";
});
document.getElementById("olho").addEventListener("mouseup", function () {
  document.getElementById("password").type = "password";
  document.getElementById("olho").className = "fa-solid fa-eye-slash olho";
});

//MASCARA DE CPF

function mascaraCPF(i) {
  var v = i.value;
  if (isNaN(v[v.length - 1])) {
    // impede entrar outro caractere que não seja número
    i.value = v.substring(0, v.length - 1);
    return;
  }
  i.setAttribute("maxlength", "14");
  if (v.length === 3 || v.length === 7) i.value += ".";
  if (v.length === 11) i.value += "-";
  if (v.length === 14) verificarCPF(v.replace(/[^0-9]/g, ""));
}

function verificarCPF(c) {
  var i;
  s = c;
  var c = s.substr(0, 9);
  var dv = s.substr(9, 2);
  var d1 = 0;
  var v = false;
  if (new Set(c).size > 1) {
    for (i = 0; i < 9; i++) {
      d1 += c.charAt(i) * (10 - i);
    }
    if (d1 == 0) {
      document.getElementById("txtCpf").style.backgroundColor =
        "rgb(240, 107, 107)";
      v = true;
      return false;
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(0) != d1) {
      document.getElementById("txtCpf").style.backgroundColor =
        "rgb(240, 107, 107)";
      v = true;
      return false;
    }
    d1 *= 2;
    for (i = 0; i < 9; i++) {
      d1 += c.charAt(i) * (11 - i);
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(1) != d1) {
      document.getElementById("txtCpf").style.backgroundColor =
        "rgb(240, 107, 107)";
      v = true;
      return false;
    }
    if (!v) {
      document.getElementById("txtCpf").style.backgroundColor =
        "rgb(107, 240, 147)";
    }
  } else {
    document.getElementById("txtCpf").style.backgroundColor =
      "rgb(240, 107, 107)";
  }
}
