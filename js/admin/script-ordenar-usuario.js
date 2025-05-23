$(document).ready(function() { // Esperar a que el DOM esté completamente cargado
    $('#example').DataTable({ // Inicializar DataTable
        dom: 'Bfrtilp', // Definir el DOM para los elementos de la tabla
        buttons: [
            {
                extend: 'excelHtml5', // Botón para copiar al portapapeles
                text: '<i class="fa-solid fa-file-excel"></i>', // Icono de copiar
                titleAttr: 'Exportar a Excel', // Tooltip al pasar el mouse
                className: 'btn btn-success', // Clase CSS para el botón
                exportOptions: {
                    columns: ':not(:nth-child(6)):not(:nth-child(7)):not(:nth-child(12))', // Excluir columnas 5, 6 y 11
                    format: {
                        body: function(data, row, column, node) {
                            // Personalizar la columna de estado (columna 10)
                            if (column === 9) { // Índice de la columna Estado (base 0)
                                if ($(node).find('i').hasClass('fa-user-check')) {
                                    return 'Activo';
                                } else if ($(node).find('i').hasClass('fa-circle-xmark')) {
                                    return 'Inactivo';
                                } else if ($(node).find('i').hasClass('fa-ban')) {
                                    return 'Suspendido';
                                }
                            }
                            return data; // Devolver el contenido original para las demás columnas
                        }
                    }
                }
            },
            {
                extend: 'pdfHtml5', // Botón para exportar a PDF
                text: '<i class="fa-solid fa-file-pdf"></i>', // Icono de PDF
                titleAttr: 'Exportar a PDF', // Tooltip al pasar el mouse
                className: 'btn btn-danger', // Clase CSS para el botón
                exportOptions: {
                    columns: ':not(:nth-child(6)):not(:nth-child(7)):not(:nth-child(12))', // Excluir columnas 5, 6 y 11
                    format: {
                        body: function(data, row, column, node) {
                            // Personalizar la columna de estado (columna 10)
                            if (column === 9) { // Índice de la columna Estado (base 0)
                                if ($(node).find('i').hasClass('fa-user-check')) {
                                    return 'Activo';
                                } else if ($(node).find('i').hasClass('fa-circle-xmark')) {
                                    return 'Inactivo';
                                } else if ($(node).find('i').hasClass('fa-ban')) {
                                    return 'Suspendido';
                                }
                            }
                            return data; // Devolver el contenido original para las demás columnas
                        }
                    }
                }
            },
            {
                extend: 'print', // Botón para imprimir
                text: '<i class="fa-solid fa-print"></i>', // Icono de imprimir
                titleAttr: 'Imprimir', // Tooltip al pasar el mouse
                className: 'btn btn-info', // Clase CSS para el botón
                exportOptions: {
                    columns: ':not(:nth-child(6)):not(:nth-child(7)):not(:nth-child(12))', // Excluir columnas 5, 6 y 11
                    format: {
                        body: function(data, row, column, node) {
                            // Personalizar la columna de estado (columna 10)
                            if (column === 9) { // Índice de la columna Estado (base 0)
                                if ($(node).find('i').hasClass('fa-user-check')) {
                                    return 'Activo';
                                } else if ($(node).find('i').hasClass('fa-circle-xmark')) {
                                    return 'Inactivo';
                                } else if ($(node).find('i').hasClass('fa-ban')) {
                                    return 'Suspendido';
                                }
                            }
                            return data; // Devolver el contenido original para las demás columnas
                        }
                    }
                }
            }
        ], // Definir los botones para exportar
        lengthMenu: [5, 10, 15, 20, 25, 50], // Opciones de longitud de página
        columnDefs: [ // Definiciones de columnas
            { orderable: false, targets: [2, 3, 4, 5, 6, 9, 10, 11] }, // desactivar ordenación en columnas específicas
            { searchable: false, targets: [0, 3, 4, 5, 6, 7, 10, 11] }, // desactivar búsqueda en columnas específicas
            { width: "4%", target: [0] },   // columna id
            { width: "20%", target: [1] },  // columna nombre
            { width: "8%", target: [2, 3] }, // columna cedula y columna telefono
            { width: "12%", target: [4] },  // columna correo
            { width: "8%", target: [5] },  // columna contraseña
            { width: "4%", target: [6] },   // columna QR
            { width: "7%", target: [7] },   // columna fecha de registro
            { width: "8%", target: [8] },   // columna rol
            { width: "5%", target: [9, 10] }, // columna estado y columna puntos
            { width: "6%", target: [11] }   // columna acciones
        ],
        pageLength: 8, // Número de filas por página
        language: { // Configuración de idioma
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad",
                "collection": "Colección",
                "colvisRestore": "Restaurar visibilidad",
                "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                "copySuccess": {
                    "1": "Copiada 1 fila al portapapeles",
                    "_": "Copiadas %ds fila al portapapeles"
                },
                "copyTitle": "Copiar al portapapeles",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "-1": "Mostrar todas las filas",
                    "_": "Mostrar %d filas"
                },
                "pdf": "PDF",
                "print": "Imprimir",
                "renameState": "Cambiar nombre",
                "updateState": "Actualizar",
                "createState": "Crear Estado",
                "removeAllStates": "Remover Estados",
                "removeState": "Remover",
                "savedStates": "Estados Guardados",
                "stateRestore": "Estado %d"
            },
            "autoFill": {
                "cancel": "Cancelar",
                "fill": "Rellene todas las celdas con <i>%d<\/i>",
                "fillHorizontal": "Rellenar celdas horizontalmente",
                "fillVertical": "Rellenar celdas verticalmente"
            },
            "decimal": ",",
            "searchBuilder": {
                "add": "Añadir condición",
                "button": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "clearAll": "Borrar todo",
                "condition": "Condición",
                "conditions": {
                    "date": {
                        "before": "Antes",
                        "between": "Entre",
                        "empty": "Vacío",
                        "equals": "Igual a",
                        "notBetween": "No entre",
                        "not": "Diferente de",
                        "after": "Después",
                        "notEmpty": "No Vacío"
                    },
                    "number": {
                        "between": "Entre",
                        "equals": "Igual a",
                        "gt": "Mayor a",
                        "gte": "Mayor o igual a",
                        "lt": "Menor que",
                        "lte": "Menor o igual que",
                        "notBetween": "No entre",
                        "notEmpty": "No vacío",
                        "not": "Diferente de",
                        "empty": "Vacío"
                    },
                    "string": {
                        "contains": "Contiene",
                        "empty": "Vacío",
                        "endsWith": "Termina en",
                        "equals": "Igual a",
                        "startsWith": "Empieza con",
                        "not": "Diferente de",
                        "notContains": "No Contiene",
                        "notStartsWith": "No empieza con",
                        "notEndsWith": "No termina con",
                        "notEmpty": "No Vacío"
                    },
                    "array": {
                        "not": "Diferente de",
                        "equals": "Igual",
                        "empty": "Vacío",
                        "contains": "Contiene",
                        "notEmpty": "No Vacío",
                        "without": "Sin"
                    }
                },
                "data": "Data",
                "deleteTitle": "Eliminar regla de filtrado",
                "leftTitle": "Criterios anulados",
                "logicAnd": "Y",
                "logicOr": "O",
                "rightTitle": "Criterios de sangría",
                "title": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "value": "Valor"
            },
            "searchPanes": {
                "clearMessage": "Borrar todo",
                "collapse": {
                    "0": "Paneles de búsqueda",
                    "_": "Paneles de búsqueda (%d)"
                },
                "count": "{total}",
                "countFiltered": "{shown} ({total})",
                "emptyPanes": "Sin paneles de búsqueda",
                "loadMessage": "Cargando paneles de búsqueda",
                "title": "Filtros Activos - %d",
                "showMessage": "Mostrar Todo",
                "collapseMessage": "Colapsar Todo"
            },
            "select": {
                "cells": {
                    "1": "1 celda seleccionada",
                    "_": "%d celdas seleccionadas"
                },
                "columns": {
                    "1": "1 columna seleccionada",
                    "_": "%d columnas seleccionadas"
                },
                "rows": {
                    "1": "1 fila seleccionada",
                    "_": "%d filas seleccionadas"
                }
            },
            "thousands": ".",
            "datetime": {
                "previous": "Anterior",
                "hours": "Horas",
                "minutes": "Minutos",
                "seconds": "Segundos",
                "unknown": "-",
                "amPm": [
                    "AM",
                    "PM"
                ],
                "months": {
                    "0": "Enero",
                    "1": "Febrero",
                    "10": "Noviembre",
                    "11": "Diciembre",
                    "2": "Marzo",
                    "3": "Abril",
                    "4": "Mayo",
                    "5": "Junio",
                    "6": "Julio",
                    "7": "Agosto",
                    "8": "Septiembre",
                    "9": "Octubre"
                },
                "weekdays": {
                    "0": "Dom",
                    "1": "Lun",
                    "2": "Mar",
                    "4": "Jue",
                    "5": "Vie",
                    "3": "Mié",
                    "6": "Sáb"
                },
                "next": "Próximo"
            },
            "editor": {
                "close": "Cerrar",
                "create": {
                    "button": "Nuevo",
                    "title": "Crear Nuevo Registro",
                    "submit": "Crear"
                },
                "edit": {
                    "button": "Editar",
                    "title": "Editar Registro",
                    "submit": "Actualizar"
                },
                "remove": {
                    "button": "Eliminar",
                    "title": "Eliminar Registro",
                    "submit": "Eliminar",
                    "confirm": {
                        "_": "¿Está seguro de que desea eliminar %d filas?",
                        "1": "¿Está seguro de que desea eliminar 1 fila?"
                    }
                },
                "error": {
                    "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                },
                "multi": {
                    "title": "Múltiples Valores",
                    "restore": "Deshacer Cambios",
                    "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
                    "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, haga clic o pulse aquí, de lo contrario conservarán sus valores individuales."
                }
            },
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "stateRestore": {
                "creationModal": {
                    "button": "Crear",
                    "name": "Nombre:",
                    "order": "Clasificación",
                    "paging": "Paginación",
                    "select": "Seleccionar",
                    "columns": {
                        "search": "Búsqueda de Columna",
                        "visible": "Visibilidad de Columna"
                    },
                    "title": "Crear Nuevo Estado",
                    "toggleLabel": "Incluir:",
                    "scroller": "Posición de desplazamiento",
                    "search": "Búsqueda",
                    "searchBuilder": "Búsqueda avanzada"
                },
                "removeJoiner": "y",
                "removeSubmit": "Eliminar",
                "renameButton": "Cambiar Nombre",
                "duplicateError": "Ya existe un Estado con este nombre.",
                "emptyStates": "No hay Estados guardados",
                "removeTitle": "Remover Estado",
                "renameTitle": "Cambiar Nombre Estado",
                "emptyError": "El nombre no puede estar vacío.",
                "removeConfirm": "¿Seguro que quiere eliminar %s?",
                "removeError": "Error al eliminar el Estado",
                "renameLabel": "Nuevo nombre para %s:"
            },
            "infoThousands": "."
        },
    });
});