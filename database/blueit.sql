--
-- File generated with SQLiteStudio v3.2.1 on seg dez 17 14:17:18 2018
--
-- Text encoding used: System
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: channel
DROP TABLE IF EXISTS channel;

CREATE TABLE channel (
    id                   INTEGER PRIMARY KEY,
    name                 VARCHAR NOT NULL
                                 UNIQUE,
    subscription_counter INTEGER NOT NULL
                                 DEFAULT (1),
    description          VARCHAR NOT NULL,
    image                VARCHAR
);

INSERT INTO channel (
                        id,
                        name,
                        subscription_counter,
                        description,
                        image
                    )
                    VALUES (
                        1,
                        'science',
                        17,
                        'Want to stay in touch with the latest science trends? Then grab a chair and read some stories.',
                        '../assets/channels/science.jpg'
                    );

INSERT INTO channel (
                        id,
                        name,
                        subscription_counter,
                        description,
                        image
                    )
                    VALUES (
                        2,
                        'news',
                        8,
                        'This  is the place for meaningful stories about the latest world events.',
                        '../assets/channels/news.jpg'
                    );

INSERT INTO channel (
                        id,
                        name,
                        subscription_counter,
                        description,
                        image
                    )
                    VALUES (
                        3,
                        'funny',
                        17,
                        'Funny place for funny people. Tell us your best joke.',
                        '../assets/channels/funny.jpg'
                    );

INSERT INTO channel (
                        id,
                        name,
                        subscription_counter,
                        description,
                        image
                    )
                    VALUES (
                        4,
                        'gaming',
                        4,
                        'A subreddit for anything game related. Discuss video games, board games, card games, etc..',
                        '../assets/channels/gaming.jpg'
                    );


-- Table: comment
DROP TABLE IF EXISTS comment;

CREATE TABLE comment (
    post_id     INTEGER PRIMARY KEY
                        REFERENCES post,
    parent_post INTEGER REFERENCES post (id) 
);

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        2,
                        1
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        3,
                        2
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        4,
                        3
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        6,
                        NULL
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        7,
                        NULL
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        8,
                        1
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        12,
                        3
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        13,
                        1
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        14,
                        1
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        27,
                        26
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        28,
                        26
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        29,
                        26
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        30,
                        26
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        31,
                        26
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        32,
                        26
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        33,
                        26
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        34,
                        26
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        35,
                        26
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        39,
                        38
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        40,
                        38
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        41,
                        38
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        42,
                        38
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        43,
                        38
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        44,
                        38
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        45,
                        38
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        46,
                        38
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        47,
                        38
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        48,
                        38
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        49,
                        38
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        51,
                        50
                    );

INSERT INTO comment (
                        post_id,
                        parent_post
                    )
                    VALUES (
                        53,
                        52
                    );


-- Table: post
DROP TABLE IF EXISTS post;

CREATE TABLE post (
    id              INTEGER PRIMARY KEY,
    content         VARCHAR NOT NULL,
    posted_at       INTEGER NOT NULL
                            DEFAULT (strftime('%s', 'now') ),
    user_id         INTEGER REFERENCES user,
    upvotes_count   INTEGER NOT NULL
                            DEFAULT (0),
    downvotes_count INTEGER NOT NULL
                            DEFAULT (0) 
);

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     1,
                     '[deleted]',
                     1543925303,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     2,
                     'O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset, que continham passagens com Lorem Ipsum, e mais recentemente com os programas de publicação como o Aldus PageMaker que incluem versões do Lorem Ipsum.

',
                     1543925303,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     3,
                     '[deleted]',
                     1543925303,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     4,
                     'O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset, que continham passagens com Lorem Ipsum, e mais recentemente com os programas de publicação como o Aldus PageMaker que incluem versões do Lorem Ipsum.

',
                     1543925303,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     5,
                     '1543925303',
                     1543925303,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     6,
                     '[deleted]',
                     1543925303,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     7,
                     '[deleted]',
                     1543925303,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     8,
                     '[deleted]',
                     1543925303,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     12,
                     '[deleted]',
                     1544123642,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     13,
                     'ola',
                     1544124026,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     14,
                     'ola',
                     1544124159,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     21,
                     '[deleted]',
                     1544458728,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     24,
                     '[deleted]',
                     1544458839,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     25,
                     '[deleted]',
                     1544459031,
                     1,
                     0,
                     1
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     26,
                     '[deleted]',
                     1544459094,
                     1,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     27,
                     'afdasf',
                     1544629369,
                     NULL,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     28,
                     'amsmDKLMSDAs',
                     1544630217,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     29,
                     'aklsMKLSADMLKSAF /u/teste
',
                     1544630229,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     30,
                     'adsdaasdas /u/teste
',
                     1544633466,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     31,
                     '/u/teste
',
                     1544633547,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     32,
                     'ewrqw /u/teste',
                     1544633618,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     33,
                     '/u/teste',
                     1544633685,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     34,
                     'Array',
                     1544633797,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     35,
                     'Array',
                     1544633817,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     36,
                     '[deleted]',
                     1544634981,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     37,
                     '[deleted]',
                     1544635003,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     38,
                     '[deleted]',
                     1544636712,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     39,
                     '/c/news',
                     1544636819,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     40,
                     '/u/teste',
                     1544636824,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     41,
                     '<a href="./profile.php?user=teste" class="author-name">teste</a>/',
                     1544636853,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     42,
                     '<a href="./profile.php?user=teste" class="author-name">teste</a>',
                     1544636891,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     43,
                     'asdas',
                     1544637139,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     44,
                     '<a href="./profile.php?channel=news" class="sc_channel">news</a>',
                     1544637203,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     45,
                     '<a href="./profile.php?channel=news" class="sc_channel">news</a>',
                     1544637216,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     46,
                     '<a href="./profile.php?channel=news" class="sc_channel">news</a>',
                     1544637261,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     47,
                     '<a href="./profile.php?channel=news" class="sc_channel">news</a>',
                     1544637269,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     48,
                     '<a href="./profile.php?channel=news" class="sc_channel">news</a>',
                     1544637308,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     49,
                     'iosakmadsfsadf',
                     1544637314,
                     3,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     50,
                     '<p><img src="https://bordalo.observador.pt/800x,q85/https://s3.observador.pt/wp-content/uploads/2018/11/30071947/lusa2015_jc04-1_770x433_acf_cropped.jpg" alt="josé socrates" /></p>
<p>A <em>SIC</em> apresenta a maior investigação judicial da democracia portuguesa. Uma reportagem que mostra um homem combativo, que confronta os investigadores com as fragilidades que encontrou na Operação Marquês. O ex-primeiro ministro, José Sócrates, é a figura central no processo.</p>
<h1>Uma acusação injusta?</h1>
<p>Desde o primeiro dia que José Sócrates contesta a investigação: acusa-a de ser persecutória, desprovida de provaslenta a investigar e a acusar, fechada aos arguidos, mas exposta na comunicação social. José Sócrates foi interrogado três vezes.</p>
<p>A primeira, quando foi detido e as restantes em 2015 e 2017. São estes dois últimos interrogatórios que estão na Grande Reportagem. José Sócrates, O Confronto mostra um homem combativo, que confronta os investigadores com as fragilidades que encontrou no processo.</p>',
                     1544920508,
                     4,
                     2,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     51,
                     'O Governo francês manifestou este domingo a esperança de que o protesto dos "coletes amarelos" chegue ao fim, depois de no sábado a mobilização ter registado um acentuado declínio. ',
                     1544970678,
                     4,
                     1,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     52,
                     '<p><em>Benfica entrou melhor mas parcial de 8-0 do FC Porto em 12 minutos foi decisivo no clássico: dragões vencem águias por 28-24 na 12.ª jornada e alcançam Sporting na liderança do Campeonato de andebol.</em></p>
<p><img src="https://bordalo.observador.pt/800x,q85/https://s3.observador.pt/wp-content/uploads/2018/12/01200514/doc-20171213-23405629-mar_8807_770x433_acf_cropped-1.jpg" alt="imagem" /></p>
<p>Phil Jackson foi um dos melhores treinadores de sempre de basquetebol mas há uma frase que pesa tanto no seu legado como os 11 títulos de campeão nos Chicago Bulls e nos Los Angeles Lakers – “<strong>Os ataques ganham jogos, as defesas ganham campeonatos</strong>”. E essa ideia ainda hoje é utilizada por técnicos das mais variadas modalidades, na sua forma original ou nas variantes como a que foi feita por um dos melhores atletas de todos os tempos. “O primeiro passo para se ganhar será uma defesa coesa. Um dia Michael Jordan disse que uma boa equipa com um bom ataque consegue ganhar jogos, mas uma boa equipa com uma defesa permite ganhar campeonatos. O ataque é normalmente mais divertido, todos os jogadores estão habituados a jogar com bola, mas necessitamos de atletas capazes de jogar sem bola na defesa”, dizia Carlos Resende no lançamento do clássico.</p>
<h1>E como vai o sporting?</h1>
<p>Com o Sporting a manter a mesma regularidade que lhe permitiu ganhar os últimos dois Campeonatos (e chegar a uma inédita qualificação para os oitavos da Liga dos Campeões), a clara melhoria do FC Porto e do Benfica promete promover uma prova disputada até às derradeiras jornadas. No lado dos dragões, a chegada do sueco Magnus Andersson ao comando técnico trouxe outra qualidade à equipa, que melhorou e muito sobretudo na defesa (permitindo feitos históricos como o triunfo frente ao Magdeburgo que deu entrada na fase de grupos da Taça EHF); em relação às águias, percebe-se que a manutenção do treinador e das principais unidades com um reforço de peso na baliza (Ristovski) permitiu dar continuidade ao projeto que teve início da última temporada. É por isso que os clássicos ganharam agora outro peso nas decisões. E, no deste sábado, o conjunto azul e branco foi mais forte (28-24), igualando assim o Sporting na liderança da classificação.</p>
<h1>E o Benfica?</h1>
<p>O Benfica até começou melhor o encontro mas a primeira parte iria resumir-se numa única frase: a melhor fase dos encarnados até ao intervalo, com um parcial de 5-0, ficou aquém da melhor fase dos azuis e brancos, que viraram na resposta com um 8-0. Houve outros fatores que pesaram na decisão do clássico mas foi no “fosso” de cinco golos criado pelo FC Porto que acabou por estar a chave de uma partida onde a defesa das águias ainda conseguiu ser superior na primeira metade, deixando em branco o ataque dos dragões durante sete minutos quando o rival estava em inferioridade numérica (de 3-5 chegou aos 8-5). Depois, em 12 minutos, houve um eclipse tão grande que até golos sem guarda-redes na baliza foram falhados: os visitados foram recuperando, passaram para a frente e alargaram a vantagem aos cinco golos quase em cima do intervalo (13-8).</p>
<p>No segundo tempo, logo no arranque e sensivelmente a meio, o Benfica ainda reduziu para apenas dois golos de diferença mas o FC Porto foi conseguindo sempre gerir o resultado beneficiando das intervenções decisivas de Alfredo Quintana em muitas bolas que podiam ter alterado o sentido da partida. E quando Resende fala, e bem, na importância da defesa, há também no andebol essa figura fulcral do guarda-redes que, este sábado, teve mais destaque no luso-cubano (14 defesas em 37 remates, com uma eficácia de 38%) do que em Ristovski. No final, os dragões ganharam por 28-24 num jogo onde o central encarnado Pedro Seabra foi o melhor marcador com seis golos, seguido do lateral azul e branco André Gomes (cinco).</p>',
                     1544972223,
                     5,
                     1,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     53,
                     'Isto é tudo muito fixe..
<a href="./profile.php?user=josesocrates" class="author-name">josesocrates</a> que tens a dizer?',
                     1544972527,
                     5,
                     0,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     54,
                     '<p><img src="https://i.imgur.com/0nOGMw2.jpg" alt="baterias" /></p>
<p>A notícia está a criar grande entusiasmo junto da comunidade científica internacional e a razão prende-se essencialmente com o facto de se poder estar perante uma nova geração de baterias sólidas, capazes de armazenar muito mais energia do que as de ião de lítio, com uma vida muito mais longa, mais seguras e não poluentes. A garantia chega-nos através de <strong>Maria Helena Braga, investigadora do Departamento de Engenharia Física da Faculdade de Engenharia da U.Porto (FEUP),</strong> que há mais de dois anos se dedica ao estudo de materiais para o armazenamento de energia em baterias.</p>
<p>A principal inovação destas novas baterias é fazer depender a capacidade de armazenamento de energia a partir do ânodo, em vez do tradicional cátodo, através de um eletrólito sólido de vidro, que permite a utilização de um ânodo construído em metais alcalinos sem a formação de “dendritos” (curto-circuitos internos). Estes elementos podem surgir em baterias de lítio tradicionais, que usam eletrólitos líquidos, levando a curtos circuitos internos que provocam incêndios rápidos e até mesmo explosões.</p>
<p>A tecnologia de eletrólitos em vidro foi desenvolvida por Maria Helena Braga e tem ainda a vantagem de poder operar em temperaturas muito baixas, outro benefício relativamente às baterias de lítio atuais. Isso poderá revolucionar todo o paradigma dos carros elétricos, por exemplo, uma vez que com estas novas baterias vão poder operar a temperaturas de -60 graus celsius.</p>
<p><strong>Maria Helena Braga</strong>, 45 anos, publicou pela primeira vez sobre a tecnologia de eletrólitos de vidro em 2014 quando desenvolvia investigação na FEUP. De imediato recebeu inúmeros telefonemas e pedidos de contacto, um deles de Andy Murchison, investigador norte-americano da Universidade do Texas, que conhecia bem John Goodenough, o inventor das baterias de iões de lítio. Com 94 anos de idade e ainda no ativo, Goodenough desafiou a investigadora portuguesa a trabalhar com ele de maneira a provar que a tecnologia de eletrólitos de vidro funcionava, de facto.</p>
<p><em>“Durante um ano vim muitas vezes a UT-Austin e em fevereiro de 2016 pedi equiparação a bolseiro para fazer trabalho em baterias com lítio-metálico que não podia fazer na FEUP porque à data não tinha laboratório e muito menos caixa de luvas que é absolutamente essencial para este trabalho, uma vez que o lítio reage violentamente na presença de humidade e oxida facilmente”, explica Maria Helena Braga.
</em></p>',
                     1544973192,
                     5,
                     1,
                     0
                 );

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     55,
                     '<p><img src="https://insider.dn.pt/files/2018/08/fortnite-5-960x540_c.jpg" alt="fortnite" /></p>
<p><strong>Não é de todo uma grande surpresa, já que foi a própria Epic Games, a responsável pelo jogo, a fazer um ‘spoiler’, ao partilhar uma imagem da próxima atualização do jogo, onde é visível a chegada de novo armamento ao jogo que movimenta milhões.</strong></p>
<p>Fortnite é atualizado frequentemente, para incluir novidades, como skins (vestuário para as personagens) e, neste caso, novo armamento, como espadas. A confirmação chegou através do Twitter da Epic Games, onde muitas vezes são anunciadas as novidades a caminho do jogo do estilo battle royale.</p>
<p>E por que razão é que a chegada das espadas está a movimentar curiosidade? Até ao momento, em Fortnite, que coloca cem jogadores em modo de batalha, onde apenas um pode sobreviver, há pouco armamento do género disponível – a opção mais parecida é uma espécie de picareta. A questão é que não é um tipo de arma com muitas valências para os momentos de combate contra outros jogadores. Para maior dano, os jogadores podem recorrer a um arsenal de armas de fogo.</p>',
                     1545001820,
                     6,
                     0,
                     0
                 );


-- Table: story
DROP TABLE IF EXISTS story;

CREATE TABLE story (
    post_id    INTEGER PRIMARY KEY
                       REFERENCES post,
    channel_id         REFERENCES channel,
    title      VARCHAR NOT NULL
);

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      1,
                      1,
                      '[deleted]'
                  );

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      3,
                      1,
                      '[deleted]'
                  );

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      21,
                      1,
                      '[deleted]'
                  );

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      24,
                      3,
                      '[deleted]'
                  );

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      25,
                      2,
                      '[deleted]'
                  );

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      26,
                      4,
                      '[deleted]'
                  );

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      36,
                      2,
                      '[deleted]'
                  );

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      37,
                      2,
                      '[deleted]'
                  );

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      38,
                      2,
                      '[deleted]'
                  );

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      50,
                      2,
                      'Primo José Paulo recebeu de um angolano o apartamento de luxo na Ericeira onde Sócrates vive'
                  );

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      52,
                      3,
                      'FC Porto vence Benfica no Dragão e cola-se ao Sporting na liderança do Campeonato de andebol'
                  );

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      54,
                      1,
                      'Investigadora da FEUP lidera invenção de bateria revolucionária'
                  );

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      55,
                      4,
                      'Fortnite: as espadas vão chegar ao jogo do momento'
                  );


-- Table: subscription
DROP TABLE IF EXISTS subscription;

CREATE TABLE subscription (
    user_id    INTEGER REFERENCES user,
    channel_id INTEGER REFERENCES channel,
    PRIMARY KEY (
        user_id,
        channel_id
    )
);

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             1,
                             2
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             1,
                             1
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             1,
                             3
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             1,
                             4
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             2,
                             4
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             4,
                             2
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             5,
                             3
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             5,
                             4
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             5,
                             2
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             5,
                             1
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             6,
                             3
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             6,
                             4
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             6,
                             2
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             6,
                             1
                         );


-- Table: user
DROP TABLE IF EXISTS user;

CREATE TABLE user (
    id          INTEGER PRIMARY KEY,
    email       VARCHAR UNIQUE
                        NOT NULL,
    username    VARCHAR UNIQUE
                        NOT NULL,
    password    VARCHAR NOT NULL,
    profile_pic VARCHAR DEFAULT ('../assets/profile_pics/0.png'),
    bio         VARCHAR DEFAULT ('A mysterious stranger with a mysterious attitude.'),
    points      INTEGER NOT NULL
                        DEFAULT (0) 
);

INSERT INTO user (
                     id,
                     email,
                     username,
                     password,
                     profile_pic,
                     bio,
                     points
                 )
                 VALUES (
                     1,
                     'teste',
                     'teste',
                     '$2y$12$jbSNo4oy63wlNv1/l5/Z0eOtoIotb42dKzFngH8fekX3Sxzohru.i',
                     '../assets/profile_pics/154437681019235112545c0d51ea628686.90938975.png',
                     'abcd
efgh
ijkl',
-                    1
                 );

INSERT INTO user (
                     id,
                     email,
                     username,
                     password,
                     profile_pic,
                     bio,
                     points
                 )
                 VALUES (
                     2,
                     'ricardomft@gmail.com',
                     'EgzysT',
                     '$2y$12$eaGR1fkGi7aVzHJ2WsG81.mV2U45yqGZM2Qlv2s/0EyTpCo5kQoH2',
                     '../assets/profile_pics/0.png',
                     'A mysterious stranger with a mysterious attitude.',
                     0
                 );

INSERT INTO user (
                     id,
                     email,
                     username,
                     password,
                     profile_pic,
                     bio,
                     points
                 )
                 VALUES (
                     3,
                     'anasasousasilva@gmail.com',
                     'ana',
                     '$2y$12$XoKCRwfNYad0fABhwMhveO5Kz2nFyeF8.XS8NkK5R3qaGxZb2CQJ2',
                     '../assets/profile_pics/0.png',
                     'A mysterious stranger with a mysterious attitude.',
                     0
                 );

INSERT INTO user (
                     id,
                     email,
                     username,
                     password,
                     profile_pic,
                     bio,
                     points
                 )
                 VALUES (
                     4,
                     'socrates@socrates.com',
                     'josesocrates',
                     '$2y$12$oajJRVOW60ye0MEj4NjwI.OGtc7r1SDnbxuBtd3aLlro6rOq0TwxS',
                     '../assets/profile_pics/1544920220297835c159c9cd902e4.32450656.png',
                     'Sou um político português, nascido na cidade do Porto a 6 de setembro de 1957 e criado junto com o seu pai na Covilhã. Recentemente estive preso e agora estou pronto a dar o meu melhor para melhorar as minhas finanças.
',
                     3
                 );

INSERT INTO user (
                     id,
                     email,
                     username,
                     password,
                     profile_pic,
                     bio,
                     points
                 )
                 VALUES (
                     5,
                     'pintocosta@fcporto.pt',
                     'pintocosta',
                     '$2y$12$uo3MJSE9Tsx3klqYBiGUCOQ6nbuVbbOydlGq28ZYdt93b5r.kTbJa',
                     '../assets/profile_pics/1544986504324995c169f88476c79.57579348.jpg',
                     'Jorge Nuno de Lima Pinto da Costa é um dirigente desportivo, atual presidente do Futebol Clube do Porto. É o presidente que ganhou mais títulos à frente de um clube de futebol.',
                     2
                 );

INSERT INTO user (
                     id,
                     email,
                     username,
                     password,
                     profile_pic,
                     bio,
                     points
                 )
                 VALUES (
                     6,
                     'cristina@ferreira.pt',
                     'cristinaferreira',
                     '$2y$12$inrQa2O2zwphs.Ze5Fwij.gCbmy6MqAcQrvHCTjAm7QFjOy0uizXG',
                     '../assets/profile_pics/154500173355085c16db058fc3f4.19755526.jpg',
                     'Cristina Maria Jorge Ferreira (Malveira, 9 de Setembro de 1977) é uma empresária e apresentadora de televisão portuguesa.',
                     0
                 );


-- Table: vote
DROP TABLE IF EXISTS vote;

CREATE TABLE vote (
    user_id   INTEGER  REFERENCES user (id),
    post_id   INTEGER  REFERENCES post (id),
    vote_type CHAR (1) NOT NULL
                       CHECK (vote_type = 'u' OR 
                              vote_type = 'd'),
    PRIMARY KEY (
        user_id,
        post_id
    )
);

INSERT INTO vote (
                     user_id,
                     post_id,
                     vote_type
                 )
                 VALUES (
                     4,
                     50,
                     'u'
                 );

INSERT INTO vote (
                     user_id,
                     post_id,
                     vote_type
                 )
                 VALUES (
                     4,
                     25,
                     'd'
                 );

INSERT INTO vote (
                     user_id,
                     post_id,
                     vote_type
                 )
                 VALUES (
                     5,
                     52,
                     'u'
                 );

INSERT INTO vote (
                     user_id,
                     post_id,
                     vote_type
                 )
                 VALUES (
                     5,
                     54,
                     'u'
                 );

INSERT INTO vote (
                     user_id,
                     post_id,
                     vote_type
                 )
                 VALUES (
                     5,
                     51,
                     'u'
                 );

INSERT INTO vote (
                     user_id,
                     post_id,
                     vote_type
                 )
                 VALUES (
                     5,
                     50,
                     'u'
                 );


-- Trigger: delete_comment
DROP TRIGGER IF EXISTS delete_comment;
CREATE TRIGGER delete_comment
        BEFORE DELETE
            ON comment
BEGIN
    UPDATE post
       SET content = '[deleted]'
     WHERE id = old.post_id;
    SELECT RAISE(IGNORE);
END;


-- Trigger: delete_downvote
DROP TRIGGER IF EXISTS delete_downvote;
CREATE TRIGGER delete_downvote
        BEFORE DELETE
            ON vote
          WHEN old.vote_type = 'd'
BEGIN
    UPDATE post
       SET downvotes_count = post.downvotes_count - 1
     WHERE id = old.post_id;
    UPDATE user
       SET points = user.points + 1
     WHERE id = (
                    SELECT user_id
                      FROM post
                     WHERE id = old.post_id
                );
END;


-- Trigger: delete_story
DROP TRIGGER IF EXISTS delete_story;
CREATE TRIGGER delete_story
        BEFORE DELETE
            ON story
BEGIN
    UPDATE post
       SET content = '[deleted]'
     WHERE id = old.post_id;
    UPDATE story
       SET title = '[deleted]'
     WHERE post_id = old.post_id;
    SELECT RAISE(IGNORE);
END;


-- Trigger: delete_upvote
DROP TRIGGER IF EXISTS delete_upvote;
CREATE TRIGGER delete_upvote
        BEFORE DELETE
            ON vote
          WHEN old.vote_type = 'u'
BEGIN
    UPDATE post
       SET upvotes_count = post.upvotes_count - 1
     WHERE id = old.post_id;
    UPDATE user
       SET points = user.points - 1
     WHERE id = (
                    SELECT user_id
                      FROM post
                     WHERE id = old.post_id
                );
END;


-- Trigger: insert_downvote
DROP TRIGGER IF EXISTS insert_downvote;
CREATE TRIGGER insert_downvote
         AFTER INSERT
            ON vote
          WHEN new.vote_type = 'd'
BEGIN
    UPDATE post
       SET downvotes_count = post.downvotes_count + 1
     WHERE id = new.post_id;
    UPDATE user
       SET points = user.points - 1
     WHERE id = (
                    SELECT user_id
                      FROM post
                     WHERE id = new.post_id
                );
END;


-- Trigger: insert_upvote
DROP TRIGGER IF EXISTS insert_upvote;
CREATE TRIGGER insert_upvote
         AFTER INSERT
            ON vote
          WHEN new.vote_type = 'u'
BEGIN
    UPDATE post
       SET upvotes_count = post.upvotes_count + 1
     WHERE id = new.post_id;
    UPDATE user
       SET points = user.points + 1
     WHERE id = (
                    SELECT user_id
                      FROM post
                     WHERE id = new.post_id
                );
END;


-- Trigger: subscribe
DROP TRIGGER IF EXISTS subscribe;
CREATE TRIGGER subscribe
         AFTER INSERT
            ON subscription
BEGIN
    UPDATE channel
       SET subscription_counter = channel.subscription_counter + 1
     WHERE new.channel_id = id;
END;


-- Trigger: unsubscribe
DROP TRIGGER IF EXISTS unsubscribe;
CREATE TRIGGER unsubscribe
        BEFORE DELETE
            ON subscription
BEGIN
    UPDATE channel
       SET subscription_counter = channel.subscription_counter - 1
     WHERE old.channel_id = id;
END;


-- Trigger: update_to_downvote
DROP TRIGGER IF EXISTS update_to_downvote;
CREATE TRIGGER update_to_downvote
         AFTER UPDATE
            ON vote
          WHEN old.vote_type = 'u' AND 
               new.vote_type = 'd'
BEGIN
    UPDATE post
       SET upvotes_count = post.upvotes_count - 1,
           downvotes_count = post.downvotes_count + 1
     WHERE id = new.post_id;
    UPDATE user
       SET points = user.points - 2
     WHERE id = (
                    SELECT user_id
                      FROM post
                     WHERE id = new.post_id
                );
END;


-- Trigger: update_to_upvote
DROP TRIGGER IF EXISTS update_to_upvote;
CREATE TRIGGER update_to_upvote
         AFTER UPDATE
            ON vote
          WHEN old.vote_type = 'd' AND 
               new.vote_type = 'u'
BEGIN
    UPDATE post
       SET upvotes_count = post.upvotes_count + 1,
           downvotes_count = post.downvotes_count - 1
     WHERE id = new.post_id;
    UPDATE user
       SET points = user.points + 2
     WHERE id = (
                    SELECT user_id
                      FROM post
                     WHERE id = new.post_id
                );
END;


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
