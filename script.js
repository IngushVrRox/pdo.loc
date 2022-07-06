const league = document.getElementById('form-league')
const time = document.getElementById('form-time')
const player = document.getElementById('form-player')

const send = async function(data, text = false) {
    return await fetch('/controllers/Controller.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => { return text ? response.text() : response.json() });
}

player.player.onchange = async function (e) {
    e.preventDefault();
    await send({ event: 'player', id: this.value})
        .then(res => player.children[2].innerHTML = res)
}

time.send.onclick = async function (e) {
    e.preventDefault();
    await send({ event: 'time', from: time.from.value, to: time.to.value }, true)
        .then(str => new window.DOMParser().parseFromString(str, "text/xml"))
        .then(data => time.children[5].innerHTML = data['activeElement']['innerHTML']);
}

league.league.onchange = async function(e) {
    e.preventDefault();
    await send({ event: 'league', lg: this.value }, true)
        .then(res => league.children[2].innerHTML = res)
}

