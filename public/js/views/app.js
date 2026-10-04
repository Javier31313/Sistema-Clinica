let card = document.getElementById('cardP')
fetch('/dashboard/pacientesTotales')
.then(response => response.json())
.then(data => {
        let p = document.createElement("p")
        p.value = data[0].num
        p.textContent = data[0].num
        card.appendChild(p);
})