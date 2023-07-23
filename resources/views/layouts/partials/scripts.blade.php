<script src="{{ asset('js/jquery1-3.4.1.min.js') }}"></script>

<script src="{{ asset('js/popper1.min.js') }}"></script>

<script src="{{ asset('js/bootstrap1.min.js') }}"></script>

<script src="{{ asset('js/metisMenu.js') }}"></script>

<script src="{{ asset('vendors/count_up/jquery.waypoints.min.js') }}"></script>

<script src="{{ asset('vendors/chartlist/Chart.min.js') }}"></script>

<script src="{{ asset('vendors/count_up/jquery.counterup.min.js') }}"></script>

<script src="{{ asset('vendors/swiper_slider/js/swiper.min.js') }}"></script>

<script src="{{ asset('vendors/niceselect/js/jquery.nice-select.min.js') }}"></script>

<script src="{{ asset('vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('vendors/gijgo/gijgo.min.js') }}"></script>

<script src="{{ asset('vendors/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/datatable/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('vendors/datatable/js/jszip.min.js') }}"></script>
<script src="{{ asset('vendors/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendors/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendors/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendors/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/chart.min.js') }}"></script>

<script src="{{ asset('vendors/progressbar/jquery.barfiller.js') }}"></script>

<script src="{{ asset('vendors/tagsinput/tagsinput.js') }}"></script>

<script src="{{ asset('vendors/text_editor/summernote-bs4.js') }}"></script>
<script src="{{ asset('vendors/apex_chart/apexcharts.js') }}"></script>

<script src="{{ asset('js/custom.js') }}"></script>


<script src="{{ asset('js/active_chart.js') }}"></script>
<script src="{{ asset('vendors/apex_chart/radial_active.js') }}"></script>
<script src="{{ asset('vendors/apex_chart/stackbar.js') }}"></script>
<script src="{{ asset('vendors/apex_chart/area_chart.js') }}"></script>
<script src="{{ asset('vendors/apex_chart/bar_active_1.js') }}"></script>
<script src="{{ asset('vendors/chartjs/chartjs_active.js') }}"></script>

<script>
    $('#search').on('keyup', function() {
        $value = $(this).val().toLowerCase();
        //find the entire table with class lms_table_active
        //not call the ajax
        $('.lms_table_active tbody tr').each(function(index, elem) {
            //index is the number of the row
            //elem is the row itself
            //find the td in the row
            //find the first td in the row
            //find the text in the first td
            //if the text in the first td is equal to the value of the input
            //show the row
            //if not hide the row
            var found = false;
            $(elem).find('td').each(function(index, elem) {
                var id = $(elem).text().toLowerCase();
                if (id.indexOf($value) !== -1) {
                    found = true;
                }
            });
            if (found == true) {
                $(elem).show();
            } else {
                $(elem).hide();
            }
        });
    })
</script>

@stack('scripts')
