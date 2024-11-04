document.querySelectorAll('.form-select-wrapper').forEach(wrapper => {
  wrapper.addEventListener('click', function() {
    this.classList.toggle('open');
  });
});
