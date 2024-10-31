document.querySelectorAll(".filter-content").forEach(function (content) {
  content.style.height = "auto";
});

document.querySelectorAll(".filter-header").forEach(function (header) {
  header.addEventListener("click", function () {
    const contents = header.parentNode.querySelectorAll(".filter-content");

    contents.forEach(function (content) {
      if (content.style.height === "0px" || content.style.height === "") {
        content.style.height = content.scrollHeight + "px";
        header.classList.add("active");

        setTimeout(function () {
          content.style.height = "auto";
        }, 300);
      } else {
        content.style.height = content.scrollHeight + "px";

        setTimeout(function () {
          content.style.height = "0";
        }, 10);

        header.classList.remove("active");
      }
    });
  });
});