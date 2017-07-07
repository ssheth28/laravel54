var vueDepartment;

var createDepartment = function() {
    var handleValidationAddPage = function() {
        $('.js-frm-create-department').validate({
            rules: {
                department_name: {
                    required: true
                }
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

var editDepartment = function() {
    var handleValidationAddPage = function() {
        $('.js-frm-edit-department').validate({
            rules: {
                department_name: {
                    required: true
                }
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
    createDepartment.init();
    editDepartment.init();

	$(document).on('click', '.js-edit-department', function(e){
		 var department = $(this).data('department');
		 var action = $(this).data('url');
		 $('#department_name').val(department);
		 $(".js-edit-modal-form").prop('action', action);
	});

    $(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vueDepartment.departmentListData(1, vueDepartment.sortby, vueDepartment.sorttype, vueDepartment.searchdata);
    });

	function getDepartmentData() {
        vueDepartment = new Vue({
            el: "#departmentsList",
            data: {
                DepartmentData: [],
                departmentCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: '',
                sorttype: '',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.departmentListData();
            },
            methods: {
                departmentListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("getDepartmentData", data, 'POST', 'json', departmentDataSuccess);
                    } else {
                        ajaxCall("getDepartmentData?page="+page, data, 'POST', 'json', departmentDataSuccess);
                    }
                },
                searchDepartmentData: function() {

                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.departmentListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueDepartment);
                    this.departmentListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                },
            }
        });
    }

    getDepartmentData();
});

function departmentDataSuccess(departmentData, status, xhr){
    vueDepartment.$set('departmentData', departmentData['data']);
    vueDepartment.$set('departmentCount', departmentData['data'].length);

    setTimeout(function(){
        if(departmentData['data'].length>0 && Cookies.get('pagination_length') > 0) {
            vueDepartment.$set('currPage', departmentData.current_page);
            current_page = departmentData.current_page;

            if(current_page == 1) {
                $('#department_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = departmentData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueDepartment.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#department_pagination').twbsPagination({
                  totalPages: departmentData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueDepartment.departmentListData(page, vueDepartment.sortby, vueDepartment.sorttype, vueDepartment.searchdata);
                  }
                });
                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), departmentData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueDepartment.$set('page_index', 1);
            setPaginationRecords(1, departmentData.total, departmentData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#department_pagination').data("twbs-pagination")){
                $('#department_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}