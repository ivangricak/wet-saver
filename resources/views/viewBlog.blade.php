@extends('layouts.layout')
@section('content')
    <section class="blogPage"> <!-- -->
        <div class="blogBlock">
            <div class="blogBlockMain"> <!-- ширина 800px висота 500px -->
                <div class="blogBlockMainLeft"> <!-- ширина 50% висота 100% -->
                    <img src="" alt="">
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
                <div class="blogBlockThreeBlocksIn bBfirst small-block"> <!-- ширина 1/3 висота 250px -->
                    <p class="block-title">JOIN OUR <br> COMMUNITY</p>
                    <p class="small-text-block">We are waiting for you in <br> our community</p>
                    <p class="text-btn-block">Community</p>
                </div>
                <div class="blogBlockThreeBlocksIn second small-block"> <!-- ширина 1/3 висота 250px -->
                    <p class="block-title">WATCH OUR <br> ACHIEVEMENTS</p>
                    <p class="small-text-block"> live these moments with us. We are happy for everyone.</p>
                    <p class="text-btn-block">Social Media</p>
                </div>
                <div class="blogBlockThreeBlocksIn third small-block"> <!-- ширина 1/3 висота 250px -->
                    <p class="block-title">HAVE SOME <br> QUESTIONS?</p>
                    <p class="text-btn-block">Contact us</p>
                </div>
            </div>


            <div class="blogBlockInfoPhoto"> <!-- ширина 800px висота 500px -->
                <div class="blogBlockInfoPhotoIn"> <!-- ширина 50% висота 100% -->
                    <img src="" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {

const newContents = [
  `
    <div class="dynamic-links">
      <button type="button" class="center-link photo-tg" onclick="location.href='https://t.me'"></button>
    </div>
  `,
  `
    <div class="dynamic-links">
        <button type="button" class="center-link" onclick="location.href='https://t.me'">Join Telegram</button>
        <button type="button" class="center-link" onclick="location.href='https://tiktok.com'">TikTok</button>
        <button type="button" class="center-link" onclick="location.href='https://instagram.com'">Instagram</button>
    </div>
  `,
  `
    <div class="dynamic-links">
      <button type="button" class="center-link gmail-logo" onclick="location.href='mailto:support@example.com'"></button>
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

