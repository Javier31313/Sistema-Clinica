var clientes, idlast;
// let url;    
$(function () {
    // Configuración del JqGrid
    // Configuramos la tabla dinámica para que sea responsive
    //$.jgrid.defaults.responsive = true;

    // Aplicamos las clases de Bootstrap en la tabla dinámica
    $.jgrid.styleUI.Bootstrap5.base.rowTable = "table table-bordered table-hover table-sm ";
    $.jgrid.styleUI.Bootstrap5.base.rowNumTable = "table-dark";


    clientes = $('#historial').jqGrid({
        url: 'historial/obtener_historial',
        datatype: "json",
        styleUI: "Bootstrap5",
        iconSet: "fontAwesome",
        mtype: "POST",
        colModel: [ // Establece la estructura de la tabla dinamica
            /*{ label: 'ID', name: 'id', index: 'id', width: 100 },*/
            { label: 'FECHA DE ULTIMA REGLA (FUR)', name: 'FUR', index: 'FUR', width: 250, align: "center", align: "center"},
            { label: 'ANTECEDENTES HEREDOFAMILIARES (AHF)', name: 'fecha_nacimiento', index: 'fecha_nacimiento', width: 320, align: "center"},
            { label: 'ANTECEDENTES NO PATOLÓGICOS (ANP)', name: 'edad', index: 'edad', width: 300, align: "center"},
            { label: 'HABITOS', name: 'doc_identidad', index: 'doc_identidad', width: 250, align: "center" },
            { label: 'ALERGIAS', name: 'telefonos', index: 'telefonos', width: 150, align: "center" },
            { label: 'LABORATORIO CLíNICO', name: 'contacto_emergencia_nombre', index: 'contacto_emergencia_nombre', width: 300, align: "center" },
            { label: 'ESTUDIOS PREVIOS', name: 'contacto_emergencia_telefono', index: 'contacto_emergencia_telefono', width: 300, align: "center" },
            { label: 'INDICACIONES MEDICAS', name: 'direcResidencial', index: 'direcResidencial', width: 210, align: "center" },
            { label: 'RECOMENDACIONES NO FARMACOLOGICAS', name: 'id', index: 'id', width: 310, align: "center"}
        ],
        shrinkToFit: false,
        width: $('.workspace').width(),
        height: $(window).height() * 0.32,
        rowNum: 500, // Establece el número de filas o registros que se veran en la tabla
        rownumbers: true,
        rowNumWidth: 35,
        pager: '#navhistorial', // Indica el div de la barra de navegacion
        sortname: 'id_historial', // Indica el nombre del campo por el que se ordenan los registros
        viewrecords: true,
        sortorder: "asc", // Indica el ordenamiento ascendente o descendente
        onSelectRow: function (rowid, status, e) {
            idlast = rowid;
        }
    });

    // Configuramos la barra de navegación del JqGrid
    clientes.navGrid('#navhistorial', { edit: true, add: true, del: true, view: true, search: false, });
});