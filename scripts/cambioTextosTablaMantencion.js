
$("#dataTable").dataTable({
    language: {
        'lengthMenu'    : "Mostrar _MENU_ registros por página",
        'paginate': {
        'previous': 'Anterior',
        'next': 'Siguiente',
        },
        'search': 'Buscar:',
        'info': "Mostrando página _PAGE_ de _PAGES_",
    },
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excel',
            exportOptions: {
                columns: ':visible:not(:first-child)'
            },
            title: titulo.toUpperCase(), 
            className: 'btn-outline-primary options-button-style rounded-pill',
            filename: titulo,
            text: '<i class="fas fa-cloud-download-alt download-icon"></i> Descarga',
        }
    ]
});