var vueRecruitment;
var Recruitment = function() {
    var handleValidationAddPage = function() {
        $('.js-frm-create-recruitment, .js-frm-edit-recruitment').validate({
            doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                person_name: {
                    required: true
                },
                position: {
                    required: true
                },
                date_of_interview: {
                    required: true
                },
                time_of_interview: {
                    required: true
                },
                assigned_to :{
                    required: true
                },
                last_status: {
                    required: true
                },
                area_of_interest: {
                    required: true
                },
                how_did_you: {
                    required: true
                },
                remarks: {
                    required: true
                },
                contact_no: {
                    required: true
                },
                current_salary: {
                    required: true
                },
                expected_salary: {
                    required: true
                },
                notice_period: {
                    required: true
                },
                date_of_joining: {
                    required: true
                },
                preferred_location: {
                    required: true
                },
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                if(element.prop('nodeName') == "SELECT") {
                    element.parent().parent().parent().append(error);
                } else {
                    element.parent().parent().append(error);
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    };
    return {
        init: function() {
            handleValidationAddPage();
        }
    }
}();

$(document).ready(function() {
    Recruitment.init();
    $(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vueRecruitment.recruitmentListData(1, vueRecruitment.sortby, vueRecruitment.sorttype, vueRecruitment.searchdata);
    });

    $(document).on('click', '.js-recruitment-detail', function(){
        var data={};
        ajaxCall($(this).data("url"), data, 'GET', 'json', recruitmentDetailSuccess);
    });

    function getRecruitmentData() {
        vueRecruitment = new Vue({
            el: "#recruitmentList",
            data: {
                recruitmentData: [],
                recruitmentCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: '',
                sorttype: '',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.recruitmentListData();
            },
            methods: {
                recruitmentListData: function(page, sortby, sorttype, searchdata) {
                    if(typeof(sortby) == "undefined"){
                        sortby = this.sortby;
                        sorttype = this.sorttype;
                    } else {
                        this.sortby = sortby;
                        this.sorttype = sorttype;
                    }

                    var data = "sortby="+sortby + "&sorttype=" + sorttype;

                    if(typeof(searchdata) != "undefined") {
                        data += searchdata;
                    }

                    data += setPaginationAmount();

                    if(typeof(page) == "undefined"){
                        ajaxCall("getRecruitmentData", data, 'POST', 'json', recruitmentDataSuccess);
                    } else {
                        ajaxCall("getRecruitmentData?page="+page, data, 'POST', 'json', recruitmentDataSuccess);
                    }
                },
                searchRecruitmentData: function() {
                    var person_name = $("#person_name").val();
                    var position = $("#position").val();
                    var last_status = $("#last_status").val();
                    var searchdata = "&person_name="+ person_name + "&position=" + position + "&last_status=" + last_status;
                    if($('#recruitment_pagination').data("twbs-pagination")){
                        $('#recruitment_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.recruitmentListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.recruitmentListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueRecruitment);
                    this.recruitmentListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                }
            }
        });
    }
    getRecruitmentData();
})

function recruitmentDataSuccess(recruitmentData, status, xhr){
    vueRecruitment.$set('recruitmentData', recruitmentData['data']);
    vueRecruitment.$set('recruitmentCount', recruitmentData['data'].length);

    setTimeout(function(){
        if(recruitmentData['data'].length > 0 && Cookies.get('pagination_length') > 0) {
            vueRecruitment.$set('currPage', recruitmentData.current_page);
            current_page = recruitmentData.current_page;

            if(current_page == 1) {
                $('#recruitment_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = recruitmentData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueRecruitment.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#recruitment_pagination').twbsPagination({
                  totalPages: recruitmentData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueRecruitment.recruitmentListData(page, vueRecruitment.sortby, vueRecruitment.sorttype, vueRecruitment.searchdata);
                  }
                });
                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), recruitmentData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueRecruitment.$set('page_index', 1);
            setPaginationRecords(1, recruitmentData.total, recruitmentData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#recruitment_pagination').data("twbs-pagination")){
                $('#recruitment_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}

function recruitmentDetailSuccess(response, status, xhr) {
    $(".js-recruitment-detail-content").html(response.recruitmentDetailHtml);
}