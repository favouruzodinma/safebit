document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.querySelector('.overlay');
    const overlayContent = document.querySelector('.overlay-content');
    const menuIcon = document.getElementById('menuIcon');
  
    menuIcon.addEventListener('click', function () {
      if (overlay.style.width === '250px') {
        closeMenu();
      } else {
        openMenu();
      }
    });
  
    // Close the menu if the overlay is clicked
    overlay.addEventListener('click', function () {
      closeMenu();
    });
  
    // Close the menu when a menu item is clicked
    const menuItems = document.querySelectorAll('.overlay-content a');
    menuItems.forEach(function (item) {
      item.addEventListener('click', function () {
        closeMenu();
      });
    });
  
    function openMenu() {
      overlay.style.width = '250px';
      overlayContent.style.left = '0';
    }
  
    function closeMenu() {
      overlay.style.width = '0';
      overlayContent.style.left = '-250px';
    }
  });
  
  