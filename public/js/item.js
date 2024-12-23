document.addEventListener('click', function(event) {
if (event.target.classList.contains('add-remove-item')) {
const container = document.getElementById('itemContainer');
const currentRow = event.target.closest('.item-row');
if (event.target.textContent === '+') {
const newRow = currentRow.cloneNode(true);
newRow.querySelectorAll('input, textarea').forEach(input => input.value = '');
container.insertBefore(newRow, container.firstChild);
event.target.textContent = '-';
} else if (event.target.textContent === '-') {
currentRow.remove();
}
}
});
