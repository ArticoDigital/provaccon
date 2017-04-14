$("#owl-carousel").owlCarousel({
    navigation: true,
    slideSpeed: 400,
    paginationSpeed: 400,
    autoPlay : 5000,
    singleItem: true,
    navigationText: ["", ""],
});
$("#ClientsOwl").owlCarousel({
    navigationText: ["<", ">"],
    navigation: true,
    slideSpeed: 400,
    paginationSpeed: 400,
    autoPlay : 5000,
    items : 3, //10 items above 1000px browser width
    itemsDesktop : [1000,5], //5 items between 1000px and 901px
    itemsDesktopSmall : [900,3], // betweem 900px and 601px
    itemsTablet: [600,1], //2 items between 600 and 0;
    itemsMobile : [600,1], // itemsMobile disabled - inherit from itemsTablet option

});
$('.Header-buttonNav').on('click',function () {
    $('.Header-bar').toggleClass('open')
});
$('.content-menu  ul li').on('click',function () {
    
    var $ul =  $(this).find('ul');
    if($ul.hasClass('open')){
       $ul.css('display','none')
    }else{
        $ul.css('display','block')
    }
    $ul.toggleClass('open')

});
