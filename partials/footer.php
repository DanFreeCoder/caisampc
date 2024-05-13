<!-- JS for jQuery -->
<script src="../../assets/jquery/jquery-3.3.1.min.js"></script>
<!-- sweetAlert -->
<script src="../../assets/sweetAlert/sweetalert2.all.min.js"></script>
<!-- bootstrap js -->
<script src="../../assets/bootstrap5/bootstrap5.3.2.bundle.min.js"></script>
<!-- select2 plugins -->
<script src="../../assets/select2/js/select2.min.js"></script>

<script src="../../assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="../../assets/datatables/js/dataTables.bootstrap5.min.js"></script>
<!-- <script src="../../datepicker/dist/js/window-date-picker.min.js"></script> -->

<!-- notification -->
<script src="../../assets/toastr/toastr.min.js"></script>
<!-- toast -->
<script src="../../assets/toastr/toastr.min.js"></script>
<!-- loadingIndicator -->
<script src="../../assets/loadingIndicator/loading.toast.js"></script>
<!-- datepicker -->
<script src="../../assets/datapicker/bootstrap-datepicker.js"></script>

<script>
    $(document).ready(function() {
        // Toggle the side navigation
        const sidebarToggle = $('#sidebarToggle');
        if (sidebarToggle.length > 0) {
            // Uncomment Below to persist sidebar toggle between refreshes
            // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            //     $('body').toggleClass('sb-sidenav-toggled');
            // }
            sidebarToggle.on('click', function(event) {
                event.preventDefault();
                $('body').toggleClass('sb-sidenav-toggled');
                localStorage.setItem('sb|sidebar-toggle', $('body').hasClass('sb-sidenav-toggled'));
            });
        }
    });

    // logout
    function confirmLogout() {
        Swal.fire({
            title: "Are you sure you want to logout?",
            showCancelButton: true,
            confirmButtonText: "Yes",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location.href = '../../controller/logout.php';
            }
        });
    }
    // auto generate the age
    var age = '';
    const autoAge = (date, ageE) => {
        $(date).on('change', function() {
            var birthdate = new Date($(this).val());
            var today = new Date();
            age = today.getFullYear() - birthdate.getFullYear();
            var m = today.getMonth() - birthdate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }
            $(ageE).val(age);
        })
    }
    //for client age
    autoAge('#f_date_of_birth', '#f_age');
    // for spouse age
    autoAge('#f_spouse_birth', '#f_spouse_age');



    $(document).on('input', '#f_tin', function() {
        var input = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
        var formattedInput = '';

        // Insert hyphen every 3 digits, assuming the total length is less than or equal to 12
        for (var i = 0; i < Math.min(input.length, 12); i += 3) {
            formattedInput += input.substring(i, i + 3) + '-';
        }

        formattedInput = formattedInput.slice(0, -1); // Remove the trailing hyphen

        $(this).val(formattedInput);

        // Prevent further typing if the limit is reached
        if (input.length >= 12) {
            $(this).unbind('input');
        }
    });

    // height trapping
    $('#f_height').on('input', function() {
        var inputValue = $(this).val();
        if (inputValue.length > 3) {
            // Filter non-digits from input value.
            var filteredValue = inputValue.replace(/\D/g, '');
            // Truncate the value to 10 digits after filtering.
            $(this).val(filteredValue.substring(0, 2));
        }
    });

    // weight trapping
    $('#f_weight').on('input', function() {
        var inputValue = $(this).val();
        if (inputValue.length > 3) {
            // Filter non-digits from input value.
            var filteredValue = inputValue.replace(/\D/g, '');
            // Truncate the value to 10 digits after filtering.
            $(this).val(filteredValue.substring(0, 2));
        }
    });

    const ShowToast = (title) => {
        $.Toast.showToast({
            // toast message
            "title": title,
            "image": "../../assets/loadingIndicator/loading.png",
            "duration": 2000
        });
    }
    var isgoodnum = false;
    $('.stringOnly').on('input', function() {
        var node = $(this);
        node.val(node.val().replace(/[^a-zA-Z\s]/g, ''));
    });

    $('.numberOnly').on('input', function() {
        if (/\D/g.test(this.value)) {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });

    $('#f_phone_no').on('input', function() {
        var inputValue = $(this).val();
        if (inputValue.length > 11) {
            // Filter non-digits from input value.
            var filteredValue = inputValue.replace(/\D/g, '');
            // Truncate the value to 10 digits after filtering.
            $(this).val(filteredValue.substring(0, 10));
            toastr.warning('Phone number contain 11 digits only')
        } else {
            isgoodnum = true;
        }
    });




    $(document).ready(() => {
        // unseen message
        const user_id = $('#session_id').val();

        $.ajax({
            type: 'POST',
            url: '../../controller/unseen_msg.php',
            data: {
                id: user_id
            },
            success: function(res) {
                $('#msg_notif').text(res)
            }
        })


        var isBelowAge = false;
        var isBelowAge2 = false;


        $('#f_primary_birth').on('change', function() {
            var today = new Date();
            var f_primary_birth = $(this).val();

            // Split the input to extract year, month, and day
            var dobParts = f_primary_birth.split('-');
            var year = parseInt(dobParts[0], 10);
            var month = parseInt(dobParts[1], 10);
            var day = parseInt(dobParts[2], 10);

            var birthdate = new Date(year, month - 1, day); // Corrected the month value

            var ageDifference = today.getFullYear() - birthdate.getFullYear();

            console.log("DOB Parts: year=" + year + ", month=" + month + ", day=" + day);
            console.log("Birthdate:", birthdate);
            console.log("Age Difference:", ageDifference);

            if (ageDifference < 18 ||
                (ageDifference === 18 &&
                    (today.getMonth() < birthdate.getMonth() ||
                        (today.getMonth() === birthdate.getMonth() && today.getDate() < day)))) {
                isBelowAge = true;
            } else {
                isBelowAge = false;
            }
            console.log("isBelowAge:", isBelowAge);
        });
        $('#f_secondary_birth').on('change', function() {
            var today = new Date();
            var f_secondary_birth = $(this).val();

            // Split the input to extract year, month, and day
            var dobParts = f_secondary_birth.split('-');
            var year = parseInt(dobParts[0], 10);
            var month = parseInt(dobParts[1], 10);
            var day = parseInt(dobParts[2], 10);

            var birthdate = new Date(year, month - 1, day); // Corrected the month value

            var ageDifference = today.getFullYear() - birthdate.getFullYear();

            console.log("DOB Parts: year=" + year + ", month=" + month + ", day=" + day);
            console.log("Birthdate:", birthdate);
            console.log("Age Difference:", ageDifference);

            if (ageDifference < 18 ||
                (ageDifference === 18 &&
                    (today.getMonth() < birthdate.getMonth() ||
                        (today.getMonth() === birthdate.getMonth() && today.getDate() < day)))) {
                isBelowAge2 = true;
            } else {
                isBelowAge2 = false;
            }
            console.log("isBelowAge:", isBelowAge2);
        });

        // prompt form
        $('#modal1').modal('show');


        $('#next').on('click', () => {
            if (age >= 18) {
                var isBlank = true;
                $('.page1').each(function() {
                    if ($(this).val() !== '' && $('#f_date_of_birth').val() != '') {
                        isBlank = false
                    } else {
                        isBlank = true
                    }
                })

                if (isBlank) {
                    toastr.error('Please fill out all fields')
                } else {
                    $('#modal2').modal('show');
                    $('#modal1').modal('hide');
                }
            } else {
                toastr.error('Your age is not eligable to continue this membership registration')
            }


        });

        $('#prev').on('click', () => {
            $('#modal2').modal('hide');
            $('#modal1').modal('show');
        })
        $('#prev2').on('click', () => {
            $('#modal3').modal('hide');
            $('#modal2').modal('show');
        })
        $('#next2').on('click', () => {
            var isBlank = true;
            var tin_front = $('#tin_front')[0].files.length;
            var tin_back = $('#tin_back')[0].files.length;
            $('.page2').each(function() {
                if ($(this).val() !== '' && $('#f_father_birth').val() != '' && $('#f_date_grad').val() != '' && $('#f_mother_birth').val() != '' && tin_front !== 0 && tin_back !== 0) {
                    isBlank = false
                } else {
                    isBlank = true
                }
            });
            if (isBlank) {
                toastr.error('Please fill out all fields')
            } else {
                $('#modal2').modal('hide');
                $('#modal3').modal('show');
            }

        })
        $('#next3').on('click', () => {
            var isBlank = true;
            $('.page3').each(function() {
                if ($(this).val() !== '' && $('#f_primary').val() != '' && $('#f_secondary').val() != '') {
                    isBlank = false
                } else {
                    isBlank = true
                }
            });
            if (isBlank) {
                toastr.error('Please fill out all fields')
            } else {
                if (isBelowAge == true || isBelowAge2 == true) {
                    toastr.error('Beneficiaries must be 18 years or older to proceed.')
                } else {
                    $('#modal3').modal('hide');
                    $('#modal4').modal('show');
                }

            }

        });
        $('#prev3').on('click', () => {
            $('#modal4').modal('hide');
            $('#modal3').modal('show');
        });


        // check user status
        const user_status = $('#user_status').val();
        const user_reason = $('#user_reason').val();
        if (user_status == 2) {
            $('.grid-container').addClass('pendingModal');
            $('#pendingModal').modal('show')
        } else if (user_status == 4) {
            $('.grid-container').addClass('pendingModal');
            $('#reason').val(user_reason)
            $('#DeclinedModal').modal('show')
        }
        // exit
        $('.exit').on('click', () => {
            window.location = "../../controller/logout.php";
        })
        var isOverSize = false;

        const checkImageSize = (tin, error) => {
            tin.bind('change', function() {
                var size = (this.files[0].size)
                var type = (this.files[0].type)
                if (type == 'image/jpeg') {
                    var size_limit = 2097152; //bytes, total of 2 MB
                    if (size > size_limit) {
                        isOverSize = true;
                        error.attr('hidden', false)
                        $('#next2').attr('disabled', true);
                    } else {
                        error.attr('hidden', true)
                        $('#next2').attr('disabled', false);
                    }
                } else {
                    toastr.error('Please upload image only');
                    $('#next2').attr('disabled', true);
                }
            });
        }

        const error1 = $('#error1');
        const error2 = $('#error2');
        const front = $('#tin_front');
        const back = $('#tin_back');

        //front
        checkImageSize(front, error1);
        //back
        checkImageSize(back, error2);

        // form submit
        $('#form_submit').on('click', () => {

            const f_id = $('#f_id').val();
            const f_fname = $('#f_fname').val();
            const f_mname = $('#f_mname').val();
            const f_lname = $('#f_lname').val();
            const f_civil = $('#f_civil option:selected').val();
            const f_sex = $('#f_sex').val();
            const f_height = $('#f_height').val();
            const f_weight = $('#f_weight').val();
            const f_phone_no = $('#f_phone_no').val();
            const f_residence = $('#f_residence').val();
            const f_place_of_birth = $('#f_place_of_birth').val();
            const f_date_of_birth = $('#f_date_of_birth').val();
            const f_age = $('#f_age').val();
            const f_father_name = $('#f_father_name').val();
            const f_father_birth = $('#f_father_birth').val();
            const f_educ_attain = $('#f_educ_attain').val();
            const f_school = $('#f_school').val();
            const f_date_grad = $('#f_date_grad').val();
            const f_real_prop = $('#f_real_prop').val();
            const f_mother_name = $('#f_mother_name').val();
            const f_mother_birth = $('#f_mother_birth').val();
            const f_emp_business = $('#f_emp_business').val();
            const f_tin = $('#f_tin').val();
            const f_ctc = $('#f_ctc').val();
            const arb = $("input[name='btnradio']:checked").val();
            const f_no_of_dep = $('#f_no_of_dep').val();
            const f_elementary = $('#f_elementary').val();
            const f_hs = $('#f_hs').val();
            const f_college = $('#f_college').val();
            const f_primary = $('#f_primary').val();
            const f_primary_birth = $('#f_primary_birth').val();
            const f_secondary = $('#f_secondary').val();
            const f_secondary_birth = $('#f_secondary_birth').val();
            const f_spouse_name = $('#f_spouse_name').val();
            const f_reg_aff = $('#f_reg_aff').val();
            const crime = $("input[name='flexRadioDefault']:checked").val();
            const f_spouse_place = $('#f_spouse_place').val();
            const f_spouse_birth = $('#f_spouse_birth').val();
            const f_spouse_age = $('#f_spouse_age').val();
            const f_spouse_father_name = $('#f_spouse_father_name').val();
            const f_spouse_mother_name = $('#f_spouse_mother_name').val();
            const f_person1 = $('#f_person1').val();
            const f_person2 = $('#f_person2').val();

            var file_data = $('#tin_front').prop('files')[0];
            var form_data = new FormData();
            form_data.append('files', file_data);
            var file_data2 = $('#tin_back').prop('files')[0];
            var form_data2 = new FormData();
            form_data2.append('files', file_data2);

            const mydata = `id=${f_id}&firstname=${f_fname}&middle_name=${f_mname}&lastname=${f_lname}&civil=${f_civil}&sex=${f_sex}&height=${f_height}&weight=${f_weight}&phone_no=${f_phone_no}&residence=${f_residence}&place_of_birth=${f_place_of_birth}&date_of_birth=${f_date_of_birth}&age=${f_age}&father_name=${f_father_name}&father_birth=${f_father_birth}&educ_attain=${f_educ_attain}&school=${f_school}&date_grad=${f_date_grad}&real_prop=${f_real_prop}&mother_name=${f_mother_name}&mother_birth=${f_mother_birth}&emp_business=${f_emp_business}&tin=${f_tin}&ctc=${f_ctc}&arb=${arb}&no_of_dep=${f_no_of_dep}&elementary=${f_elementary}&hs=${f_hs}&college=${f_college}&primary=${f_primary}&primary_birth=${f_primary_birth}&secondary=${f_secondary}&secondary_birth=${f_secondary_birth}&spouse_name=${f_spouse_name}&reg_aff=${f_reg_aff}&crime=${crime}&spouse_place=${f_spouse_place}&spouse_birth=${f_spouse_birth}&spouse_age=${f_spouse_age}&spouse_father_name=${f_spouse_father_name}&spouse_mother_name=${f_spouse_mother_name}&person1=${f_person1}&person2=${f_person2}`;


            const allValuesNotEmpty = checkAllValuesNotEmpty(mydata);

            if (allValuesNotEmpty) {
                if (file_data && file_data2) {
                    $.ajax({
                        type: 'POST',
                        url: '../../controller/save_member_details.php',
                        data: mydata,
                        success: function(res) {
                            if (res > 0) {
                                $.ajax({
                                    type: 'POST',
                                    url: `../../controller/upload_tin_front.php?id=${f_id}`, //id of last save
                                    data: form_data,
                                    contentType: false,
                                    cache: true,
                                    processData: false,
                                    success: function(res) {
                                        if (res > 0) {
                                            $.ajax({
                                                type: 'POST',
                                                url: `../../controller/upload_tin_back.php?id=${f_id}`, //id of last save
                                                data: form_data2,
                                                contentType: false,
                                                cache: true,
                                                processData: false,
                                                success: function(res2) {
                                                    if (res2 > 0) {
                                                        toastr.success('Thank you for submitting your form. Your request is now being reviewed. You will receive an SMS message once it has been approved.');
                                                        // logout after 6 seconds
                                                        setTimeout(() => {
                                                            window.location = "../../controller/logout.php";
                                                        }, 6000)
                                                    }
                                                }
                                            })
                                        }
                                    }
                                })

                            }
                        }
                    })
                }
            } else {
                toastr.error("Please input required field");
            }
        });

        function checkAllValuesNotEmpty(dataString) {
            const values = dataString.split('&');
            for (const keyValue of values) {
                const [key, value] = keyValue.split('=');
                if (!value) {
                    return false; // At least one value is empty
                }
            }
            return true; // All values have content
        }
    });
</script>