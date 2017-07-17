var vueProject;
var project = function() {
    var handleValidation = function() {
        $('.js-frm-create-project, .js-frm-edit-project').validate({
            rules: {
                project_name: {
                    required: true
                },
                project_tech: {
                    required: true
                },
                project_type: {
                    required: true
                },
                client_name: {
                    required: true
                },
                project_member: {
                    required: true
                },
                start_date :{
                    required: true
                },
                end_date: {
                    required: true
                },
                project_status : {
                    required: true
                },
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                console.log(element.prop('nodeName'));
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
            handleValidation();
        }
    }
}();

$(document).ready(function() {
    project.init();

	$(document).on('click', '.js-edit-techology', function(e){
		 var technology = $(this).data('technology');
		 var action = $(this).data('url');
		 $('#technology_name').val(technology.name);
		 $(".js-edit-modal-form").prop('action', action);
	});

	$(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vueProject.projectListData(1, vueProject.sortby, vueProject.sorttype, vueProject.searchdata);
    });

    $(document).on('click', '.js-project-detail', function(){
        console.log('here');
        var data={};
        ajaxCall($(this).data("url"), data, 'GET', 'json', projectDetailSuccess);
    });    

	function getProjectData() {
        vueProject = new Vue({
            el: "#projectList",
            data: {
                ProjectData: [],
                projectCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: '',
                sorttype: '',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.projectListData();
            },
            methods: {
                projectListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("getProjectData", data, 'POST', 'json', projectDataSuccess);
                    } else {
                        ajaxCall("getProjectData?page="+page, data, 'POST', 'json', projectDataSuccess);
                    }
                },
                searchProjectData: function() {
                    var name= $("#name").val();
                    var searchdata = "&name="+ name;
                    if($('#project_pagination').data("twbs-pagination")){
                        $('#project_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.projectListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.projectListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueProject);
                    this.projectListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                },
            }
        });
    }

    getProjectData();
});

function projectDataSuccess(projectData, status, xhr){
    console.log(projectData['data'].length);
    vueProject.$set('projectData', projectData['data']);
    vueProject.$set('projectCount', projectData['data'].length);

    setTimeout(function(){
        if(projectData['data'].length>0 && Cookies.get('pagination_length') > 0) {
            vueProject.$set('currPage', projectData.current_page);
            current_page = projectData.current_page;

            if(current_page == 1) {
                $('#project_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = projectData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueProject.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#project_pagination').twbsPagination({
                  totalPages: projectData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueProject.projectListData(page, vueProject.sortby, vueProject.sorttype, vueProject.searchdata);
                  }
                });
                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), projectData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueProject.$set('page_index', 1);
            setPaginationRecords(1, projectData.total, projectData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#project_pagination').data("twbs-pagination")){
                $('#project_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}

function projectDetailSuccess(response, status, xhr) {
    $(".js-project-detail-content").html(response.projectDetailHtml);
}