
// If there's an error response, show it in the toast
document.addEventListener('htmx:responseError', event => {
	const toastEl = document.getElementById('toast');
	toastEl.querySelector('.toast-body').textContent = event.detail.xhr.responseText;
	const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
	toast.show();
});
