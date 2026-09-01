var clientes, idlast;
// let url;    
$(function () {
    // Configuración del JqGrid
    // Configuramos la tabla dinámica para que sea responsive
    //$.jgrid.defaults.responsive = true;

    // Aplicamos las clases de Bootstrap en la tabla dinámica
    $.jgrid.styleUI.Bootstrap5.base.rowTable = "table table-bordered table-hover table-sm ";
    $.jgrid.styleUI.Bootstrap5.base.rowNumTable = "table-dark";


    clientes = $('#pacientes').jqGrid({
        url: 'pacientes/obtener_pacientes',
        datatype: "json",
        styleUI: "Bootstrap5",
        iconSet: "fontAwesome",
        mtype: "POST",
        colModel: [ // Establece la estructura de la tabla dinamica
            /*{ label: 'ID', name: 'id', index: 'id', width: 100 },*/
            { label: 'NOMBRE', name: 'nombre', index: 'nombre', width: 150, align: "center", editable: true},
            { label: 'FECHA DE NACIMIENTO', name: 'fecha_nacimiento', index: 'fecha_nacimiento', width: 190, editable: true},
            { label: 'EDAD', name: 'edad', index: 'edad', width: 100, editable: true },
            { label: 'DOCUMENTO DE IDENTIDAD', name: 'doc_identidad', index: 'doc_identidad', width: 250, editable: true },
            { label: 'TELEFONOS', name: 'telefonos', index: 'telefonos', width: 150, editable: true },
            { label: 'NOMBRE DE CONTACTO DE EMERGENCIA', name: 'contacto_emergencia_nombre', index: 'contacto_emergencia_nombre', width: 300, editable: true },
            { label: 'TELEFONO DE CONTACTO DE EMERGENCIA', name: 'contacto_emergencia_telefono', index: 'contacto_emergencia_telefono', width: 300, editable: true },
            { label: 'DIRECCIÓN DE RECIDENCIA', name: 'direcResidencial', index: 'direcResidencial', width: 210, editable: true },
            { label: 'NÚMERO DE EXPEDIENTE', name: 'id', index: 'id', width: 200 , key: true}
        ],
        shrinkToFit: false,
        width: $('.workspace').width(),
        height: $(window).height() * 0.32,
        rowNum: 500, // Establece el número de filas o registros que se veran en la tabla
        rownumbers: true,
        rowNumWidth: 35,
        pager: '#navpacientes', // Indica el div de la barra de navegacion
        sortname: 'numExpediente', // Indica el nombre del campo por el que se ordenan los registros
        viewrecords: true,
        sortorder: "asc", // Indica el ordenamiento ascendente o descendente
        onSelectRow: function (rowid, status, e) {
            idlast = rowid;
        }
    });

    // Configuramos la barra de navegación del JqGrid
    clientes.navGrid('#navpacientes', 
        { edit: true, add: true, del: true, view: true, search: false, },
        {url: '/pacientes/editar'},
        {url: '/pacientes/agregar'},
        {url: '/pacientes/eliminar'}
    );

    let dialog = document.getElementById("dialog")
    let btnMostrarModel = document.getElementById("btnAgregar")
    btnMostrarModel.addEventListener('click', ()=> {
        //process = "new";
    dialog.showModal();
    });

    document.addEventListener('submit', (e)=> {
        e.preventDefault();

        let fd = new FormData(e.target)//FormData lee todos los campos de un formulario y e.target que;

        fetch('/pacientes/agregar', {
            method: 'POST',
            body: fd
        })
        .then(()=>{
            clientes.trigger('reloadGrid')
        })
    })

    let btnEliminar = document.getElementById('btnEliminar');
    btnEliminar.addEventListener('click', () => {
    if (!idlast) {
        alert('Selecciona un paciente de la tabla primero.');
        return;
    }

    if (confirm('¿Seguro que quieres eliminar este paciente?')) {
        document.getElementById('id_eliminar').value = idlast;
        document.getElementById('formEliminar').submit();
    }

});

});