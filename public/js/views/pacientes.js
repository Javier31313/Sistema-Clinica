var clientes, idlast;
let offcanvas
let data
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
        { edit: false, add: false, del: false, view: true, search: false, }, {url: ''},{url: ''}, {url: '/pacientes/eliminar'});
});


    let btnGuardar = document.getElementById('btnGuardar'); // Defino la variable btnGuardar para que almacene el botón

    btnGuardar.addEventListener('click', (e)=> { // Le declaramos un evento al botón btnGuardar de 'click'
    e.preventDefault()
    let fd = new FormData(document.getElementById('formRegistro'))// Le definimos a FormData el id del formulario para que lea sus campos
    fetch('/pacientes/agregar', {
        method: 'POST',
        body: fd
    })
    .then(()=> {
        clientes.trigger('reloadGrid')
    })
})


let btnEditar = document.getElementById('btnEditar');
let btnFormBoostEditar = document.getElementById('btnFormBoostEditar');

btnFormBoostEditar.addEventListener('click', ()=> {
    if(!idlast) { 
        alert('Selecciona un registro primero.')
        return
    } else {
        offcanvas = bootstrap.Offcanvas.getOrCreateInstance(document.getElementById('offcanvasRight'))
        offcanvas.show()
        btnEditar.style.display = "block"
        btnGuardar.style.display = "none"

        data = clientes.jqGrid('getRowData', idlast) //Mostramos la información del registro en los campos
        document.getElementById('nombre').value = data.nombre
        document.getElementById('fecha_nacimiento').value = data.fecha_nacimiento;
        document.getElementById('edad').value = data.edad
        document.getElementById('doc_identidad').value = data.doc_identidad
        document.getElementById('telefonos').value = data.telefonos
        document.getElementById('contacto_emergencia_nombre').value = data.contacto_emergencia_nombre
        document.getElementById('contacto_emergencia_telefono').value = data.contacto_emergencia_telefono
        document.getElementById('direcResidencial').value = data.direcResidencial
        // document.getElementById('id_paciente').value = idlast
    }
    
})

btnEditar.addEventListener('click', (e)=> {
    e.preventDefault()

    const fd = new FormData(document.getElementById('formRegistro'))
    fd.append('id',idlast)
    fetch('/pacientes/editar', {
        method: 'POST',
        body: fd
    })
    .then(()=> {
        clientes.trigger('reloadGrid')
    })
})



btnFormBoostEliminar = document.getElementById('btnFormBoostEliminar') // btn de vista
btnEliminar = document.getElementById('btnEliminar') // btn de eliminar

btnFormBoostEliminar.addEventListener('click', ()=> {
    if(!idlast) {
        alert('Selecciona un registro primero.') // Creamos una condicional en caso que no se seleccione un registro, muestra la alerta
    }else {
        // data = clientes.jqGrid('getRowData', idlast) // Pedimos la información de los campos
        // document.getElementById('id_paciente').value = idlast //Le definimos a idlast que ahora toma el valor del id del registro

        if(confirm('¿Estas de acuerdo en eliminar este registro?')) {
        let fd = new FormData()
        fd.append('id', idlast)
        fetch('/pacientes/eliminar', {
        method: 'POST',
        body: fd
        })
        .then(()=> {
            clientes.trigger('reloadGrid');
        })
    }
    }

    
    // data = clientes.jqGrid('getRowData', idlast) // Pedimos la información de los campos
    // document.getElementById('id_paciente').value = idlast //Le definimos a idlast que ahora toma el valor del id del registro

    // let fd = new FormData()
    // fetch('/pacientes/eliminar', {
    //     method: 'POST',
    //     body: fd
    // })

})

// btnEliminar.addEventListener('click', (e)=> { // Añadimos un evento con parametro e para evitar la recarga de la página
//     e.preventDefault();


// })