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
