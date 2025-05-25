    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('backend/js/demo/chart-pie-demo.js') }}"></script>

    <!--Data table -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function sweetAlertDelete(id) {
            event.preventDefault();
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this Information!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Your data has been deleted!", {
                            icon: "success",
                            buttons: false,
                            timer: 2000
                        });
                        $("#deleteButton" + id).submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
        }
    </script>
