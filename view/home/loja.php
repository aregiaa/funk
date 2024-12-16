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
                <img src="./img/img1.png" alt="não existe" width="200" height="100">
                <h2 class="nomeProduto">Flak 2.0 XL</h2>
                <div class="price">R$ 136,00</div>
                <button class="addCart">
                    Adicionar ao carrinho
                </button>
            </div>
        </div>
    </div>

    <div class="cartTab">
        <h1>Carrinho de Compras</h1>
        <div class="listCart">
            <div class="itemloja">
                <div class="image">
                    <img src="./img/img1.png" alt="">
                </div>
                <div class="name">
                    <h2>Flak 2.0 XL</h2>
                </div>
                <div class="totalPrice">
                    <h2>R$ 136,00</h2>
                </div>
                <div class="quantity">
                    <span class="minus">
                        <
                            </span>
                            <span>1</span>
                            <span class="plus">></span>
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
    let carts = [];
    let listProucts = []; // Variável corrigida
    let listCartHTML = document.querySelector('.listCart');
    let iconCartSpan = document.querySelector('.icon-cart span');

    iconCart.addEventListener('click', () => {
        body.classList.toggle('showCart');
    });
    closeCart.addEventListener('click', () => {
        body.classList.toggle('showCart');
    });

    // Carregar produtos e exibir na tela
    const initApp = () => {
        fetch('./json/produtos.json')
            .then(response => response.json())
            .then(data => {
                listProucts = data; // Atribui os dados do JSON
                addDataToHTML(); // Chama função para renderizar os produtos
            })
            .catch(error => console.error('Erro ao carregar produtos:', error));
    }

    // Função para renderizar produtos no HTML
    const addDataToHTML = () => {
        listProductHTML.innerHTML = ''; // Limpa a lista

        if (listProucts.length > 0) { // Verifica se há produtos
            listProucts.forEach(product => {
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
        listProductHTML.addEventListener('click', (event) => {
            let positionClick = event.target;
            if (positionClick.classList.contains('addCart')) {
                let product_id = positionClick.parentElement.dataset.id;
                alert(product_id)
            }
        })

        const addToCart = () => {
            if (carts.length <= 0) {
                carts = [{
                    product_id: product_id,
                    quantity: 1
                }]
            }
            console.log(carts); //erro aqui!!!!
        }
    }

    // Chama a inicialização
    initApp();
</script>