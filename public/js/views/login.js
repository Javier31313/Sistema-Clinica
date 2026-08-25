let ui;
document.addEventListener('DOMContentLoaded' , () => {
document.addEventListener('submit', (e) => {
    e.preventDefault() //evitamos la recarga de la página
    const fd = new FormData(document.getElementById('login-form'));
    fetch('/auth/verificar' , {
        method: 'POST',
        body: fd
    })
    .then(response => response.json())
    .then(data => {
        if(data.res)
            window.location = '/clientes';//cargar una pagina diferente
         else {
            if(data.message == 'Usuario incorrecto') {
                ui = document.getElementById('user-info');
            } else {
                ui = document.getElementById('pass-info');
            }
            ui.classList.remove('hide');
            ui.textContent = data.message;
        }        
    })
})
});
