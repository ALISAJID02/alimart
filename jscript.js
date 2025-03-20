    let category = document.querySelectorAll('.category-product');
let brand = document.querySelectorAll('.brand-image');
let count = 0;

// Get the total number of items for categories and brands
const totalCategories = category.length;
const totalBrands = brand.length;

const catpre = () => {
    // Decrease the count to go to the previous item
    count--;
    if (count < 0) {
        count = totalCategories - 1; // If at the beginning, go to the last item
    }
    catslider();
}

const catnext = () => {
    // Increase the count to go to the next item
    count++;
    if (count >= totalCategories) {
        count = 0; // If at the end, go to the first item
    }
    catslider();
}

const catslider = () => {
    // Move each category item based on the count
    category.forEach((slide) => {
        slide.style.transition = "transform 0.5s ease"; // Smooth transition
        slide.style.transform = `translateX(${count * -230}px)`; // Move based on count
    });
}

const brandpre = () => {
    // Decrease the count to go to the previous item for brands
    count--;
    if (count < 0) {
        count = totalBrands - 1; // If at the beginning, go to the last item
    }
    brandslider();
}

const brandnext = () => {
    // Increase the count to go to the next item for brands
    count++;
    if (count >= totalBrands) {
        count = 0; // If at the end, go to the first item
    }
    brandslider();
}

const brandslider = () => {
    // Move each brand item based on the count
    brand.forEach((slide) => {
        slide.style.transition = "transform 0.5s ease"; // Smooth transition
        slide.style.transform = `translateX(${count * -200}px)`; // Move based on count
    });
}

let slides = document.querySelectorAll('.slides');

let counter = 0;
slides.forEach(
    (slide, index) => {

        slide.style.left = `${index * 100}%`;
    }
)

const goPre = () => {
    counter--;

    imgSlider();
}
const goNext = () => {
    counter++;
    if (counter >= slides.length) {
        counter = 0;
    }
    imgSlider();
}

const imgSlider = () => {
    slides.forEach(
        (slide) => {
            slide.style.transform = `translateX(-${counter * 100}%)`
        }
    )

}

setInterval(goNext, 3000);


let blog = document.querySelectorAll('.latest-blog-product');
let counte = 0;
const blogpre = () => {
    counte++;
    blogslider();
}
const blognext = () => {
    counte--;
    blogslider();
}

const blogslider = () => {
    blog.forEach(
        (slide) => {
            slide.style.transform = `translateX(${counte * 450}px)`
        }
    )

};

let quick = document.querySelectorAll('.quickslides');
let counting = 0;
const quickleft = () => {
    counting++;
    quickslider();
}
const quickright = () => {
    counting--;
    quickslider();
}

const quickslider = () => {
    quick.forEach(
        (slide) => {
            slide.style.transform = `translateY(${counting * 40}px)`
        }
    )

};
var show = 1;
parseInt(show);
function minusbtn() {
    if (show <= 100 && show <= 0) {
        return 1;
    }
    show--;
    document.getElementById("counter").value = show;
}
function plusbtn() {
    if (show >= 100 && show >= 0) {
        return 1;
    }
    show++;
    document.getElementById("counter").value = show;
}

