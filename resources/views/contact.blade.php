<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Agency - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/style.css" rel="stylesheet" />
        {{-- Vite assets --}}
        @vite([
            'resources/css/main/style.css',
            'resources/js/main_style/scripts.js',
        ])
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="assets/img/n.png" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{ route('login.show') }}">Log-in</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.create') }}">Register</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link" href="#about">About</a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link" href="#team">Team</a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container container-masthead">
                <div class="cont-left">
                    <div class="masthead-subheading">Too many open tabs?</div>
                    <!-- <div class="masthead-subheading">Забагато відкритих вкладок?</div> -->
                    <div class="masthead-heading">Save links in one click and return later.</div>
                    <!-- <div class="masthead-heading">Зберігайте посилання в один клік <br> і повертайтеся до них пізніше.</div> -->
                    <!-- <div class="masthead-small-text">A simple service to save and organize links instead of keeping dozens of tabs open.</div> -->
                    <!-- <div class="masthead-small-text">Простий сервіс для збереження та впорядкування посилань замість того, щоб тримати відкритими десятки вкладок.</div> -->
                    <a class="btn btn-dark btn-xl text-uppercase" href="{{ route('home.index') }}">GET STARTED</a>
                    <!-- <a class="btn btn-dark btn-xl text-uppercase" href="{{ route('home.index') }}">Почати</a> -->
                </div>
                <div class="cont-right">
                    <img class="img-cont-right" src="qwe-portrait.png" alt="">
                    <img class="img-cont-right-part" src="qwe-portrait-part.png" alt="">
                </div>
            </div>
            <div class="btn-next-slide" onclick="location.href='#services'">
                <a href="#service">More</a>
                <!-- <a href="#services">Більше</a> -->
                <img src="/assets/arrow-down.svg" alt="">
            </div>
        </header>
        <!-- Masthead2-->
        <!-- <section class="hero" id="services">
            <div class="container">
                <div class="hero-content">
                    <h1 class="fw-bold mb-4 hero-h1">
                        Ви зберігаєте корисні речі,<br>
                        але не повертаєтесь до них
                    </h1>

                    <div class="row">
                    <div class="col-6 feature">
                        <div class="feature-title">Вкладки</div>
                        <small class="text-muted">
                            Працюєте з великою кількістю посилань і тримаєте десятки вкладок відкритими.
                        </small>
                    </div>

                    <div class="col-6 feature">
                        <div class="feature-title">Хаос</div>
                        <small class="text-muted">
                        Посилання розкидані по нотатках, месенджерах і різних сервісах.
                        </small>
                    </div>

                    <div class="col-6 feature">
                        <div class="feature-title">Потім</div>
                        <small class="text-muted">
                        Зберігаєте матеріали “на потім”, але майже не повертаєтесь до них.
                        </small>
                    </div>

                    <div class="col-6 feature">
                        <div class="feature-title">Обмін</div>
                        <small class="text-muted">
                        Складно ділитися матеріалами, якщо вони не зібрані в одному місці.
                        </small>
                    </div>
                    </div>
                </div>
            </div>
            <img
            src="macbookpage2.png"
            alt="App preview"
            class="hero-image"
            >
        </section> -->
        <section class="hero" id="service">
            <div class="container">
                <div class="hero-content">
                    <h1 class="fw-bold mb-4 hero-h1">
                        You save useful things,<br>
                        but don’t come back to them
                    </h1>

                    <div class="row">
                        <div class="col-6 feature">
                            <div class="feature-title">Tabs</div>
                            <small class="text-muted">
                                You work with a large number of links and keep dozens of tabs open.
                            </small>
                        </div>

                        <div class="col-6 feature">
                            <div class="feature-title">Chaos</div>
                            <small class="text-muted">
                                Links are scattered across notes, messengers, and different services.
                            </small>
                        </div>

                        <div class="col-6 feature">
                            <div class="feature-title">Later</div>
                            <small class="text-muted">
                                You save materials “for later,” but rarely return to them.
                            </small>
                        </div>

                        <div class="col-6 feature">
                            <div class="feature-title">Sharing</div>
                            <small class="text-muted">
                                It’s hard to share materials when they’re not collected in one place.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image on the right -->
            <img
                src="macbookpage2.png"
                alt="App preview"
                class="hero-image"
            >
        </section>
        <!-- <section class="page-section" id="hero-mobile">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Проблема</h2>
                    <h3 class="section-subheading text-muted">
                        Ви зберігаєте корисні речі,
                        але не повертаєтесь до них
                    </h3>
                </div>

                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                            <i class="fas fa-window-restore timeline-icon text-white"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Вкладки</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Працюєте з великою кількістю посилань і тримаєте <b>десятки вкладок</b> відкритими.
                                </p>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <i class="fas fa-clock timeline-icon text-white"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Потім</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Зберігаєте матеріали “<b>на потім</b>”, але майже не повертаєтесь до них.
                                </p>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="timeline-image">
                            <i class="fas fa-random timeline-icon text-white"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Хаос</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    <b>Посилання розкидані</b> по нотатках, месенджерах і різних сервісах.
                                </p>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <i class="fas fa-share-nodes timeline-icon text-white"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Обмін</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Складно <b>ділитися матеріалами</b>, якщо вони не зібрані в одному місці.
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section> -->
        <section class="page-section" id="hero-mobile">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Problem</h2>
                    <h3 class="section-subheading text-muted">
                        You save useful things,
                        but don’t come back to them
                    </h3>
                </div>

                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                            <i class="fas fa-window-restore timeline-icon text-white"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Tabs</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    You work with a large number of links and keep <b>dozens of tabs</b> open.
                                </p>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <i class="fas fa-clock timeline-icon text-white"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Later</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    You save materials <b>“for later”</b>, but rarely return to them.
                                </p>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="timeline-image">
                            <i class="fas fa-random timeline-icon text-white"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Chaos</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    <b>Links are scattered</b> across notes, messengers, and different services.
                                </p>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <i class="fas fa-share-nodes timeline-icon text-white"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Sharing</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    It’s hard <b>to share materials</b> if they’re not collected in one place.
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Services-->
        <!-- <section class="page-section">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Рішення</h2>
                    <h3 class="section-subheading text-muted">
                        Все, що потрібно для збереження та організації посилань
                    </h3>
                </div>

                <div class="row text-center">
                    <div class="col-md-4">
                        <img class="img-service" src="n1.png" alt="">
                        <h4 class="my-3">Зберігай в один клік</h4>
                        <p class="text-muted">
                            Зберігайте будь-яке посилання за секунду — без хаосу і зайвих дій.
                        </p>
                    </div>

                    <div class="col-md-4">
                        <img class="img-service" src="n2.png" alt="">
                        <h4 class="my-3">Сортуйте за групами</h4>
                        <p class="text-muted">
                            Створюйте власні категорії для роботи, навчання або натхнення.
                        </p>
                    </div>

                    <div class="col-md-4">
                        <img class="img-service" src="n3.png" alt="">
                        <h4 class="my-3">Ділись підбірками</h4>
                        <p class="text-muted">
                            Діліться цілими підбірками, а не окремими посиланнями.
                        </p>
                    </div>
                </div>
            </div>
        </section> -->
        <section class="page-section">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Solution</h2>
                    <h3 class="section-subheading text-muted">
                        Everything you need to save and organize links
                    </h3>
                </div>

                <div class="row text-center">
                    <!-- Saving -->
                    <div class="col-md-4">
                        <img class="img-service" src="n1.png" alt="">
                        <h4 class="my-3">Save in one click</h4>
                        <p class="text-muted">
                            Save any link in seconds — without chaos or extra steps.
                        </p>
                    </div>

                    <!-- Organization -->
                    <div class="col-md-4">
                        <img class="img-service" src="n2.png" alt="">
                        <h4 class="my-3">Organize by groups</h4>
                        <p class="text-muted">
                            Create your own categories for work, study, or inspiration.
                        </p>
                    </div>

                    <!-- Sharing -->
                    <div class="col-md-4">
                        <img class="img-service" src="n3.png" alt="">
                        <h4 class="my-3">Share collections</h4>
                        <p class="text-muted">
                            Share entire collections, not just individual links.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about">
            <div class="container">
                <div class="text-about">
                    <div class="title">
                        <h3>Про Nexora</h3>
                    </div>
                    <div class="paragraf">
                        <p>Nexora was created from a simple idea — to have one place for all your important links.</p>
                        <p>Every day we save websites, articles, resources, and ideas. <br>But over time, they get lost among tabs, notes, and chats.</p>
                        <p>Nexora was built to bring order to that chaos. <br>So you always know where your link is — and can find it in seconds.</p>
                        <p>It’s a tool for anyone who works with information <br>and wants quick access instead of constant searching.</p>
                    </div>  
                    <!-- <div class="paragraf">
                        <p>Nexora зʼявилась з простої ідеї — мати одне місце для всіх важливих посилань. </p>
                        <p> Ми щодня зберігаємо сайти, статті, ресурси, ідеї. <br> Але з часом вони губляться серед вкладок, нотаток і чатів. </p>
                        <p>  Nexora створена, щоб навести порядок у цьому хаосі. <br> Щоб ви завжди знали, де ваше посилання — і знаходили його за секунди.</p>
                        <p> Це інструмент для всіх, хто працює з інформацією <br> і хоче мати швидкий доступ замість постійного пошуку.</p>
                    </div> -->
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>