/*$('.btn-select-company').click(function() {
    var selected = $('#user_company_roles option:selected');
    alert(selected); 
});​*/
$('.btn-select-company').click(function(){
	console.log("aaa");
	var companyId = $(this).data('company-id');
	var companySlug = $(this).data('company-slug');
	$.ajax({
    	type: "POST",
    	url: "companyselect",
    	headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    	data: {'companyslug': companySlug, 'roleid': $("#user_company_roles_" + companyId).val()},
    	success: function(result){
    		window.location.href = result.redirecturl;
	    }
	});
});