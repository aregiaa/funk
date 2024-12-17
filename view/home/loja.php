<body>



    <div class="containerloja">
        <header class="headerloja">
            <div class="title">PRODUTOS</div>
            <div class="icon-cart"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                </svg>
                <span class="spanloja">0</span>
            </div>
        </header>

        <div class="listProduct">
            <div class="itemloja">
                <!-- <img src="./img/img1.png" alt="não existe">
                <h2 class="nomeProduto">Flak 2.0 XL</h2>
                <div class="price">R$ 136,00</div>
                <button class="addCart">
                    Adicionar ao carrinho
                </button> -->
            </div>
        </div>
    </div>

    <div class="cartTab">
        <h1>Carrinho de Compras</h1>
        <div class="listCart">
            <div class="itemloja" data-id="1">
                <div class="image">
                    <img src="produto.jpg" alt="Produto">
                </div>
                <div class="name">
                    <h2>Nome do Produto</h2>
                </div>
                <div class="totalPrice">
                    <h2>R$ 136,00</h2>
                </div>
                <div class="quantity">
                    <span class="minus">-</span>
                    <span>1</span>
                    <span class="plus">+</span>
                </div>
            </div>


        </div>

        <div class="botao">
            <button class="close">FECHAR</button>
            <button class="checkOut">Finalizar</button>
        </div>
    </div>
</body>
<script>
    let iconCart = document.querySelector('.icon-cart');
    let body = document.querySelector('body');
    let closeCart = document.querySelector('.close');
    let listProductHTML = document.querySelector('.listProduct');
    let carts = JSON.parse(localStorage.getItem('carts')) || []; // Carregar carrinho salvo
    let listProducts = [];
    let listCartHTML = document.querySelector('.listCart');
    let iconCartSpan = document.querySelector('.icon-cart span');

    // Abrir e fechar o carrinho
    iconCart.addEventListener('click', () => {
        body.classList.toggle('showCart');
    });
    closeCart.addEventListener('click', () => {
        body.classList.toggle('showCart');
    });

    // Carregar os produtos
    const initApp = () => {
        fetch('./json/produtos.json')
            .then(response => response.json())
            .then(data => {
                listProducts = data;
                addProductsToHTML();
                addCartToHTML();
                updateCartCount();
            })
            .catch(error => console.error('Erro ao carregar produtos:', error));
    };

    // Adicionar os produtos na tela
    const addProductsToHTML = () => {
        listProductHTML.innerHTML = '';
        if (listProducts.length > 0) {
            listProducts.forEach(product => {
                let newProduct = document.createElement('div');
                newProduct.classList.add('itemloja');
                newProduct.dataset.id = product.id;

                newProduct.innerHTML = `
                <img src="${product.image}" alt="${product.name}">
                <h2 class="nomeProduto">${product.name}</h2>
                <div class="price">R$ ${product.price}</div>
                <button class="addCart">Adicionar ao carrinho</button>
            `;
                listProductHTML.appendChild(newProduct);
            });
        }
    };

    // Adicionar ao carrinho
    listProductHTML.addEventListener('click', (event) => {
        if (event.target.classList.contains('addCart')) {
            let product_id = event.target.parentElement.dataset.id;
            addToCart(parseInt(product_id));
        }
    });

    const addToCart = (product_id) => {
        let productExists = carts.find(item => item.product_id === product_id);

        if (productExists) {
            productExists.quantity += 1;
        } else {
            carts.push({
                product_id,
                quantity: 1
            });
        }

        localStorage.setItem('carts', JSON.stringify(carts));
        updateCartCount();
        addCartToHTML();
    };

    // Remover do carrinho
    const removeFromCart = (product_id) => {
        let productIndex = carts.findIndex(item => item.product_id === product_id);

        if (productIndex !== -1) {
            if (carts[productIndex].quantity > 1) {
                carts[productIndex].quantity -= 1;
            } else {
                carts.splice(productIndex, 1); // Remove o item
            }

            localStorage.setItem('carts', JSON.stringify(carts));
            updateCartCount();
            addCartToHTML();
        }
    };

    // Atualizar quantidade no ícone
    const updateCartCount = () => {
        let totalQuantity = carts.reduce((sum, item) => sum + item.quantity, 0);
        iconCartSpan.innerText = totalQuantity;
    };

    // Renderizar o carrinho
    const addCartToHTML = () => {
        listCartHTML.innerHTML = '';
        if (carts.length > 0) {
            carts.forEach(item => {
                let product = listProducts.find(product => product.id === item.product_id);
                if (product) {
                    let newCartItem = document.createElement('div');
                    newCartItem.classList.add('itemloja');
                    newCartItem.dataset.id = product.id;

                    newCartItem.innerHTML = `
                    <div class="image">
                        <img src="${product.image}" alt="${product.name}">
                    </div>
                    <div class="name">
                        <h2>${product.name}</h2>
                    </div>
                    <div class="totalPrice">
                        <h2>R$ ${(product.price * item.quantity).toFixed(2)}</h2>
                    </div>
                    <div class="quantity">
                        <span class="minus">-</span>
                        <span>${item.quantity}</span>
                        <span class="plus">+</span>
                    </div>
                `;
                    listCartHTML.appendChild(newCartItem);
                }
            });
        }
    };

    // Eventos de clique para minus e plus
    listCartHTML.addEventListener('click', (event) => {
        let positionClick = event.target;

        if (positionClick.classList.contains('minus')) {
            let product_id = positionClick.closest('.itemloja').dataset.id;
            removeFromCart(parseInt(product_id));
        } else if (positionClick.classList.contains('plus')) {
            let product_id = positionClick.closest('.itemloja').dataset.id;
            addToCart(parseInt(product_id));
        }
    });

    // Inicializar a aplicação
    initApp();
</script>