let likeCount = 0;
let comments = [];

// Função para curtir
document.getElementById("likeButton").addEventListener("click", function() {
  likeCount++;
  document.getElementById("likeStatus").textContent = "Curtido: " + likeCount;
});

// Função para compartilhar
document.getElementById("shareButton").addEventListener("click", function() {
  alert("Conteúdo compartilhado!");
});

// Função para adicionar comentário
document.getElementById("postCommentButton").addEventListener("click", function() {
  let commentText = document.getElementById("commentBox").value;
  if (commentText) {
    comments.push(commentText);
    updateComments();
    document.getElementById("commentBox").value = ''; // Limpa a caixa de comentário
  }
});

// Atualizar lista de comentários
function updateComments() {
  const commentsList = document.getElementById("commentsList");
  commentsList.innerHTML = ''; // Limpa lista existente
  comments.forEach((comment, index) => {
    const li = document.createElement("li");
    li.textContent = comment;
    commentsList.appendChild(li);
  });
}