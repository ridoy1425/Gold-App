$(function () {
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate: '<div class="title">#title#</div>',
        labels: {
            previous: 'Previous',
            next: 'Next Step',
            current: ''
        },
    });

    function initializeDatepicker() {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: "-70:+50",
        });
    }

    function calculateAndDisplayAge(dateFieldId, ageFieldId) {
        $(dateFieldId).datepicker({
            dateFormat: 'yy/mm/dd',
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            maxDate: new Date(),
            inline: true,

            onSelect: function () {
                var Day = $(dateFieldId).val();
                var date = new Date(Day);
                var today = new Date();
                const ageInMillis = today - date;
                const ageDate = new Date(ageInMillis);
                const years = ageDate.getUTCFullYear() - 1970;
                const months = ageDate.getUTCMonth();
                const days = ageDate.getUTCDate() - 1;
                var ageTotal = years + " Y," + months + " M," + days + " D";
                $(ageFieldId).val(ageTotal);
            }
        });
    }


    // image preview ----------------------------8888888888888888---------------------
    function displayImages(input) {
        const imagePreview = document.querySelector('.image-preview');
        imagePreview.innerHTML = ''; // Clear previous previews

        const files = input.files;
        for (let i = 0; i < files.length; i++) {
            const image = document.createElement('img');
            image.height = 30;
            image.width = 30;
            image.src = window.URL.createObjectURL(files[i]);

            const downloadLink = document.createElement('a');
            downloadLink.href = image.src;
            downloadLink.download = `image_${i + 1}.jpg`;
            downloadLink.appendChild(image);

            imagePreview.appendChild(downloadLink);
        }
    }

    var i = 0;
    $("#add").click(function () {
        $.get(appConfig.getLaravelUrl + '/employee/get-degrees', function (response) {
            var count = $('#academic_form_count').val();
            if (count) {
                i = count;
                count++
                $('#academic_form_count').val(count);
            }
            ++i;
            var degrees = response.degrees;
            var selectOptions = '<option value="">Choose...</option>';
            degrees.forEach(function (degree) {
                selectOptions += '<option value="' + degree.id + '">' + degree.value + '</option>';
            }, 'json');

            $("#dynamicTable").append('<tr><td><select class="form-select-sm form-select degree" name="addmore[' + i + '][degree_id]">' + selectOptions + '</select></td><td><input type="text" name="addmore[' + i + '][institute]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][pass_yr]"  class="form-control form-control-sm"/></td><td><input type="text" name="addmore[' + i + '][grade]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][discipline]" class="form-control form-control-sm" /></td><td><div class="row"><div class="col-md-4"><input type="file" class="form-control form-control-sm" name="addmore[' + i + '][attachment][]" multiple onchange="displayImages(this)"></div><div class="col-md-8"><div class="image-preview"></div></div></div ></td><td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i class="fas fa-trash nav-icon"></i></button></td></tr>');
            initializeDatepicker();
        });
    });

    $("#add_employment").click(function () {
        var count = $('#employment_form_count').val();
        if (count) {
            i = count;
            count++
            $('#employment_form_count').val(count);
        }
        ++i;
        $("#employmentTable").append('<tr><td><input type="text" name="addmore[' + i + '][org_name]" class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][org_address]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][last_position]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][service_from]"  class="form-control form-control-sm datepicker" /></td><td><input type="text" name="addmore[' + i + '][service_to]"  class="form-control form-control-sm datepicker" /></td><td><input type="text" name="addmore[' + i + '][separation]"  class="form-control form-control-sm" /></td><td><div class="row"><div class="col-md-4"><input type="file" class="form-control form-control-sm" name="addmore[' + i + '][attachment][]" multiple onchange="displayImages(this)"></div><div class="col-md-8"><div class="image-preview"></div></div></div ></td><td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i class="fas fa-trash nav-icon"></i></button></td></tr>');
        initializeDatepicker();
    });

    $("#add_profession").click(function () {
        var count = $('#professional_form_count').val();
        if (count) {
            i = count;
            count++
            $('#professional_form_count').val(count);
        }
        ++i;
        $("#professionTable").append('<tr><td><input type="text" name="addmore[' + i + '][degree]" class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][institute]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][duration_from]"  class="form-control form-control-sm datepicker" /></td><td><input type="text" name="addmore[' + i + '][duration_to]"  class="form-control form-control-sm datepicker" /></td><td><input type="text" name="addmore[' + i + '][grade]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][area]"  class="form-control form-control-sm" multiple /></td><td><div class="row"><div class="col-md-4"><input type="file" class="form-control form-control-sm" name="addmore[' + i + '][attachment][]" multiple onchange="displayImages(this)"></div><div class="col-md-8"><div class="image-preview"></div></div></div ></td><td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i class="fas fa-trash nav-icon"></i></button></td></tr>');
        initializeDatepicker();
    });

    $("#add_training").click(function () {
        var count = $('#training_form_count').val();
        if (count) {
            i = count;
            count++
            $('#training_form_count').val(count);
        }
        ++i;
        $("#trainingTable").append('<tr><td><input type="text" name="addmore[' + i + '][training]" class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][institute]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][org_by]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][topic]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][duration_from]"  class="form-control form-control-sm datepicker" /></td><td><input type="text" name="addmore[' + i + '][duration_to]"  class="form-control form-control-sm datepicker" /></td><td><div class="row"><div class="col-md-4"><input type="file" class="form-control form-control-sm" name="addmore[' + i + '][attachment][]" multiple onchange="displayImages(this)"></div><div class="col-md-8"><div class="image-preview"></div></div></div ></td><td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i class="fas fa-trash nav-icon"></i></button></td></tr>');
        initializeDatepicker();
    });

    $("#add_family").click(function () {
        var count = $('#family_form_count').val();
        if (count) {
            i = count;
            count++
            $('#family_form_count').val(count);
        }
        ++i;
        $("#familyTable").append('<tr><td><input type="text" name="addmore[' + i + '][name]" class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][dob]"  class="form-control form-control-sm family_dob' + i + '" /></td><td><input type="text" name="addmore[' + i + '][age]"  class="form-control form-control-sm family_age' + i + '" /></td><td><input type="text" name="addmore[' + i + '][relation]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][occupation]"  class="form-control form-control-sm" /></td><td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i class="fas fa-trash nav-icon"></i></button></td></tr>');
        calculateAndDisplayAge(".family_dob" + i, ".family_age" + i);
    });

    $("#add_nominee").click(function () {
        var count = $('#nominee_form_count').val();
        if (count) {
            i = count;
            count++
            $('#nominee_form_count').val(count);
        }
        ++i;
        $("#nomineeTable").append('<tr><td><input type="text" name="addmore[' + i + '][name]" class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][dob]"  class="form-control form-control-sm datepicker" /></td><td><input type="text" name="addmore[' + i + '][relation]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][occupation]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][address]"  class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][amount]"  class="form-control form-control-sm" /></td><td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i class="fas fa-trash nav-icon"></i></button></td></tr>');
        initializeDatepicker();
    });

    $("#add_promotion").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post(appConfig.getLaravelUrl + '/designation/get-designation', function (response) {
            var count = $('#promotion_form_count').val();
            if (count) {
                i = count;
                count++
                $('#promotion_form_count').val(count);
            }
            ++i;

            var selectOptions = '<option value="">Choose...</option>';
            response.forEach(function (designation) {
                selectOptions += '<option value="' + designation.id + '">' + designation.designation + '</option>';
            }, 'json');
            $("#promotionTable").append('<tr><td><select class="form-select-sm form-select degree" name="addmore[' + i + '][designation_id]">' + selectOptions + '</select></td><td><input type="text" name="addmore[' + i + '][effective_date]"  class="form-control form-control-sm datepicker" /></td><td><input type="text" name="addmore[' + i + '][salary]"  class="form-control form-control-sm"/></td><td><input type="text" name="addmore[' + i + '][salary_grade]" class="form-control form-control-sm" /></td><td><input type="text" name="addmore[' + i + '][pay_step]" class="form-control form-control-sm" /></td><td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i class="fas fa-trash nav-icon"></i></button></td></tr>');
            initializeDatepicker();
        });
    });
    $(document).on('click', '.remove-tr', function () {
        $(this).parents('tr').remove();
    });

});
