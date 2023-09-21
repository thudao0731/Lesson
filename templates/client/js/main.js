var acc = document.getElementsByClassName("chapter");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}


const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const menus = $$('.menu-item');

menus.forEach((menu) => {
    menu.onClick = function() {
      this.classList.add('active_header');
    }
});

