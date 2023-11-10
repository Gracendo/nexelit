var images = document.querySelectorAll('img');
var imageOptions = {};

images.forEach(function (value,index){
    var imageSrc = value.getAttribute('src');
    value.removeAttribute('src');
    value.setAttribute('data-src',imageSrc);
});

var observer = new IntersectionObserver(function (entries,observer){
    entries.forEach(function(entry){
       if (!entry.isIntersecting){return;}
        var image = entry.target;
        var imageSrc = image.getAttribute('data-src');
        image.setAttribute('src',imageSrc);
        observer.unobserve(image);
    });
},imageOptions);

images.forEach(function (image){
    observer.observe(image);
});