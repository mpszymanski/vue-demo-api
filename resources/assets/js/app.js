require('./bootstrap');

$(function () {
	$('.delete-action').on('click', function(event) {
		event.preventDefault()
		let decision = confirm('Are you sure, you want remove this receipt?')
		if(decision) {
			console.log($(this))
			$(this).parent('form').submit()
		}
	})
})