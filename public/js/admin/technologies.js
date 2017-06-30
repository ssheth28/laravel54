var vueTechnology;

var createTechnology = function() {
    var handleValidationAddPage = function() {
        $('.js-frm-create-technology').validate({
            rules: {
                technology_name: {
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

var editTechnology = function() {
    var handleValidationAddPage = function() {
        $('.js-frm-edit-technology').validate({
            rules: {
                technology_name: {
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

    createTechnology.init();
    editTechnology.init();

	$(document).on('click', '.js-edit-techology', function(e){
		 var technology = $(this).data('technology');
		 var action = $(this).data('url');
		 $('#technology_name').val(technology);
		 $(".js-edit-modal-form").prop('action', action);
	});

	function getTechnologiesData() {
        vueTechnology = new Vue({
            el: "#technologiesList",
            data: {
                technologyData: [],
                technologyCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: '',
                sorttype: '',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.technologyListData();
            },
            methods: {
                technologyListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("getTechnologyData", data, 'POST', 'json', technologyDataSuccess);
                    } else {
                        ajaxCall("getTechnologyData?page="+page, data, 'POST', 'json', technologyDataSuccess);
                    }
                },
                searchTechnologyData: function() {

                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.technologyListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueTechnology);
                    this.technologyListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                },
            }
        });
    }

    getTechnologiesData();
});

function technologyDataSuccess(technologyData, status, xhr){
    vueTechnology.$set('technologyData', technologyData['data']);
    vueTechnology.$set('technologyCount', technologyData['data'].length);

    setTimeout(function(){
        if(technologyData['data'].length>0 && Cookies.get('pagination_length') > 0) {
            vueTechnology.$set('currPage', technologyData.current_page);
            current_page = technologyData.current_page;

            if(current_page == 1) {
                $('#technology_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = technologyData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueTechnology.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#technology_pagination').twbsPagination({
                  totalPages: technologyData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueTechnology.technologyListData(page, vueTechnology.sortby, vueTechnology.sorttype, vueTechnology.searchdata);
                  }
                });
                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), technologyData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueTechnology.$set('page_index', 1);
            setPaginationRecords(1, technologyData.total, technologyData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#technology_pagination').data("twbs-pagination")){
                $('#technology_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}