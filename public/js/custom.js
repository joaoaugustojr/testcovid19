$(document).on('click', 'body', function () {
    $('.cpf').mask('000.000.000-00', {
        reverse: false
    });
    $('.phone-cel').mask('(00) 00000-0000');
});

$(document).ready(function () {

    $.noConflict()


    var target = document.querySelector('[data-js="div"]');
    var observer = new MutationObserver(handleMutationObserver);
    var config = {
        childList: true,
    };

    function handleMutationObserver() {
        let table = document.getElementById("datatables-style");

        if (table != null) {
            $('#datatables-style').DataTable({
                responsive: true,
                "paging": true,
                "ordering": true,
                "info": false,
                'searching': true,
                'lengthChange': false,
                "pagingType": "simple_numbers",
                "rowReorder": true,
                "language": {
                    "emptyTable": "Nenhum Registro Encontrado.",
                    "paginate": {
                        "first": "Primeiro",
                        "last": "Último",
                        "next": "<i class='icon-paginate fas fa-caret-right'></i>",
                        "previous": "<i class='icon-paginate fas fa-caret-left'></i>"
                    },
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "search": "Pesquisar"
                },
                stateSave: true,
            });
        }
    }

    if (target) {
        observer.observe(target, config);
    }
});
