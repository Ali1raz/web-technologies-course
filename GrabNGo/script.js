[
  document.querySelector("input[type='checkbox'].menu"),
  document.querySelector("input[type='checkbox'].menu-close"),
  document.querySelector("ul.menu-list"),
].forEach((item) =>
  item.addEventListener("click", () => {
    document.querySelector("ul").classList.toggle("checked");
  })
);

document.querySelector("form.search").addEventListener("submit", (e) => {
  e.preventDefault();
  if (document.querySelector("input[type='text']#search").value === "") {
    alert("input cant be empty");
  } else {
    alert(
      `Query: ${document.querySelector("input[type='text']#search").value}`
    );
  }
});

document.querySelectorAll(".order-now").forEach((button) => {
  button.addEventListener("click", function () {
    const menuCard = button.parentElement;

    const confirmationMessage = menuCard.querySelector(".confirmation-message");
    confirmationMessage.textContent = `${
      menuCard.querySelector("h3").textContent
    } added to your order!`;
    confirmationMessage.style.display = "block";
  });
});

// Add 3D effect for hero section
const hero = document.querySelector('.hero');

hero.addEventListener('mousemove', (e) => {
    const { left, top, width, height } = hero.getBoundingClientRect();
    const x = (e.clientX - left - width / 2) / (width / 2);
    const y = (e.clientY - top - height / 2) / (height / 2);
    
    // Calculate rotation angles (limited to 15 degrees)
    const rotateX = -y * 15;
    const rotateY = x * 15;
    
    // Update CSS variables
    hero.style.setProperty('--rotate-x', `${rotateX}deg`);
    hero.style.setProperty('--rotate-y', `${rotateY}deg`);
});

// Reset rotation when mouse leaves
hero.addEventListener('mouseleave', () => {
    hero.style.setProperty('--rotate-x', '0deg');
    hero.style.setProperty('--rotate-y', '0deg');
});
