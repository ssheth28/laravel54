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
                element.parent().parent().append(error);
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
        vueRecruitment.clientListData(1, vueRecruitment.sortby, vueRecruitment.sorttype, vueRecruitment.searchdata);
    });

    $(document).on('click', '.js-client-detail', function(){
        var data={};
        ajaxCall($(this).data("url"), data, 'GET', 'json', clientDetailSuccess);
    });

    function getClientData() {
        vueRecruitment = new Vue({
            el: "#clientlist",
            data: {
                clientData: [],
                clientCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: '',
                sorttype: '',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.clientListData();
            },
            methods: {
                clientListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("getClientData", data, 'POST', 'json', clientDataSuccess);
                    } else {
                        ajaxCall("getClientData?page="+page, data, 'POST', 'json', clientDataSuccess);
                    }
                },
                searchClientData: function() {
                    var name = $("#name").val();
                    var email = $("#email").val();
                    var skype = $("#skype").val();
                    var country = $("#country").val();
                    var industry = $("#industry").val();
                    var searchdata = "&name="+ name + "&email=" + email + "&skype=" + skype + "&country="+ country + "&industry=" + industry;
                    if($('#user_pagination').data("twbs-pagination")){
                        $('#user_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.clientListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.clientListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueRecruitment);
                    this.clientListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                }
            }
        });
    }
    getClientData();
})

function clientDataSuccess(clientData, status, xhr){
    vueRecruitment.$set('clientData', clientData['data']);
    vueRecruitment.$set('clientCount', clientData['data'].length);

    setTimeout(function(){
        if(clientData['data'].length > 0 && Cookies.get('pagination_length') > 0) {
            vueRecruitment.$set('currPage', clientData.current_page);
            current_page = clientData.current_page;

            if(current_page == 1) {
                $('#client_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = clientData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueRecruitment.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#client_pagination').twbsPagination({
                  totalPages: clientData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueRecruitment.clientListData(page, vueRecruitment.sortby, vueRecruitment.sorttype, vueRecruitment.searchdata);
                  }
                });
                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), clientData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueRecruitment.$set('page_index', 1);
            setPaginationRecords(1, clientData.total, clientData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#client_pagination').data("twbs-pagination")){
                $('#client_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}

function clientDetailSuccess(response, status, xhr) {
    $(".js-client-detail-content").html(response.clientDetailHtml);
}