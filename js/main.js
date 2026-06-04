$(document).ready(function() {
    let slidesData = [];
    let currentSlideIndex = 0;

    // Fetch data from API
    $.get('api.php', function(res) {
        if(res.status === 'success' && res.data.length > 0) {
            slidesData = res.data;
            initDesktopView();
            initMobileView();
        } else {
            console.error("No data received or API error");
        }
    });

    function initDesktopView() {
        let tabsHtml = '';
        let dotsHtml = '';
        
        slidesData.forEach((slide, index) => {
            // Generate tabs
            tabsHtml += `
                <button class="list-group-item tab-item ${index === 0 ? 'active' : ''}" data-index="${index}">
                    <img src="${slide.tab_icon_path}" alt="icon"> ${slide.tab_name}
                </button>
            `;
            // Generate dots for column 2
            dotsHtml += `<span class="dot ${index === 0 ? 'active' : ''}" data-index="${index}"></span>`;
        });
        
        $('#desktopTabs').html(tabsHtml);
        $('.slider-dots').html(dotsHtml);
        
        // Render initial content
        renderDesktopContent(0);

        // Bind events
        $('.tab-item').on('click', function() {
            let index = $(this).data('index');
            currentSlideIndex = index;
            updateDesktopActiveState(index);
            renderDesktopContent(index);
        });

        $('.dot').on('click', function() {
            let index = $(this).data('index');
            currentSlideIndex = index;
            updateDesktopActiveState(index);
            renderDesktopContent(index);
        });
    }

    function updateDesktopActiveState(index) {
        $('.tab-item').removeClass('active');
        $(`.tab-item[data-index="${index}"]`).addClass('active');
        
        $('.dot').removeClass('active');
        $(`.dot[data-index="${index}"]`).addClass('active');
    }

    function renderDesktopContent(index) {
        let slide = slidesData[index];
        if(!slide) return;

        let contentHtml = `
            <div class="category">${slide.category}</div>
            <h3>${slide.title}</h3>
            <a href="${slide.link}" class="learn-more">Learn More &rarr;</a>
        `;
        $('#desktopContent').hide().html(contentHtml).fadeIn(300);
        
        $('#desktopImage').hide().css('background-image', `url(${slide.image_path})`).fadeIn(300);
    }

    function initMobileView() {
        let accordionHtml = '<div class="accordion" id="mobileAccordionList">';
        
        slidesData.forEach((slide, index) => {
            let isExpanded = index === 0 ? 'true' : 'false';
            let showClass = index === 0 ? 'show' : '';
            let collapsedClass = index === 0 ? '' : 'collapsed';

            accordionHtml += `
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading${index}">
                        <button class="accordion-button ${collapsedClass}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${index}" aria-expanded="${isExpanded}" aria-controls="collapse${index}">
                            <img src="${slide.tab_icon_path}" alt="icon"> ${slide.tab_name}
                        </button>
                    </h2>
                    <div id="collapse${index}" class="accordion-collapse collapse ${showClass}" aria-labelledby="heading${index}" data-bs-parent="#mobileAccordionList">
                        <div class="accordion-body p-0">
                            <div class="mobile-content-wrapper" style="background-image: url('${slide.image_path}')">
                                <div class="mobile-content-inner">
                                    <div class="category">${slide.category}</div>
                                    <h4>${slide.title}</h4>
                                    <a href="${slide.link}" class="learn-more">Learn More &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        
        accordionHtml += '</div>';
        $('#mobileAccordion').html(accordionHtml);
    }
});
