// Seleciona todos os itens .lineuser
document.querySelectorAll('.lineuser').forEach(item => {
    // Adiciona um ouvinte de evento de clique a cada item
    item.addEventListener('click', () => {
      // Alterna a classe 'active' no item, que faz a animação e mostra/oculta o conteúdo
      item.classList.toggle('active');
    });
  });
  