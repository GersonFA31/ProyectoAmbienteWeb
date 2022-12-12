ajax();

function ajax() {
    let http = new XMLHttpRequest();
    http.open("POST", "php/productos.php");
    http.send(null);

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            cargarProductos(data);
        }
    }
}

function cargarProductos(productos) {
    productos.forEach(producto => {
        const id = producto.id;
        const img = producto.img;
        const nombre = producto.nombre;
        const precio = producto.precio;

        const imgProducto = document.createElement("img");
        imgProducto.src = "img/productos/" + img;
        imgProducto.alt = "Producto";
        imgProducto.classList.add("img"); //clase css

        const nombreProducto = document.createElement("h3");
        nombreProducto.textContent = nombre;

        const precioProducto = document.createElement("p");
        precioProducto.innerHTML = `₡ ${precio}`;

        const botonProducto = document.createElement("a");
        botonProducto.href = `admin/controller/carrito.php?ID=${id}`;
        botonProducto.className = "boton";
        botonProducto.innerHTML = "Agregar al carro";

        const cardCointainerDiv = document.createElement("div");
        cardCointainerDiv.className = "cardContainer";

        const cardDiv = document.createElement("div");
        cardDiv.className = "card";

        const cardSideDiv = document.createElement("div");
        cardSideDiv.className = "side front";

        const infoDiv = document.createElement("div");
        infoDiv.className = "info";

        infoDiv.appendChild(nombreProducto);
        infoDiv.appendChild(precioProducto);
        infoDiv.appendChild(botonProducto);
        cardSideDiv.appendChild(imgProducto);
        cardSideDiv.appendChild(infoDiv);

        cardDiv.appendChild(cardSideDiv);
        cardCointainerDiv.appendChild(cardDiv);

        document.querySelector("#productos").appendChild(cardCointainerDiv);
    });
}

function seleccionarProducto(e) {

    let producto;

    if (e.target.tagName === "DIV") {
        producto = e.target;
    } else {
        producto = e.target.parentElement;
    }

    if (producto.classList.contains("seleccionado")) {
        producto.classList.remove('seleccionado')
    } else {
        producto.classList.add('seleccionado')
    }
}