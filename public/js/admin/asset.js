var Asset =  function(){
   var handleValidationAddPage = function() {
    $('.js-frm-create-asset, .js-frm-edit-asset').validate({
        rules: {
            desk_name: {
                required: true
            },
            ip_address: {
                required: true
            },
            keyboard_name: {
                required: true
            },
            mouse_name: {
            	required: true
            },
            manufacture_name: {
            	required:true
            },
           	asset_price: {
           		required:true
           	},
           	motherboard_model: {
           		required: true
           	},
           	processor: {
           		required:true
           	},
           	hdd: {
           		required:true
           	},
           	os_version: {
           		required:true
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
    Asset.init();

    $(document).on('click', '.js-asset-detail', function(){
        var data={};
        ajaxCall($(this).data("url"), data, 'GET', 'json', assetDetailSuccess);
    });


    function getAssetData() {
    	vueAsset = new Vue({
    		el: "#assetList",
    		data: {
    			assetData: [],
                assetCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: '',
                sorttype: '',
                searchdata: '',
    		},
    		ready: function() {
                this.assetListData();
            },
            methods: {

            	 assetListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("getAssetData", data, 'POST', 'json', assetDataSuccess);
                    } else {
                        ajaxCall("getAssetData?page="+page, data, 'POST', 'json', assetDataSuccess);
                    }
                },
                 searchAssetData: function() {
                    var desk_name = $("#desk_name").val();
                    var ip_address = $("#ip_address").val();
                    var manufacture_name = $("#manufacture_name").val();
                    var asset_price = $("#asset_price").val();
                    var searchdata = "&desk_name="+ desk_name + "&ip_address=" + ip_address + "&manufacture_name=" + manufacture_name + "&asset_price=" + asset_price;
                    if($('#asset_pagination').data("twbs-pagination")){
                        $('#asset_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.assetListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.assetListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueClient);
                    this.assetListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                }
            }
    	});
    }
    getAssetData();
    setTimeout(function(){
        $('.alert-success').slideUp();
      }, 5000);
});

function assetDataSuccess(assetData, status, xhr){
    vueAsset.$set('assetData', assetData['data']);
    vueAsset.$set('assetCount', assetData['data'].length);

    setTimeout(function(){
        if(assetData['data'].length>0 && Cookies.get('pagination_length') > 0) {
            
            vueAsset.$set('currPage', assetData.current_page);
            current_page = assetData.current_page;

            if(current_page == 1) {
                $('#asset_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = assetData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueAsset.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#asset_pagination').twbsPagination({
                  totalPages: assetData.last_page,
                  visiblePages: 10,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueAsset.assetListData(page, vueAsset.sortby, vueAsset.sorttype, vueAsset.searchdata);
                  }
                });
                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), assetData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueAsset.$set('page_index', 1);
            setPaginationRecords(1, assetData.total, assetData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#asset_pagination').data("twbs-pagination")){
                $('#asset_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}

function assetDetailSuccess(response, status, xhr) {
    $(".js-asset-detail-content").html(response.assetDetailHtml);
}


