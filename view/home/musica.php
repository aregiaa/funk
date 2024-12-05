<form class="search-container">
    <input type="text" id="search-bar" placeholder="Busca">
    <a href="#"><img class="search-icon"
            src="http://www.endlessicons.com/wp-content/uploads/2012/12/search-icon.png"></a>
</form>
<div class="musica">
    <div class="boxMusica">
        <!-- <h1>Buscar Músicas no Spotify</h1> -->
        <input type="text" id="trackName" placeholder="Digite o nome da música" />

        <button id="searchButton">Buscar</button>

        <div id="albums"></div>



        <div id="musicResults">
        </div>

        <!-- <script>
                const CLIENT_ID = '71f2124d58744ac4948ffa5a1fe14b5c';
                const CLIENT_SECRET = '697e7e954244469aa469ec3f2d1ee25a';
                async function getAccessToken() {
                    const response = await fetch('https://accounts.spotify.com/api/token', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'Authorization': 'Basic ' + btoa(CLIENT_ID + ':' + CLIENT_SECRET),
                        },
                        body: 'grant_type=client_credentials',
                    });

                    const data = await response.json();
                    return data.access_token;
                }

             
                async function searchTracks(query) {
                    const token = await getAccessToken();
                    const response = await fetch(`https://api.spotify.com/v1/search?q=${query}&type=track&limit=10`, {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                        },
                    });

                    const data = await response.json();
                    displayTracks(data.tracks.items);  // Chama a função para exibir as músicas
                }

                // Função para exibir os resultados das músicas
                function displayTracks(tracks) {
                    const musicResults = document.getElementById('musicResults');
                    musicResults.innerHTML = '';  // Limpa os resultados anteriores

                    tracks.forEach(track => {
                        const trackElement = document.createElement('div');
                        trackElement.innerHTML = `
          <h3>${track.name}</h3>
          <p>Artista(s): ${track.artists.map(artist => artist.name).join(', ')}</p>
          <p>Álbum: ${track.album.name}</p>
          <img src="${track.album.images[0].url}" alt="${track.name}" style="width: 10px; height: 10px;" />
          <a href="${track.external_urls.spotify}" target="_blank">Ouvir no Spotify</a>
          <hr />
        `;
                        musicResults.appendChild(trackElement);
                    });
                }

                // Evento de clique no botão para buscar músicas
                document.getElementById('searchButton').addEventListener('click', function () {
                    const trackName = document.getElementById('trackName').value;
                    if (trackName) {
                        searchTracks(trackName);  // Chama a função para buscar músicas
                    } else {
                        alert('Por favor, insira o nome da música.');
                    }
                });
            </script> -->
    </div>

    <div class="comentarios">
        <div class="containerMusica">
            <div class="buttons">
                <button id="likeButton">Curtir</button>
            </div>

            <div id="likeStatus" style="margin-top: 10px; color:white">Curtido: 0</div>

            <div class="comment-section">
                <textarea id="commentBox" class="comment-box" placeholder="Escreva um comentário..."></textarea>
                <button id="postCommentButton">Postar Comentário</button>
                <ul id="commentsList" class="comments-list">

                </ul>
            </div>
        </div>
    </div>
</div>