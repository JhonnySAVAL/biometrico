function copiarFeriados(añoOrigen) {
    document.getElementById("anioOriginal").value = añoOrigen;
    
    fetch(`/biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=ObtenerFeriadosPorAno&anio=${añoOrigen}`)
        .then(response => response.json())
        .then(data => {
            const listaFeriados = document.getElementById("feriadosLista");
            listaFeriados.innerHTML = ""; // Limpiar la lista antes de agregar los nuevos elementos
            data.forEach(feriado => {
                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.id = `feriado-${feriado.idFeriado}`;
                checkbox.name = "feriados[]";
                checkbox.value = feriado.idFeriado;
                
                const label = document.createElement("label");
                label.setAttribute("for", `feriado-${feriado.idFeriado}`);
                label.innerText = `${feriado.nombre} - ${feriado.fecha}`;
                
                const div = document.createElement("div");
                div.appendChild(checkbox);
                div.appendChild(label);
                
                listaFeriados.appendChild(div);
            });
        })
        .catch(error => {
            console.error("Error al cargar los feriados:", error);
        });
}

function confirmarCopiarFeriados() {
    const form = document.getElementById("formCopiarFeriado");
    const feriadosSeleccionados = Array.from(document.querySelectorAll('input[name="feriados[]"]:checked')).map(input => input.value);

    if (feriadosSeleccionados.length === 0) {
        return alert("Por favor, selecciona al menos un feriado para copiar.");
    }

    const inputSeleccionados = document.createElement("input");
    inputSeleccionados.type = "hidden";
    inputSeleccionados.name = "feriadosSeleccionados";
    inputSeleccionados.value = JSON.stringify(feriadosSeleccionados);

    form.appendChild(inputSeleccionados);
    form.submit();
}

document.getElementById("tipo").addEventListener("change", function() {
    const anioDiv = document.getElementById("anioDiv");
    if (this.value === "anual") {
        anioDiv.style.display = "block";
    } else {
        anioDiv.style.display = "none";
    }
});
document.getElementById('anioOriginal').addEventListener('change', function() {
    var anio = this.value;
    fetch('/biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=obtenerFeriadosPorAnio&anio=' + anio)
        .then(response => response.json())
        .then(data => {
            var feriadosLista = document.getElementById('feriadosLista');
            feriadosLista.innerHTML = ''; 

            data.forEach(function(feriado) {
                var checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'feriados[]';
                checkbox.value = feriado.idFeriado;
                var label = document.createElement('label');
                label.textContent = feriado.nombre + ' (' + feriado.fecha + ')';
                var div = document.createElement('div');
                div.appendChild(checkbox);
                div.appendChild(label);
                feriadosLista.appendChild(div);
            });
        });
});