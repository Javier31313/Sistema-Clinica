var pacientes, idlast;
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


    pacientes = $('#pacientes').jqGrid({
        url: 'pacientes/obtener_pacientes',
        datatype: "json",
        styleUI: "Bootstrap5",
        iconSet: "fontAwesome",
        mtype: "POST",
        colModel: [ // Establece la estructura de la tabla dinamica
            /*{ label: 'ID', name: 'id', index: 'id', width: 100 },*/
            { label: 'NÚMERO DE EXPEDIENTE', name: 'id', index: 'id', width: 185, align: "center", classes: "columna-roja" ,key: true,},
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
        pager: false, // Indica el div de la barra de navegacion
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

    let btnGuardar = document.getElementById('btnGuardar');//llamamos al boton de agregar que está dentro del formulario

    btnGuardar.addEventListener('click', (e)=> { //Definimos 'e' como un parámetro que ejecuta al momento del evento
        e.preventDefault(); // Evita el comportamiento por defecto de bntGuardar

        let fd = new FormData(document.getElementById('formRegistro'))//FormData recibe los campos del form
        fetch('/pacientes/agregar', {// Solicitamos la información de agregar
            method: 'POST',
            body: fd
        })
        .then(()=> {// Actualizamos  el nuevo registro en la tabla jqGrid
            pacientes.trigger('reloadGrid');
        })
    })

    btnEditar = document.getElementById('btnEditar');//llamada a boton de editar
    btnFormBoostEditar = document.getElementById('btnFormBoostEditar')//llamando a boton para mostrar formulario

    btnFormBoostEditar.addEventListener('click', ()=> {
        if(!idlast) {
            alert('Seleccione un registro primero')
            return
        } else {
            let offcanvas = bootstrap.Offcanvas.getOrCreateInstance(document.getElementById('offcanvasRight'))
            offcanvas.show() //Mostramos el formulario
            btnEditar.style.display = "block"
            btnGuardar.style.display = "none"

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
    })

    btnEditar.addEventListener('click', (e)=> { //siempre prevenimos la recarga de la página
        e.preventDefault();

        let fd = new FormData(document.getElementById('formRegistro'))
        fd.append('id', idlast)
        fetch('/pacientes/editar', {
            method: 'POST',
            body: fd
        })
        .then(()=> {
            pacientes.trigger('reloadGrid')
        })
    })


    let btnFormBoostEliminar = document.getElementById('btnFormBoostEliminar')

    btnFormBoostEliminar.addEventListener('click', ()=> { //no se pone parametro e pq no es de submit
        if(!idlast) {
            alert('Selecciona un registro primero')
            return;
        } else {
            
            if(confirm('¿Borrar registro? =(')){
                let fd = new FormData()
                fd.append('id',idlast)
                fetch('/pacientes/eliminar', {
                    method: 'POST',
                    body: fd
                })
                .then(()=> {
                    pacientes.trigger('reloadGrid')
                })
            }
        }
    })

let btnImprimir = document.getElementById('btnImprimir');

if (btnImprimir) {
    btnImprimir.addEventListener('click', () => {
        if (!idlast) {
            alert('Por favor, selecciona un paciente de la tabla para imprimir su expediente.');
            return;
        }

        // Abre el PDF pasando el idlast (numExpediente)
        window.open('/pacientes/pdf?id=' + idlast, '_blank');
    });
}