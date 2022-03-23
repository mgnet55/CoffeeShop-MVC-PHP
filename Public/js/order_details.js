function order_products(order_id, panel,button) {
    fetch(`/orderdetails?id=${order_id}`)
        .then(response => response.json())
        .then((data) => {
            let html = ''
            data.forEach(product => {
                html +=
                    `<div class="card col-2"><p class="card-header">${product['prd_name']}</p>
                        <div class="card-body">
                            <img class="card-img-top" src="/uploads/${product['image']}" alt="Card image cap">
                        </div>
                        <p class="card-footer">Quantity: ${product['quantity']}</p>
                    </div>
`
            });
            panel.innerHTML = html;
            button.onclick ='';
        });
}