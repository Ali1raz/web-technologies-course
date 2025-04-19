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
