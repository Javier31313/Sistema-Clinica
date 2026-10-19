var pacientes, idlast;
let offcanvas
let data
// let url;

document.addEventListener('DOMContentLoaded', ()=> {

$(function () {
    // Configuración del JqGrid
    // Configuramos la tabla dinámica para que sea responsive
    //$.jgrid.defaults.responsive = true;

    // Aplicamos las clases de Bootstrap en la tabla dinámica
    $.jgrid.styleUI.Bootstrap5.base.rowTable = "table table-bordered table-hover ";
    $.jgrid.styleUI.Bootstrap5.base.rowNumTable = "table-dark";


    pacientes = $('#pacientes').jqGrid({
        url: 'pacientes/obtener_pacientes',
        datatype: "json",
        styleUI: "Bootstrap5",
        iconSet: "fontAwesome",
        mtype: "POST",
        colModel: [ // Establece la estructura de la tabla dinamica
            /*{ label: 'ID', name: 'id', index: 'id', width: 100 },*/
            { label: 'NÚMERO DE EXPEDIENTE', name: 'id', index: 'id', width: 185, align: "center",key: true},
            { label: 'NOMBRE', name: 'nombre', index: 'nombre', width: 200, align: "center", editable: true},
            { label: 'FECHA DE NACIMIENTO', name: 'fecha_nacimiento', index: 'fecha_nacimiento', align: "center",width: 190, editable: true},
            { label: 'EDAD', name: 'edad', index: 'edad', width: 100, align: "center",editable: true },
            { label: 'DOCUMENTO DE IDENTIDAD', name: 'doc_identidad', index: 'doc_identidad', align: "center",width: 250, editable: true },
            { label: 'TELEFONOS', name: 'telefonos', index: 'telefonos', align: "center",width: 150, editable: true },
            { label: 'NOMBRE DE CONTACTO DE EMERGENCIA', name: 'contacto_emergencia_nombre', index: 'contacto_emergencia_nombre', align: "center",width: 300, editable: true },
            { label: 'TELEFONO DE CONTACTO DE EMERGENCIA', name: 'contacto_emergencia_telefono', index: 'contacto_emergencia_telefono', align: "center", width: 300, editable: true },
            { label: '', name: 'direcResidencial', index: 'direcResidencial', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'genero', index: 'genero', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'ocupacion', index: 'ocupacion', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'correo', index: 'correo', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'contacto_emergencia_parentesco', index: 'contacto_emergencia_parentesco', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'sexoBiologico', index: '', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'medUsoHabitual', index: 'medUsoHabitual', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'antecFamiliares', index: 'antecFamiliares', align: "center",width: 210,hidden:  true, editable: true },
            { label: '', name: 'antecPatologicos', index: 'antecPatologicos', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'antecTrauma', index: 'antecTrauma', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'antecQuirurgicos', index: 'antecQuirurgicos', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'fechaAtencion', index: 'fechaAtencion', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'horaAtencion', index: 'horaAtencion', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'signosVitales', index: 'signosVitales', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'planTratamiento', index: 'planTratamiento', align: "center",width: 210, hidden: true,editable: true },
            { label: '', name: 'aseguradora', index: 'aseguradora', align: "center",width: 210, hidden: true,editable: true },
        ],
        shrinkToFit: false,
        width: $('.workspace').width(),
        height: $(window).height() * 0.32,
        rowNum: 500, // Establece el número de filas o registros que se veran en la tabla
        rownumbers: true,
        rowNumWidth: 35,
        pager: '#navpacientes', // Indica el div de la barra de navegacion
        sortname: 'id', // Indica el nombre del campo por el que se ordenan los registros
        viewrecords: true,
        sortorder: "asc", // Indica el ordenamiento ascendente o descendente
        onSelectRow: function (rowid, status, e) {
            idlast = rowid;
        }
    });

    // Configuramos la barra de navegación del JqGrid
    pacientes.navGrid('#navpacientes', 
        { edit: false, add: false, del: false, view: false, search: false, });
});

    // Función para Guargar un registro
    btnGuardar = document.getElementById('btnGuardar')
    btnGuardar.addEventListener('click', (e)=> {
        e.preventDefault();
        guardar();
    })
    
    // Función para abrir offCanvas con registro.
    btnFormBoostEditar = document.getElementById('btnFormBoostEditar')
    btnFormBoostEditar.addEventListener('click', ()=> {
        abrirEditar();
        //movi esto
    })

    // Función para Editar un registro.
    btnEditar = document.getElementById('btnEditar');//llamada a boton de editar
    btnEditar.addEventListener('click', ()=> { //siempre prevenimos la recarga de la página
        editar();
    })

    // Función para Eliminar un registro.
    btnFormBoostEliminar = document.getElementById('btnFormBoostEliminar');
    btnFormBoostEliminar.addEventListener('click', ()=> { //no se pone parametro e pq no es de submit
        eliminar();
    })

    // Función para Imprimir un registro
    let btnImprimir = document.getElementById('btnImprimir');
    btnImprimir.addEventListener('click', () => {
        imprimir();
    });

});



    
function guardar() {
    let fd = new FormData(document.getElementById('formRegistro'))
    fetch('/pacientes/agregar', {
        method: 'POST',
        body: fd
    })
    .then(()=> {
        pacientes.trigger('reloadGrid');
    })
}


function abrirEditar() {
        if(!idlast) {
            alert('Seleccione un registro primero')
            return
        } else {
            offcanvas = bootstrap.Offcanvas.getOrCreateInstance(document.getElementById('offcanvasRight'))
            offcanvas.show() //Mostramos el formulario

            btnGuardar.style.display = "none";
            btnEditar.style.display = "block";

            data = pacientes.jqGrid('getRowData', idlast);
            document.getElementById('doc_identidad').value = data.doc_identidad
            document.getElementById('nombre').value = data.nombre
            document.getElementById('edad').value = data.edad
            document.getElementById('genero').value = data.genero
            document.getElementById('ocupacion').value = data.ocupacion
            document.getElementById('telefonos').value = data.telefonos
            document.getElementById('correo').value = data.correo
            document.getElementById('contacto_emergencia_nombre').value = data.contacto_emergencia_nombre
            document.getElementById('contacto_emergencia_parentesco').value = data.contacto_emergencia_parentesco
            document.getElementById('contacto_emergencia_telefono').value = data.contacto_emergencia_telefono
            document.getElementById('direcResidencial').value = data.direcResidencial
            document.getElementById('sexoBiologico').value = data.sexoBiologico
            document.getElementById('medUsoHabitual').value = data.medUsoHabitual
            document.getElementById('fecha_nacimiento').value = data.fecha_nacimiento;
            document.getElementById('antecFamiliares').value = data.antecFamiliares
            document.getElementById('antecPatologicos').value = data.antecPatologicos
            document.getElementById('antecTrauma').value = data.antecTrauma
            document.getElementById('antecQuirurgicos').value = data.antecQuirurgicos         
            document.getElementById('fechaAtencion').value = data.fechaAtencion          
            document.getElementById('horaAtencion').value = data.horaAtencion     
            document.getElementById('signosVitales').value = data.signosVitales        
            document.getElementById('planTratamiento').value = data.planTratamiento         
            document.getElementById('aseguradora').value = data.aseguradora         
        }
}

    
        
function editar() {
    let fd = new FormData(document.getElementById('formRegistro'))
    fd.append('id', idlast)
    fetch('/pacientes/editar', {
        method: 'POST',
        body: fd
    })
    .then(()=> {
        document.getElementById('formRegistro').reset(); // evitar que se muestren los datos del form
        pacientes.trigger('reloadGrid')
        pacientes.jqGrid('resetSelection');
    })
}

function eliminar() {
    if(!idlast) {
        alert('Selecciona un registro primero')
        return;
    } else {
        if(confirm('¿Desea eliminar este registro?')){
            let fd = new FormData()
            fd.append('id', idlast)
            fetch('/pacientes/eliminar', {
                method: 'POST',
                body: fd
            })
            .then(()=> {
                pacientes.trigger('reloadGrid')
                pacientes.jqGrid('resetSelection')
            })
        }
    }
} 

function imprimir() {
    if (!idlast) {
        alert('Por favor, selecciona un paciente de la tabla para imprimir su expediente.');
         return;
    }
    window.open('/pacientes/pdf?id=' + idlast, '_blank');
} 