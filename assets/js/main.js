console.log('hello from assignment js script');

const items = document.querySelectorAll('.accordian__heading');
const contents = document.querySelectorAll('.accordian__content');
const images = document.querySelectorAll('.accordian__image');

items.forEach((item, index) => {
    item.addEventListener('click', () => {

        items.forEach(sib => sib.classList.remove('active'));
        item.classList.add('active');

        contents.forEach(sib => sib.classList.remove('active'));
        contents[index].classList.add('active');

        images.forEach(sib => sib.classList.remove('active'));
        images[index].classList.add('active');
    })
});