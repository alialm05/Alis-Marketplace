import {removeFromCart, addToCart} from "../myCart/cart.js"; 

var itemsJson = null;
var cart = null;

const toggleCartButton = (btn, added) => {

    if (added){
        btn.classList.toggle('added');
        btn.innerText = '✔️';
    }else {
        btn.classList.remove('added');
        btn.innerText = '🛒'
    }

}

const getItems = async () => {
    
    console.log('Fetching items...');
    
    cart = localStorage.getItem("cart");
    cart = cart ? JSON.parse(cart) : { items: [] };
    
    const products = document.querySelector('.products');
    

    fetch('./catalogData.json')
    .then( async (response) => {    
        itemsJson = await response.json()
        console.log(itemsJson)
        
        itemsJson.map(item => {
            const product = document.createElement('div')
            const cartButton = document.createElement('button')
            cartButton.classList.add('add-to-cart');

            // chheck if already in cart
            if (cart.items.find(v => v.name === item.name)) {
                toggleCartButton(cartButton, true);
            }else {    
                toggleCartButton(cartButton, false);
            }
            
            cartButton.addEventListener('click', (e) => {

                e.preventDefault();
                
                if (cartButton.classList.contains('added')) {
                    removeFromCart(item);                
                    toggleCartButton(cartButton, false);
                    return;
                }
                
                addToCart(item);
                toggleCartButton(cartButton, true);

            })


            product.classList.add('product')
            
            product.innerHTML = `
                <img src="${item.src}" alt="${item.name} width="200" height="200">
                <h3>${item.name}</h3>
                <p>${item.description}</p>
                <span>
                    <strong>
                        $${item.price}
                    </strong>
                </span>
            `
            // Append the product to the products container 
            products.appendChild(product)
            product.querySelector('span').appendChild(cartButton)

        })
    
})
}

document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded and parsed');
    if (window.location.pathname.indexOf('/home') >= 0) {
        console.log('Home page detected, fetching items...');
        getItems();
    }
});