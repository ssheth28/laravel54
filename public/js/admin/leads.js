var vueLead;
var Lead = function() {
    var handleValidationAddPage = function() {
        $('.js-frm-create-lead, .js-frm-edit-lead').validate({
            rules: {
                lead_name: {
                    required: true
                },
                email: {
                    required: true
                },
                contact_no: {
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
    Lead.init();
    $(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vueLead.leadListData(1, vueLead.sortby, vueLead.sorttype, vueLead.searchdata);
    });


    $(document).on('click', '.js-lead-detail', function(){
        var data={};
        ajaxCall($(this).data("url"), data, 'GET', 'json', leadDetailSuccess);
    });  

    function getLeadData() {
        vueLead = new Vue({
            el: "#leadList",
            data: {
                leadData: [],
                leadCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: '',
                sorttype: '',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.leadListData();
            },
            methods: {
                leadListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("getLeadsData", data, 'POST', 'json', leadDataSuccess);
                    } else {
                        ajaxCall("getLeadsData?page="+page, data, 'POST', 'json', leadDataSuccess);
                    }
                },
                searchLeadData: function() {
                    var lead_name = $("#lead_name").val();
                    var lead_email = $("#lead_email").val();
                    var country = $("#country").val();
                    var searchdata = "&lead_name="+ lead_name + "&lead_email="+ lead_email + "&country="+ country;
                    if($('#lead_pagination').data("twbs-pagination")){
                        $('#lead_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.leadListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.leadListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueLead);
                    this.leadListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                }
            }
        });
    }
    getLeadData();
})

function leadDataSuccess(leadData, status, xhr){
    vueLead.$set('leadData', leadData['data']);
    vueLead.$set('leadCount', leadData['data'].length);

    setTimeout(function(){
        if(leadData['data'].length > 0 && Cookies.get('pagination_length') > 0) {
            vueLead.$set('currPage', leadData.current_page);
            current_page = leadData.current_page;

            if(current_page == 1) {
                $('#lead_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = leadData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueLead.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#lead_pagination').twbsPagination({
                  totalPages: leadData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueLead.leadListData(page, vueLead.sortby, vueLead.sorttype, vueLead.searchdata);
                  }
                });
                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), leadData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueLead.$set('page_index', 1);
            setPaginationRecords(1, leadData.total, leadData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#lead_pagination').data("twbs-pagination")){
                $('#lead_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}

function leadDetailSuccess(response, status, xhr) {
    $(".js-lead-detail-content").html(response.leadDetailHtml);
}