[
  document.querySelector("input[type='checkbox'].menu"),
  document.querySelector("input[type='checkbox'].menu-close"),
  document.querySelector("ul.menu-list"),
].forEach((item) =>
  item.addEventListener("click", () => {
    document.querySelector("ul").classList.toggle("checked");
  })
);
