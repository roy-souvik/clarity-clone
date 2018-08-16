/**
 * The js for category CRUD, interactions
 */
$(document).ready(function() {
	$('#category-name').focus();
	// Click handler for parent category selection while adding a new category
	$('.category').click(function(event){
		event.preventDefault();
		var parentId = $(this).attr('id');
		var parentLabel = $(this).text();
		$('#parent-category-id').attr('value', parentId);
		$('#parent-category-name').text(parentLabel);
		$('#category-name').focus();
	});

	// Commenting out the feature : will be opened when needed
	// 
	// function removeCategory(category_id, element){
	// 	var baseUrl = $('#baseUrl').val();
	// 	$.ajax({
	// 		type: "GET",
	// 		url : baseUrl + '/admin/removeCategory',
	// 		data: {
	// 			 id  : category_id
	// 		},
	// 		beforeSend: function( ) {
	// 		},
	// 		success : function(data){
	// 			toastClear();
	// 			if(data == 1) {
	// 				element.parent().slideUp('normal');
	// 				if ($('#parent-category-id').val() == category_id) {
	// 					populateFormWithFirstLevelCategory();
	// 				}
	// 				toastSuccess('Category deleted');
	// 				return false;
	// 			}
	// 			toastError('Unable to delete category.<br>Verify it has any child or not.');
	// 		}
	// 	});
	// }
	//
	// $('.remove-category').click(function(){
	// 	var category_id	=	$(this).data('categoryid');
	// 	removeCategory(category_id, $(this));
	// });
	//
	// function populateFormWithFirstLevelCategory() {
	// 	$('#parent-category-id').attr('value', 2);
	// 	$('#parent-category-name').text('Business');
	// 	$('#category-name').focus();
	// }

});
