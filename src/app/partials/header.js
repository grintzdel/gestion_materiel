const tl = gsap.timeline({paused: true});

/*
Open and close menu
*/
function openNav() {
    animateOpenNav();
    const navBtn = document.querySelector(".header__button--toggle");
    navBtn.onclick = function (e) {
        navBtn.classList.toggle("active");
        tl.reversed(!tl.reversed());
    };
}

openNav();

/*
Animate menu with GSAP
*/
function animateOpenNav() {
    tl.to(".header__nav", 0.2, {
        autoAlpha: 1,
        delay: 0.1,
    });

    tl.from(".header__nav__menu__list > div", 0.4, {
        opacity: 0,
        y: 10,
        stagger: {
            amount: 0.04,
        },
    });

    tl.to(
        ".header__nav__menu__list__items__item > a",
        0.8,
        {
            top: -15,
            ease: "power2.inOut",
            stagger: {
                amount: 0.1,
            },
        },
        "-=0.4"
    ).reverse();
}