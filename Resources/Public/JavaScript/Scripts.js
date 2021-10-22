function updateHardcopy() {
    if ($('#hardcopy INPUT').is(':checked')) {
        $('#serreportfile').hide();
        $('#serreportfile INPUT').attr('disabled', 'disabled');
    } else {
        $('#serreportfile').show();
        $('#serreportfile INPUT').removeAttr('disabled');
        if ($('#serreportfile INPUT').get(0).files.length > 0) {
            $('#hardcopy').hide();
            $('#hardcopy INPUT').attr('disabled', 'disabled');
        } else {
            $('#hardcopy').show();
            $('#hardcopy INPUT').removeAttr('disabled');
        }
    }
}

function updateType() {
    if ($('#type').val() != 1) {
        $('#programs').hide();
    } else {
        $('#programs').show();
    }
}

define(['jquery', 'TYPO3/CMS/WpDeqarReports/Select2'], function ($, Select2) {

    $(document).ready(function () {

        updateHardcopy();
        updateType();

        $('.select2').select2({
            ajax: {
                url: '/?type=123',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term
                    }
                    // Query parameters will be ?search=[term]&type=public
                    return query;
                }
            }
        });

        $(document).on('click', '#addprogram', function (e) {
            e.preventDefault();
            var newProgramm = $('#newProgram').html();
            $('.programs').append(newProgramm);
            return false;
        });

        $(document).on('change', '#hardcopy, #serreportfile', function (e) {
            updateHardcopy();
        });
        $(document).on('change', '#type', function (e) {
            updateType();
        });
    });

});