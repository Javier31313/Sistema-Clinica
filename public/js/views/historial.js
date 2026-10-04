var clientes, idlast;
let offcanvas;
let data;
// let url;    
$(function () {
    // Configuración del JqGrid
    // Configuramos la tabla dinámica para que sea responsive
    //$.jgrid.defaults.responsive = true;

    // Aplicamos las clases de Bootstrap en la tabla dinámica
    $.jgrid.styleUI.Bootstrap5.base.rowTable = "table table-bordered table-hover table-sm ";
    $.jgrid.styleUI.Bootstrap5.base.rowNumTable = "table-dark";


    historial = $('#historial').jqGrid({
        url: 'historial/obtener_historial',
        datatype: "json",
        styleUI: "Bootstrap5",
        iconSet: "fontAwesome",
        mtype: "POST",
        colModel: [// Establece la estructura de la tabla dinamica
            /*{ label: 'ID', name: 'id', index: 'id', width: 100 },*/
            { label: 'ID HISTORIAL', name: 'id', index: 'id', width: 150, align: "center", key: true},
            { label: 'FECHA DE ULTIMA REGLA (FUR)', name: 'FUR', index: 'FUR', width: 250, align: "center", align: "center"},
            { label: 'ANTECEDENTES HEREDOFAMILIARES (AHF)', name: 'AHF', index: 'AHF', width: 320, align: "center"},
            { label: 'ANTECEDENTES NO PATOLÓGICOS (ANP)', name: 'ANP', index: 'ANP', width: 300, align: "center"},
            { label: 'HABITOS', name: 'habitos', index: 'habitos', width: 250, align: "center" },
            { label: 'ALERGIAS', name: 'alergias', index: 'alergias', width: 150, align: "center" },
            { label: 'LABORATORIO CLíNICO', name: 'labClinico', index: 'labClinico', width: 300, align: "center" },
            { label: 'ESTUDIOS PREVIOS', name: 'estudiosPrev', index: 'estudiosPrev', width: 300, align: "center" },
            { label: 'INDICACIONES MEDICAS', name: 'indicMedicas', index: 'indicMedi', width: 210, align: "center" },
            { label: 'RECOMENDACIONES NO FARMACOLÓGICAS', name: 'recNoFarmacologicas', index: 'recNoFarmacologicas', width: 310, align: "center"},
            { label: '', name: 'histVisitas', index: 'histVisitas', hidden: true, editable: true},
            { label: '', name: 'interconsultas', index: 'interconsultas', hidden: true, editable: true},
            { label: '', name: 'imgDiagnosticas', index: 'imgDiagnosticas', hidden: true, editable: true},
            { label: '', name: 'examFiscSeg', index: 'examFiscSeg', hidden: true, editable: true},
            { label: '', name: 'APP', index: 'APP', hidden: true, editable: true},
            { label: '', name: 'HEA', index: 'HEA', hidden: true, editable: true},
            { label: '', name: 'motivo', index: 'motivo', hidden: true, editable: true},
            { label: '', name: 'antecGinecoObstetricos', index: 'antecGinecoObstetricos', hidden: true, editable: true},
            { label: '', name: 'signosVitalesAct', index: 'signosVitalesAct', hidden: true, editable: true},
            { label: '', name: 'id_paciente', index: 'id_paciente', hidden: true, editable: true},
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
    historial.navGrid('', { edit: false, add: false, del: false, view: true, search: false, });
    SeleccionarId();
});

    let btnGuardar = document.getElementById('btnGuardar')

    btnGuardar.addEventListener('click', (e)=> {
    e.preventDefault();

    let fd = new FormData(document.getElementById('formRegistro'))
    fetch('/historial/agregar', {
        method: 'POST',
        body: fd
    })
    .then(()=> {
        historial.trigger('reloadGrid');
    })
 })

let btnFormBoostEditar = document.getElementById('btnFormBoostEditar');

let btnEditar = document.getElementById('btnEditar');

btnFormBoostEditar.addEventListener('click', ()=> {
    if(!idlast) { //Si idlast no existe
        alert('Selecciona un registro primero');
        return
    } else { // Si idlast existe
        offcanvas = bootstrap.Offcanvas.getOrCreateInstance(document.getElementById('offcanvasRight'));// Ejecutamos la funcion de boostrap para mostrar el offcanvas
        offcanvas.show(); //mostrar el offcanvas
        btnEditar.style.display = 'block';
        btnGuardar.style.display = 'none';

            data = historial.jqGrid('getRowData', idlast)
            document.getElementById('FUR').value = data.FUR
            document.getElementById('AHF').value = data.AHF
            document.getElementById('ANP').value = data.ANP
            document.getElementById('habitos').value = data.habitos
            document.getElementById('alergias').value = data.alergias
            document.getElementById('labClinico').value = data.labClinico
            document.getElementById('estudiosPrev').value = data.estudiosPrev
            document.getElementById('indicMedicas').value = data.indicMedicas
            document.getElementById('recNoFarmacologicas').value = data.recNoFarmacologicas
            document.getElementById('histVisitas').value = data.histVisitas
            document.getElementById('interconsultas').value = data.interconsultas
            document.getElementById('imgDiagnosticas').value = data.imgDiagnosticas
            document.getElementById('examFiscSeg').value = data.examFiscSeg
            document.getElementById('APP').value = data.APP
            document.getElementById('HEA').value = data.HEA
            document.getElementById('motivo').value = data.motivo
            document.getElementById('antecGinecoObstetricos').value = data.antecGinecoObstetricos
            document.getElementById('signosVitalesAct').value = data.signosVitalesAct
    }
    })

    btnEditar = document.getElementById('btnEditar');
    
    btnEditar.addEventListener('click', (e)=>{
        e.preventDefault();

        let fd = new FormData(document.getElementById('formRegistro'));
        fd.append('id', idlast)
        fetch('/historial/editar', {
            method: 'POST',
            body: fd
        })
        .then(()=> {
            historial.trigger('reloadGrid');
        })
    })

    btnFormBoostEliminar.addEventListener('click', ()=> {
        if(!idlast) {
            alert('Selecciona un registro primero')
        }else {
            if(confirm('¿Desea eliminar este registro?')){
                let fd = new FormData()
                fd.append('id', idlast)
                fetch('/historial/eliminar', {
                    method: 'POST',
                    body: fd
                })
                .then(()=> {
                    historial.trigger('reloadGrid')
                })
            }
        }
    })

    function SeleccionarId() {
        let select = document.getElementById('idSelect')
        fetch('/historial/findId')
        .then(response => response.json())
        .then(data => {
            for(let i = 0; i < data.length; i++) {
                let option = document.createElement("option")
                option.value = data[i].id
                option.textContent = data[i].id
                select.appendChild(option)
            }
        })
}


    let select
    select = document.getElementById('idSelect')
    select.addEventListener('change', ()=> { //Ten en encuenta que select no existe
        let idPaciente = select.value // idPaciente asimila el valor que trae el evento change

        document.getElementById('id_paciente_form').value = idPaciente // En el input hidden se almacena el valor de idPaciente
        
        historial.jqGrid('setGridParam', { postData:{id_paciente: idPaciente} }).trigger('reloadGrid')
    })