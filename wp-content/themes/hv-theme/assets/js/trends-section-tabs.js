document.addEventListener("DOMContentLoaded", function () {
  // trends-section-tabs
  const tabButtons = document.querySelectorAll(
    ".trends-section-tabs__pills .trends-section-tabs-btn"
  );
  const tabContents = document.querySelectorAll(
    ".trends-section-tabs__panels > div"
  );

  if (tabButtons && tabContents) {
    tabButtons.forEach((tabBtn) => {
      tabBtn.addEventListener("click", () => {
        const tabId = tabBtn.getAttribute("data-id");

        tabButtons.forEach((btn) => btn.classList.remove("active"));
        tabBtn.classList.add("active");

        tabContents.forEach((content) => {
          content.classList.remove("active");

          if (content.id === tabId) {
            content.classList.add("active");
          }
        });
      });
    });
  }
});
