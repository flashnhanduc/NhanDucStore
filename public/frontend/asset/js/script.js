const sliderItem = document.querySelectorAll('.slider-item')
for (let index = 0; index < sliderItem.length; index++) {

    sliderItem[index].style.left = index * 100 + "%"

}
const sliderItems = document.querySelector('.slider-items')
const arrowRight = document.querySelector('.ri-arrow-right-line')
const arrowLeft = document.querySelector('.ri-arrow-left-line')
let i = 0
if (arrowRight != null && arrowLeft != null) {
    arrowRight.addEventListener('click', () => {
        if (i < sliderItem.length - 1) {
            i++
            console.log(i)
            sliderMove(i)
        }
        else {
            return false
        }
    })
    arrowLeft.addEventListener('click', () => {
        if (i <= 0) {
            return false
        }
        {
            i--
            console.log(i)
            sliderMove(i)
        }
    })

}

function autoSlider() {
    if (i < sliderItem.length - 1) {
        i++
        sliderMove(i)
    }
    else {
        i = 0

    }
}
function sliderMove(i) {
    sliderItems.style.left = -i * 100 + "%"

}
setInterval(autoSlider, 5000)
//Menu res
const MenuBar = document.querySelector('.header-bar-icon')
const headerNav = document.querySelector('.header-nav')
MenuBar.addEventListener('click', () => {
    headerNav.classList.toggle('active')
})
//stickey header
window.addEventListener('scroll', () => {
    if (scrollY > 50) {
        document.querySelector('#header').classList.add('active')
    }
    else {
        document.querySelector('#header').classList.remove('active')
    }

})
//clip product img detail
const imageSmall = document.querySelectorAll('.product-images-items img')
const imageMain = document.querySelector('.main-image')
for (let index = 0; index < imageSmall.length; index++) {
    imageSmall[index].addEventListener('click', () => {
        for (let a = 0; a < imageSmall.length; a++) {
            imageSmall[a].classList.remove('active')

        }
        imageMain.src = imageSmall[index].src

        imageSmall[index].classList.add('active')

    })
}
// quantity -product
const quanPlus = document.querySelectorAll('.ri-add-line')
const quanMinus = document.querySelectorAll('.ri-subtract-line')
const quanInput = document.querySelectorAll('.quantity-input')

if (quanMinus != null && quanPlus != null) { 
    for (let index = 0; index < quanMinus.length; index++) {

        quanPlus[index].addEventListener('click', () => {
            inputValue = quanInput[index].value
            inputValue ++
            quanInput[index].value = inputValue
              
            // console.log(quanInput.value)
            // console.log(qty)
        })
        quanMinus[index].addEventListener('click', () => {
            inputValue = quanInput[index].value
            if (inputValue <= 1) {
                return false
            }
            else {
                inputValue--
               quanInput[index].value = inputValue
            }
        })
    }
}





