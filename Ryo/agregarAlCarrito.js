let productosEnCarrito = {};

function agregarAlCarrito(nombreProducto, precioProducto) {
    if (productosEnCarrito[nombreProducto]) {
        productosEnCarrito[nombreProducto]++;
    } else {
        productosEnCarrito[nombreProducto] = 1;
    }

    actualizarCanastaPrincipal();
    actualizarTotal();
}

function actualizarCanastaPrincipal() {
    const contadorCarrito = document.getElementById("cart-counter");
    let cantidadTotal = Object.values(productosEnCarrito).reduce((total, cantidad) => total + cantidad, 0);
    contadorCarrito.textContent = "(" + cantidadTotal + ")";
}

function actualizarTotal() {
    let total = 0;
    for (const producto in productosEnCarrito) {
        let cantidad = productosEnCarrito[producto];
        let precioUnitario = obtenerPrecioProducto(producto);
        total += cantidad * precioUnitario;
    }
    document.getElementById("total").textContent = total.toFixed(2);
}

function obtenerPrecioProducto(nombreProducto) {
    // Implementación para obtener el precio del producto según su nombre
    switch (nombreProducto) {
        case "Dog chow":
            return 299; // Precio del Dog chow
        case "Pedigree":
            return 99; // Precio del Pedigree
        case "Nupec":
            return 599; // Precio de Nupec
        case "Royal":
            return 499; // Precio de Royal
        case "Catchow":
            return 199; // Precio de Royal
        case "Pasta":
            return 89; // Precio Pasta
        case "Shampoo":
                return 131; // Precio shampoo
        case "Sobre":
                return 19; // Precio Sobre
        // Agrega lógica similar para los demás productos
        default:
            return 0; // Precio predeterminado para productos no encontrados
    }
}

document.querySelectorAll(".add-cart").forEach(item => {
    item.addEventListener("click", function() {
        let nombreProducto = this.parentNode.parentNode.querySelector("h3").textContent.trim();
        let precioProducto = parseFloat(this.parentNode.parentNode.querySelector(".price").textContent.trim().replace("$", ""));
        agregarAlCarrito(nombreProducto, precioProducto);
    });
});

document.querySelector(".content-shopping-cart").addEventListener("click", function() {
    irATicket();
});

document.getElementById("cart-button").addEventListener("click", function() {
    irATicket();
});

function irATicket() {
    let urlTicket = "ticket.html?";
    for (const producto in productosEnCarrito) {
        urlTicket += encodeURIComponent(producto) + "=" + encodeURIComponent(productosEnCarrito[producto]) + "&";
    }
    window.location.href = urlTicket;
}

window.onload = actualizarTotal;

function eliminarProducto(event) {
    const productoAEliminar = event.target.parentNode;
    const Pedigree = productoAEliminar.querySelector("Pedigree").textContent.trim();
    delete productosEnCarrito[Pedigree]; // Eliminar el producto del objeto productosEnCarrito
    productoAEliminar.remove(); // Eliminar el elemento del DOM
    actualizarTotal(); // Actualizar el total después de eliminar el producto
    actualizarCanastaPrincipal(); // Actualizar el contador del carrito
}

