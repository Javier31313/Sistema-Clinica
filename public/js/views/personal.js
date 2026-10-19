var personal, idlast;
let offcanvas;
let data;

$(function () {
    $.jgrid.styleUI.Bootstrap5.base.rowTable = "table table-bordered table-hover table-sm ";
    $.jgrid.styleUI.Bootstrap5.base.rowNumTable = "table-dark";

    personal = $('#personal').jqGrid({
        url: 'personal/obtener_personal',
        datatype: "json",
        styleUI: "Bootstrap5",
        iconSet: "fontAwesome",
        mtype: "POST",
        colModel: [
            { label: 'ID', name: 'id_personal', index: 'id_personal', width: 50,  align: "center", key: true, editable: false},
            { label: 'NOMBRE', name: 'nombre', index: 'nombre', width: 130, align: "center", editable: true },
            { label: 'APELLIDO', name: 'apellido', index: 'apellido', width: 130, align: "center", editable: true },
            { label: 'ESPECIALIDAD', name: 'especialidad', index: 'especialidad', width: 180, align: "center",  editable: true },
            { label: 'TELÉFONO', name: 'telefono', index: 'telefono', width: 120, align: "center", editable: true },
            { label: 'CORREO', name: 'correo', index: 'correo', width: 180, align: "center", editable: true },
            { label: 'HORARIO ATENCION', name: 'horario_atencion', index: 'horario_atencion', width: 150, align: "center", editable: true }
        ],
        shrinkToFit: false,
        width: $('.workspace').width(),
        height: $(window).height() * 0.32,
        rowNum: 500,
        rownumbers: true,
        rowNumWidth: 35,
        pager: '#navpersonal',
        sortname: 'id_personal',
        viewrecords: true,
        sortorder: "asc",
        onSelectRow: function (rowid, status, e) {
            idlast = rowid;
        }
    });

    personal.navGrid('#navpersonal', 
            { edit: false, add: false, del: false, view: true, search: false }, 
            { url: '' }, { url: '' }, { url: '' }
        ).jqGrid('navButtonAdd', '#navpersonal', {
            caption: " PDF",
            title: "Generar Ficha de Personal Clínico",
            buttonicon: "fa-solid fa-file-pdf",
            onClickButton: function() {
                if (!idlast) {
                    alert('Por favor, selecciona un registro de la tabla primero.');
                } else {
                    window.open('/personal/generar_pdf?id=' + idlast, '_blank');
                }
            },
            position: "last"
        });
});

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

function guardar() {
        let fd = new FormData(document.getElementById('formPersonal'));
        fetch('personal/agregar', {
            method: 'POST',
            body: fd
        })
        .then(() => {
            personal.trigger('reloadGrid');
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

        data = personal.jqGrid('getRowData', idlast);
        document.getElementById('nombre').value = data.nombre;
        document.getElementById('apellido').value = data.apellido;
        document.getElementById('especialidad').value = data.especialidad;
        document.getElementById('telefono').value = data.telefono;
        document.getElementById('correo').value = data.correo;
        document.getElementById('horario_atencion').value = data.horario_atencion;
    }
}

function editar() {
    const fd = new FormData(document.getElementById('formPersonal'));
    fd.append('id_personal', idlast);
    
    fetch('personal/editar', {
        method: 'POST',
        body: fd
    })
    .then(() => {
        idlast = null;
        personal.jqGrid('resetSelection');
        personal.trigger('reloadGrid');
    });
}

function eliminar() {
    if (!idlast) {
        alert('Selecciona un registro primero.');
    } else {
        if (confirm('¿Estás de acuerdo en eliminar este registro?')) {
            let fd = new FormData();
            fd.append('id_personal', idlast);
            
            fetch('personal/eliminar', {
                method: 'POST',
                body: fd
            })
            .then(() => {
                idlast = null;
                personal.jqGrid('resetSelection');
                personal.trigger('reloadGrid');
            });
        }
    }
}