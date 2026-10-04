var citas, idlast;
let offcanvas;
let data;

function cargarPacientes() {
    fetch('citas/obtener_pacientes')
        .then(res => res.json())
        .then(data => {
            let select = document.getElementById('id');
            select.innerHTML = '<option value="">Seleccione un paciente...</option>';
            data.forEach(p => {
                select.innerHTML += `<option value="${p.id}">${p.id} - ${p.nombre}</option>`;
            });
        });
}

$(function () {$.jgrid.styleUI.Bootstrap5.base.rowTable = "table table-bordered table-hover table-sm ";
    $.jgrid.styleUI.Bootstrap5.base.rowNumTable = "table-dark";

    cargarPacientes();

    citas = $('#citas').jqGrid({
        url: 'citas/obtener_citas',
        datatype: "json",
        styleUI: "Bootstrap5",
        iconSet: "fontAwesome",
        mtype: "POST",
        colModel: [
            { label: 'EXPEDIENTE', name: 'id', index: 'id', width: 130, align: "center" },
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
    );
});

// Referencias a botones principales
let btnGuardar = document.getElementById('btnGuardar');
let btnEditar = document.getElementById('btnEditar');

// Abrir panel para AGREGAR un nuevo registro
let btnFormBoostAgregar = document.getElementById('btnFormBoostAgregar');
if (btnFormBoostAgregar) {
    btnFormBoostAgregar.addEventListener('click', () => {
        offcanvas = bootstrap.Offcanvas.getOrCreateInstance(document.getElementById('offcanvasRight'));
        offcanvas.show();

        // Limpiar los campos del formulario
        document.getElementById('formCitas').reset();

        // Mostrar el botón de Guardar y ocultar el de Editar
        if (btnGuardar) btnGuardar.style.display = "block";
        if (btnEditar) btnEditar.style.display = "none";

        // Vaciar la selección previa
        idlast = null;
        citas.jqGrid('resetSelection');
    });
}

// Guardar nueva cita
if (btnGuardar) {
    btnGuardar.addEventListener('click', (e) => {
        e.preventDefault();
        let fd = new FormData(document.getElementById('formCitas'));

        fetch('citas/agregar', {
            method: 'POST',
            body: fd
        })
        .then(() => {
            idlast = null;
            citas.jqGrid('resetSelection');
            citas.trigger('reloadGrid');
            bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasRight')).hide();
        });
    });
}

// Cargar datos en el formulario para EDITAR
let btnFormBoostEditar = document.getElementById('btnFormBoostEditar');
if (btnFormBoostEditar) {
    btnFormBoostEditar.addEventListener('click', () => {
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
            document.getElementById('id').value = data.id;
            document.getElementById('fecha').value = data.fecha;
            document.getElementById('hora').value = data.hora;
            document.getElementById('especialista').value = data.especialista;
            document.getElementById('consultorio').value = data.consultorio;
            document.getElementById('modalidad').value = data.modalidad;
        }
    });
}

// Guardar cambios al EDITAR
if (btnEditar) {
    btnEditar.addEventListener('click', (e) => {
        e.preventDefault();
        const fd = new FormData(document.getElementById('formCitas'));
        fd.append('id_cita', idlast);
        
        fetch('citas/editar', {
            method: 'POST',
            body: fd
        })
        .then(() => {
            idlast = null;
            citas.jqGrid('resetSelection');
            citas.trigger('reloadGrid');
            bootstrap.Offcanvas.getOrCreateInstance(document.getElementById('offcanvasRight')).hide();
        });
    });
}

// ELIMINAR cita
let btnFormBoostEliminar = document.getElementById('btnFormBoostEliminar');
if (btnFormBoostEliminar) {
    btnFormBoostEliminar.addEventListener('click', () => {
        if (!idlast) {
            alert('Selecciona un registro primero.');
        } else {
            if (confirm('¿Estás de acuerdo en eliminar este registro?')) {
                let fd = new FormData();
                fd.append('id_cita', idlast);
                
                fetch('citas/eliminar', {
                    method: 'POST',
                    body: fd
                })
                .then(() => {
                    idlast = null;
                    citas.jqGrid('resetSelection');
                    citas.trigger('reloadGrid');
                    bootstrap.Offcanvas.getOrCreateInstance(document.getElementById('offcanvasRight')).hide();
                });
            }
        }
    });
}