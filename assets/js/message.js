document.addEventListener("DOMContentLoaded", () => {
  const toastData = document.getElementById("toast-data");

  if (toastData) {
    const message = toastData.getAttribute("data-message");
    const type = toastData.getAttribute("data-type");

    Swal.fire({
      toast: true,
      position: "top-end",
      icon: type,
      title: message,
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });
  }
});
