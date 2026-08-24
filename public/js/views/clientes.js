var clientes, idlast;
$(function () {
    // Configuración del JqGrid
    // Configuramos la tabla dinámica para que sea responsive
    $.jgrid.defaults.responsive = true;

    // Aplicamos las clases de Bootstrap en la tabla dinámica
    $.jgrid.styleUI.Bootstrap5.base.rowTable = "table table-bordered table-hover table-sm";

    clientes = $('#clientes').jqGrid({
        url: 'clientes/obtener_clientes',
        datatype: "json",
        styleUI: "Bootstrap5",
        iconSet: "fontAwesome",
        mtype: "POST",
        colModel: [ // Establece la estructura de la tabla dinamica
            { label: 'NRC', name: 'id', index: 'nrc', width: 100 },
            { label: 'NOMBRE DE LA EMPRESA', name: 'nombre_empresa', index: 'nombre_empresa', width: 300 },
            { label: 'CORREO EMPRESARIAL', name: 'correo_empresarial', index: 'correo_empresarial', width: 250 },
            { label: 'TELEFONO EMPRESA', name: 'telefono_empresa', index: 'telefono_empresa', width: 120, align: "center" },
            { label: 'CONTACTO', name: 'persona_contacto', index: 'persona_contacto', width: 250 },
            { label: 'TELÉFONO', name: 'correo_contacto', index: 'telefono_contacto', width: 120, align: "center" },
            { label: 'CORREO ELECTRÓNICO', name: 'telefono_contacto', index: 'correo_contacto', width: 400 },
            { label: 'CORREO ELECTRÓNICO', name: 'celular_contacto', index: 'correo_contacto', width: 400 },
            { label: 'CORREO ELECTRÓNICO', name: 'fecha_creacion', index: 'correo_contacto', width: 400 },
            { label: 'CORREO ELECTRÓNICO', name: 'fecha_modificacion', index: 'correo_contacto', width: 400 }

        ],
        shrinkToFit: false,
        width: $('.workspace').width(),
        height: $(window).height() * 0.55,
        rowNum: 500, // Establece el número de filas o registros que se veran en la tabla
        rownumbers: true,
        rowNumWidth: 35,
        pager: '#navclientes', // Indica el div de la barra de navegacion
        sortname: 'nombre_empresa', // Indica el nombre del campo por el que se ordenan los registros
        viewrecords: true,
        sortorder: "asc", // Indica el ordenamiento ascendente o descendente
        onSelectRow: function (rowid, status, e) {
            idlast = rowid;
        }
    });

    // Configuramos la barra de navegación del JqGrid
    clientes.navGrid('#navclientes', { edit: false, add: false, del: false, view: true, search: false });
});