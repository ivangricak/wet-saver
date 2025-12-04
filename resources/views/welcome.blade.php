@extends('layouts.layout')
@section('content')
    <div class="section">
        <div class="main-block" onclick="location.href='{{ route('home.index') }}'" oncontextmenu="return false;">
            <img src="/frame1.png" alt="">
        </div>
        <div class="blog small-block" onclick="location.href='#blogPage'" oncontextmenu="return false;">
            <img src="/frame2.png" alt="">
        </div>
        <div class="about small-block" onclick="location.href='#about'">
            <p class="block-title">DISCOVER <br> OUR HISTORY</p>
            <p class="text-btn-block">About us</p>
        </div>
        <div class="contact small-block" id="contactBlock">
            <p class="block-title">HAVE SOME <br> QUESTIONS?</p>
            <p class="text-btn-block">Contact us</p>
        </div>
    </div>
    <section class="blogPage" id="blogPage"> <!-- -->
        <div class="blogBlock">
            <h2>VIEW OUR BLOG</h2>
            <div class="blogBlockMain"> <!-- ширина 800px висота 500px -->
                <div class="blogBlockMainLeft"> 
                    <img src="/nexoraBaner.png" class="phone-img">
                </div>
                <div class="blogBlockMainRight"> <!-- ширина 50% висота 100% -->
                <h2 class="mt-4 ms-4 mb-2 fw-bold">WHAT WE OFFER</h2>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" >
                            Fast Project Development
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">We ensure rapid and continuous platform evolution — new features, improvements, and updates are implemented quickly and efficiently.</div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Future Ecosystem
                        </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">We are building the foundation for a complete ecosystem where all tools work seamlessly together, providing a scalable and user-friendly experience.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Flexibility in Every Detail
                        </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Our solutions easily adapt to your needs. The system grows, changes, and expands without limitations.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                            Community & Support
                        </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">We are building an active community (e.g., a Telegram chat) where users can connect, share ideas, ask for help, and contribute to the project’s growth.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                            High Performance & Speed
                        </button>
                        </h2>
                        <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">The platform is built on modern, optimized technologies to deliver fast, smooth, and stable performance.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                            Direct Communication With Users
                        </button>
                        </h2>
                        <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Questions, ideas, or suggestions — we respond quickly and value feedback. Together, we shape a better platform.</div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="blogBlockThreeBlocks"> <!-- ширина 800px висота 250px -->
                <div class="blogBlockThreeBlocksIn small-block"> <!-- ширина 1/3 висота 250px -->
                    <p class="block-title">JOIN OUR <br> COMMUNITY</p>
                    <p class="small-text-block">We are waiting for you in <br> our community</p>
                    <p class="text-btn-block">Community</p>
                </div>
                <div class="blogBlockThreeBlocksIn small-block"> <!-- ширина 1/3 висота 250px -->
                    <p class="block-title">WATCH OUR <br> ACHIEVEMENTS</p>
                    <p class="small-text-block"> live these moments with us. We are happy for everyone.</p>
                    <p class="text-btn-block">Social Media</p>
                </div>
                <div class="blogBlockThreeBlocksIn small-block"> <!-- ширина 1/3 висота 250px -->
                    <p class="block-title">HAVE SOME <br> QUESTIONS?</p>
                    <p class="text-btn-block">Contact us</p>
                </div>
            </div>
            <!-- <div class="blogBlockInfoPhoto">
                <div class="blogBlockInfoPhotoIn"> 
                    <img src="" alt="">
                </div>
            </div> -->
        </div>
    </section>


<section class="nexora-container" id="about">
    <h2>ABOUT US</h2>
    <!-- <div class="aboutUsblockMain" aboutUsPage>
        <h2>About Us</h2>
        <div class="aboutUsblock">
            <h4>About Project</h4>
            <p> <img src="" alt="">
                I am the founder of this project, driven by the goal of redefining how people interact with links and online information. 
                <br>
                <br>
                At the moment, I’m developing the product independently while actively looking for like-minded individuals to join the future team. 
                <br>
                <br>
                Despite limited resources, I’m committed to building a tool that saves time, removes unnecessary steps, and makes everyday work on the internet noticeably simpler.
            </p>
        </div>
        <div class="aboutUsblock">
            <h4>Mission</h4>
            <p>
                My mission is to provide the fastest and most convenient way to save and organize links, helping people spend less time on routine tasks and more time on what truly matters. 
                <br>
                I want access to important information to be so quick and precise that it takes just one click.
            </p>
        </div>
        <div class="aboutUsblock">
            <h4>What We’re Building</h4>
            <p>
                The product is an independent, multifunctional link storage solution built around three core principles:
                <br><br>
                Speed: saving and accessing links in seconds.
                <br><br>
                Convenience: an interface and logic designed with zero unnecessary actions.
                <br><br>
                Flexibility: the ability to work with links in the way that suits you best.
                <br><br>
                It is currently intended for everyday users, but in the future, a dedicated version for teams or businesses may also appear.
            </p>
        </div>
        <div class="aboutUsblock">
            <h4>Our Path & Goals</h4>
            <p>
            The project is launching for Ukrainian and English-speaking audiences, and its development will focus on building a full ecosystem of interconnected tools. 
            <br><br>
            The long-term goal is to go beyond a simple link-saving service and become a complete information-management solution, including:
            <br><br>
            an expanded web platform,
            <br>
            a mobile application,
            <br>
            a Telegram bot,
            <br>
            a browser extension,
            <br>
            multi-platform support and a synchronized ecosystem.
            <br><br>
            All of this is aimed at allowing users to save, find, and use information quickly – regardless of the device or context.
            </p>
        </div>
    </div> -->

    <!-- HEADER BLOCK -->
    <section class="blockHeaderAboutUs">
        <div class="blockHeaderAboutUsDiv shadow-lg">
            <div class="blockImg">
                <img src="/main.png" class="" alt="">
            
                <div class="text">
                    <h2>About Us</h2>
                    <p>
                        I am the founder of this project, driven by the goal of redefining how people interact 
                        with links and online information.
                    </p>
                    <p>
                        At the moment, I’m developing the product independently while actively looking 
                        for like-minded individuals to join the future team.
                    </p>
                    <p>
                        Despite limited resources, I’m committed to building a tool that saves time, 
                        removes unnecessary steps, and makes everyday work on the internet noticeably simpler.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- MISSION BLOCK -->
    <section class="my-4">
        <div class="p-4 bg-white shadow-lg rounded-4">
            <h2 class="mb-4">Mission</h2>

            <div class="row">
                <div class="blockMission col-md-4 mb-4">
                    <div class="mission-number">1</div>
                    <p>Provide the fastest way to save and organize links</p>
                </div>
                <div class="blockMission col-md-4 mb-4">
                    <div class="mission-number">2</div>
                    <p>Create an ecosystem and flexibility of use</p>
                </div>
                <div class="blockMission col-md-4 mb-4">
                    <div class="mission-number">3</div>
                    <p>Collaborate with others organizations and companies</p>
                </div>
            </div>
        </div>
    </section>

    <!-- WHAT WE'RE BUILDING -->
    <!-- <section class="blockWhatWaAreBuilding bg-white shadow-lg rounded-4">
        <div class="blockWhatWaAreBuildingDiv">
            <h2>What We’re Building</h2>
            <p>
                The product is an independent, multifunctional link storage solution 
                built around three core principles
            </p>

            <div class="blockImg">
                <img src="/main1.png" alt="">
                
                <img src="/main2.png" alt="">

                <img src="/main3.png" alt="">
            </div>
        </div>
    </section> -->
</section>
@endsection



<script>
document.addEventListener('DOMContentLoaded', function () {

    const contactBlock = document.getElementById('contactBlock');

    if (!contactBlock) return;

    const originalContent = contactBlock.innerHTML;

    const newContent = `
        <div class="dynamic-links blockContact">
            <button type="button" class="center-link gmail-logo rounded-5" onclick="location.href='mailto:nexora.join@gmail.com'"></button>
        </div>
    `;

    let toggled = false;

    contactBlock.addEventListener('click', () => {

        if (contactBlock.classList.contains('animating')) return;

        contactBlock.classList.add('animating', 'fade-out');

        setTimeout(() => {

            contactBlock.innerHTML = toggled ? originalContent : newContent;

            const container = contactBlock.querySelector('.dynamic-links');
            if (container) {
                const buttons = container.querySelectorAll('.center-link').length;

                if (buttons === 1) container.classList.add('single');
                if (buttons === 2) container.classList.add('double');
                if (buttons === 3) container.classList.add('triple');
            }

            contactBlock.classList.remove('fade-out');

            setTimeout(() => {
                contactBlock.classList.remove('animating');
                toggled = !toggled;
            }, 400);

        }, 400);
    });

});
</script>




<script>
    document.addEventListener('DOMContentLoaded', function () {
    const newContents = [
    `
        <div class="dynamic-links">
        <button type="button" class="center-link photo-tg" onclick="location.href='https://t.me/+OlnATWKlLmI0ZTgy'"></button>
        </div>
    `,
    `
        <div class="dynamic-links">
            <button type="button" class="center-link" onclick="location.href='https://t.me/+Qlod5OF35LdmZTYy'">Join Telegram</button>
            <button type="button" class="center-link" onclick="location.href='#'">TikTok</button>
            <button type="button" class="center-link" onclick="location.href='#'">Instagram</button>
        </div>
    `,
    `
        <div class="dynamic-links">
        <button type="button" class="center-link gmail-logo" onclick="location.href='mailto:nexora.join@gmail.com'"></button>
        </div>
    `
    ];

        document.querySelectorAll('.blogBlockThreeBlocksIn').forEach((block, index) => {

        const originalContent = block.innerHTML;
        const newContent = newContents[index];

        let toggled = false;

        block.addEventListener('click', () => {
            if (block.classList.contains('animating')) return;

            block.classList.add('animating', 'fade-out');

            setTimeout(() => {
            block.innerHTML = toggled ? originalContent : newContent;

            // ---- Додаємо клас по кількості кнопок ----
            const container = block.querySelector('.dynamic-links');
            if (container) {
                const buttons = container.querySelectorAll('.center-link').length;

                if (buttons === 1) container.classList.add('single');
                if (buttons === 2) container.classList.add('double');
                if (buttons === 3) container.classList.add('triple');
            }

            block.classList.remove('fade-out');

            setTimeout(() => {
                block.classList.remove('animating');
                toggled = !toggled;
            }, 400);

            }, 400);
        });

        });
    });
</script>