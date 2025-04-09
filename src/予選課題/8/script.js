const btn = document.getElementById("button");
const content = document.getElementById("show");

btn.addEventListener("click", () => {
  if (content.style.display !== "none") {
    content.style.display = "none";
    btn.textContent = "表示";
  } else {
    content.style.display = "block";
    btn.textContent = "非表示";
  }
});