<?php
get_header();
?>
<main class="main-container">
  <div class="home">
    <div class="welcome-section">
      <div class="welcome-section-content">
        <div class="welcome-section-info">
          <img src="/wp-content/themes/hv-theme/assets/images/home/welcome-shape.svg" class="welcome-section-shape"
            alt="shape">
          <img src="/wp-content/themes/hv-theme/assets/images/home/welcome-shape-mobile.png"
            class="welcome-section-shape-mobile" alt="shape">
          <div class="welcome-section-inner">
            <div class="welcome-section-text">
              <h1 class="title welcome-section-title">Збери свій <br> ящик смаків</h1>
              <div class="welcome-section-icons">
                <img src="/wp-content/themes/hv-theme/assets/images/home/welcome-icon.svg" alt="icon">
                <p><strong>12+</strong> смаків на вибір</p>
              </div>
              <div class="welcome-section-action">
                <a href="/" class="button button-solid">Купити
                  <span class="icon-arrow">
                    <img src="/wp-content/themes/hv-theme/assets/images/icons/button-arrow.svg" alt="">
                  </span>
                </a>
              </div>
            </div>
          </div>
          <img src="/wp-content/themes/hv-theme/assets/images/home/home_white_wawe.svg"
            class="welcome-section-white-wave" alt="" />
        </div>
        <div class="welcome-section-video">
          <video src="/wp-content/themes/hv-theme/assets/videos/main_comp.mp4" autoplay loop muted></video>
        </div>
      </div>
    </div>

    <div class="properties-section">
      <div class="home-content main-content">
        <h2 class="title">Грінки Хвилясті</h2>
        <div class="properties-section-container mobile-container">
          <div class="properties-section-mobile-wrapper">
            <div class="properties-section-swiper-mobile swiper" id="propertiesSwiperMobile">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <img class="properties-section-img"
                    src="/wp-content/themes/hv-theme/assets/images/properties/properties-1.png">
                  <div class="properties-section-swiper-mobile__number"><span>1</span></div>
                  <div class="properties-section-swiper-mobile__name">Cвіжий хліб</div>
                </div>
                <div class="swiper-slide">
                  <img class="properties-section-img"
                    src="/wp-content/themes/hv-theme/assets/images/properties/properties-2.png">
                  <div class="properties-section-swiper-mobile__number"><span>2</span></div>
                  <div class="properties-section-swiper-mobile__name">Унікальна форма</div>
                </div>
                <div class="swiper-slide">
                  <img class="properties-section-img"
                    src="/wp-content/themes/hv-theme/assets/images/properties/properties-3.png">
                  <div class="properties-section-swiper-mobile__number"><span>3</span></div>
                  <div class="properties-section-swiper-mobile__name">Технологія знежирення</div>
                </div>
                <div class="swiper-slide">
                  <img class="properties-section-img"
                    src="/wp-content/themes/hv-theme/assets/images/properties/properties-4.png">
                  <div class="properties-section-swiper-mobile__number"><span>4</span></div>
                  <div class="properties-section-swiper-mobile__name">Асортимент смаків</div>
                </div>
                <div class="swiper-slide">
                  <img class="properties-section-img"
                    src="/wp-content/themes/hv-theme/assets/images/properties/properties-5.png">
                  <div class="properties-section-swiper-mobile__number"><span>5</span></div>
                  <div class="properties-section-swiper-mobile__name">Якість</div>
                </div>
                <div class="swiper-slide">
                  <img class="properties-section-img"
                    src="/wp-content/themes/hv-theme/assets/images/properties/properties-6.png">
                  <div class="properties-section-swiper-mobile__number"><span>6</span></div>
                  <div class="properties-section-swiper-mobile__name">Поживність</div>
                </div>
              </div>
            </div>
            <div class="hv-swiper-button swiper-button-next" id="properties-swiper-button-next"></div>
            <div class="hv-swiper-button swiper-button-prev" id="properties-swiper-button-prev"></div>
          </div>
        </div>
        <div class="properties-section-container desktop-container">
          <div class="properties-section-swiper swiper" id="propertiesSwiperDesktop">
            <div class="swiper-wrapper">
              <div class="swiper-slide"><img class="properties-section-img"
                  src="/wp-content/themes/hv-theme/assets/images/properties/properties-1.png"></div>
              <div class="swiper-slide"><img class="properties-section-img"
                  src="/wp-content/themes/hv-theme/assets/images/properties/properties-2.png"></div>
              <div class="swiper-slide"><img class="properties-section-img"
                  src="/wp-content/themes/hv-theme/assets/images/properties/properties-3.png"></div>
              <div class="swiper-slide"><img class="properties-section-img"
                  src="/wp-content/themes/hv-theme/assets/images/properties/properties-4.png"></div>
              <div class="swiper-slide"><img class="properties-section-img"
                  src="/wp-content/themes/hv-theme/assets/images/properties/properties-5.png"></div>
              <div class="swiper-slide"><img class="properties-section-img"
                  src="/wp-content/themes/hv-theme/assets/images/properties/properties-6.png"></div>
            </div>
          </div>
          <div class="properties-pagination-item active" id="pagination-item-1">
            <div class="properties-pagination-item__number"><span>1</span></div>
            <div class="properties-pagination-item__name">Cвіжий хліб</div>
            <div class="line-with-circle"></div>
          </div>
          <div class="properties-pagination-item" id="pagination-item-2">
            <div class="properties-pagination-item__number"><span>2</span></div>
            <div class="properties-pagination-item__name">Унікальна форма</div>
            <div class="line-with-circle"></div>
          </div>
          <div class="properties-pagination-item" id="pagination-item-3">
            <div class="properties-pagination-item__number"><span>3</span></div>
            <div class="properties-pagination-item__name">Технологія знежирення</div>
            <div class="line-with-circle"></div>
          </div>
          <div class="properties-pagination-item right" id="pagination-item-4">
            <div class="properties-pagination-item__number"><span>4</span></div>
            <div class="properties-pagination-item__name">Асортимент смаків</div>
            <div class="line-with-circle"></div>
          </div>
          <div class="properties-pagination-item right" id="pagination-item-5">
            <div class="properties-pagination-item__number"><span>5</span></div>
            <div class="properties-pagination-item__name ">Якість</div>
            <div class="line-with-circle"></div>
          </div>
          <div class="properties-pagination-item right" id="pagination-item-6">
            <div class="properties-pagination-item__number"><span>6</span></div>
            <div class="properties-pagination-item__name">Поживність</div>
            <div class="line-with-circle"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="trends-section">
      <img src="/wp-content/themes/hv-theme/assets/images/home/section_white_wawe.svg" class="section-white-wawe"
        alt="wawe">
      <div class="home-content main-content">
        <h2 class="title trends-section-title">Тренди</h2>
        <div class="trends-section-container">
          <div class="trends-section-tabs">
            <div class="trends-section-tabs__pills">
              <button class="trends-section-tabs-btn active" data-id="first-trends-tab">Усі</button>
              <button class="trends-section-tabs-btn" data-id="second-trends-tab">Хвилясті</button>
              <button class="trends-section-tabs-btn" data-id="third-trends-tab">Вергуни</button>
            </div>

            <div class="trends-section-tabs__panels">
              <!-- first-trends-tab -->
              <div id="first-trends-tab" class="active">
                <div class="swiper" id="firstTrendsTabSwiper">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">product-card 1-1</div>
                    <div class="swiper-slide">product-card 1-2</div>
                    <div class="swiper-slide">product-card 1-3</div>
                    <div class="swiper-slide">product-card 1-4</div>
                    <div class="swiper-slide">product-card 1-5</div>
                    <div class="swiper-slide">product-card 1-6</div>
                  </div>
                </div>
                <div class="hv-swiper-button swiper-button-next" id="hv-swiper-button-next"></div>
                <div class="hv-swiper-button swiper-button-prev" id="hv-swiper-button-prev"></div>
              </div>
              <!-- second-trends-tab -->
              <div id="second-trends-tab" class="">
                <div class="swiper" id="secondTrendsTabSwiper">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">product-card 2-1</div>
                    <div class="swiper-slide">product-card 2-2</div>
                    <div class="swiper-slide">product-card 2-3</div>
                    <div class="swiper-slide">product-card 2-4</div>
                    <div class="swiper-slide">product-card 2-5</div>
                    <div class="swiper-slide">product-card 2-6</div>
                  </div>
                </div>
                <div class="hv-swiper-button swiper-button-next" id="hv-swiper-button-next"></div>
                <div class="hv-swiper-button swiper-button-prev" id="hv-swiper-button-prev"></div>
              </div>
              <!-- third-trends-tab -->
              <div id="third-trends-tab" class="">
                <div class="swiper" id="thirdTrendsTabSwiper">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">product-card 3-1</div>
                    <div class="swiper-slide">product-card 3-2</div>
                    <div class="swiper-slide">product-card 3-3</div>
                    <div class="swiper-slide">product-card 3-4</div>
                    <div class="swiper-slide">product-card 3-5</div>
                    <div class="swiper-slide">product-card 3-6</div>
                  </div>
                </div>
                <div class="hv-swiper-button swiper-button-next" id="hv-swiper-button-next"></div>
                <div class="hv-swiper-button swiper-button-prev" id="hv-swiper-button-prev"></div>
              </div>
            </div>
          </div>
        </div>
        <a href="/" class="button button-solid-secondary">Скласти власний бокс</a>
      </div>
    </div>

    <div class="social-media-section">
      <img src="/wp-content/themes/hv-theme/assets/images/home/section_grey_wawe.svg" class="section-white-wawe"
        alt="wawe">
      <div class="home-content main-content">
        <h2 class="title">Про нас</h2>
        <p class="home-section-text">Свіжий житньо-пшеничний хліб, унікальна форма, приправи, що виготовлені на
          натуральній основі або натуральних ароматизаторах, а також створення продукції ручним способом — усе це
          вирізняє Хвилясті серед інших.</p>
        <div class="social-media-section-container">
          <img class="social-media-section-image" src="/wp-content/themes/hv-theme/assets/images/social-media/inst.png">
          <img class="social-media-section-image"
            src="/wp-content/themes/hv-theme/assets/images/social-media/tiktok.png">
        </div>
        <a href="/about" class="button button-outlined">Дізнатися більше</a>
      </div>
    </div>

    <div class="video-section">
      <img src="/wp-content/themes/hv-theme/assets/images/home/section_white_wawe.svg" class="section-white-wawe"
        alt="wawe">
      <div class="home-content main-content">
        <h2 class="title">Для партнерів</h2>
        <p class="home-section-text">Наш продукт є ваговим. Кожен ящик містить 12 порцій, розташованих в два яруси.
          В одній порції 7 – 12 грінок, вага яких 75 г, в залежності від розміру хліба. Продукція ручної праці дає
          можливість отримати продукт найвищої якості в широкому асортименті.</p>
        <div class="video-section-container">
          <video src="/wp-content/themes/hv-theme/assets/videos/main_comp.mp4" autoplay loop muted controls></video>
        </div>
        <a href="/partners" class="button button-solid">Заявка на співпрацю</a>
      </div>
    </div>

  </div>
</main>
<?php get_footer();?>
</body>