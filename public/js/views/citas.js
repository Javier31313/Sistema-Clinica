var citas, idlast;
let offcanvas;
let data;

document.addEventListener('DOMContentLoaded', ()=> {
$(function () {$.jgrid.styleUI.Bootstrap5.base.rowTable = "table table-bordered table-hover table-sm ";
    $.jgrid.styleUI.Bootstrap5.base.rowNumTable = "table-dark";

    citas = $('#citas').jqGrid({
        url: 'citas/obtener_citas',
        datatype: "json",
        styleUI: "Bootstrap5",
        iconSet: "fontAwesome",
        mtype: "POST",
        colModel: [
            { label: 'ID CITA', name: 'id', index: 'id', width: 130, align: "center"},
            { label: 'FECHA', name: 'fecha', index: 'fecha', width: 130, align: "center", editable: true },
            { label: 'HORA', name: 'hora', index: 'hora', width: 120, editable: true },
            { label: 'ESPECIALISTA', name: 'especialista', index: 'especialista', width: 180, editable: true },
            { label: 'CONSULTORIO', name: 'consultorio', index: 'consultorio', width: 180, editable: true },
            { label: 'MODALIDAD', name: 'modalidad', index: 'modalidad', width: 150, editable: true }
        ],
        shrinkToFit: false,
        width: $('.workspace').width(),
        height: $(window).height() * 0.32,
        rowNum: 500,
        rownumbers: true,
        rowNumWidth: 35,
        pager: '#navpacientes',
        sortname: 'id_cita',
        viewrecords: true,
        sortorder: "asc",
        onSelectRow: function (rowid, status, e) {
            idlast = rowid;
        }
    });

    citas.navGrid('#navpacientes', 
            { edit: false, add: false, del: false, view: true, search: false }, 
            { url: '' }, { url: '' }, { url: '/citas/eliminar' }
        ).jqGrid('navButtonAdd', '#navpacientes', {
            caption: " PDF",
            title: "Generar Comprobante PDF de Cita",
            buttonicon: "fa-solid fa-file-pdf",
            onClickButton: function() {
                if (!idlast) {
                    alert('Por favor, selecciona una cita de la tabla primero.');
                } else {
                    window.open('/citas/generar_pdf?id=' + idlast, '_blank');
                }
            },
            position: "last"
        });
});

    //Función para traer los nombres de los pacientes.

    // Función para Guardar un registro
    let btnGuardar = document.getElementById('btnGuardar');
    btnGuardar.addEventListener('click', (e)=> {
        e.preventDefault();
        guardar();
    })

    // Función para abrir offCanvas con información
    let btnFormBoostEditar = document.getElementById('btnFormBoostEditar');
    btnFormBoostEditar.addEventListener('click', () => {
        abrirEditar();
    });

    // Función Editar
    let btnEditar = document.getElementById('btnEditar');
    btnEditar.addEventListener('click', (e) => {
        e.preventDefault();
        editar();
    })

    // Función para Eliminar un registro.
    let btnFormBoostEliminar = document.getElementById('btnFormBoostEliminar');
    btnFormBoostEliminar.addEventListener('click', () => {
        eliminar();
    });

    //Función para Buscar un registro
    let btnBuscar = document.getElementById('buttonBuscarID')
    btnBuscar.addEventListener('click', ()=> {
        buscarPaciente();
        nombresPacientes();
    })

    // let btnImprimir = document.getElementById('btnImprimir')
    // btnImprimir.addEventListener('click', ()=> {
    //     imprimir();
    // })
    
});


function guardar() {
        let fd = new FormData(document.getElementById('formCitas'));
        fetch('citas/agregar', {
            method: 'POST',
            body: fd
        })
        .then(() => {
            citas.trigger('reloadGrid');
        });
}


function abrirEditar() {
        if (!idlast) { 
            alert('Selecciona un registro primero.');
            return;
        } else {
            offcanvas = bootstrap.Offcanvas.getOrCreateInstance(document.getElementById('offcanvasRight'));
            offcanvas.show();
            
            // Mostrar el botón de Editar y ocultar el de Guardar
            if (btnEditar) btnEditar.style.display = "block";
            if (btnGuardar) btnGuardar.style.display = "none";

            data = citas.jqGrid('getRowData', idlast);
            document.getElementById('fecha').value = data.fecha;
            document.getElementById('hora').value = data.hora;
            document.getElementById('especialista').value = data.especialista;
            document.getElementById('consultorio').value = data.consultorio;
            document.getElementById('modalidad').value = data.modalidad;
        }
}

function editar() {
        const fd = new FormData(document.getElementById('formCitas'));
        fd.append('id', idlast);
        
        fetch('citas/editar', {
            method: 'POST',
            body: fd
        })
        .then(() => {
            idlast = null;
            citas.jqGrid('resetSelection');
            citas.trigger('reloadGrid');
        });
}

function eliminar() {
        if (!idlast) {
            alert('Selecciona un registro primero.');
        } else {
            if (confirm('¿Estás de acuerdo en eliminar este registro?')) {
                let fd = new FormData();
                fd.append('id', idlast);
                
                fetch('citas/eliminar', {
                    method: 'POST',
                    body: fd
                })
                .then(() => {
                    idlast = null;
                    citas.jqGrid('resetSelection');
                    citas.trigger('reloadGrid');
                });
            }
        }
}

function buscarPaciente() {
    let buscador_id = document.getElementById('buscador_id') //id de el buscador de arriba
    let buscador_id_2 = buscador_id.value

    document.getElementById('id_paciente_form').value = buscador_id_2

    citas.jqGrid('setGridParam', {postData: {id_paciente: buscador_id_2}}).trigger('reloadGrid');
}

function nombresPacientes() {
let divNombre = document.getElementById('divNombres')
fetch('/citas/nombrePaciente')
.then(response => response.json())
.then(data => {
    divNombre.innerHTML = '';
    for(let i = 0; i < data.length; i++) {
        let p = document.createElement("p")
        p.dataset.id = data[i].id
        p.textContent = data[i].nombre
        p.style.display = 'none'
        divNombre.appendChild(p);
    }
    let buscador_id = document.getElementById('buscador_id').value
    p = document.querySelectorAll('#divNombres p')
    p.forEach(function(nombre) {
    if(nombre.dataset.id === buscador_id) {
            nombre.style.display = 'block';
        } else {
            nombre.style.display = 'none';
        }
    })
});
}

// function imprimir() {
//     if (!idlast) {
//         alert('Por favor, selecciona un paciente de la tabla para imprimir su expediente.');
//          return;
//     }
//     window.open('/citas/pdf?id=' + idlast, '_blank');
// }