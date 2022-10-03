//BildSlider
let sliders = document.querySelectorAll('._swiper');
if (sliders) {
    for (let index = 0; index < sliders.length; index++) {
        let slider = sliders[index];
        if (!slider.classList.contains('swiper-bild')) {
            let slider_items = slider.children;
            if (slider_items) {
                for (let index = 0; index < slider_items.length; index++) {
                    let el = slider_items[index];
                    el.classList.add('swiper-slide');
                }
            }
            let slider_content = slider.innerHTML;
            let slider_wrapper = document.createElement('div');
            slider_wrapper.classList.add('swiper-wrapper');
            slider_wrapper.innerHTML = slider_content;
            slider.innerHTML = '';
            slider.appendChild(slider_wrapper);
            slider.classList.add('swiper-bild');

            if (slider.classList.contains('_swiper_scroll')) {
                let sliderScroll = document.createElement('div');
                sliderScroll.classList.add('swiper-scrollbar');
                slider.appendChild(sliderScroll);
            }
        }
        if (slider.classList.contains('_gallery')) {
            //slider.data('lightGallery').destroy(true);
        }
    }
    sliders_bild_callback();
}

function sliders_bild_callback(params) {}

let sliderScrollItems = document.querySelectorAll('._swiper_scroll');
if (sliderScrollItems.length > 0) {
    for (let index = 0; index < sliderScrollItems.length; index++) {
        const sliderScrollItem = sliderScrollItems[index];
        const sliderScrollBar = sliderScrollItem.querySelector('.swiper-scrollbar');
        const sliderScroll = new Swiper(sliderScrollItem, {
            observer: true,
            observeParents: true,
            direction: 'vertical',
            slidesPerView: 'auto',
            freeMode: true,
            scrollbar: {
                el: sliderScrollBar,
                draggable: true,
                snapOnRelease: false
            },
            mousewheel: {
                releaseOnEdges: true,
            },
        });
        sliderScroll.scrollbar.updateSize();
    }
}


function sliders_bild_callback(params) {}

let slider_about = new Swiper('.slider__container', {
    autoplay: {
        delay: 0,
        disableOnInteraction: false,
    },
    slidesPerView: 'auto',
    slidesPerGroup: 1,
    spaceBetween: 30,
    autoHeight: true,
    speed: 2800,
    loop: true,
    freeMode: true,
    reverseDirection: false,
    //touchRatio: 0,
    //simulateTouch: false,
    //loop: true,
    //preloadImages: false,
    //lazy: true,
    // Dotts
    //pagination: {
    //	el: '.slider-quality__pagging',
    //	clickable: true,
    //},
    // Arrows
    navigation: {
        nextEl: '.about__more .more__item_next',
        prevEl: '.about__more .more__item_prev',
    },
    /*
    breakpoints: {
    	320: {
    		slidesPerView: 1,
    		spaceBetween: 0,
    		autoHeight: true,
    	},
    	768: {
    		slidesPerView: 2,
    		spaceBetween: 20,
    	},
    	992: {
    		slidesPerView: 3,
    		spaceBetween: 20,
    	},
    	1268: {
    		slidesPerView: 4,
    		spaceBetween: 30,
    	},
    },
    */
    on: {
        lazyImageReady: function () {
            ibg();
        },
    }
    // And if we need scrollbar
    //scrollbar: {
    //	el: '.swiper-scrollbar',
    //},
});

//let btn = document.querySelectorAll('button[type="submit"],input[type="submit"]');
let forms = document.querySelectorAll('form');
if (forms.length > 0) {
    for (let index = 0; index < forms.length; index++) {
        const el = forms[index];
        el.addEventListener('submit', form_submit);
    }
}
async function form_submit(e) {
    let btn = e.target;
    let form = btn.closest('form');
    let error = form_validate(form);
    if (error == 0) {
        let formAction = form.getAttribute('action') ? form.getAttribute('action').trim() : '#';
        let formMethod = form.getAttribute('method') ? form.getAttribute('method').trim() : 'GET';
        const message = form.getAttribute('data-message');
        const ajax = form.getAttribute('data-ajax');
        const test = form.getAttribute('data-test');

        //SendForm
        if (ajax) {
            e.preventDefault();
            let formData = new FormData(form);
            form.classList.add('_sending');
            let response = await fetch(formAction, {
                method: formMethod,
                body: formData
            });
            if (response.ok) {
                let result = await response.json();
                form.classList.remove('_sending');
                if (message) {
                    popup_open(message + '-message');
                }
                form_clean(form);
            } else {
                alert("Ошибка");
                form.classList.remove('_sending');
            }
        }
        // If test
        if (test) {
            e.preventDefault();
            popup_open(message + '-message');
            form_clean(form);
        }
    } else {
        let form_error = form.querySelectorAll('._error');
        if (form_error && form.classList.contains('_goto-error')) {
            _goto(form_error[0], 1000, 50);
        }
        e.preventDefault();
    }
}

function form_validate(form) {
    let error = 0;
    let form_req = form.querySelectorAll('._req');
    if (form_req.length > 0) {
        for (let index = 0; index < form_req.length; index++) {
            const el = form_req[index];
            if (!_is_hidden(el)) {
                error += form_validate_input(el);
            }
        }
    }
    return error;
}

function form_validate_input(input) {
    let error = 0;
    let input_g_value = input.getAttribute('data-value');

    if (input.getAttribute("name") == "email" || input.classList.contains("_email")) {
        if (input.value != input_g_value) {
            let em = input.value.replace(" ", "");
            input.value = em;
        }
        if (email_test(input) || input.value == input_g_value) {
            form_add_error(input);
            error++;
        } else {
            form_remove_error(input);
        }
    } else if (input.getAttribute("type") == "checkbox" && input.checked == false) {
        form_add_error(input);
        error++;
    } else {
        if (input.value == '' || input.value == input_g_value) {
            form_add_error(input);
            error++;
        } else {
            form_remove_error(input);
        }
    }
    return error;
}

function form_add_error(input) {
    input.classList.add('_error');
    input.parentElement.classList.add('_error');

    let input_error = input.parentElement.querySelector('.form__error');
    if (input_error) {
        input.parentElement.removeChild(input_error);
    }
    let input_error_text = input.getAttribute('data-error');
    if (input_error_text && input_error_text != '') {
        input.parentElement.insertAdjacentHTML('beforeend', '<div class="form__error">' + input_error_text + '</div>');
    }
}

function form_remove_error(input) {
    input.classList.remove('_error');
    input.parentElement.classList.remove('_error');

    let input_error = input.parentElement.querySelector('.form__error');
    if (input_error) {
        input.parentElement.removeChild(input_error);
    }
}

function form_clean(form) {
    let inputs = form.querySelectorAll('input,textarea');
    for (let index = 0; index < inputs.length; index++) {
        const el = inputs[index];
        el.parentElement.classList.remove('_focus');
        el.classList.remove('_focus');
        el.value = el.getAttribute('data-value');
    }
    let checkboxes = form.querySelectorAll('.checkbox__input');
    if (checkboxes.length > 0) {
        for (let index = 0; index < checkboxes.length; index++) {
            const checkbox = checkboxes[index];
            checkbox.checked = false;
        }
    }
    let selects = form.querySelectorAll('select');
    if (selects.length > 0) {
        for (let index = 0; index < selects.length; index++) {
            const select = selects[index];
            const select_default_value = select.getAttribute('data-default');
            select.value = select_default_value;
            select_item(select);
        }
    }
}

let viewPass = document.querySelectorAll('.form__viewpass');
for (let index = 0; index < viewPass.length; index++) {
    const element = viewPass[index];
    element.addEventListener("click", function (e) {
        if (element.classList.contains('_active')) {
            element.parentElement.querySelector('input').setAttribute("type", "password");
        } else {
            element.parentElement.querySelector('input').setAttribute("type", "text");
        }
        element.classList.toggle('_active');
    });
}

//Select
let selects = document.getElementsByTagName('select');
if (selects.length > 0) {
    selects_init();
}

function selects_init() {
    for (let index = 0; index < selects.length; index++) {
        const select = selects[index];
        select_init(select);
    }
    //select_callback();
    document.addEventListener('click', function (e) {
        selects_close(e);
    });
    document.addEventListener('keydown', function (e) {
        if (e.code === 'Escape') {
            selects_close(e);
        }
    });
}

function selects_close(e) {
    const selects = document.querySelectorAll('.select');
    if (!e.target.closest('.select') && !e.target.classList.contains('_option')) {
        for (let index = 0; index < selects.length; index++) {
            const select = selects[index];
            const select_body_options = select.querySelector('.select__options');
            select.classList.remove('_active');
            _slideUp(select_body_options, 100);
        }
    }
}

function select_init(select) {
    const select_parent = select.parentElement;
    const select_modifikator = select.getAttribute('class');
    const select_selected_option = select.querySelector('option:checked');
    select.setAttribute('data-default', select_selected_option.value);
    select.style.display = 'none';

    select_parent.insertAdjacentHTML('beforeend', '<div class="select select_' + select_modifikator + '"></div>');

    let new_select = select.parentElement.querySelector('.select');
    new_select.appendChild(select);
    select_item(select);
}

function select_item(select) {
    const select_parent = select.parentElement;
    const select_items = select_parent.querySelector('.select__item');
    const select_options = select.querySelectorAll('option');
    const select_selected_option = select.querySelector('option:checked');
    const select_selected_text = select_selected_option.text;
    const select_type = select.getAttribute('data-type');

    if (select_items) {
        select_items.remove();
    }

    let select_type_content = '';
    if (select_type == 'input') {
        select_type_content = '<div class="select__value icon-select-arrow"><input autocomplete="off" type="text" name="form[]" value="' + select_selected_text + '" data-error="Ошибка" data-value="' + select_selected_text + '" class="select__input"></div>';
    } else {
        select_type_content = '<div class="select__value icon-select-arrow"><span>' + select_selected_text + '</span></div>';
    }

    select_parent.insertAdjacentHTML('beforeend',
        '<div class="select__item">' +
        '<div class="select__title">' + select_type_content + '</div>' +
        '<div class="select__options">' + select_get_options(select_options) + '</div>' +
        '</div></div>');

    select_actions(select, select_parent);
}

function select_actions(original, select) {
    const select_item = select.querySelector('.select__item');
    const selectTitle = select.querySelector('.select__title');
    const select_body_options = select.querySelector('.select__options');
    const select_options = select.querySelectorAll('.select__option');
    const select_type = original.getAttribute('data-type');
    const select_input = select.querySelector('.select__input');

    selectTitle.addEventListener('click', function (e) {
        selectItemActions();
    });

    function selectMultiItems() {
        let selectedOptions = select.querySelectorAll('.select__option');
        let originalOptions = original.querySelectorAll('option');
        let selectedOptionsText = [];
        for (let index = 0; index < selectedOptions.length; index++) {
            const selectedOption = selectedOptions[index];
            originalOptions[index].removeAttribute('selected');
            if (selectedOption.classList.contains('_selected')) {
                const selectOptionText = selectedOption.innerHTML;
                selectedOptionsText.push(selectOptionText);
                originalOptions[index].setAttribute('selected', 'selected');
            }
        }
        select.querySelector('.select__value').innerHTML = '<span>' + selectedOptionsText + '</span>';
    }

    function selectItemActions(type) {
        if (!type) {
            let selects = document.querySelectorAll('.select');
            for (let index = 0; index < selects.length; index++) {
                const select = selects[index];
                const select_body_options = select.querySelector('.select__options');
                if (select != select_item.closest('.select')) {
                    select.classList.remove('_active');
                    _slideUp(select_body_options, 100);
                }
            }
            _slideToggle(select_body_options, 100);
            select.classList.toggle('_active');
        }
    }
    for (let index = 0; index < select_options.length; index++) {
        const select_option = select_options[index];
        const select_option_value = select_option.getAttribute('data-value');
        const select_option_text = select_option.innerHTML;

        if (select_type == 'input') {
            select_input.addEventListener('keyup', select_search);
        } else {
            if (select_option.getAttribute('data-value') == original.value && !original.hasAttribute('multiple')) {
                select_option.style.display = 'none';
            }
        }
        select_option.addEventListener('click', function () {
            for (let index = 0; index < select_options.length; index++) {
                const el = select_options[index];
                el.style.display = 'block';
            }
            if (select_type == 'input') {
                select_input.value = select_option_text;
                original.value = select_option_value;
            } else {
                if (original.hasAttribute('multiple')) {
                    select_option.classList.toggle('_selected');
                    selectMultiItems();
                } else {
                    select.querySelector('.select__value').innerHTML = '<span>' + select_option_text + '</span>';
                    original.value = select_option_value;
                    select_option.style.display = 'none';
                }
            }
            let type;
            if (original.hasAttribute('multiple')) {
                type = 'multiple';
            }
            selectItemActions(type);
        });
    }
}

function select_get_options(select_options) {
    if (select_options) {
        let select_options_content = '';
        for (let index = 0; index < select_options.length; index++) {
            const select_option = select_options[index];
            const select_option_value = select_option.value;
            if (select_option_value != '') {
                const select_option_text = select_option.innerHTML;
                select_options_content = select_options_content + '<div data-value="' + select_option_value + '" class="select__option">' + select_option_text + '</div>';
            }
        }
        return select_options_content;
    }
}

function select_search(e) {
    let select_block = e.target.closest('.select ').querySelector('.select__options');
    let select_options = e.target.closest('.select ').querySelectorAll('.select__option');
    let select_search_text = e.target.value.toUpperCase();

    for (let i = 0; i < select_options.length; i++) {
        let select_option = select_options[i];
        let select_txt_value = select_option.textContent || select_option.innerText;
        if (select_txt_value.toUpperCase().indexOf(select_search_text) > -1) {
            select_option.style.display = "";
        } else {
            select_option.style.display = "none";
        }
    }
}

function selects_update_all() {
    let selects = document.querySelectorAll('select');
    if (selects) {
        for (let index = 0; index < selects.length; index++) {
            const select = selects[index];
            select_item(select);
        }
    }
}

//Placeholers
let inputs = document.querySelectorAll('input[data-value],textarea[data-value]');
inputs_init(inputs);

function inputs_init(inputs) {
    if (inputs.length > 0) {
        for (let index = 0; index < inputs.length; index++) {
            const input = inputs[index];
            const input_g_value = input.getAttribute('data-value');
            input_placeholder_add(input);
            if (input.value != '' && input.value != input_g_value) {
                input_focus_add(input);
            }
            input.addEventListener('focus', function (e) {
                if (input.value == input_g_value) {
                    input_focus_add(input);
                    input.value = '';
                }
                if (input.getAttribute('data-type') === "pass" && !input.parentElement.querySelector('.form__viewpass').classList.contains('_active')) {
                    input.setAttribute('type', 'password');
                }
                if (input.classList.contains('_date')) {
                    /*
                    input.classList.add('_mask');
                    Inputmask("99.99.9999", {
                    	//"placeholder": '',
                    	clearIncomplete: true,
                    	clearMaskOnLostFocus: true,
                    	onincomplete: function () {
                    		input_clear_mask(input, input_g_value);
                    	}
                    }).mask(input);
                    */
                }
                if (input.classList.contains('_phone')) {
                    //'+7(999) 999 9999'
                    //'+38(999) 999 9999'
                    //'+375(99)999-99-99'
                    input.classList.add('_mask');
                    Inputmask("+48 (99) 9999999", {
                        //"placeholder": '',
                        clearIncomplete: true,
                        clearMaskOnLostFocus: true,
                        onincomplete: function () {
                            input_clear_mask(input, input_g_value);
                        }
                    }).mask(input);
                }
                if (input.classList.contains('_digital')) {
                    input.classList.add('_mask');
                    Inputmask("9{1,}", {
                        "placeholder": '',
                        clearIncomplete: true,
                        clearMaskOnLostFocus: true,
                        onincomplete: function () {
                            input_clear_mask(input, input_g_value);
                        }
                    }).mask(input);
                }
                form_remove_error(input);
            });
            input.addEventListener('blur', function (e) {
                if (input.value == '') {
                    input.value = input_g_value;
                    input_focus_remove(input);
                    if (input.classList.contains('_mask')) {
                        input_clear_mask(input, input_g_value);
                    }
                    if (input.getAttribute('data-type') === "pass") {
                        input.setAttribute('type', 'text');
                    }
                }
            });
            if (input.classList.contains('_date')) {
                const calendarItem = datepicker(input, {
                    customDays: ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"],
                    customMonths: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
                    overlayButton: 'Применить',
                    overlayPlaceholder: 'Год (4 цифры)',
                    startDay: 1,
                    formatter: (input, date, instance) => {
                        const value = date.toLocaleDateString()
                        input.value = value
                    },
                    onSelect: function (input, instance, date) {
                        input_focus_add(input.el);
                    }
                });
                const dataFrom = input.getAttribute('data-from');
                const dataTo = input.getAttribute('data-to');
                if (dataFrom) {
                    calendarItem.setMin(new Date(dataFrom));
                }
                if (dataTo) {
                    calendarItem.setMax(new Date(dataTo));
                }
            }
        }
    }
}

function input_placeholder_add(input) {
    const input_g_value = input.getAttribute('data-value');
    if (input.value == '' && input_g_value != '') {
        input.value = input_g_value;
    }
}

function input_focus_add(input) {
    input.classList.add('_focus');
    input.parentElement.classList.add('_focus');
}

function input_focus_remove(input) {
    input.classList.remove('_focus');
    input.parentElement.classList.remove('_focus');
}

function input_clear_mask(input, input_g_value) {
    input.inputmask.remove();
    input.value = input_g_value;
    input_focus_remove(input);
}

// Button menu click
let ButtonMenu = document.querySelector('#hider');
let menu = document.querySelector('#config-btn');

const toggleMenu = () => {
    menu.classList.toggle('active');
};

ButtonMenu.addEventListener('click', e => {
    e.stopPropagation();

    toggleMenu();
});

document.addEventListener('click', e => {
    let target = e.target;
    let itsMenu = target == menu || menu.contains(target);
    let itsButtonMenu = target == ButtonMenu;
    let menuIsActive = menu.classList.contains('active');

    if (!itsMenu && !itsButtonMenu && menuIsActive) {
        toggleMenu();
    }
});


//======================================================================================
//show more

if (document.getElementById('show-more')) {
    let showMore = document.getElementById('show-more');
    let item = document.querySelectorAll('.hide-service');
    if (item.length < 7) {
        showMore.style.display = 'none';
    }
    showMore.onclick = function btnClick() {
        let blockMain = document.querySelector('.main-title');
        let item = document.querySelectorAll('.hide-service');
        item.forEach(item => {
            if (item.classList.contains("add-show")) {
                blockMain.scrollIntoView({
                    block: "start",
                    behavior: "smooth"
                });
                showMore.innerHTML = "Zobacz więcej";
            } else {
                showMore.innerHTML = "Zobacz mniej";
            }
            item.classList.toggle("add-show");
        });
    };
}


if (document.getElementById('show-more__add')) {
    let showMoreAdd = document.getElementById('show-more__add');
    let itemAdd = document.querySelectorAll('.add-service');
    if (itemAdd.length < 7) {
        showMoreAdd.style.display = 'none';
    }
    showMoreAdd.onclick = function btnClickAdd() {
        let itemAdd = document.querySelectorAll('.add-service');
        let blockAdd = document.querySelector('.add-title');
        itemAdd.forEach(itemAdd => {
            if (itemAdd.classList.contains("add-show")) {
                blockAdd.scrollIntoView({
                    block: "start",
                    behavior: "smooth"
                });
                showMoreAdd.innerHTML = "Zobacz więcej";
            } else {
                showMoreAdd.innerHTML = "Zobacz mniej";
            }
            itemAdd.classList.toggle("add-show");
        });
    };
}
//Reset checkbox


if (document.getElementById('form-choice')) {
    let formChoice = document.getElementById('form-choice');
    formChoice.reset();
    for (i = 0; i < formChoice.elements.length; i++) {

        if (formChoice.elements.type == "checkbox") {

            formChoice.elements.checked = false;
        }
    }
}
//======================================================================================

//===============================================================
//DATEPICKER OPTIONS
let hourr = document.querySelectorAll('.days__item');


for (let hh = 0; hh < hourr.length; hh++) {
    hourr[hh].addEventListener('click', hours);
}

function hours() {
    let dateHour = (this.innerHTML).replace(/\s+/g, '');
    document.querySelector('#datePick2').value = dateHour;
}



var ua = window.navigator.userAgent;
var msie = ua.indexOf("MSIE ");
var isMobile = {
    Android: function () {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function () {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function () {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function () {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function () {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function () {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

function isIE() {
    ua = navigator.userAgent;
    var is_ie = ua.indexOf("MSIE ") > -1 || ua.indexOf("Trident/") > -1;
    return is_ie;
}
if (isIE()) {
    document.querySelector('html').classList.add('ie');
}
if (isMobile.any()) {
    document.querySelector('html').classList.add('_touch');
}

function testWebP(callback) {
    var webP = new Image();
    webP.onload = webP.onerror = function () {
        callback(webP.height == 2);
    };
    webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
}
testWebP(function (support) {
    if (support === true) {
        document.querySelector('html').classList.add('_webp');
    } else {
        document.querySelector('html').classList.add('_no-webp');
    }
});

function ibg() {
    if (isIE()) {
        let ibg = document.querySelectorAll("._ibg");
        for (var i = 0; i < ibg.length; i++) {
            if (ibg[i].querySelector('img') && ibg[i].querySelector('img').getAttribute('src') != null) {
                ibg[i].style.backgroundImage = 'url(' + ibg[i].querySelector('img').getAttribute('src') + ')';
            }
        }
    }
}
ibg();

window.addEventListener("load", function () {
    if (document.querySelector('.wrapper')) {
        setTimeout(function () {
            document.querySelector('.wrapper').classList.add('_loaded');
        }, 0);
    }
});

let unlock = true;

//=================
//ActionsOnHash
if (location.hash) {
    const hsh = location.hash.replace('#', '');
    if (document.querySelector('.popup_' + hsh)) {
        popup_open(hsh);
    } else if (document.querySelector('div.' + hsh)) {
        _goto(document.querySelector('.' + hsh), 500, '');
    }
}
//=================
//Menu
let iconMenu = document.querySelector(".icon-menu");
if (iconMenu != null) {
    let delay = 500;
    let menuBody = document.querySelector(".menu__body");
    iconMenu.addEventListener("click", function (e) {
        if (unlock) {
            body_lock(delay);
            iconMenu.classList.toggle("_active");
            menuBody.classList.toggle("_active");
        }
    });
};

function menu_close() {
    let iconMenu = document.querySelector(".icon-menu");
    let menuBody = document.querySelector(".menu__body");
    iconMenu.classList.remove("_active");
    menuBody.classList.remove("_active");
}
//=================
//BodyLock
function body_lock(delay) {
    let body = document.querySelector("body");
    if (body.classList.contains('_lock')) {
        body_lock_remove(delay);
    } else {
        body_lock_add(delay);
    }
}

function body_lock_remove(delay) {
    let body = document.querySelector("body");
    if (unlock) {
        let lock_padding = document.querySelectorAll("._lp");
        setTimeout(() => {
            for (let index = 0; index < lock_padding.length; index++) {
                const el = lock_padding[index];
                el.style.paddingRight = '0px';
            }
            body.style.paddingRight = '0px';
            body.classList.remove("_lock");
        }, delay);

        unlock = false;
        setTimeout(function () {
            unlock = true;
        }, delay);
    }
}

function body_lock_add(delay) {
    let body = document.querySelector("body");
    if (unlock) {
        let lock_padding = document.querySelectorAll("._lp");
        for (let index = 0; index < lock_padding.length; index++) {
            const el = lock_padding[index];
            el.style.paddingRight = window.innerWidth - document.querySelector('.wrapper').offsetWidth + 'px';
        }
        body.style.paddingRight = window.innerWidth - document.querySelector('.wrapper').offsetWidth + 'px';
        body.classList.add("_lock");

        unlock = false;
        setTimeout(function () {
            unlock = true;
        }, delay);
    }
}
//=================
//Spollers
let spollers = document.querySelectorAll("._spoller");
let spollersGo = true;
if (spollers.length > 0) {

    function spollerCLick(e) {
        const spoller = e.target.classList.contains('_spoller') ? e.target : e.target.closest('._spoller');
        if (spollersGo) {
            spollersGo = false;

            if (spoller.closest('._spollers').classList.contains('_one')) {
                let curent_spollers = spoller.closest('._spollers').querySelectorAll('._spoller');
                for (let i = 0; i < curent_spollers.length; i++) {
                    let el = curent_spollers[i];
                    if (el != spoller) {
                        el.classList.remove('_active');
                        _slideUp(el.nextElementSibling);
                    }
                }
            }
            console.log(spoller.nextElementSibling);
            spoller.classList.toggle('_active');
            _slideToggle(spoller.nextElementSibling);

            setTimeout(function () {
                spollersGo = true;
            }, 500);
        }
    }

    function spollersInit() {
        for (let index = 0; index < spollers.length; index++) {
            const spoller = spollers[index];
            let spollerMax = spoller.getAttribute('data-max');

            if (spollerMax && window.innerWidth > spollerMax) {
                if (spoller.classList.contains('_init')) {
                    spoller.classList.remove('_active');
                    spoller.classList.remove('_init');
                    spoller.nextElementSibling.style.cssText = '';
                    spoller.removeEventListener("click", spollerCLick);
                }
            } else if (!spoller.classList.contains('_init')) {
                spoller.classList.add('_init');
                spoller.addEventListener("click", spollerCLick);
            }
        }
    }

    function spollersShowActive() {
        for (let index = 0; index < spollers.length; index++) {
            const spoller = spollers[index];
            if (spoller.classList.contains('_active')) {
                _slideToggle(spoller.nextElementSibling);
            }
        }
    }
    window.addEventListener("resize", spollersInit);

    setTimeout(function () {
        spollersShowActive();
        spollersInit();
    }, 0);
}
//=================
//DigiFormat
function digi(str) {
    var r = str.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, "$1 ");
    return r;
}
//=================
//SlideToggle
let _slideUp = (target, duration = 500) => {
    target.style.transitionProperty = 'height, margin, padding';
    target.style.transitionDuration = duration + 'ms';
    target.style.height = target.offsetHeight + 'px';
    target.offsetHeight;
    target.style.overflow = 'hidden';
    target.style.height = 0;
    target.style.paddingTop = 0;
    target.style.paddingBottom = 0;
    target.style.marginTop = 0;
    target.style.marginBottom = 0;
    window.setTimeout(() => {
        target.style.display = 'none';
        target.style.removeProperty('height');
        target.style.removeProperty('padding-top');
        target.style.removeProperty('padding-bottom');
        target.style.removeProperty('margin-top');
        target.style.removeProperty('margin-bottom');
        target.style.removeProperty('overflow');
        target.style.removeProperty('transition-duration');
        target.style.removeProperty('transition-property');
        target.classList.remove('_slide');
    }, duration);
}
let _slideDown = (target, duration = 500) => {
    target.style.removeProperty('display');
    let display = window.getComputedStyle(target).display;
    if (display === 'none')
        display = 'block';

    target.style.display = display;
    let height = target.offsetHeight;
    target.style.overflow = 'hidden';
    target.style.height = 0;
    target.style.paddingTop = 0;
    target.style.paddingBottom = 0;
    target.style.marginTop = 0;
    target.style.marginBottom = 0;
    target.offsetHeight;
    target.style.transitionProperty = "height, margin, padding";
    target.style.transitionDuration = duration + 'ms';
    target.style.height = height + 'px';
    target.style.removeProperty('padding-top');
    target.style.removeProperty('padding-bottom');
    target.style.removeProperty('margin-top');
    target.style.removeProperty('margin-bottom');
    window.setTimeout(() => {
        target.style.removeProperty('height');
        target.style.removeProperty('overflow');
        target.style.removeProperty('transition-duration');
        target.style.removeProperty('transition-property');
        target.classList.remove('_slide');
    }, duration);
}
let _slideToggle = (target, duration = 500) => {
    if (!target.classList.contains('_slide')) {
        target.classList.add('_slide');
        if (window.getComputedStyle(target).display === 'none') {
            return _slideDown(target, duration);
        } else {
            return _slideUp(target, duration);
        }
    }
}
//========================================
//Wrap
function _wrap(el, wrapper) {
    el.parentNode.insertBefore(wrapper, el);
    wrapper.appendChild(el);
}
//========================================
//RemoveClasses
function _removeClasses(el, class_name) {
    for (var i = 0; i < el.length; i++) {
        el[i].classList.remove(class_name);
    }
}
//========================================
//Полифилы
(function () {
    // проверяем поддержку
    if (!Element.prototype.closest) {
        // реализуем
        Element.prototype.closest = function (css) {
            var node = this;
            while (node) {
                if (node.matches(css)) return node;
                else node = node.parentElement;
            }
            return null;
        };
    }
})();
(function () {
    // проверяем поддержку
    if (!Element.prototype.matches) {
        // определяем свойство
        Element.prototype.matches = Element.prototype.matchesSelector ||
            Element.prototype.webkitMatchesSelector ||
            Element.prototype.mozMatchesSelector ||
            Element.prototype.msMatchesSelector;
    }
})();


const picker = datepicker('#datePick', {

    // Customizations.
    formatter: (input, date, instance) => {
        // This will display the date as `1/1/2019`.
        input.value = date.toLocaleDateString();
    },

    // Settings.
    alwaysShow: true, // Never hide the calendar.
    dateSelected: new Date(), // Today is selected.
    maxDate: new Date(2099, 0, 1), // Jan 1st, 2099.
    minDate: new Date(), // June 1st, 2016.
    startDate: new Date(), // This month.
    showAllDates: false, // Numbers for leading & trailing days outside the current month will show.
    customMonths: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień',
        'Wrzesień', 'Październik', 'Listopad', 'Grudzień'
    ],
    customDays: ['Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'So', 'N'],
});


