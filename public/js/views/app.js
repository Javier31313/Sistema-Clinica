document.addEventListener('DOMContentLoaded', ()=> {
        totalPacientes();
        citasTotales();
})

// Pacientes totales
function totalPacientes() {
let card = document.getElementById('cardP')
fetch('/dashboard/pacientesTotales')
.then(response => response.json())
.then(data => {
        let p = document.createElement("p")
        p.value = data[0].num
        p.textContent = data[0].num
        card.appendChild(p);
})
}


// Citas totales
function citasTotales() {
let cardC = document.getElementById('cardC')
fetch('/dashboard/citasTotales')
.then(response => response.json())
.then(data => {
        let p = document.createElement("p")
        p.value = data[0].numCita
        p.textContent = data[0].numCita
        cardC.appendChild(p);
});
}