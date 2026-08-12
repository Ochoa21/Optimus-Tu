// password-check.js
// Uso: initPasswordChecklist('idDelInput', 'idDelRecuadro');
// El recuadro debe tener adentro elementos .pw-check-item con data-rule="len|num|esp"
// y dentro de cada uno un <span class="pw-status">.

function initPasswordChecklist(inputId, boxId) {

    var input = document.getElementById(inputId);
    var box = document.getElementById(boxId);

    if (!input || !box) return;

    function evaluar() {

        var val = input.value;

        var reglas = {
            len: val.length >= 8,
            num: /[0-9]/.test(val),
            esp: /\W/.test(val)
        };

        var items = box.querySelectorAll('.pw-check-item');

        items.forEach(function (item) {

            var regla = item.getAttribute('data-rule');
            var ok = !!reglas[regla];
            var status = item.querySelector('.pw-status');

            if (status) {
                status.textContent = ok ? '✓' : '✗';
            }

            item.classList.toggle('ok', ok);
            item.classList.toggle('bad', !ok);
        });
    }

    input.addEventListener('input', evaluar);
    evaluar();
}
