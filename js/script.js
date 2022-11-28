ajax();

function ajax(){
    let http = new XMLHttpRequest();
    http.open("POST","texto.txt");
    http.send(null);

    http.onreadystatechange = function(){
        console.log(this);
    }
    
   /* http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200){
            let data = JSON.parse(this.responseText);
            cargarProductos(data);
        }
    }*/
}


function cargarProductos(productos) {
    productos.forEach(producto => {
        const img = producto.img;
        const nombre = producto.nombre;
        const precio = producto.precio;
    
        const imgProducto = document.createElement("img");
        imgProducto.src = "img/productos/" + img;
        imgProducto.alt = "Producto";
    
        const nombreProducto = document.createElement("h3");
        nombreProducto.textContent = nombre;
    
        const precioProducto = document.createElement("p");
        precioProducto.innerHTML = `₡ ${precio}`;
    
        const productoDiv = document.createElement("div");
        productoDiv.classList.add("producto");
        productoDiv.onclick = seleccionarProducto;
        productoDiv.appendChild(imgProducto);
        productoDiv.appendChild(nombreProducto);
        productoDiv.appendChild(precioProducto);
    
        document.querySelector("#productos").appendChild(productoDiv);
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
    }else{
        producto.classList.add('seleccionado')
    }

}