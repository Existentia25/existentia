//TESTIMONIAL//

$('.testimonials-container').owlCarousel({
    loop:true,
    autoplay:true,
    autoplayTimeout:4000,
    margin:10,
    nav:true,
    navText:["<i class='ri-arrow-left-line'></i>",
             "<i class='ri-arrow-right-line'></i>"],
    responsive:{
        0:{
            items:1
        },
        768:{
            items:2
        },

    }
})