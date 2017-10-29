$(document).ready ->

	# Categories
	$('.categories__link').click ->
		id = $(@).data('id')

		$().setGetParams({
			'search': '',
			'page': 1,
			'category': id
		})
		return

	# Search
	$('input[name=search]').keyup (e) ->
		query = $(@).val()

		if e.keyCode == 13
			if query.length
				$().setGetParams({
					'search': query,
					'page': 1
				})
		return

	# Sorting
	$('select[name=sort]').change ->
		sort = $(@).val()

		$().setGetParams({
			'page': 1,
			'sort': sort
		})
		return

	# Count
	$('select[name=count]').change ->
		count = $(@).val()

		$().setGetParams({
			'page': 1,
			'count': count
		})
		return

	# Pagination
	$('.pagination__link').click ->
		page = $(@).data('page')

		$().setGetParams({
			'page': page
		})
		return

	return
