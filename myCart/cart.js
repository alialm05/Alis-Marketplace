var cart = null;

const removeFromCart = (item) => {
    
    let cart = localStorage.getItem('cart');
    cart = cart ? JSON.parse(cart) : cart = { items: [] };

    cart.items = cart.items.filter(v => v.name != item.name);
    localStorage.setItem('cart', JSON.stringify(cart));
    console.log(`currentCart: `, cart);
    
}

const addToCart = (item) => {

    let cart = localStorage.getItem('cart');
    cart = cart ? JSON.parse(cart) : cart = { items: [] };

    cart.items.push(item);
    localStorage.setItem('cart', JSON.stringify(cart));
}

const getItemsInCart = async () => {
    
    const cartContainer = document.querySelector('.cart');
    
    cart = localStorage.getItem("cart");
    cart = cart ? JSON.parse(cart) : { items: [] };    
    
    cart.items.map(item => {
        const itm = document.createElement('div')
        const rmFromCart = document.createElement('button')
        
        rmFromCart.classList.add('rm-from-cart');
        rmFromCart.textContent = '🗑️'
        
        rmFromCart.addEventListener('click', (e) => {
            
            // Prevents the button from refreshing the page when clicked
            e.preventDefault();

            removeFromCart(item);
            console.log(cart);
            cartContainer.removeChild(itm);

        })


        itm.classList.add('cartItem')
        
        itm.innerHTML = `
            <img src="${item.src}" alt="${item.name} width="200" height="200">
            <h3>${item.name}</h3>
            <span>
                <strong>
                    $${item.price}
                </strong>
            </span>
        `
        // Append the product to the products container 
        cartContainer.appendChild(itm)
        itm.querySelector('span').appendChild(rmFromCart)

    })
}



document.addEventListener('DOMContentLoaded', () => {
    if (window.location.pathname.indexOf('/myCart') >= 0) {
        console.log('Cart page detected.');
        getItemsInCart()

    }
});

export {removeFromCart, addToCart};