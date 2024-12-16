<section class="max-width bg" id="servicos">
    <div class="containerserv">
        <div class="conteudo">
            <div class="titulo">
                Título do conteúdo (opcional)
            </div>

            <input type="radio" name="slider" id="item-1" checked>
            <input type="radio" name="slider" id="item-2">
            <input type="radio" name="slider" id="item-3">

            <div class="cards">
                <label class="card" for="item-1" id="song-1" aria-label="Funk Song 1">
                    <div class="titulovideo">
                        <h1>FUNK</h1>
                        <div class="video">
                            <iframe id="video1" width="460" height="280"
                                src="https://www.youtube.com/embed/UfflDn4Mq_4?enablejsapi=1&autoplay=0"
                                title="Funk Song 1 Video" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                </label>

                <label class="card" for="item-2" id="song-2" aria-label="Funk Song 2">
                    <div class="titulovideo">
                        <h1>FUNK</h1>
                        <div class="video">
                            <iframe id="video2" width="460" height="280"
                                src="https://www.youtube.com/embed/CcCtKg6IYDY?enablejsapi=1&autoplay=0"
                                title="Funk Song 2 Video" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                </label>

                <label class="card" for="item-3" id="song-3" aria-label="Funk Song 3">
                    <div class="titulovideo">
                        <h1>FUNK</h1>
                        <div class="video">
                            <iframe id="video3" width="460" height="280"
                                src="https://www.youtube.com/embed/9ctGibE15o0?enablejsapi=1&autoplay=0"
                                title="Funk Song 3 Video" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                </label>
            </div>

        </div>
    </div>
</section>

<!-- API do YouTube -->
<script>
    let players = [];

    // Função para inicializar os players
    function onYouTubeIframeAPIReady() {
        players = [
            new YT.Player('video1', {
                events: {
                    'onReady': onPlayerReady
                }
            }),
            new YT.Player('video2', {
                events: {
                    'onReady': onPlayerReady
                }
            }),
            new YT.Player('video3', {
                events: {
                    'onReady': onPlayerReady
                }
            })
        ];
    }

    // Função chamada quando o player estiver pronto
    function onPlayerReady(event) {
        event.target.pauseVideo(); // Inicia pausando o vídeo
    }

    // Função para controlar os vídeos quando o botão de rádio é selecionado
    document.querySelectorAll('input[name="slider"]').forEach((radio, index) => {
        radio.addEventListener('change', () => {
            // Pausar todos os vídeos
            players.forEach(player => player.pauseVideo());

            // Reproduzir o vídeo correspondente ao rádio selecionado
            if (radio.checked) {
                players[index].playVideo();
            }
        });
    });
</script>

<!-- Carregar a API do YouTube -->
<script src="https://www.youtube.com/iframe_api"></script>