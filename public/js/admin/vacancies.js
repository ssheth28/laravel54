var vueVacancy;
var Vacancy = function() {
    var handleValidationAddPage = function() {
        $('.js-frm-create-vacancy, .js-frm-edit-vacancy').validate({
            rules: {
                position_name: {
                    required: true
                },
                department_name: {
                    required: true
                },
                no_of_vacancies: {
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
    Vacancy.init();
    $(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vueVacancy.vacancyListData(1, vueVacancy.sortby, vueVacancy.sorttype, vueVacancy.searchdata);
    });

    function getVacancyData() {
        vueVacancy = new Vue({
            el: "#vacancyList",
            data: {
                vacancyData: [],
                vacancyCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: '',
                sorttype: '',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.vacancyListData();
            },
            methods: {
                vacancyListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("getVacanciesData", data, 'POST', 'json', vacancyDataSuccess);
                    } else {
                        ajaxCall("getVacanciesData?page="+page, data, 'POST', 'json', vacancyDataSuccess);
                    }
                },
                searchVacancyData: function() {
                    var position_name = $("#position_name").val();
                    var searchdata = "&position_name="+ position_name;
                    if($('#vacancy_pagination').data("twbs-pagination")){
                        $('#vacancy_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.vacancyListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.vacancyListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueVacancy);
                    this.vacancyListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                }
            }
        });
    }
    getVacancyData();
})

function vacancyDataSuccess(vacancyData, status, xhr){
    vueVacancy.$set('vacancyData', vacancyData['data']);
    vueVacancy.$set('vacancyCount', vacancyData['data'].length);

    setTimeout(function(){
        if(vacancyData['data'].length > 0 && Cookies.get('pagination_length') > 0) {
            vueVacancy.$set('currPage', vacancyData.current_page);
            current_page = vacancyData.current_page;

            if(current_page == 1) {
                $('#vacancy_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = vacancyData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueVacancy.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#vacancy_pagination').twbsPagination({
                  totalPages: vacancyData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueVacancy.vacancyListData(page, vueVacancy.sortby, vueVacancy.sorttype, vueVacancy.searchdata);
                  }
                });
                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), vacancyData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueVacancy.$set('page_index', 1);
            setPaginationRecords(1, vacancyData.total, vacancyData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#vacancy_pagination').data("twbs-pagination")){
                $('#vacancy_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}