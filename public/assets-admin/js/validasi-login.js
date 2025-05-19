const successfulMsg = $(".flash_msg").data("successful");
const failedMsg = $(".flash_msg").data("failed");
const goofyMsg = $(".flash_msg").data("goofy");
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "2000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
if (successfulMsg) {
  toastr.success(`anda berhasil keluar ...`);
} else if (failedMsg) {
  toastr.danger(`Login Gagal.. Username Atau Kata Sandi yang anda masukkan salah.`);
} 
else if (goofyMsg) {
  toastr.info(`Anda belum login! Silahkan login terlebih dahulu`);

}
// if (goofyMsg) {
//   toastr.error(`Anda belum login! Silahkan login terlebih dahulu`);
// }
