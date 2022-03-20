window.onload = updateCart();

function readLocalStorage() {

    return localStorage.cartItems ? JSON.parse(localStorage.cartItems) : {};
}

function addToCart(id, name, unitPrice, image) {
    console.log('invoked')
    let items = readLocalStorage();
    if (items[id]) {
        items[id].quantity += 1;
        items[id]['total'] =  Math.round(items[id]['total']+ unitPrice)
    } else {
        items[id] = {name, unitPrice, quantity: 1, image, total: unitPrice};
    }
    localStorage.cartItems = JSON.stringify(items);
    updateCart();
}

function deleteFromCart(id) {
    let items = readLocalStorage();
    delete items[id];
    localStorage.cartItems = JSON.stringify(items);
    updateCart()
}

function updateCart() {
    //update total price element
    let cartTotalPrice = 0
    let html = '';
    let container = document.getElementById('cartSection');
    const items = readLocalStorage();
    for (const index in items) {
        cartTotalPrice += items[index]['total']
        html += `
        <tr>
            <td><img src="/uploads/${items[index].image}" class="product-thumb" width="50px" alt="Product"></td>
            <td>
                <div class="product-item">
                    <div class="product-info"><h4 class="product-title">${items[index].name}</h4></div>
                </div>
            </td>
            <td class="text-center">${items[index].quantity}</td>
            <td class="text-center text-lg text-medium">$${items[index].total}</td>
            <td class="text-danger text-center text-lg" onclick="deleteFromCart(${index})"><i class="fa-solid fa-trash "></i></td>
        </tr>`;
    }
    container.innerHTML = html;
    document.getElementById('totalcart').innerHTML = Math.round(cartTotalPrice)+" EGP";
}

function clearCart() {
    localStorage.removeItem('cartItems');
    updateCart();
}

function sendOrder() {
    let order = {};
    const items = readLocalStorage();
    for (const id in items) {
        order[id] = items[id].quantity;
    }
    order = JSON.stringify(order);

    fetch('/neworder', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: order,
    })
        .then(response => response.json())
        .then(data => {
            if (data['success']) {
                updateCart();
                clearCart();
                Swal.fire(
                    'Good job!',
                    'Order has been sent!',
                    'success'
                )
            } else {
                Swal.fire(
                    'Failed!',
                    'Order has not been sent!',
                    'error')
            }
        })
        .catch(() => {
            Swal.fire(
                'Failed!',
                'Order has not been sent!',
                'error')
        });

}