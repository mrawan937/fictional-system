document.getElementById('bookingForm').addEventListener('submit', function(e) {
  e.preventDefault();
  document.getElementById('bookingForm').classList.add('hidden');
  document.getElementById('confirmation').classList.remove('hidden');
});
