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


// Get all the menu items
const menuItems = document.querySelectorAll('.menu-item');

// Function to handle click event
function handleClick(event) {
  // Remove 'active' class from all menu items
  menuItems.forEach(item => item.classList.remove('active'));

  // Add 'active' class to the clicked menu item
  event.target.classList.add('active');
}

// Attach click event listener to each menu item
menuItems.forEach(item => {
  item.addEventListener('click', handleClick);
});

let data = "SELECT * FROM lesson";
console.log(data);